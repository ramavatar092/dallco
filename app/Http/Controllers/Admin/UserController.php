<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('users.index');
    }

    public function getData(Request $request)
    {
        $query = User::query();

        return DataTables::of($query)
            ->addColumn('register_date', function ($user) {
                // assuming you have a created_at timestamp or something similar
                return $user->created_at->format('Y-m-d');
                dd($user->created_at);
            })
            ->addColumn('account_balance', function ($user) {
                // compute or retrieve from accessor or relationship
                return number_format($user->account_balance, 2);
            })
            ->addColumn('action', function ($user) {
                return '<a href="/users/' . $user->id . '/edit" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->rawColumns(['action']) // to render the HTML in 'action' column
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
