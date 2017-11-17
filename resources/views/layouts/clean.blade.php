<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ace @yield('title')</title>

    @section('styles')
        <!-- Styles -->
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

            <style>
                html, body {
                    height : 100%;
                }

                .panel-body {
                    margin : auto 1em;
                }

                .container {
                    display : flex;
                    height  : 100%;
                }

                .title {
                    font-size   : 84px;
                    color       : #636b6f;
                    font-family : 'Raleway', sans-serif;
                    font-weight : 100;
                    text-align  : center;
                }
            </style>
    @show
</head>
<body>
<div class="container">

    @yield('content')

</div>
<!-- Scripts -->
@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@show
</body>
</html>