<?php


namespace App\Repository;


use App\Models\Conta;
use App\Models\Pessoa;
use App\Util\AppUtil;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ContaRepository
{
    protected $model;
    protected $colunas =  [
        'contas.id',
        'contas.numero',
        'contas.pessoa_id',
        'pessoas.nome',
        'pessoas.cpf',
        'contas.saldo'
    ];

    public function __construct(Conta $conta){
     $this->model = $conta;
    }

    public function pesquisar($data){
        try{
            $contas = $this->getQuery()->where('contas.numero', 'like','%'.$data['texto_busca'].'%')
                ->orwhere('pessoas.nome', 'like','%'.$data['texto_busca'].'%')
                ->orwhere('pessoas.cpf', 'like','%'.$data['texto_busca'].'%')
                ->paginate();

            return $contas;
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function getQuery(){
        return $this->model
            ->select($this->colunas)
            ->join('pessoas', 'pessoas.id', '=', 'contas.pessoa_id');

    }

    public function getConta($id){
        try{
            return $this->model::find($id);
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function getContas(){
        try{
            return  $this->getQuery()->paginate();

        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function getContasPorPessoa($id){
        try{
            return  $this->getQuery()->where('contas.pessoa_id', '=',$id)->get()->toArray();

        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function store($data){
        try{

            $this->model::create($data);
            return true;
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function update($id,$data){
        try{

            $obj = $this->model::find($id);

            if(!$obj){
                return false;
            }

            $obj->fill($data);
            $obj->save();

            return true;
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function delete($id){
        try{
            $obj = $this->model::find($id);
            $obj->delete();

            return true;
        }catch (QueryException $e){
            \Log::info($e);
            return false;
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function getObj($data){
        try{
            $obj = new Conta();

            $obj->fill($data);

            return $obj;
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }
}
