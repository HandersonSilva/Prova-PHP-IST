@extends('template.template') @section('conteudo')

<div class="container-md conteudo">
    <h4 class="ml-4">Contas</h4>
    <div class="row div-botoes">
        <div class="col-md-3 mb-4">
            <a href="{{ url('conta/create') }}" class="btn btn-success">
                Nova Conta
            </a>
        </div>
        <div class="col-md-9">
            <form action="/conta/pesquisar" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="form-row">
                    <div class="col-10">
                        <div class="form-group mb-2">
                            <input
                                type="text"
                                class="form-control"
                                name="texto_busca"
                                placeholder="Pesquisar..."
                                value="{{Session::get('texto_busca') ?? ''}}"
                            />
                        </div>
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary mb-2">
                            Pesquisar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 scroll-table">
            <div class="table-responsive">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="10%" scope="col">Código</th>
                            <th width="20%"  scope="col">Nome</th>
                            <th width="15%"  scope="col">CPF</th>
                            <th width="15%"  scope="col">Número da conta</th>
                            <th width="20%"  scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    {{$contas}}
                        @foreach($contas as $obj)
                        <tr>
                            <td width="10%"  scope="row">{{ $obj->id }}</td>
                            <td width="20%" >{{ $obj->nome }}</td>
                            <td width="15%" >{{ $obj->cpf }}</td>
                            <td width="35%" >{{ $obj->numero }}</td>
                            <td width="20%" >
                                <a

                                    class="btn btn-info"
                                    href="{{url("conta/$obj->id/edit")}}"
                                    >Editar</a
                                >
                                <button type="button"  id="{{url("conta/$obj->id")}}"
                                    onclick="deleteRegistro(this.id)"  class="btn btn-danger">
                                    Excluir
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ( sizeof($contas) <= 0)
            <h3 style="text-align: center;">Nenhum pessoa cadastrado</h3>
            @endif
        </div>
        {{$contas->links()}}
    </div>
</div>
@endsection
