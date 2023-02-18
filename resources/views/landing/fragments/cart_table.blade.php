<table class="table table-bordered">
        <thead>
            <tr>
                <th> ردیف </th>
                <th> محصول </th>
                <th> فروشگاه </th>
                <th> تعداد </th>
                <th> قابل پرداخت </th>
                @if($operations)
                 <th>  حذف </th>
                @endif
            </tr>
        </thead>

        <tbody>
            <!-- LandingController cart method -->
            <!-- each cart has many cart items -->
            @foreach ($cart->items as $key => $item)
            <tr>
                <th> {{ $key+1 }} </th>
                <td> {{ $item->product->title ?? '--' }} </td> <!-- CartItem.php - public function product() --> 
                <td> {{ $item->product->shop->title ?? '--' }} </td> <!-- product.php - public function shop() --> 
                <td>
                @if($operations)
                    
                        <form method="post" action="{{ route('cart.manage', $item->product_id) }}">
                            @csrf
                            <button type="submit" name="type" value="minus" class="btn btn-warning btn-sm text-primary"> - </button>
                            <span class="cart-count"> {{ $item->count }} </span> <!-- تعداد محصول در سبد خرید را به کاربر نشان می دهیم -->
                            <button type="submit" name="type" value="add" class="btn btn-warning btn-sm text-primary"> + </button>
                        </form>
                    
                @else
                
                    {{ $item->count }}
                @endif
                </td>
                <td> {{ number_format($item->payable) }} </td>
                <!--حذف از سبد خرید-->
                @if($operations)
                    <td>
                        <form class="" action="{{route('cart.remove', $item->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger bg-danger btn-sm"> حذف </button>
                        </form>
                    </td>
                @endif
            </tr>
            @endforeach
            <!-- جمع سبد خرید -->
            <tr>
                <td colspan="4"> جمع کل </td>
                <td colspan="2"> {{ number_format($cart->sum) }} تومان</td> <!-- Cart.php - getSumAttribute() -->
            </tr>
        </tbody>
    </table>