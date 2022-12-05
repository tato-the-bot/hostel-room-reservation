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
                    'monthly_rental' => ['required', 'numeric'],
                    'deposit' => ['required', 'numeric'],
                    'image' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
                    'remark' => ['nullable','string'],
                ]
            );

            if (!$validator->fails()) {
                $room = Room:: where('agent_id', Auth::guard('web_agent')->user()->id)
                    ->where('id', $roomId)
                    ->first();

                if ($request->image != NULL){
                    $imageName = time().'.'.$request->image->extension();  
                    $request->image->move(public_path('storage/images'), $imageName);
                    $imgURL = '/storage/images/'.$imageName;
                } else {
                    $imgURL = $room->image;
                }

                $room->room_title = $request->get('room_title');
                $room->room_type = $request->get('room_type');
                $room->room_desc = $request->get('room_desc');
                $room->location = $request->get('location');
                $room->monthly_rental = $request->get('monthly_rental');
                $room->deposit = $request->get('deposit');
                $room->image = $imgURL;
                $room->remark = $request->get('remark');

                $room->status = 0;
                $room->agent_id = Auth::guard('web_agent')->user()->id;
        
                $room->save();
                
                return redirect()->route('agent.room-index');
            }
        }
        
        $room = Room:: where('agent_id', Auth::guard('web_agent')->user()->id)
            ->where('id', $roomId)
            ->firstOrFail();

        $viewData = [
            'room_title' => $request->post('room_title') ?? $room->room_title,
            'room_type' => $request->post('room_type') ?? $room->room_type,
            'room_desc' => $request->post('room_desc') ?? $room->room_desc,
            'location' => $request->post('location') ?? $room->location,
            'monthly_rental' => $request->post('monthly_rental') ?? $room->monthly_rental,
            'deposit' => $request->post('deposit') ?? $room->deposit,
            'remark' => $request->post('remark') ?? $room->remark,
            'room' => $room,
            'errors' => !empty($validator) ? $validator->errors()->getMessages() : []
        ];

        return view('agent.room-update', $viewData);
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
        $room = new Room;

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

            if (!$validator->fails()) {
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
                $room->location = $request->get('location') ;
                $room->monthly_rental = $request->get('monthly_rental');
                $room->deposit = $request->get('deposit');
                $room->image = $imgURL;
                $room->remark = $request->get('remark');
    
                $room->status = 0;
                $room->agent_id = Auth::guard('web_agent')->user()->id;
        
                $room->save();
                
                return redirect()->route('agent.room-index');
            }
        }

        $viewData = [
            'room_title' => $request->post('room_title'),
            'room_type' => $request->post('room_type'),
            'room_desc' => $request->post('room_desc'),
            'location' => $request->post('location'),
            'monthly_rental' => $request->post('monthly_rental'),
            'deposit' => $request->post('deposit'),
            'remark' => $request->post('remark'),
            'room' => $room,
            'errors' => !empty($validator) ? $validator->errors()->getMessages() : []
        ];

        return view('agent.room-create', $viewData);
    }    
}
