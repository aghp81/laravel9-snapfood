<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of orders') }}
        </h2>
    </x-slot>

    
    <table>
        <thead>
            <tr>
                <th> ردیف </th>
                <th> مشتری </th>
                <th> محصول </th>
                <th> تعداد </th>
                <th> قابل پرداخت </th>
                <th> تاریخ  </th>
                <th> ساعت  </th>
            </tr>
        </thead>

        <tbody>
            @foreach($items as $key => $item)
                <tr>
                    <th> {{ $key + 1 }} </th>
                    <td> {{ $item->cart->user->name ?? '--' }} </td>
                    <td> {{ $item->product->title ?? '--' }} </td> <!-- CartItem.php === belongsTo(Product::class) -->
                    <td> {{ $item->count }} </td>
                    <td> {{ number_format($item->payable) }} </td>
                    <td> {{ persianDate($item->created_at) }} </td>
                    <td> {{ $item->created_at->format('H:i') }} </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
    

</x-app-layout>
