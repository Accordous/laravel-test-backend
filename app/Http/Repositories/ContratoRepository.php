<?php
namespace App\Http\Repositories;

use App\Contrato;
use Exception;
use Illuminate\Support\Facades\DB;

class ContratoRepository extends BaseRepository
{
	protected $model;

	public function __construct(Contrato $model)
	{
		$this->model = $model;
	}

	public function atualizaStatus($id,$data)
	{
		try {
			$query = $this->model->query();

			return 	$query->whereId($id)->update($data);
			
		} catch(Exception $e) {
			return [''=>$e->getMessage()];
		}
	}

}