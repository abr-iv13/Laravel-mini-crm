<?php

namespace App\Http\Controllers\Handbook;

use App\Http\Controllers\Handbook\HandbookController;
use App\Models\Gender;
use App\Http\Requests\HandBookCreateUpdateRequest as RequestValid;

class GenderController extends HandbookController
{
    protected $model;
    protected $routeName = 'genders';

    public function __construct(Gender $model)
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
    public function update(Gender $gender, RequestValid $requestValid)
    {
        $this->model = $gender;
        return $this->setUpdate($requestValid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gender $gender)
    {
        $this->model = $gender;
        return $this->deleteElement();
    }
}
