<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Brand;
use App\Models\Carousel;
use App\Models\Cart;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    private function forFooterAndMenu()
    {
//        if (!Cookie::get('LaravelShopCartId')) {
//            $LaravelShopCartId = sha1('LaravelShopCartId'.time().rand(0, 9999999).uniqid());
//            Cookie::queue('LaravelShopCartId', $LaravelShopCartId, 60 * 24 * 30 * 12);
//            \cookie('LaravelShopCartId', $LaravelShopCartId, 60 * 24 * 30 * 12);
//            dd($LaravelShopCartId);
//        }

        return [
            'LaravelShopCartId' => '',
            'allPages' => Page::whereNull('deleted')->orderBy('order_by', 'asc')->get(['id', 'name']),
            'allBrands' => Brand::whereNull('deleted')->orderBy('order_by', 'asc')->get(['id', 'name']),
            'allProducts' => Product::whereNull('deleted')->orderBy('order_by', 'asc')->get(['id', 'name', 'brand_id']),
        ];
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $selectCarousels = Carousel::whereNull('deleted')->orderBy('order_by', 'asc')->paginate(999999999);
        $selectBrands = Brand::whereNull('deleted')->orderBy('order_by', 'asc')->paginate(999999999);
        $selectFaqs = Faq::whereNull('deleted')->orderBy('order_by', 'asc')->paginate(999999999);
        $selectPage1 = Page::whereNull('deleted')->where('id', 1)->first();//1 - Производители
        $selectPage2 = Page::whereNull('deleted')->where('id', 2)->first();//2 - О нас
        $selectPage3 = Page::whereNull('deleted')->where('id', 3)->first();//3 = Последние новости
        $selectPage4 = Page::whereNull('deleted')->where('id', 4)->first();//4 - Контакты
        $selectPage5 = Page::whereNull('deleted')->where('id', 5)->first();//5 - Вопросы/Ответы (FAQ)
        $selectLastArticles = Article::whereNull('deleted')->orderBy('id', 'desc')->paginate(4);
        $forFooterAndMenu = $this->forFooterAndMenu();
        $selectProductGroups = ProductGroup::whereNull('deleted')
            ->where('show_on_homepage', 1)
            ->orderBy('order_by', 'asc')
            ->get();

        return view('templateLandingPage')

            ->with('LaravelShopCartId', $forFooterAndMenu['LaravelShopCartId'])
            ->with('allPages', $forFooterAndMenu['allPages'])
            ->with('allBrands', $forFooterAndMenu['allBrands'])
            ->with('allProducts', $forFooterAndMenu['allProducts'])

            ->with('meta_title', $selectPage2->meta_title)
            ->with('meta_keywords', $selectPage2->meta_keywords)
            ->with('meta_description', $selectPage2->meta_description)

            ->with('page1', $selectPage1)
            ->with('page2', $selectPage2)
            ->with('page3', $selectPage3)
            ->with('page4', $selectPage4)
            ->with('page5', $selectPage5)
            ->with('lastArticles', $selectLastArticles)
            ->with('carousels', $selectCarousels)
            ->with('productGroups', $selectProductGroups)
            ->with('faqs', $selectFaqs)
            ->with('brands', $selectBrands);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function brandPage(Request $request)
    {
        $selectBrand = Brand::whereNull('deleted')->where('id', $request->route('id'))->first();

        $select = ProductGroup::whereNull('deleted')->where('brand_id', $request->route('id'));
        $select = $this->standartPagination($select, $request);

        $forFooterAndMenu = $this->forFooterAndMenu();

        return view('templateBrand')

            ->with('LaravelShopCartId', $forFooterAndMenu['LaravelShopCartId'])
            ->with('allPages', $forFooterAndMenu['allPages'])
            ->with('allBrands', $forFooterAndMenu['allBrands'])
            ->with('allProducts', $forFooterAndMenu['allProducts'])

            ->with('meta_title', $selectBrand->meta_title)
            ->with('meta_keywords', $selectBrand->meta_keywords)
            ->with('meta_description', $selectBrand->meta_description)

            ->with('brand', $selectBrand)
            ->with('productGroups', $select->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productGroupPage(Request $request)
    {
        $selectProductGroup = ProductGroup::whereNull('deleted')->where('id', $request->route('id'))->first();

        $select = Product::whereNull('deleted')->where('product_group_id', $request->route('id'));
        $select = $this->standartPagination($select, $request);

        $forFooterAndMenu = $this->forFooterAndMenu();

        return view('templateProductGroup')

            ->with('LaravelShopCartId', $forFooterAndMenu['LaravelShopCartId'])
            ->with('allPages', $forFooterAndMenu['allPages'])
            ->with('allBrands', $forFooterAndMenu['allBrands'])
            ->with('allProducts', $forFooterAndMenu['allProducts'])

            ->with('meta_title', $selectProductGroup->meta_title)
            ->with('meta_keywords', $selectProductGroup->meta_keywords)
            ->with('meta_description', $selectProductGroup->meta_description)

            ->with('productGroup', $selectProductGroup)
            ->with('products', $select->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function magazinPage(Request $request)
    {
        $selectPage8 = Page::whereNull('deleted')->where('id', 8)->first(); // магазин
        $selectProductGroups = ProductGroup::whereNull('deleted')
            ->with('brand')
            ->get();
        $selectBrands = Brand::whereNull('deleted')->get();

        $forFooterAndMenu = $this->forFooterAndMenu();

        return view('templateMagazin')

            ->with('LaravelShopCartId', $forFooterAndMenu['LaravelShopCartId'])
            ->with('allPages', $forFooterAndMenu['allPages'])
            ->with('allBrands', $forFooterAndMenu['allBrands'])
            ->with('allProducts', $forFooterAndMenu['allProducts'])

            ->with('meta_title', $selectPage8->meta_title)
            ->with('meta_keywords', $selectPage8->meta_keywords)
            ->with('meta_description', $selectPage8->meta_description)

            ->with('page', $selectPage8)
            ->with('brands', $selectBrands->toArray())
            ->with('productGroups', $selectProductGroups->toArray());
    }



    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articlesPage(Request $request)
    {
        $select = Article::whereNull('deleted');
        $select = $this->standartPagination($select, $request);
        $selectPage3 = Page::whereNull('deleted')->where('id', 3)->first();
        $forFooterAndMenu = $this->forFooterAndMenu();

        return view('templateArticles')

            ->with('LaravelShopCartId', $forFooterAndMenu['LaravelShopCartId'])
            ->with('allPages', $forFooterAndMenu['allPages'])
            ->with('allBrands', $forFooterAndMenu['allBrands'])
            ->with('allProducts', $forFooterAndMenu['allProducts'])

            ->with('meta_title', $selectPage3->meta_title)
            ->with('meta_keywords', $selectPage3->meta_keywords)
            ->with('meta_description', $selectPage3->meta_description)

            ->with('articles', $select->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pagePage(Request $request)
    {
        $selectPage = Page::whereNull('deleted')->where('id', $request->route('id'))->first();
        $forFooterAndMenu = $this->forFooterAndMenu();

        return view('templatePage')

            ->with('LaravelShopCartId', $forFooterAndMenu['LaravelShopCartId'])
            ->with('allPages', $forFooterAndMenu['allPages'])
            ->with('allBrands', $forFooterAndMenu['allBrands'])
            ->with('allProducts', $forFooterAndMenu['allProducts'])

            ->with('meta_title', $selectPage->meta_title)
            ->with('meta_keywords', $selectPage->meta_keywords)
            ->with('meta_description', $selectPage->meta_description)

            ->with('page', $selectPage);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articlePage(Request $request)
    {
        $selectArticle = Article::whereNull('deleted')->where('id', $request->route('id'))->first();
        $forFooterAndMenu = $this->forFooterAndMenu();

        return view('templateArticle')

            ->with('LaravelShopCartId', $forFooterAndMenu['LaravelShopCartId'])
            ->with('allPages', $forFooterAndMenu['allPages'])
            ->with('allBrands', $forFooterAndMenu['allBrands'])
            ->with('allProducts', $forFooterAndMenu['allProducts'])

            ->with('meta_title', $selectArticle->meta_title)
            ->with('meta_keywords', $selectArticle->meta_keywords)
            ->with('meta_description', $selectArticle->meta_description)

            ->with('article', $selectArticle);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cartPage(Request $request)
    {
        $selectCart = Cart::whereNull('deleted')
            ->whereNull('bought')
            ->with('product')
            ->where('cart_id', Cart::currentCartId())
            ->get();

        $forFooterAndMenu = $this->forFooterAndMenu();

        return view('templateCart')

            ->with('LaravelShopCartId', $forFooterAndMenu['LaravelShopCartId'])
            ->with('allPages', $forFooterAndMenu['allPages'])
            ->with('allBrands', $forFooterAndMenu['allBrands'])
            ->with('allProducts', $forFooterAndMenu['allProducts'])

            ->with('meta_title', 'Корзина покупателя')
            ->with('meta_keywords', '')
            ->with('meta_description', '')

            ->with('items', $selectCart);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function addContactFromForm(Request $request)
    {
        $request->validate([
            'mail' => 'required|max:255',
        ]);
        if ($request->mail) {

            if ($request->getMethod() == 'POST') {
                $validator = validator()->make($request->all(), [
                    'captcha' => 'required|captcha'
                ]);
                if ($validator->fails()) {
                    $error = 'Вы не прошли проверку CAPTCHA';
                } else {

                    $model = new Contact();
                    $model->fio = $request->fio;
                    $model->email = $request->mail;
                    $model->message = $request->mess;
                    $model->ip = $request->ip();
                    if (!Auth::guest()) {
                        $model->user_id = Auth::user()->id;
                    }
                    $this->sendEmailToAdmin('Новый фопрос в контактной форме');
                    return response()->json(['success'=>true, 'data'=>$model->save()]);
                }

            }


        }
        return response()->json(['success'=>false, 'data' => $error]);
    }

    private function sendEmailToAdmin($subj)
    {
        // todo:
    }
}
