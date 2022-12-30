<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sellers Management') }}
        </h2>
    </x-slot>


    <div class="flex justify-end">

        <a href="{{ route ('shop.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
            {{ __('Define New Sellers') }}
        </a>

        
        <a href=""></a>
        <a href=""></a>
        <a href=""></a>
    </div>

    
    <hr class="my-4">


</x-app-layout>
