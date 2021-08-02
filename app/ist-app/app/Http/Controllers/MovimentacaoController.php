<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovimentacaoRequest;
use App\Http\Requests\PessoaRequest;
use App\Repository\ContaRepository;
use App\Repository\MovimentacaoRepository;
use App\Repository\PessoaRepository;
use Illuminate\Http\Request;
use App\Models\Pessoa;

class MovimentacaoController extends Controller
{
    protected $pessoaRepository;
    protected $contaRepository;
    protected $movimentacaoRepository;

    public function __construct(PessoaRepository $pessoaRepository,
                                ContaRepository $contaRepository,
                                MovimentacaoRepository $movimentacaoRepository){
        $this->pessoaRepository = $pessoaRepository;
        $this->contaRepository = $contaRepository;
        $this->movimentacaoRepository = $movimentacaoRepository;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pessoas = $this->pessoaRepository->getPessoas();
        $contas = $this->contaRepository->getContas();
        return view('movimentacao.index')->with(compact('contas','pessoas'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $id = $this->movimentacaoRepository->store($data);

        if(!$id){
            return response()->json(['data'=> $data],400);
        }

        return $this->getMovimentacaoPorConta($data['conta_id']);
    }


    public function getMovimentacaoPorConta($id){

        $movimentacao = $this->movimentacaoRepository->getMovimentacaoPorConta($id);
        $conta = $this->contaRepository->getConta($id);

        $data = [
            'movimentacao'=> $movimentacao,
            'saldo'=> $conta->saldo
        ];

        return response()->json(['data'=> $data],200);
    }

}
