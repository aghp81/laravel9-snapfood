<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Sellers') }}
        </h2>
    </x-slot>

    <!-- اگر شاپ آی دی داشت هدایت شود به آپدیت در غیر این صورت هدایت شود به استور -->
    <form class="grid grid-cols-3 gap-4" action="{{$shop->id ? route('shop.update', $shop->id) : route('shop.store') }}" method="POST">

        @csrf
        

        <!-- برای آپدیت متد را روی PUT قرار می دهیم. -->
        @if($shop->id)
            @method('PUT')
        @endif

        <div>
            <x-jet-label for="title" value="{{ __('Title Of Store') }}" />
            <x-jet-input id="title" class="block mt-3 w-full" type="text" name="title" :value="$shop->title ?? old('title')" required autofocus />
        </div>

        <div>
            <x-jet-label for="first_name" value="{{ __('first_name') }}" />
            <x-jet-input id="first_name" class="block mt-3 w-full" type="text" name="first_name" :value="$shop->first_name ?? old('first_name')" required />
        </div>

        <div>
            <x-jet-label for="last_name" value="{{ __('last_name') }}" />
            <x-jet-input id="last_name" class="block mt-3 w-full" type="text" name="last_name" :value="$shop->last_name ?? old('last_name')" required />
        </div>

        <div>
            <x-jet-label for="telephone" value="{{ __('telephone') }}" />
            <x-jet-input id="telephone" class="block mt-3 w-full" type="text" name="telephone" :value="$shop->telephone ?? old('telephone')" required />
        </div>

        

        
        <!-- دریافت ایمیل و نام کاربری و آدرس-->

        <!-- اگر ایجاد فروشگاه جدید باشد، فیلد ایمیل و نام کاربری نمایش دادم می شود، در غیر اینصورت نمایش داده نمی شود -->
        @unless($shop->id)

            <div>
                <div>
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-3 w-full" type="text" name="email" :value="$shop->email ?? old('email')" required />
                </div>
            </div>

            <div>
                <div>
                    <x-jet-label for="username" value="{{ __('Username') }}" />
                    <x-jet-input id="username" class="block mt-3 w-full" type="text" name="username" :value="$shop->username ?? old('username')" required />
                </div>
            </div>

        @endunless


        <div class="col-span-3">
            <x-jet-label for="address" value="{{ __('address') }}" />
            <x-jet-input id="address" class="block mt-3 w-full" type="text" name="address" :value="$shop->address ?? old('address')" />
        </div>
        

        
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
