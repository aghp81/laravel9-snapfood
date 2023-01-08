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
        'discount' => 'nullable|integer|between:1,100',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2000',
    ];

    // برای پیاده سازی میدلور CheckAdmins
    public function __construct()
    {
        $this->middleware(['auth', 'admins']);
    }
 
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

 
    public function create()
    {
        $product = new Product; // برای اینکه اگر فرم در حالت ایجاد بود همه فیلدها رو نشون بده اگر در حالت ویرایش بود فیلد نام کاربری و ایمیل رو نشون نده.
        return view('product.form', compact('product')); // برای ایجاد و ویرایش فروشگاه
        // product در حالت create ای دی ندارد.
    }



    public function store(Request $request)
    {
        $data = $request->validate($this->validationRules); // ولدیشین ها
        // dd($request->all());

        // برای افزودن shop_id
        $shop = Shop::where('user_id', auth()->id())->firstOrFail(); // اونجایی که آی دی کاربر با آی دی شخصی که لاگین کرده برابره
        $data['shop_id'] = $shop->id; // دسترسی به ای دی فروشگاه

        if (isset($data['image']) && $data['image']) { // اگر دیتای ایمیج داشتیم
            $data['image'] = upload($data['image']); // آپلود تصویر ا استفاده از تابع هلپر
        }

        // ایجاد محصول در دیتابیس
        Product::create($data);
        return redirect()->route('product.index')->withMessage( __('SUCCESS') ); // DELETED in fa.json
    }

 
   
    public function edit(Product $product)
    {
        return view('product.form', compact('product')); // برای ایجاد و ویرایش فروشگاه
    }


    public function update(Request $request, product $product)
    {
        $data = $request->validate($this->validationRules); // ولدیشین ها
        if (isset($data['image']) && $data['image']) { // اگر دیتای ایمیج داشتیم
            $data['image'] = upload($data['image']); // آپلود تصویر ا استفاده از تابع هلپر
        }

        $product->update($data); // آپدیت محصول از طریق اطلاعاتی که ار دیتا رسیده

    }


    public function destroy(product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->withMessage( __('DELETED') ); // DELETED in fa.json
    }
}
