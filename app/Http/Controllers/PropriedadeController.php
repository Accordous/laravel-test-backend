<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PropriedadeRequest;
use App\Http\Repositories\PropriedadeRepository;
use App\Http\Resources\PropriedadeCollection;
use App\Http\Resources\PropriedadeResource;
use App\Propriedade;

class PropriedadeController extends Controller
{


    protected $propriedade_repository;

    public function __construct(
        PropriedadeRepository $propriedade_repository
    )
    {
        $this->propriedade_repository = $propriedade_repository;
    }


    public function index(Request $request)
    {

        $columns = ['email_prop', 'rua', 'numero'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = $this->propriedade_repository->listagemOrderBy($columns[$column], $dir);
       
        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('email_prop', 'like', '%' . $searchValue . '%')
                ->orWhere('cidade', 'like', '%' . $searchValue . '%');
            });
        }

        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function store(PropriedadeRequest $request)
    {

     $getPropriedade = $request->all();
     $this->propriedade_repository->add($getPropriedade);
    }


    public function show($id)
    {
       return new PropriedadeResource($this->propriedade_repository->find($id));
    }


    public function update(PropriedadeRequest $request, $id)
    {

     $getPropriedade = $request->all();
     $this->propriedade_repository->edit($id,$getPropriedade);

    }

    public function destroy($id)
    {
        $getPropriedade = $this->propriedade_repository->delete($id);

    }

}

