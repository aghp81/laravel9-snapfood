<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Management') }}
        </h2>
    </x-slot>

    <!-- اگر شاپ آی دی داشت هدایت شود به آپدیت در غیر این صورت هدایت شود به استور -->
    <form class="grid grid-cols-3 gap-4" action="{{$product->id ? route('product.update', $product->id) : route('product.store') }}" method="POST">

        @csrf
        

        <!-- برای آپدیت متد را روی PUT قرار می دهیم. -->
        @if($product->id)
            @method('PUT')
        @endif

      
        <!-- دکمه ذخیره -->
        <div  class="col-start-2 col-end-3">
            <div class="flex justify-center">
                <x-jet-button>
                    {{ __('Save') }}
                </x-jet-button>
            </div>
        </div>

        

    </form>
    


</x-app-layout>
