@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">{{ config('app.name') }}</a></li>
                <li><a href="{{ url('usuarios') }}">Usuarios</a></li>
                <li class="active">Adicionar</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastro de usuário</div>

                <div class="panel-body">
                    <form action="{{ url('usuarios') }}" method="POST" class="form-horizontal">
                        {!! method_field("POST") !!}
                        @include('usuarios.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
