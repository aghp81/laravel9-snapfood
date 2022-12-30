<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;

use Illuminate\Http\Request;

class ShopController extends Controller
{

    // برای پیاده سازی میدلور CheckAdmin
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
        // $this->middleware(['auth', 'admin'])->except(['show', 'index']);// خارج کردن دو بخش از میدلور. همه کاربران می توانند ببینند.
       // $this->middleware(['auth', 'admin'])->only(['show', 'index']);// فقط این دو بخش در میدلور ادمین باشند و سایر بخش ها را همه بتوانند ببینند.
      // $this->middleware('auth');
     // $this->middleware('admin');
    }
    
    public function index()
    {
        return view('shop.index');
    }

    
    public function create()
    {
        return view('shop.create');
    }

    
    public function store(Request $request)
    {
        // dd($request->all());

        // validate request for shop
        $data = $request->validate([
            'title' => 'required|between:3,100|string|unique:shops,title', // مشخص میکنیم در چه جدولی و چه ستونی یونیک باشد.
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'telephone' => 'required|string|size:11',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,name',// مشخص میکنیم در چه جدولی و چه ستونی یونیک باشد.
            'address' => 'nullable',
        ]);

        // create user in database

        $randomPass = rand (1000, 9999);// پسورد را رندم می سازد.

        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'role' => 'shop',
            'email_verified_at' => now(),
            'password' => bcrypt($randomPass), // پسورد را رندم می سازد.
        ]);

        // dd($data);
        // dd($user->id);

        // create shop in database

        Shop::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'telephone' => $request->telephone,
            'address' => $request->address,
        ]);

        // redirect


    }

 
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
