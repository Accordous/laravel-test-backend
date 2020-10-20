<?php
namespace App\Http\Repositories;

use App\Propriedade;
use Exception;
use Illuminate\Support\Facades\DB;

class PropriedadeRepository extends BaseRepository
{
	protected $model;

	public function __construct(Propriedade $model)
	{
		$this->model = $model;
	}


}