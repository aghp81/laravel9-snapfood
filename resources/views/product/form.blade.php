<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Management') }}
        </h2>
    </x-slot>

    <!-- اگر شاپ آی دی داشت هدایت شود به آپدیت در غیر این صورت هدایت شود به استور -->
    <form enctype="multipart/form-data" action="{{$product->id ? route('product.update', $product->id) : route('product.store') }}" method="POST">

        @csrf
        

        <!-- برای آپدیت متد را روی PUT قرار می دهیم. -->
        @if($product->id)
            @method('PUT')
        @endif

        <div class="grid grid-cols-12 gap-4">

            <div class="col-span-3">
                <x-jet-label for="title" value="{{ __('Title Of Product') }}" />
                <x-jet-input id="title" class="block mt-3 w-full" type="text" name="title" :value="$product->title ?? old('title')" required autofocus />
            </div>

            <div class="col-span-3">
                <x-jet-label for="price" value="{{ __('Price Of Product') }}" />
                <x-jet-input id="price" class="block mt-3 w-full" type="text" name="price" :value="$product->price ?? old('price')" required />
            </div>

            <div class="col-span-3">
                <x-jet-label for="discount" value="{{ __('Discount') }}" />
                <x-jet-input id="discount" class="block mt-3 w-full" type="text" name="discount" :value="$product->discount ?? old('discount')" />
            </div>

            <div class="col-span-3">
                <x-jet-label for="image" value="{{ __('Image') }}" />
                <input type="file" class="mt-4" name="image" id="image">
            </div>

            <div class="col-span-12">
                <x-jet-label for="description" value="{{ __('Description') }}" />
                <x-jet-input id="description" class="block mt-3 w-full" type="text" name="description" :value="$product->description ?? old('description')" />
            </div>
        
        </div>

        <!-- دکمه ذخیره -->
        
            <div class="flex justify-center mt-4">
                <x-jet-button>
                    {{ __('Save') }}
                </x-jet-button>
            </div>
        

        

    </form>
    


</x-app-layout>
