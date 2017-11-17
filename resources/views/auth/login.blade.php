@extends('layouts.clean')
@section('title',' - Login')
@section('styles')
    @parent
    <style>
        .login-form {
            margin : auto;
            width  : 33rem;
        }
    </style>
@stop
@section('content')
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
@endsection