<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Gender;
use App\Models\Position;
use App\Models\Section;
use App\Models\Status;
use Yajra\DataTables\Html\Builder;

use DataTables;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request, Builder $builder, User $user)
    {
        if ($request->ajax()) {

            $data = User::with(['gender', 'status', 'section', 'position', 'roles']);

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('users.buttons', compact('data'));
                })
                ->addColumn('roles', function ($user) {
                    return $user->roles->map(function ($role) {
                        return $role->display_name;
                    })->implode('<br>');
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => '№', 'style' => 'width:  100px'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Имя', 'style' => 'width: 100px'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Почта'],
            ['data' => 'roles', 'name' => 'roles', 'title' => 'Права', 'style' => 'width: 100px'],
            ['data' => 'section.title', 'name' => 'section.title', 'title' => 'Отдел', 'style' => 'width: 100px'],
            ['data' => 'position.title', 'name' => 'position.title', 'title' => 'Должность', 'style' => 'width: 100px'],
            ['data' => 'gender.title', 'name' => 'gender.title', 'title' => 'Пол', 'style' => 'width: 100px'],
            ['data' => 'status.title', 'name' => 'status.title', 'title' => 'Статус', 'style' => 'width: 100px'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Действие', 'style' => 'width: 50px'],
        ])->parameters([
            'language' => [
                'url' => url('vendor/datatables/js/lang-ru.json')
            ]
        ]);

        return view('users.index', compact('builder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');
        $genders = Gender::get();
        $positions = Position::get();
        $statuses = Status::get();
        $sections = Section::get();

        return view('users.create', compact('roles', 'genders', 'positions', 'statuses', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, CreateUserRequest $request)
    {
        $requestAll = $request->all();
        $userCreate = $user->create($requestAll);
        $userCreate->attachRole($request->role);
        flash(__('user.create'))->success();
        return redirect()->route('users.index')->with('success', trans('user.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roleId = $user->roles->pluck('id');
        $roles = Role::pluck('name', 'id');
        $genders = Gender::get();
        $positions = Position::get();
        $statuses = Status::get();
        $sections = Section::get();

        return view('users.edit', compact('user', 'roleId', 'roles', 'genders', 'positions', 'statuses', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(UserRequest $request, User $user)
    {
        $requestAll = $request->all();
        if ($request->password == null) {
            unset($requestAll['password']);
        }
        $user->update($requestAll);
        $user->roles()->sync($request->role);
        flash(__('user.create'))->success();
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['status' => 'success']);
    }
}
