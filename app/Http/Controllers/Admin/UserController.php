<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $inputs = $request->all();
        User::create($inputs);

        $notification = array(
            'message' => trans('panel.message.store'),
            'alert-type' =>  trans('panel.alert-type.success')
        );

        return redirect()->route('users.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
        $update = $request->all();
        $user->update($update);

        $notification = array(
            'message' => trans('panel.message.update'),
            'alert-type' =>  trans('panel.alert-type.success')
        );

        return redirect()->route('users.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        $notification = array(
            'message' => trans('panel.message.delete'),
            'alert-type' =>  trans('panel.alert-type.success')
        );

        return redirect()->route('users.index')->with($notification);
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status === 'active' ? 'deactive' : 'active';
        $user->save();

        return response()->json([
            'success' => true,
            'status' => $user->status
        ]);
    }

}
