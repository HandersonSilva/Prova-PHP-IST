@extends('template.template') @section('conteudo')

<div class="container-md conteudo">
    <h4 class="ml-4">Movimentações</h4>
    <div class="row">
        <div class="col-md-6 scroll-table">
            <h4 class="ml-4">Cadastro de movimentação</h4>
            <form  method="POST" id="form-movimentacao">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="id" id="id_pessoa" value="" />
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12 ">
                            <label for="nome">Pessoa</label>
                            <select name="pessoa_id_movimentacao" id="pessoa_id_movimentacao" class="form-control" value="">
                                <option value="" disabled="" selected="">Selecione</option>
                                @foreach($pessoas as $pessoa)
                                    <option value="{{ $pessoa->id }}"
                                    >{{ $pessoa->nome }} - {{$pessoa->cpf }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 ">
                            <label for="nome">Número da conta</label>
                            <select name="conta_id" id="conta_id" class="form-control" value="">
                                <option value="" disabled="" selected="">Selecione</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="endereco">Valor</label>
                            <input
                                type="text"
                                class="form-control"
                                id="valor"
                                name="valor"
                                placeholder=""
                            />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="nome">Depositar/Retirar</label>
                            <select name="movimentacao" id="movimentacao" class="form-control" value="">
                                <option value="">Selecione</option>
                                <option value="1">Depositar</option>
                                <option value="0">Retirar</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <button type="button" onclick="saveMovimentacao()" class="btn ml-4 btn-success">
                Salvar
            </button>
            <br/>
        </div>
        <div class="col-md-6 ">
            <h4 class="ml-4">Extrato</h4>
            <div class="table-responsive scroll-table extrato">
                <table class="table table-hover table-extrato">
                    <thead>
                        <tr>
                            <th width="50%" scope="col">Data</th>
                            <th width="50%"  scope="col">Valor</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-extrato">
                    </tbody>
                </table>
            </div>
            <div class="saldo">

            </div>
        </div>

    </div>
</div>
@endsection
