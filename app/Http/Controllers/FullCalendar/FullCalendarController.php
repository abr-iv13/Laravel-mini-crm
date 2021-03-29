<?php

namespace App\Http\Controllers\FullCalendar;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\CreateEventFullcalendarRequest;
use App\Http\Requests\UpdateFullcalendarRequest;
use Illuminate\Http\Request;

class FullCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        if (auth()->user()->hasRole('admin')) {
            $authorizedRoles = ['admin', 'user', 'manager'];
            $roleUsers = User::whereHas('roles', function ($query) use ($authorizedRoles) {
                return $query->whereIn('name', $authorizedRoles);
            })->get();
        }
        if (auth()->user()->hasRole('manager')) {
            $roleUsers = Role::where('name', 'user')->first()->users()->get();
        }

        return view('calendar.index', compact('roleUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEventFullcalendarRequest $request, Event $event)
    {
        $event->create($request->all());
        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UpdateFullcalendarRequest $request, Event $event)
    {
        $eventAll = $event->whereBetween('start', [$request->start, $request->end])->get();
        $checkDoneTasks = $eventAll->map(function ($element) {

            if (($element->compilited_at !== null)) {
                $element->color = '#18171B';
            }
            return $element;
        });

        return $checkDoneTasks;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateEventFullcalendarRequest $request, Event $calendar)
    {
        $requestAll = $request->all();

        if ($request->end == null) {
            unset($requestAll['end']);
        }

        if ($request->compilited_at == true) {
            $requestAll['compilited_at'] = date('Y-m-d');
        } else {
            $requestAll['compilited_at'] = null;
        }

        $calendar->update($requestAll);

        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $calendar)
    {
        $calendar->delete();
        return response()->json(['status' => 'success']);
    }
}
