@extends('layouts.clean')
@section('title',' - Recuperação de senha')
@section('styles')
    @parent
    <style>
        .recuperacao-form {
            margin : auto;
            width  : 40rem;
        }
        .alert{
            font-size: 1.3em;
        }
    </style>
@stop
@section('content')
    <div class="panel panel-info recuperacao-form">
        <div class="title">
            Ace
        </div>
        <div class="panel-body">
            @if(session('status'))
                <div class="row">
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                </div>
            @else
                <p>Informe seu e-mail abaixo, enviaremos um link de recuperação de senha.</p>
                <form action="{{ url("/password/email")}}" method="POST" class="form-horizontal">
                {!! csrf_field() !!}
                <!-- Input Email -->
                    <div class="form-group">
                        <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input placeholder="E-mail" type="email" class="form-control" id="email" name="email" value="{{
                            old('email')
                        }}">
                            {!! $errors->first('email', '<span class="label label-danger">:message</span>') !!}
                        </div>
                    </div>
                    <!-- Form Submit -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-block">Enviar e-mail de recuperação</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection