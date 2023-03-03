<div class="col-md-4 my-3 product-card">
                <div class="d-flex justify-content-between">
                    <h5><a href="{{ route('product.show', $product->id) }}"> {{ $product->title }} </a> </h5>

                    <p>
                        
                        <!-- اگر تخفیف داشت -->
                        @if($product->discount)

                            <span class="text-danger off mx-2">{{ number_format($product->price) }}</span>
                            <span>{{ number_format($product->cost) }}</span><!-- cost در مدل ساخته شد. -->

                        @else <!-- اگر تخفیف نداشت -->
                            <span>{{ number_format($product->price) }}</span>

                        @endif
                    </p>
                    
                </div>
                <hr>
                    <!-- اگر تصویر نداشت تصویر پیشفرض -->
                <img src="{{ asset($product->image ?? 'img/empty.jpg') }}" alt="{{ $product->title }}">
                
                <p class="mt-3">
                    @if($product->description)
                        {{ $product->description }} 
                    @else
                        <em> بدون توضیحات ...</em>
                    @endif
                </p>
                <hr class="mt-3 mb-3">
                
                <!-- نمایش نام فروشگاه -->
                <form class="d-flex justify-content-between align-items-center" method="post" action="{{ route('cart.manage', $product->id) }}">
                    
                    <!-- چون ریکوئست را با ajax میفرستیم csrf رو از اینجا حذف میک نیم. -->
                    
                    <a href=""> {{ $product->shop->title ?? '-' }} </a>

                    <div class="in-cart    @unless($cart_item = $product->isInCart())  hidden   @endunless"> <!-- اگر در سبد خرید چیزی نبود هیدن شود. -->
                        <button type="button" name="type" value="minus" class="btn btn-warning btn-sm text-primary manage-cart"> - </button>
                        <span class="cart-count"> {{ $cart_item->count ?? 0 }} </span> <!-- تعداد محصول در سبد خرید را به کاربر نشان می دهیم -->
                        <button type="button" name="type" value="add" class="btn btn-warning btn-sm text-primary manage-cart"> + </button>
                    </div>

                    <div class="not-in-cart    @if($product->isInCart())  hidden  @endif"> <!-- اگر در سبد خرید چیزی بود هیدن شود. -->
                        <button type="button" name="type" value="add" class="btn btn-info btn-sm px-3 text-primary manage-cart">
                                    اضافه به سبد خرید 
                        </button>   
                    </div>

                        
                    
                    
                </form>

                <div class="hidden alert alert-danger mt-2">
                    
                </div>

            </div>