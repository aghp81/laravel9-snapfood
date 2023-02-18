<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order details') }}
        </h2>
    </x-slot>

    @include('landing.fragments.cart_table', ['cart' => $order, 'operations' => false])

    
</x-app-layout>
