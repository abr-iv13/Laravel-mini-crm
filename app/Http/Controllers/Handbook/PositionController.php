<?php

namespace App\Http\Controllers\Handbook;

use App\Http\Controllers\handbook\HandbookController;
use App\Models\Position;
use App\Http\Requests\HandBookCreateUpdateRequest as RequestValid;

class PositionController extends HandbookController
{
    protected $model;
    protected $routeName = 'positions';

    public function __construct(Position $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->getTable();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestValid $requestValid)
    {
        return $this->setStore($requestValid);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Position $position, RequestValid $requestValid)
    {
        $this->model = $position;
        return $this->setUpdate($requestValid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {   
        $this->model = $position;
        return $this->deleteElement();
    }
}
