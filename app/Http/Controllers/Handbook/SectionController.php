<?php

namespace App\Http\Controllers\Handbook;

use App\Http\Controllers\handbook\HandbookController;
use App\Models\Section;
use App\Http\Requests\HandBookCreateUpdateRequest as RequestValid;

class SectionController extends HandbookController
{
    protected $model;
    protected $routeName = 'sections';

    public function __construct(Section $model)
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
    public function update(Section $section, RequestValid $requestValid)
    {
        $this->model = $section;
        return $this->setUpdate($requestValid);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $this->model = $section;
        return $this->deleteElement($section);
    }
}
