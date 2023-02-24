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
                <th> وضعیت  </th>
                <th> تغییر وضعیت  </th>
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
                    <td>
                        @if($item->status == 1)
                            <span class="bg-yellow-400 text-white px-4 py-2"> سفارش جدید </span>
                        @elseif($item->status == 2)
                            <span class="bg-green-400 text-white px-4 py-2"> تحویل داده شده  </span>
                        @else
                            <span class="bg-red-400 text-white px-4 py-2"> مرجوع شده </span>
                        @endif
                    </td>

                    <td>
                        <form class="flex" action="" method="post">
                            <select class="form-control from-control-sm" name="status" id="">
                                <option value=""> ---  </option>
                                <option value="1"> سفارش جدید </option>
                                <option value="2"> تحویل داده شده  </option>
                                <option value="3"> مرجوع شده  </option>
                            </select>
                            <x-jet-button class="mr-4">
                                تایید
                            </x-jet-button>
                        </form>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-5">
        {{ $items->links() }}
    </div>
    


</x-app-layout>
