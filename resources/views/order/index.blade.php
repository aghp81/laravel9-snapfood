<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of orders') }}
        </h2>
    </x-slot>

    


    
    
    @if($orders->count())


    <!-- جدول سفارشات -->
    <table>
        <thead>
            <tr>
                <th> ردیف </th>
                <th> کاربر </th>
                <th> وضعیت </th>
                <th> کد پیگیری </th>
                <th> تاریخ </th>
            </tr>
        </thead>

        <tbody>
            
            @foreach($orders as $key => $order)
                <tr>
                    <th> {{ $key+1 }} </th>
                    <td> ... </td>
                    <td>
                        @if($order->finished)
                            <span class="text-green-600"> پرداخت شده </span>
                        @else
                            <span class="text-red-600"> تکمیل نشده </span>
                        @endif
                    </td>

                    <td> {{ $order->code ?? '-' }} </td>
                    <td> {{ persianDate($order->created_at) }} </td>
                </tr>
            @endforeach

        </tbody>
    </table>


    <!-- صفحه بندی -->
    <div class="mt-5">
        {{ $orders->links() }}
    </div>
    

    @endif
    




</x-app-layout>
