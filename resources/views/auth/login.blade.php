<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ace - Login</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <style>
        html, body{
            height: 100%;
        }
        .login-form {
            margin: auto;
            width: 23em;
        }
        .panel-body{
            margin: auto 1em;
        }
        .container{
            display: flex;
            height: 100%;
        }

        .title {
            font-size : 84px;
            color       : #636b6f;
            font-family : 'Raleway', sans-serif;
            font-weight : 100;
            text-align: center;
        }

    </style>
</head>
<body>
<div class="container">

    <div class="panel panel-info login-form">
        <div class="title">
            Ace
        </div>
        <div class="panel-body">
            <p>Forneça seu email e senha para acessar o sistema</p>
            <form action="{{ url("/login")}}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}
            <!-- Input Email -->
                <div class="form-group">
                    <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input placeholder="E-mail" type="text" class="form-control" id="email" name="email" value="{{
                        old('email')
                    }}">
                        {!! $errors->first('email', '<span class="label label-danger">:message</span>') !!}
                    </div>
                </div>
                <!-- Input Password -->
                <div class="form-group">
                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input placeholder="Senha" type="password" class="form-control" id="password" name="password">
                        {!! $errors->first('password', '<span class="label label-danger">:message</span>') !!}
                    </div>
                </div>
                <!-- Form Submit -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Login</button>
                    <a href="/password/reset" type="submit" class="btn btn-link btn-block">Esqueci a senha</a>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- Scripts -->
@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).on('click', '.logout', function (e) {
            e.preventDefault();
            $('.logout-form').submit();
        })
    </script>
@show
</body>
</html>