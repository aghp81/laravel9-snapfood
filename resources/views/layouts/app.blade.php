<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        
        
        <!-- Styles -->
        @livewireStyles
        <link href="/dist/output.css" rel="stylesheet">
            <!-- select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

     

       
    </head>
    <body class="antialiased">
        <x-jet-banner />
        

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>

                <div class="py-12">

                    <div class="max-w-7xl mx-auto px-2 sm:px-3 lg:px-4">
                        
                        <!-- نمایش ارورهای ولیدیشن -->
                        @if($errors->any())
                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 mb-6">
                                <x-jet-validation-errors />
                            </div>
                        @endif
                        
                        
                        <!-- نمایش پیام های موفقیت -->
                        @if($message = session('message'))
                            <div class="text-gray-50 bg-green-400 overflow-hidden shadow-xl sm:rounded-lg p-4 mb-6">
                                {{ $message }}
                            </div>
                        @endif
                    
                    
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                                {{ $slot }}
                        </div>
                    </div>
                </div>

            </main>
        </div>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js', 'resources/js/custom.js'])
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

            <!-- select2 -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 
        
        @stack('modals')

        @livewireScripts
    </body>
</html>
