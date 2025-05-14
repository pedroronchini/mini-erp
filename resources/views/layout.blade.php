<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mini ERP</title>
    <!-- Bootstrap CSS via CDN -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('products.index') }}">Mini ERP</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.show') }}">
                        Carrinho
                    </a>
                </li>
            </ul>
        </div>
    </nav>


    <main class="container">
        @yield('content')
    </main>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>
