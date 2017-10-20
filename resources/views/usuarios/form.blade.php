{!! csrf_field() !!}

{{--implementação visual será testado com selenium ou laravel dusk--}}

<!-- Input Nome -->
<div class="form-group">
    <label for="nome" class="col-sm-2 control-label">Nome</label>
    <div class="col-sm-10{{ $errors->has('nome') ? ' has-error' : '' }}">
        <input type="text" class="form-control" id="nome" name="nome" value="{{
            old('nome',  isset($usuario) ? $usuario->nome : null)
        }}">
        {!! $errors->first('nome', '<span class="label label-danger">:message</span>') !!}
    </div>
</div>
<!-- Input Email -->
<div class="form-group">
    <label for="email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10{{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="text" class="form-control" id="email" name="email" value="{{
            old('email',  isset($usuario) ? $usuario->email : null)
        }}">
        {!! $errors->first('email', '<span class="label label-danger">:message</span>') !!}
    </div>
</div>

<!-- Select Permissoes -->
<div class="form-group">
    <label for="permissoes" class="col-sm-2 control-label">Permissoes</label>
    <div class="col-sm-10{{ $errors->has('permissoes') ? ' has-error' : '' }}">
        <select class="form-control" id="permissoes" name="permissoes">
            @foreach(['usuario'=>'Usuário','administrador'=>'Administrador'] as $key => $val)
                <option value="{{$key}}"{!!
                old('permissoes',  isset($usuario) ? $usuario->permissoes : null) == $key?
                ' selected' : ''
                !!}>{{$val}}</option>
            @endforeach
        </select>
        {!! $errors->first('permissoes', '<span class="label label-danger">:message</span>') !!}
    </div>
</div>

<!-- Input Password -->
<div class="form-group">
    <label for="password" class="col-sm-2 control-label">Senha</label>
    <div class="col-sm-10{{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" class="form-control" id="password" name="password">
        {!! $errors->first('password', '<span class="label label-danger">:message</span>') !!}
    </div>
</div>

<!-- Input Password_confirmation -->
<div class="form-group">
    <label for="password_confirmation" class="col-sm-2 control-label">Password_confirmation</label>
    <div class="col-sm-10{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        {!! $errors->first('password_confirmation', '<span class="label label-danger">:message</span>') !!}
    </div>
</div>





<!-- Form Submit -->
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-{{isset($usuario)?'success':'info'}}">Gravar</button>
        <button type="reset" class="btn btn-default">Reset</button>
    </div>
</div>
