<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Sellers') }}
        </h2>
    </x-slot>

    <form class="grid grid-cols-5 gap-4" action="{{ route('shop.store') }}" method="POST">

        @csrf

        <div class="col-span-2">
            <x-jet-label for="title" value="{{ __('Title Of Store') }}" />
            <x-jet-input id="title" class="block mt-3 w-full" type="text" name="title" :value="old('title')" required autofocus />
        </div>

        <div>
            <x-jet-label for="first_name" value="{{ __('first_name') }}" />
            <x-jet-input id="first_name" class="block mt-3 w-full" type="text" name="first_name" :value="old('first_name')" required />
        </div>

        <div>
            <x-jet-label for="last_name" value="{{ __('last_name') }}" />
            <x-jet-input id="last_name" class="block mt-3 w-full" type="text" name="last_name" :value="old('last_name')" required />
        </div>

        <div>
            <x-jet-label for="telephone" value="{{ __('telephone') }}" />
            <x-jet-input id="telephone" class="block mt-3 w-full" type="text" name="telephone" :value="old('telephone')" required />
        </div>

        <div class="col-span-5">
            <x-jet-label for="address" value="{{ __('address') }}" />
            <x-jet-input id="address" class="block mt-3 w-full" type="text" name="address" :value="old('address')" required />
        </div>

        <div  class=" col-start-3 col-end-4">

            <div class="flex justify-center">
                <x-jet-button>
                    {{ __('Save') }}
                </x-jet-button>
            </div>
            
        </div>

    </form>
    


</x-app-layout>
