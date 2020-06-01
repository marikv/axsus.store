<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    /**
     * @param Request $request
     */
    public function addItem(Request $request)
    {
        if ($request->route('id') && $request->post('id')) {

            $product = Product::where('id', $request->post('id'))->first();
            if ($product) {
                $model = Cart::where('cart_id', $request->route('id'))
                    ->whereNull('deleted')
                    ->whereNull('bought')
                    ->where('product_id', $request->post('id'))
                    ->where('price', $product->price)
                    ->first();
                if ($model) {
                    $model->count = intval($model->count) + intval($request->post('count'));
                } else {
                    $model = new Cart();
                    $model->count = intval($request->post('count'));
                    $model->product_id = $request->post('id');
                    $model->cart_id = $request->route('id');
                    $model->price = $product->price;
                }
                $model->save();
            }
        }
    }

    public function deleteItem(Request $request)
    {
        if ($request->method() === 'DELETE' && $request->route('id') && $request->post('id')) {
            $model = Cart::where('cart_id', $request->route('id'))
                ->where('id', $request->post('id'))
                ->first();
            if ($model) {
                $model->deleted = 1;
                $model->save();
            }
        }
    }

    public function getItems(Request $request)
    {
        $model = Cart::select('product_id', 'count', 'price')
            ->with('product')
            ->where('cart_id', $request->route('id'))
            ->whereNull('bought')
            ->whereNull('deleted')
            ->get()
            ->toArray();

        return response()->json(['success' => true, 'data' => $model]);
    }


    public function addOrder(Request $request)
    {
        $cart_id = $request->route('id');
        if ($request->method() === 'POST' && $cart_id && $request->post('email')) {
            $cartWithProductExist = Cart::where('cart_id', $cart_id)
                ->whereNull('deleted')
                ->whereNull('bought')
                ->first();
            $name = $request->post('name') ? $request->post('name') : '';
            $email = $request->post('email') ? $request->post('email') : '';
            if ($cartWithProductExist) {
                if (Auth::guest()) {
                    $checkUserExist = User::where('email', $email)
                        ->whereNull('deleted')
                        ->first();
                    if ($checkUserExist) {
                        return response()->json(['success' => false, 'data' => 'userExist']);
                    }

                    $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890');
                    $password = substr($random, 0, 8);
                    $user = User::create([
                        'name' => $name ?? explode('@', $email)[0],
                        'email' => $email,
                        'password' => Hash::make($password),
                    ]);
                    Auth::login($user, true);
                    $this->sendAutoRegisterEmail($password);
                }
                $userModel = Auth::user();
                if ($request->post('phone')) {
                    $userModel->phone = $request->post('phone');
                }
                if ($name) {
                    $userModel->name = $name;
                }
                if ($request->post('inn')) {
                    $userModel->inn = $request->post('inn');
                }
                if ($request->post('kpp')) {
                    $userModel->kpp = $request->post('kpp');
                }
                if ($request->post('contactnoe_lico')) {
                    $userModel->contactnoe_lico = $request->post('contactnoe_lico');
                }
                if ($request->post('raschetnyi_schet')) {
                    $userModel->raschetnyi_schet = $request->post('raschetnyi_schet');
                }
                if ($request->post('city')) {
                    $userModel->city = $request->post('city');
                }
                if ($request->post('address')) {
                    $userModel->address = $request->post('address');
                }
                $userModel->save();

                $orderModel = new Order();
                $orderModel->user_id = $userModel->id;
                $orderModel->cart_id = $cart_id;
                $orderModel->type = $request->post('type');
                $orderModel->email = $email;
                $orderModel->phone = $userModel->phone;//$request->post('phone');
                $orderModel->name = $userModel->name;//$name;
                $orderModel->inn = $userModel->inn;//$request->post('inn');
                $orderModel->kpp = $userModel->kpp;//$request->post('kpp');
                $orderModel->contactnoe_lico = $userModel->contactnoe_lico;// $request->post('contactnoe_lico');
                $orderModel->raschetnyi_schet = $userModel->raschetnyi_schet;//$request->post('raschetnyi_schet');
                $orderModel->city = $userModel->city;//$request->post('city');
                $orderModel->address = $userModel->address;
                $orderModel->comment = $request->post('comment');
                $orderModel->discount = 0;
                $orderModel->sum = 0;
                $orderModel->is_new = 1;
                $orderModel->save();

                $cartModels = Cart::select('id', 'product_id', 'count', 'price')
                    ->with('product')
                    ->where('cart_id', $cart_id)
                    ->whereNull('bought')
                    ->whereNull('deleted')
                    ->get();
                /* @var $cartModel Cart */
                $orderProductModels = [];
                foreach ($cartModels as $cartModel) {

                    $orderModel->sum += (float)$cartModel->price * (float)$cartModel->count;

                    $orderProductModel = new OrderProduct();
                    $orderProductModel->product_id = $cartModel->product_id;
                    $orderProductModel->price = $cartModel->price;
                    $orderProductModel->count = $cartModel->count;
                    $orderProductModel->order_id = $orderModel->id;
                    $orderProductModel->save();

                    $cartModelNew = Cart::find($cartModel->id);
                    $cartModelNew->bought = 1;
                    $cartModelNew->user_id = $userModel->id;
                    $cartModelNew->save();

                    $orderProductModels[] = $orderProductModel;
                }

                $invoicePath = '';
                $contractPath = '';
                if ($orderModel->inn && $orderModel->kpp) {
                    $invoicePath = $this->generateInvoicePdf(Auth::user(), $orderModel);
                    $contractPath = 'licence_contract_AXSUS_PROJECTS.doc';
                }
                $this->sendOrderEmail($orderModel, $orderProductModels, $invoicePath, $contractPath);


                if ($orderModel->save()) {
                    return response()->json(['success' => true, 'data' => 'success']);
                }
            }
        }
    }


    public function getInvoicePdf(Request $request)
    {

        $order_id = $request->route('id');

        if (!Auth::guest() && $order_id) {
            $orderModel = Order::findOrFail($order_id);
            if ($orderModel->user_id === Auth::user()->id) {

                $pathWithoutStorage = DIRECTORY_SEPARATOR . 'invoices' . DIRECTORY_SEPARATOR . $order_id .'.pdf';
                $path = storage_path() . $pathWithoutStorage;

                if (file_exists($path) && !$request->get('generate')) {
                    $invoicePath = $pathWithoutStorage;
                } else {
                    $invoicePath = $this->generateInvoicePdf(Auth::user(), $orderModel);
                }

                $content = file_get_contents(storage_path() . $invoicePath);

                header('Content-Type: application/pdf');
                header('Content-Length: ' . strlen($content));
                header('Content-Disposition: inline; filename="'.$order_id.'.pdf"');
                header('Cache-Control: private, max-age=0, must-revalidate');
                header('Pragma: public');
                ini_set('zlib.output_compression','0');

                die($content);
            }
        }
    }

}
