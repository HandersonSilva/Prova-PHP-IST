@extends('template.template') @section('conteudo')
<div class="container-md conteudo">
    <h3 class="modal-title">
        @if(isset($conta)) Editar @else Cadastrar @endif
    </h3>
    @if(Session::get('error'))
    <div class="alert alert-danger" role="alert">
      {{Session::get('error')}}
    </div>
    @endif

    @if(isset($conta) && !empty($conta->id)) <form action="{{
        url("conta/$conta->id")
    }}" method="POST"> @method('PUT') @else
    <form action="/conta" method="POST">
        @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="id" id="id_pessoa" value="" />
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-8 ">
                    <label for="nome">Pessoa</label>
                    <select name="pessoa_id" id="pessoa_id" class="form-control" value="">
                        @foreach($pessoas as $pessoa)
                            <option value="{{ $pessoa->id }}"
                            @if ($pessoa->id == old('pessoa_id'))
                                selected="selected"
                            @endif
                            @if (isset($conta))
                                @if ($pessoa->id == $conta->pessoa_id)
                                    selected="selected"
                                @endif
                            @endif
                            >{{ $pessoa->nome }} - {{$pessoa->cpf }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('pessoa_id'))
                        <span class="help-block text-danger">
                          <strong>{{ $errors->first('pessoa_id') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="nome">Número da Conta</label>
                    <input
                        autofocus
                        type="text"
                        class="form-control"
                        id="numero"
                        name="numero"
                        maxlength="10"
                        value="{{$conta->numero ?? old('numero')}}"
                    />
                    @if ($errors->has('numero'))
                        <span class="help-block text-danger">
                          <strong>{{ $errors->first('numero') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <a href="{{ url('conta') }}" class="btn btn-danger ml-3">
            Cancelar
        </a>
        <button type="submit" class="btn btn-success">
            Salvar
        </button>
    </form>
</div>
@endsection
