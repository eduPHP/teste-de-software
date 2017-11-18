@extends('layouts.clean')
@section('title',' - Login')
@section('styles')
    @parent
    <style>
        .message-panel {
            margin : auto;
            width  : 43rem;
        }
        .title{
            color: #ff574b;
        }
    </style>
@stop
@section('content')
    <div class="panel panel-warning message-panel">
        <div class="title">
            Erro!
        </div>
        <div class="panel-body text-center">
            <h3>Acesso Negado</h3>
            <p>Você não tem permissões para executar esta ação.</p>
            <a class="btn btn-link voltar"> Voltar</a>
        </div>
    </div>
@endsection


@section('scripts')
    @parent
    <script>
        $(document).on('click', '.voltar', function (e) {
            return history.back();
        });
    </script>
@stop
