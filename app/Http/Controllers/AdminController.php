<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Brand;
use App\Models\Carousel;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.layout');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function brandsPage(Request $request)
    {
        $select = Brand::whereNull('deleted');
        $select = $this->standartPagination($select, $request);
        return view('admin.brands')->with('tableData', $select->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productsPage(Request $request)
    {
        $select = Product::with('brand')->whereNull('deleted');

        $select = $this->standartPagination($select, $request);
        $selectBrands = Brand::whereNull('deleted')->orderBy('name', 'asc')->paginate(999999999);
        $categories = Category::whereNull('deleted')->orderBy('name', 'asc')->paginate(999999999);


        return view('admin.products')
            ->with('tableData', $select->toArray())
            ->with('brands', $selectBrands->toArray())
            ->with('categories', $categories->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pagesPage(Request $request)
    {
        $select = Page::whereNull('deleted');
        $select = $this->standartPagination($select, $request);
        return view('admin.pages')
            ->with('tableData', $select->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articlesPage(Request $request)
    {
        $select = Article::whereNull('deleted');
        $select = $this->standartPagination($select, $request);
        return view('admin.articles')
            ->with('tableData', $select->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function carouselsPage(Request $request)
    {
        $select = Carousel::whereNull('deleted');
        $select = $this->standartPagination($select, $request);
        return view('admin.carousels')
            ->with('tableData', $select->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function faqsPage(Request $request)
    {
        $select = Faq::whereNull('deleted');
        $select = $this->standartPagination($select, $request);
        return view('admin.faqs')
            ->with('tableData', $select->toArray());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contactsPage(Request $request)
    {
        $select = Contact::whereNull('deleted');
        $select = $this->standartPagination($select, $request);
        Contact::where('read', 0)->update([
            'read' => 1
        ]);
        return view('admin.contacts')
            ->with('tableData', $select->toArray());
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addOrSaveProduct(Request $request)
    {
        try{

            if ($request->name || $request->description) {

                if (!empty($request->id)) {
                    $model = Product::find($request->id);
                } else {
                    $model = new Product();
                }

                $fileName = $this->uploadPhoto($request,'photo');
                if (strlen($fileName)) {
                    $model->photo = $fileName;
                }

                $model->brand_id = $request->brand_id;
                $model->name = $request->name;
                $model->article = $request->article;
                $model->category_id = $request->category_id;
                $model->mini_description = $request->mini_description;
                $model->description = $request->description;
                $model->meta_title = $request->meta_title;
                $model->meta_keywords = $request->meta_keywords;
                $model->meta_description = $request->meta_description;
                $model->order_by = $request->order_by;
                $model->price = $request->price;
                $model->old_price = $request->old_price;

                $model->save();
                return response()->json(['success' => true, 'data' => ['id' => $model->id]]);
            }
            throw new \Exception("Без имени");
        }catch (\Exception $e) {
            return response()->json(['success' => false, 'data' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addOrSaveBrand(Request $request)
    {
        try{

            if ($request->name || $request->description) {

                if (!empty($request->id)) {
                    $model = Brand::find($request->id);
                } else {
                    $model = new Brand();
                }

                $fileName = $this->uploadPhoto($request,'photo');
                if (strlen($fileName)) {
                    $model->photo = $fileName;
                }

                $model->name = $request->name;
                $model->mini_description = $request->mini_description;
                $model->description = $request->description;
                $model->meta_title = $request->meta_title;
                $model->meta_keywords = $request->meta_keywords;
                $model->meta_description = $request->meta_description;
                $model->order_by = $request->order_by;

                $model->save();
                return response()->json(['success' => true, 'data' => ['id' => $model->id]]);

            }
            throw new \Exception("Без имени");
        }catch (\Exception $e) {
            return response()->json(['success' => false, 'data' => $e->getMessage()]);
        }

    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addOrSavePage(Request $request)
    {
        try{

            if ($request->name || $request->description) {

                if (!empty($request->id)) {
                    $model = Page::find($request->id);
                } else {
                    $model = new Page();
                }

                $fileName = $this->uploadPhoto($request,'photo');
                if (strlen($fileName)) {
                    $model->photo = $fileName;
                }

                $model->name = $request->name;
                $model->mini_description = $request->mini_description;
                $model->description = $request->description;
                $model->meta_title = $request->meta_title;
                $model->meta_keywords = $request->meta_keywords;
                $model->meta_description = $request->meta_description;

                $model->save();
                return response()->json(['success' => true, 'data' => ['id' => $model->id]]);

            }
            throw new \Exception("Без имени");
        }catch (\Exception $e) {
            return response()->json(['success' => false, 'data' => $e->getMessage()]);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addOrSaveArticle(Request $request)
    {
        try{

            if ($request->name || $request->description) {

                if (!empty($request->id)) {
                    $model = Article::find($request->id);
                } else {
                    $model = new Article();
                }

                $fileName = $this->uploadPhoto($request,'photo');
                if (strlen($fileName)) {
                    $model->photo = $fileName;
                }

                $model->name = $request->name;
                $model->mini_description = $request->mini_description;
                $model->description = $request->description;
                $model->meta_title = $request->meta_title;
                $model->meta_keywords = $request->meta_keywords;
                $model->meta_description = $request->meta_description;

                $model->save();
                return response()->json(['success' => true, 'data' => ['id' => $model->id]]);

            }
            throw new \Exception("Без имени");
        }catch (\Exception $e) {
            return response()->json(['success' => false, 'data' => $e->getMessage()]);
        }

    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addOrSaveCarousel(Request $request)
    {
        try{

            if ($request->name || $request->description) {

                if (!empty($request->id)) {
                    $model = Carousel::find($request->id);
                } else {
                    $model = new Carousel();
                }

                $fileName = $this->uploadPhoto($request,'photo');
                if (strlen($fileName)) {
                    $model->photo = $fileName;
                }

                $model->name = $request->name;
                $model->link = $request->link;
                $model->button_text = $request->button_text;
                $model->description = $request->description;
                $model->order_by = $request->order_by;

                $model->save();
                return response()->json(['success' => true, 'data' => ['id' => $model->id]]);

            }
            throw new \Exception("Без имени");
        }catch (\Exception $e) {
            return response()->json(['success' => false, 'data' => $e->getMessage()]);
        }

    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addOrSaveFaq(Request $request)
    {
        try{

            if ($request->name || $request->description) {

                if (!empty($request->id)) {
                    $model = Faq::find($request->id);
                } else {
                    $model = new Faq();
                }

                $model->name = $request->name;
                $model->description = $request->description;
                $model->answer = $request->answer;
                $model->order_by = $request->order_by;

                $model->save();
                return response()->json(['success' => true, 'data' => ['id' => $model->id]]);

            }
            throw new \Exception("Без имени");
        }catch (\Exception $e) {
            return response()->json(['success' => false, 'data' => $e->getMessage()]);
        }

    }

    private function uploadPhoto($request, $name)
    {
        if ($request->file($name)) {
            $request->validate([
                'file' => 'mimes:jpg,jpeg,png,gif,ico,bmp|max:20480',
            ]);
            $fileName = date('YmdHis').'.'.$request->file('photo')->extension();
            $request->file('photo')->move(public_path('uploads'), $fileName);
            return '/uploads/' . $fileName;
        }

        return '';
    }

    public function deleteBrand(Request $request)
    {
        $model = Brand::where('id', $request->id)->first();
        $model->deleted = 1;
        $model->save();
    }
    public function deleteProduct(Request $request)
    {
        $model = Product::where('id', $request->id)->first();
        $model->deleted = 1;
        $model->save();
    }
    public function deletePage(Request $request)
    {
        $model = Page::where('id', $request->id)->first();
        $model->deleted = 1;
        $model->save();
    }
    public function deleteArticle(Request $request)
    {
        $model = Article::where('id', $request->id)->first();
        $model->deleted = 1;
        $model->save();
    }
    public function deleteCarousel(Request $request)
    {
        $model = Carousel::where('id', $request->id)->first();
        $model->deleted = 1;
        $model->save();
    }
    public function deleteFaq(Request $request)
    {
        $model = Faq::where('id', $request->id)->first();
        $model->deleted = 1;
        $model->save();
    }


}
