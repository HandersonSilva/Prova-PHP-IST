@extends('template.template') @section('conteudo')
<div class="container-md conteudo">
    <h3 class="modal-title">
        @if(isset($pessoa)) Editar @else Cadastrar @endif
    </h3>
    @if(Session::get('error'))
    <div class="alert alert-danger" role="alert">
      {{Session::get('error')}}
    </div>
    @endif

    @if(isset($pessoa) && !empty($pessoa->id)) <form action="{{
        url("pessoa/$pessoa->id")
    }}" method="POST"> @method('PUT') @else
    <form action="/pessoa" method="POST">
        @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="id" id="id_pessoa" value="" />
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-8 ">
                    <label for="nome">Nome</label>
                    <input
                        on
                        autofocus
                        type="text"
                        class="form-control"
                        id="nome"
                        name="nome"
                        value="{{$pessoa->nome ?? old('nome')}}"
                    />
                    @if ($errors->has('nome'))
                        <span class="help-block text-danger">
                          <strong>{{ $errors->first('nome') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="nome">CPF</label>
                    <input
                        autofocus
                        type="text"
                        class="form-control"
                        id="cpf"
                        name="cpf"
                        value="{{$pessoa->cpf ?? old('cpf')}}"
                    />
                    @if ($errors->has('cpf'))
                        <span class="help-block text-danger">
                          <strong>{{ $errors->first('cpf') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="endereco">Endereço</label>
                    <input
                        type="text"
                        class="form-control"
                        id="endereco"
                        name="endereco"
                        placeholder=""
                        value="{{$pessoa->endereco ?? old('endereco')}}"
                    />
                    @if ($errors->has('endereco'))
                        <span class="help-block text-danger">
                          <strong>{{ $errors->first('endereco') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <a href="{{ url('pessoa') }}" class="btn btn-danger ml-3">
            Cancelar
        </a>
        <button type="submit" class="btn btn-success">
            Salvar
        </button>
    </form>
</div>
@endsection
