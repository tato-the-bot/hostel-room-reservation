<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Room;
use App\Models\Rating;
use App\Http\Controllers\ImageUploadController;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $rooms = Room::where('agent_id', Auth::guard('web_agent')->user()->id)
            ->get();

        return view('agent.room-index', [
            'rooms' => $rooms
        ]);
    }

    public function update(Request $request, $roomId)
    {
        if ($request->isMethod('POST')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'room_title' => ['required','string'],
                    'room_type' => ['required'],
                    'room_desc' => ['nullable', 'string'],
                    'monthly_rental' => ['required'],
                    'deposit' => ['required'],
                    'image' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
                    'remark' => ['nullable','string'],
                ]
            );


            if ($validator->fails()) {
                dd($validator->errors());
            }

            $room = Room:: where('agent_id', Auth::guard('web_agent')->user()->id)
                    ->where('id', $roomId)
                    ->first();

            if($request->image != NULL){
                $imageName = time().'.'.$request->image->extension();  
                $request->image->move(public_path('storage/images'), $imageName);
                $imgURL = '/storage/images/'.$imageName;
            }else{
                $imgURL = $room->image;
            }
     
            

            $room->room_title = $request->get('room_title');
            $room->room_type = $request->get('room_type');
            $room->room_desc = $request->get('room_desc') ;
            $room->monthly_rental = $request->get('monthly_rental');
            $room->deposit = $request->get('deposit');
            $room->image = $imgURL;
            $room->remark = $request->get('remark');

            $room->status = 0;
            $room->agent_id = Auth::guard('web_agent')->user()->id;
    
            $room->save();
            
            return redirect()->route('agent.room-index');
        }

        
        $room = Room:: where('agent_id', Auth::guard('web_agent')->user()->id)
            ->where('id', $roomId)
            ->firstOrFail();

        return view('agent.room-update', [
            'room' => $room
        ]);
    }    


    public function delete(Request $request, $roomId)
    {
        $rooms = Room::where('agent_id', Auth::guard('web_agent')->user()->id)
            ->where('id', $roomId)
            ->delete();

        return redirect()->route('agent.room-index');
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'room_title' => ['required','string'],
                    'room_type' => ['required'],
                    'room_desc' => ['nullable', 'string'],
                    'monthly_rental' => ['required'],
                    'deposit' => ['required'],
                    'image' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
                    'remark' => ['nullable','string'],
                ]
            );

            if ($validator->fails()) {
                dd($validator->errors());
            }

            if($request->image != NULL){
                $imageName = time().'.'.$request->image->extension();  
                $request->image->move(public_path('storage/images'), $imageName);
                $imgURL = '/storage/images/'.$imageName;
            }else{
                $imgURL = null;
            }

            $room = new Room;
            $room->room_title = $request->get('room_title');
            $room->room_type = $request->get('room_type');
            $room->room_desc = $request->get('room_desc') ;
            $room->monthly_rental = $request->get('monthly_rental');
            $room->deposit = $request->get('deposit');
            $room->image = $imgURL;
            $room->remark = $request->get('remark');

            $room->status = 0;
            $room->agent_id = Auth::guard('web_agent')->user()->id;
    
            $room->save();
            
            return redirect()->route('agent.room-index');
        }

        return view('agent.room-create');
    }    
}
