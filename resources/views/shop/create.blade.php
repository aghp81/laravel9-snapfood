<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Sellers') }}
        </h2>
    </x-slot>

    <form class="grid grid-cols-3 gap-4" action="{{ route('shop.store') }}" method="POST">

        @csrf

        <div class="mb-4">
            <x-jet-label for="title" value="{{ __('Title Of Store') }}" />
            <x-jet-input id="title" class="block mt-3 w-full" type="text" name="title" :value="old('title')" required autofocus />
        </div>

        <div class="mb-4">
            <x-jet-label for="first_name" value="{{ __('first_name') }}" />
            <x-jet-input id="first_name" class="block mt-3 w-full" type="text" name="first_name" :value="old('first_name')" required />
        </div>

        <div class="mb-4">
            <x-jet-label for="last_name" value="{{ __('last_name') }}" />
            <x-jet-input id="last_name" class="block mt-3 w-full" type="text" name="last_name" :value="old('last_name')" required />
        </div>

        

    </form>
    


</x-app-layout>
