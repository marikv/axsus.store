<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PDF;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected function standartPagination($s, Request $request)
    {

        if ($request->pagination['sortBy']) {
            $s = $s->orderBy(
                (string)($request->pagination['sortBy']),
                (boolean)($request->pagination['descending']) ? 'desc' : 'asc'
            );
        } else {
            $s = $s->orderBy('order_by', 'asc')->orderBy('id', 'desc');
        }

        if ($request->pagination['rowsPerPage'] > 0) {
            $s = $s->paginate($request->pagination['rowsPerPage'], ['*'], 'page', $request->pagination['page']);
        } else {
            $s = $s->paginate(50);
        }
        return $s;
    }


    protected function sendAutoRegisterEmail($password)
    {
        if (!Auth::guest()) {

            $details = [
                'type' => 'register',
                'password' => $password,
            ];

            Mail::to(Auth::user()->email)->send(new \App\Mail\StoreSendMail($details));
        }
    }

    /**
     * @param Order $orderModel
     * @param array $orderProductModels
     * @param string $invoicePath
     * @param string $contractPath
     */
    protected function sendOrderEmail(Order $orderModel, array $orderProductModels, string $invoicePath = '', string $contractPath = '')
    {
        if (!Auth::guest()) {
            $details = [
                'type' => 'order',
                'order' => $orderModel,
                'orderProducts' => $orderProductModels,
                'invoicePath' => $invoicePath ? storage_path($invoicePath) : '',
                'contractPath' => $contractPath ? storage_path($contractPath) : '',
            ];

            Mail::to(Auth::user()->email)->send(new \App\Mail\StoreSendMail($details));
        }
    }

    protected function generateInvoicePdf(User $user, Order $orderModel)
    {
        if ($user) {


            $orderProductModels = OrderProduct::where('order_id', $orderModel->id)
                ->with('product')
                ->whereNull('deleted')
                ->get();

            $rus = [
                '01' => 'января',
                '02' => 'февраля',
                '03' => 'марта',
                '04' => 'апреля',
                '05' => 'мая',
                '06' => 'июня',
                '07' => 'июля',
                '08' => 'августа',
                '09' => 'сентября',
                '10' => 'октября',
                '11' => 'ноября',
                '12' => 'декабря',
            ];

            $pdf = PDF::loadView('pdf.invoice', [
                'orderModel' => $orderModel,
                'order_id' => $orderModel->id,
                'orderDate' => $orderModel->created_at->format('d.m.Y'),
                'orderDateRus' => $orderModel->created_at->format('d'). ' '.$rus[$orderModel->created_at->format('m')] . ' ' . $orderModel->created_at->format('Y'),
                'orderProductModels' => $orderProductModels,
                'inn' => Setting::getValue('inn'),
                'kpp' => Setting::getValue('kpp'),
                'jur_name' => Setting::getValue('jur_name'),
                'bank' => Setting::getValue('bank'),
                'bik' => Setting::getValue('bik'),
                'schet_banka' => Setting::getValue('schet_banka'),
                'schet_our' => Setting::getValue('schet_our'),
                'jur_address' => Setting::getValue('jur_address'),
                'phone1' => Setting::getValue('phone1'),
                'email1' => Setting::getValue('email1'),
                'jur_address_mini' => Setting::getValue('jur_address_mini'),
                'user' => $user,
            ]);

            $pathWithoutStorage = DIRECTORY_SEPARATOR . 'invoices' . DIRECTORY_SEPARATOR;
            $path = storage_path() . $pathWithoutStorage;

            if (!file_exists($path) && !mkdir($path, 0777) && !is_dir($path)) {
                return '';
            }

            $pdf->save($path . $orderModel->id . '.pdf');

            return $pathWithoutStorage . $orderModel->id . '.pdf';
        }
    }
}
