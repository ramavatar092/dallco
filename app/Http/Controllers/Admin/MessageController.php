<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Message\StoreRequest;
use App\Http\Requests\Message\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\DataTables\MessagesDataTable;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MessagesDataTable $dataTable)
    {
        return $dataTable->render('users.messages.index', ['dataTable' => $dataTable]);
    }


     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.messages.create');
    }



     public function store(StoreRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        Message::create($inputs);

        $notification = array(
            'message' => trans('panel.message.store'),
            'alert-type' =>  trans('panel.alert-type.success')
        );

        return redirect()->route('messages.index')->with($notification);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        return view('users.messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Message $message)
    {
        $update = $request->all();
        $update['user_id'] = Auth::user()->id;
        $message->update($update);

        $notification = array(
            'message' => trans('panel.message.update'),
            'alert-type' =>  trans('panel.alert-type.success')
        );

        return redirect()->route('messages.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return response()->json(['success' => true, 'message' => trans('panel.message.delete')], 200);
    }
}
