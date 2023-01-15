<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Shop;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // ولیدیشن ها
    private $validationRules = [
        'title' => 'required|string|min:3',
        'price' => 'required|integer',
        'discount' => 'nullable|integer|between:0,100',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2000',
    ];

    // برای پیاده سازی میدلور CheckAdmins
    public function __construct()
    {
        $this->middleware(['auth', 'admins']);
    }
 
    public function index(Request $request)
    {
        $shops = Shop::all(); // برای جست و جو در فروشگاه ها توسط مدیر
        
        $products = Product::query(); // برای جستجوی محصولات

        // جستجو در فروشگاه ها برای مدیر
     
        if (auth()->user()->is('admin')) { // اگر کاربر مدیر بود همه محصولات رو نمایش بده.
            if ($request->s) {
                $products = $products->where('shop_id', $request->s);
            }
        }else{
            $products = $products->where('shop_id', currentShopId());// فقط محصولات مربوط به همون فروشگاه رو نشون بده
        }

        //  جستجو بر اساس عنوان محصول و مشابه با عنوان محصول
        if ($request->t) {
            $products = $products->where('title', 'like', "%$request->t%");
        }

        // جستجو برای نمایش پاک شده ها چک باکس
        if ($request->d) {
            $products =  $products->withTrashed();
        }

        // مرتب سازی در فرم جستجو
        if ($order = $request->o) {
                if($order == 1){ // value = 1 ارزانترین
                    $products = $products->orderBy('price', 'ASC');
                }
                if($order == 2){ // value = 2 گرانترین
                    $products = $products->orderBy('price', 'DESC');
                }
                if($order == 3){ // value = 3 جدیدترین
                    $products = $products->latest(); //orderBy('created_at', 'DESC');
                }
                if($order == 4){ // value = 4 قدیمی ترین
                    $products = $products->orderBy('created_at', 'ASC');
                }
        }

       // جستجو در فروشگاه ها برای مدیر
        $products = $products->get();
        
        return view('product.index', compact('products', 'shops'));
    }

 
    public function create()
    {
        $product = new Product; // برای اینکه اگر فرم در حالت ایجاد بود همه فیلدها رو نشون بده اگر در حالت ویرایش بود فیلد نام کاربری و ایمیل رو نشون نده.
        $shops = Shop::all(); // نمایش همه شاپ ها در پنل ادمین برای افزودن محصول
        return view('product.form', compact('product', 'shops')); // برای ایجاد و ویرایش فروشگاه
        // product در حالت create ای دی ندارد.
    }



    public function store(Request $request)
    {
        $data = $request->validate($this->validationRules); // ولدیشین ها
        // dd($request->all());

        
        if (isset($data['image']) && $data['image']) { // اگر دیتای ایمیج داشتیم
            $data['image'] = upload($data['image']); // آپلود تصویر ا استفاده از تابع هلپر
        }

        // dd($data);
        // چون دیفالت تخفیف رو صفر در نظر گرفتیم در دیتابیس، اگر دیتای دیسکانت خالی بود برابر صفر درنظر بگیر
        if (!$data['discount']){
            $data['discount'] = 0;
        }


        // کاربری که لاگین کرده رو بگیر
        $currentUser = auth()->user();
        // اگر کاربر ادمین بود، شاپ ای دی رو بگیر 
        if ($currentUser->is('admin')) {
            $data['shop_id'] = $request->shop_id;
        }else{
            // برای افزودن shop_id
        $data['shop_id'] = currentShopId() ; // از طریق هلپر دسترسی به ای دی فروشگاه

        }

        
        // ایجاد محصول در دیتابیس
        Product::create($data);
        return redirect()->route('product.index')->withMessage( __('SUCCESS') ); // DELETED in fa.json
    }

 
   
    public function edit(Product $product)
    {
        checkPolicy('product', $product); // هر فروشنده فقط دسترسی ویرایش محصول به خود را دارد.
        $shops = Shop::all(); // نمایش همه شاپ ها در پنل ادمین برای افزودن محصول
        return view('product.form', compact('product', 'shops')); // برای ایجاد و ویرایش فروشگاه
    }


    public function update(Request $request, product $product)
    {
        checkPolicy('product', $product); // هر فروشنده فقط دسترسی ویرایش محصول به خود را دارد.
        $data = $request->validate($this->validationRules); // ولدیشین ها
        if (isset($data['image']) && $data['image']) { // اگر دیتای ایمیج داشتیم
            $data['image'] = upload($data['image']); // آپلود تصویر ا استفاده از تابع هلپر
        }

        // بروز شدن فروشگاه توسط مدیر
        // اگر کاربر ادمین باشد. فقط ادمین می تواند فروشگاه را تغییر دهد برای محصول
        $currentUser = auth()->user();
        if ($currentUser->is('admin')) {
            $data['shop_id'] = $request->shop_id;
        }

        $product->update($data); // آپدیت محصول از طریق اطلاعاتی که ار دیتا رسیده

        return redirect()->route('product.index')->withMessage( __('SUCCESS') ); // DELETED in fa.json

    }

    // بازیابی محصول سافت دیلیت شده
    public function restore($id)
    {
        checkPolicy('product', $product); // هر فروشنده فقط دسترسی ری استور محصول به خود را دارد.
        $product = Product::withTrashed()->where('id', $id)->firstOrFail();
        $product->restore();
        return redirect()->route('product.index')->withMessage( __('SUCCESS') );
    }


    public function destroy(product $product)
    {
        checkPolicy('', $product); // هر فروشنده فقط دسترسی حذف محصول به خود را دارد.
        $product->delete();
        return redirect()->route('product.index')->withMessage( __('DELETED') ); // DELETED in fa.json
    }
}
