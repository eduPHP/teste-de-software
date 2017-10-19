@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <ol class="breadcrumb">
                <li><a href="{{ url('/') }}">{{ config('app.name') }}</a></li>
                <li class="active">Usuarios</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Usuarios</div>
                <div class="panel-body">
                    <a href="{{ url('/usuarios/create') }}" class="btn btn-info">Adicionar</a>
                </div>
                <div class="table-responsive">
                    <table class="table crud">
                        <thead>
                        <tr>
                            <th class="col-md-1">#</th>
                            <th>Nome</th>
                            <th class="col-md-1">Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>
                                    <a href="{{ url("/usuarios/{$usuario->id}") }}">{{ $usuario->nome }}</a>
                                </td>
                                <td>
                                    <form action="{{ url("/usuarios/{$usuario->id}") }}" method="POST" class="form-horizontal">
                                        {!! method_field("DELETE") !!}
                                        {!! csrf_field() !!}
                                        <button type="submit" class="btn btn-danger remover">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <a href="{{ url("/usuarios/{$usuario->id}/edit") }}" class="btn btn-info">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="espaco">Nenhum Usuario encontrado</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div>
                    {!! $usuarios->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
