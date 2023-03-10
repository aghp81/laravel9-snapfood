<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="utf-8">
        <title> به سایت SF خوش آمدید </title>

        <!-- ajax csrf -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/public.css')}}">
    </head>
    <body>


        <div class="container py-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <!-- currentLandingPage() helper for active link -->
                    <a class="nav-link @unless(currentLandingPage())   active   @endunless" href="{{url('/')}}"> صفحه اصلی </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(currentLandingPage() == 'products')  active  @endif"  href="{{ route('landing', 'products') }}"> محصولات </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(currentLandingPage() == 'shops')  active  @endif"  href="{{ route('landing', 'shops') }}"> فروشگاه ها </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(currentLandingPage() == 'cart')  active  @endif"  href="{{ route('landing', 'cart') }}" id="cart">
                         سبد خرید  
                         <span> {{ cartCount() }} </span>
                    </a>
                </li>
                <li class="nav-item mr-auto align-self-center">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                        حساب کاربری
                    </a>
                </li>
            </ul>

            <div class="card mt-3">
                <div class="card-body">

                    <!-- نمایش خطاها -->
                    @if($error = session('error'))

                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>

                    @endif

                    <!-- نمایش پیغام موفق -->
                    @if($message = session('message'))

                        <div class="alert alert-success">
                            {{ $message }}
                        </div>

                    @endif

                    @yield('content')
                </div>
            </div>

        </div>

        
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <script src="{{asset('js/public.js')}}" charset="utf-8"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/public.css', 'resources/js/app.js', 'resources/js/public.js', 'resources/js/jquery-3.6.3.min.js'])
    </body>
</html>
