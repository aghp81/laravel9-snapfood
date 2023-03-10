<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Management') }}
        </h2>
    </x-slot>

    <!-- افزودن محصولات دکمه -->
    <div class="flex justify-end">

        <a href="{{ route ('product.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
            {{ __('Define New Product') }}
        </a>

    </div>

    <hr class="my-4">

    <!-- جستجوی محصولات -->
    <form class="flex flex-wrap justify-center items-center">

    <!-- جستجو براساس فروشگاه -->
        
        @admin

            <div class="w-1/4 my-3 px-3">
                <label class="block mb-2" for="">انتخاب فروشگاه</label>
                    <select class="select2" name="s" id="">
                        <!-- اگر شاپ ای دی در پروداکت برابر بود با آی دی شاپ باید سلکتد باشد. برای نمایش نانم فروشگاه انتخاب شده در فرم ویرایش -->
                        <option value="">
                            -- انتخاب کنید --
                        </option>    
                        @foreach($shops as $shop )
                        <option 
                        @if(request('s') == $shop->id ) 
                            selected  @endif  
                            value="{{ $shop->id }}">
                            {{ $shop->title }}
                        </option>
                        @endforeach
                    </select>
            </div>

        @endadmin

        <!-- جستجو براساس عنوان -->
        <div class="w-1/4 my-3 px-3">
            <x-jet-label for="t" value="{{ __('Title') }}" />
            <x-jet-input id="t" class="block mt-3 w-full" type="text" name="t" :value="request('t') ?? old('t')" />
        </div>

        
        <!-- مرتب سازی -->
        <div class="w-1/4 my-3 px-3">
            <label class="block mb-2" for="">مرتب سازی</label>
            <select class="w-full" name="o" id="">
                <option value="">-- انتخاب کنید --</option>
                <option @if(request('o') == 1) selected    @endif value="1">ارزانترین</option>
                <option @if(request('o') == 2) selected    @endif value="2">گرانترین</option>
                <option @if(request('o') == 3) selected    @endif value="3">جدیدترین</option>
                <option @if(request('o') == 4) selected    @endif value="4">قدیمی ترین</option>
            </select>
        </div>

        <!-- جستجو براساس نمایش پاک شده ها -->
        <div class="w-1/4 my-3 px-3">
            <label>
                <input type="checkbox" name="d" value="1" @if(request('d'))  checked   @endif>  
                نمایش پاک شده ها
            </albel>
        </div>

        <!-- دکمه جستجو -->
        <div class="w-full"></div>
        <div class="w-1/4 my-3 px-3 text-center">
            <x-jet-button>
                {{ __('Search') }}
            </x-jet-button>
        </div>

    </form>
    

    

    
    @if($products->count())

    <hr class="my-4">


    <table>
        <thead>
            <tr>
                <th> #  </th>
                <!-- نام فروشگاه را فقط برای ادمین نمایش دهد -->
                @admin
                    <th>  فروشگاه </th>
                @endadmin

                <th>  نام محصول </th>
                <th> قیمت  </th>
                <th> تخفیف  </th>
                <th> قیمت فروش  </th>
                <th> تصویر  </th>
                
                <th colspan="2"> عملیات </th>
            </tr>
        </thead>

        
        <tbody>
            @foreach($products as $key => $product)

                <tr>
                    <th> {{ $key + 1 }} </th>
                    @admin
                        <td>  {{ $product->shop->title ?? '--' }} </td>
                    @endadmin
                    <td> {{ $product->title }} </td>
                    <td> {{ number_format($product->price) }} </td> <!--  استفاده از Appends در product Model  -->
                    <td> {{ $product->discount }} </td>
                    <td> {{ number_format($product->cost) }} </td>
                    <td>
                        @if($product->image)
                            <span class="text-green-500">دارد</span>
                        @else
                            <span class="text-red-500">ندارد</span>    
                        @endif
                    </td>

                    <!-- اگر محصول قبلا حذف سافت دلیت شده بود بازیابی شود. -->
                    @if($product->trashed())
                        <td colspan="2">
                            <form action="{{ route('product.restore', $product->id) }}" method="post">
                                    @csrf
                                      
                                    <button class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                        بازیابی
                                    </button>

                                </form>
                        </td>

                        <!-- در غیر این صورت محصول حذف یا ورایش شود. -->
                    @else
                        <td> 
                                <a href="{{ route ('product.edit', $product->id) }}" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                    ویرایش
                                </a>
                            </td>
                            <td> 
                                <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="delete-record inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                        حذف
                                    </button>

                                    
                                </form>
                            </td>

                    @endif
                </tr>

            @endforeach
        </tbody>

    </table>


    <!-- صفحه بندی -->
    <div class="mt-5">
        {{ $products->links() }}
    </div>
    

    @endif
    




</x-app-layout>
