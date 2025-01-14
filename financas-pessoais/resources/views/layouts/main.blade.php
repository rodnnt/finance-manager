<!DOCTYPE html>
<html lang="pt-BR">

    <head>
        <title>@yield('title')</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="/css/style.css">
    </head>

    <body>
        @include('layouts.header')

        <div class="content-fluid">
            <div class="row">
                <nav class="sidebar bg-light d-md-block d-none">
                    
                    @include('layouts.sidebar')
                    
                </nav>

                <main class="px-md-4 fs-5 fs-sm-4 fs-md-3 fs-lg-2">
                    <div class="content py-4">
                        @include('layouts.message')
                        @yield('content')
                    </div>

                    
                </main>
            </div>
        </div>
        
        @include('layouts.footer')

        <!-- Optional JavaScript -->
        <!-- Bootstrap 5 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>