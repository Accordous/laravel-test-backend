<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class AbstractRepository
{
    use ValidatesRequests;

    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function all()
    {
        $data =  $this->model->all();
        if(sizeof($data) > 0){
            return response()->json($data);
        }else {
            return response()->json(['error' => trans('messages.404')], 404);
        }
    }

    public function store(Request $request)
    {
        $myRequest = $this->resolveRequest();

        $myRequest->validated($request->all());

        $dataForm = $request->all();

        $data = $this->model->create($dataForm);

        return response()->json($data, 200);
    }

    public function show($id)
    {
        if (!$data = $this->model->find($id)) {
            return response()->json(['error' => trans('messages.404')], 404);
        } else {
            return response()->json($data, 200);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return response()->json(['error' => trans('messages.404')], 404);
        }

        $myRequest = $this->resolveRequest();

        $myRequest->validated($request->all());

        $dataForm = $request->all();

        $data->update($dataForm);

        return response()->json($data);
    }

    public function destroy($id)
    {
        if ($data = $this->model->find($id)) {
            $data->delete();
            return response()->json(['success' => trans('messages.deleted')], 200);
        } else {
            return response()->json(['error' => trans('messages.404')], 404);
        }
    }
    
    /**
     * Resolve model
     * @return [string] model object
     */

    protected function resolveModel()
    {
        return app($this->model);
    }

    /**
     * Resolve model
     * @return [array] rules object
     */

    protected function resolveRequest()
    {
        return app($this->myRequest);
    }
}