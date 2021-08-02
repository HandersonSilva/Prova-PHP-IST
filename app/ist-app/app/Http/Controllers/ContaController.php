<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContaRequest;
use App\Http\Requests\PessoaRequest;
use App\Repository\ContaRepository;
use App\Repository\PessoaRepository;
use Illuminate\Http\Request;
use App\Models\Pessoa;

class ContaController extends Controller
{
    protected $contaRepository;
    protected $pessoaRepository;

    public function __construct(ContaRepository $contaRepository,
                                PessoaRepository $pessoaRepository){
        $this->contaRepository = $contaRepository;
        $this->pessoaRepository = $pessoaRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->forget('texto_busca');

        $contas = $this->contaRepository->getContas();


        return view('conta.index')->with(compact('contas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pessoas = $this->pessoaRepository->getPessoas();

        return view('conta.cadastrar')->with(compact('pessoas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContaRequest $request)
    {

        $data = $request->all();
        $status = $this->contaRepository->store($data);

        if(!$status){
            $request->session()->flash('error',"Error ao salvar o registro");
            $conta =  $this->contaRepository->getObj($data);
            $pessoas = $this->pessoaRepository->getPessoas();

            return view('conta.cadastrar')->with(compact(
                'conta','pessoas'
                ));
        }

        return redirect('conta');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conta = $this->contaRepository->getConta($id);
        $pessoas = $this->pessoaRepository->getPessoas();

        return view('conta.cadastrar')->with(compact('conta','pessoas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContaRequest $request, $id)
    {
        $data = $request->all();
        unset($data['id']);

        $status = $this->contaRepository->update($id,$data);

        if(!$status){
            $request->session()->flash('error',"Error ao atualizar o registro");

            $conta =  $this->contaRepository->getObj($data);
            $pessoas = $this->pessoaRepository->getPessoas();

            return view('conta.cadastrar')->with(compact(
                'conta','pessoas'
            ));
        }

        return redirect('conta');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->contaRepository->delete($id);

        if(!$status){
            return response()->json([],400);
        }

        return $status;
    }

    public function pesquisar(Request $request)
    {
        $data = $request->all();
        $request->session()->flash('texto_busca',$data['texto_busca'] );

        $contas = $this->contaRepository->pesquisar($data);

        return view('conta.index')->with(compact('contas'));
    }

    public function getContasPorPessoa($id)
    {
        $contas = $this->contaRepository->getContasPorPessoa($id);

        return response()->json(['data'=> $contas],200);
    }
}
