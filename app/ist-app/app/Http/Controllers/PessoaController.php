<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Repository\PessoaRepository;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    protected $pessoaRepository;

    public function __construct(PessoaRepository $pessoaRepository){
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

        $pessoas = $this->pessoaRepository->getPessoas();

        return view('pessoa.index')->with(compact('pessoas'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pessoa.cadastrar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PessoaRequest $request)
    {

        $data = $request->all();
        $status = $this->pessoaRepository->store($data);

        if(!$status){
            $request->session()->flash('error',"Error ao salvar o registro");
            $pessoa = $data;
            return view('pessoa.cadastrar')->with(compact('pessoa'));
        }

        return redirect('pessoa');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pessoa = $this->pessoaRepository->getPessoa($id);

        return view('pessoa.cadastrar')->with(compact('pessoa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PessoaRequest $request, $id)
    {
        $data = $request->all();
        unset($data['id']);

        $status = $this->pessoaRepository->update($id,$data);

        if(!$status){
            $request->session()->flash('error',"Error ao atualizar o registro");
            $pessoa = $data;
            return view('pessoa.cadastrar')->with(compact('pessoa'));
        }

        return redirect('pessoa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = $this->pessoaRepository->delete($id);

        if(!$status){
            return response()->json([],400);
        }

         return $status;
    }

    public function pesquisar(Request $request)
    {
        $data = $request->all();
        $request->session()->flash('texto_busca',$data['texto_busca'] );

        $pessoas = $this->pessoaRepository->pesquisar($data);

        return view('pessoa.index')->with(compact('pessoas'));
    }

    public function getListaPessoas()
    {
        $pessoas = $this->pessoaRepository->getListaPessoas();

        return $pessoas;

    }
}
