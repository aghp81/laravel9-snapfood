<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Management') }}
        </h2>
    </x-slot>


    <div class="flex justify-end">

        <a href="{{ route ('product.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
            {{ __('Define New Product') }}
        </a>

    </div>

    
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
                
                <th class="col-span-2"> عملیات </th>
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
                    <td> {{ $product->cost }} </td>
                    <td>
                        @if($product->image)
                            <span class="text-green-500">دارد</span>
                        @else
                            <span class="text-red-500">ندارد</span>    
                        @endif
                    </td>
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
                </tr>

            @endforeach
        </tbody>

    </table>



    @endif
    




</x-app-layout>
