@extends('layouts.clean')
@section('title',' - Recuperação de senha')

@section('content')
    <div class="panel panel-info reset-form">
        <div class="title">
            Ace
        </div>
        <div class="panel-body">
            <p>Reset de senha.</p>
            <form action="{{ url("/password/reset")}}" method="POST" class="form-horizontal">
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">
                <!-- Input Email -->
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input placeholder="E-mail" type="email" required
                           class="form-control" id="email" name="email" value="{{$email or old('email')}}">
                    {!! $errors->first('email', '<span class="label label-danger">:message</span>') !!}
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" placeholder="Senha"
                           type="password" class="form-control" name="password" required>
                    {!! $errors->first('password', '<span class="label label-danger">:message</span>') !!}
                </div>

                <div class="form-group">
                    <input id="password-confirm" placeholder="Confirme a senha"
                           type="password" class="form-control" name="password_confirmation" required>
                </div>

                <!-- Form Submit -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Trocar Senha </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('styles')
    @parent
    <style>
        .reset-form {
            margin : auto;
            width  : 40rem;
        }
    </style>
@stop
