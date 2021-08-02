<?php


namespace App\Repository;


use App\Models\Conta;
use App\Models\Movimentacao;
use App\Models\Pessoa;
use App\Services\CalcularSaldoService;
use App\Util\AppUtil;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class MovimentacaoRepository
{
    protected $model;
    protected $contaRepository;

    public function __construct(Movimentacao $movimentacao,
                                ContaRepository $contaRepository){
     $this->model = $movimentacao;
     $this->contaRepository = $contaRepository;
    }

    public function getQuery(){
        return $this->model
            ->select('historico.id',
                'historico.valor',
                 DB::raw("DATE_FORMAT(historico.created_at,'%d/%m/%Y %H:%m') AS data"));

    }

    public function getMovimentacao($id){
        try{
            return $this->model::find($id);
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }


    public function getMovimentacaoPorConta($id){
        try{
            return  $this->getQuery()->where('conta_id', '=',$id)->get()->toArray();

        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function store($data){
        try{

            $data['created_at'] = date('y-m-d H:m:s');

            $tipoMOvimentacao = $data['movimentacao'];

            if($tipoMOvimentacao == \App\Enums\Movimentacao::RETIRADA){
                $data['valor'] = $data['valor'] * -1;
            }

            $obj = $this->model::create($data);

            if(!$obj){
                return false;
            }
            $contaId = $data['conta_id'];
            $this->calcular($contaId);

            return $obj->id;
        }catch (\Exception $e){
            \Log::info($e);
            return false;
        }
    }

    public function calcular($idConta){
        $saldo = 0;
        $movimentacaoList = $this->getMovimentacaoPorConta($idConta);

        foreach ($movimentacaoList as $movimentacao){
            $saldo = $saldo + $movimentacao['valor'];
        }

        $this->atualizarSaldo($idConta, $saldo);

    }

    public function atualizarSaldo($idConta,$novoSaldo){
        $this->contaRepository->update($idConta,["saldo"=> $novoSaldo]);
    }

}
