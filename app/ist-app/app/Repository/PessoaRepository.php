<?php


namespace App\Repository;


use App\Models\Pessoa;
use App\Util\AppUtil;
use Illuminate\Database\QueryException;

class PessoaRepository
{
    protected $model;

    public function __construct(Pessoa $pessoa){
     $this->model = $pessoa;
    }

    public function pesquisar($data){
        try{
            $pessoas = $this->model::where('nome', 'like','%'.$data['texto_busca'].'%')
                ->orwhere('cpf', 'like','%'.$data['texto_busca'].'%')
                ->orwhere('endereco', 'like','%'.$data['texto_busca'].'%')
                ->paginate();
            return $pessoas;
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function getPessoa($id){
        try{
            return $this->model::find($id);
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function getListaPessoas(){
        try{
            return $this->model::all();
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function getPessoas(){
        try{
            return $this->model::paginate();
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function store($data){
        try{
            $data['cpf'] = AppUtil::limpaCPF_CNPJ($data['cpf']);

            $this->model::create($data);
            return true;
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function update($id,$data){
        try{
            $data['cpf'] = AppUtil::limpaCPF_CNPJ($data['cpf']);

            $obj = Pessoa::find($id);

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
}
