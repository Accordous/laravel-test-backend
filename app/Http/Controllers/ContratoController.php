<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContratoRequest;
use App\Http\Repositories\ContratoRepository;
use App\Http\Repositories\PropriedadeRepository;
use App\Http\Resources\ContratoCollection;
use App\Http\Resources\ContratoResource;
use App\Contrato;
use App\Propriedade;
use Illuminate\Support\Facades\DB;
class ContratoController extends Controller
{

    protected $contrato_repository;
    protected $propriedade_repository;

    public function __construct(
        ContratoRepository $contrato_repository,
        PropriedadeRepository $propriedade_repository
    )
    {
        $this->contrato_repository = $contrato_repository;
        $this->propriedade_repository = $propriedade_repository;
    }

    public function index(Request $request)
    {
        $columns = ['propriedade_id', 'tp_pessoa', 'documento'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
       
        //new method baserepository
        $query = $this->contrato_repository->listagemOrderBy($columns[$column], $dir);
        
        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function store(ContratoRequest $request,Propriedade $p,Contrato $c)
    {

        try{

            $contratoValida = $this->checkPropriedadeIdUnique($request->propriedade_id,$c);

            if(count($contratoValida) > 0 ){
            
             return "invalido";

        }else{

             //insere em contratos   
             $getContrato = $request->all();
             $this->contrato_repository->add($getContrato);
 
             $data['status'] = 's'; 
             $id = $request->propriedade_id;
 
             //atualiza campo status em propriedades
             $this->updateStatusPropriedade($id,$data);


        }

        } catch(Exception $e) {
            return [''=>$e->getMessage()];
        }
        
    }
    public function updateStatusPropriedade($id,$data)
    {
     //  $p->whereId($id)->update($data); 
         $this->propriedade_repository->edit($id,$data);
    }

    public function checkPropriedadeIdUnique($id,$c)
    {
        $check = $c->where('propriedade_id',$id)->pluck('propriedade_id'); 
        return $check;

        /*
         $check = DB::table('contratos')
         ->where('propriedade_id',$id)
         ->get(); 
         return $check;

          $check = Contrato::where('propriedade_id',$id)->pluck('propriedade_id'); 
         */

    }
}


