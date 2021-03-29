<?php

namespace App\Http\Controllers\handbook;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Html\Builder as BuilderDT;
use DataTables;

class HandbookController extends Controller
{
    public function getTable()
    {
        $routeName = $this->routeName;

        $title = __('handbook.' . $routeName);

        if (request()->ajax()) {

            $data = $this->model->query();

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('layouts.buttons', compact('data'));
                })
                ->addColumn('itemUrl', function ($model) use ($routeName) {
                    return route($routeName . '.update', $model->id);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $builder = app(BuilderDT::class)
            ->columns([
                ['data' => 'id', 'name' => 'id', 'title' => '№', 'style' => 'width: 40px'],
                ['data' => 'title', 'name' => 'title', 'title' => __('table.title')],
                ['data' => 'action', 'name' => 'action', 'title' => __('table.action'), 'style' => 'width: 50px'],
            ])->parameters([
                'language' => [
                    'url' => url('vendor/datatables/js/lang-ru.json')
                ]
            ]);

        return view('layouts.form', compact('builder', 'routeName', 'title'));
    }

    public function setStore($requestValid)
    {
        $this->model->create($requestValid->all());
        return response()->json(['status' => 'success']);
    }

    public function setUpdate($requestValid)
    {
        $this->model->update($requestValid->all());
        return response()->json(['status' => 'success']);
    }

    public function deleteElement()
    {
        $this->model->delete();
        return response()->json(['status' => 'success']);
    }
}
