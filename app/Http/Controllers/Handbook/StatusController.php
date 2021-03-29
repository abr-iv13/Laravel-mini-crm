<?php

namespace App\Http\Controllers\Handbook;

use App\Http\Controllers\Handbook\HandbookController;
use App\Models\Status;
use App\Http\Requests\HandBookCreateUpdateRequest as RequestValid;

class StatusController extends HandbookController
{
    protected $model;
    protected $routeName = 'statuses';

    public function __construct(Status $model)
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
    public function update(Status $status, RequestValid $requestVaid)
    {
        $this->model = $status;
        return $this->setUpdate($requestVaid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $this->model = $status;
        return $this->deleteElement();
    }
}
