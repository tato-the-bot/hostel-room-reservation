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
        // Query to get all rooms created by agent
        $rooms = Room::where('agent_id', Auth::guard('web_agent')->user()->id)
            ->get();

        return view('agent.room-index', [
            'rooms' => $rooms
        ]);
    }

    public function update(Request $request, $roomId)
    {
        if ($request->isMethod('POST')) {
            // This configures a validator to validate the request
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
            // If validating input is not fail 
            if (!$validator->fails()) {
                // Query to get room details
                $room = Room:: where('agent_id', Auth::guard('web_agent')->user()->id)
                    ->where('id', $roomId)
                    ->first();
                // If input image is not NULL
                if ($request->image != NULL){
                    // change image name to current upload time
                    $imageName = time().'.'.$request->image->extension(); 
                    // save image to public path 
                    $request->image->move(public_path('storage/images'), $imageName);
                    // store img path into a variable
                    $imgURL = '/storage/images/'.$imageName;
                // If in room data originally has img
                } else {
                    // Keep the img
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

                // set room status to active
                $room->status = 0; 
                $room->agent_id = Auth::guard('web_agent')->user()->id;
        
                $room->save();
                
                return redirect()->route('agent.room-index');
            }
        }
        
        // Query to get room details
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
        // Query to delete room
        $rooms = Room::where('agent_id', Auth::guard('web_agent')->user()->id)
            ->where('id', $roomId)
            ->first();

        $rooms->status = Room::STATUS_DELETE;
        $rooms->save();

        return redirect()->route('agent.room-index');
    }

    public function create(Request $request)
    {
        // Create new object for new room
        $room = new Room;

        if ($request->isMethod('POST')) {
            // This configures a validator to validate the request
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
            // If validating input is not fail 
            if (!$validator->fails()) {
                // If input image is not NULL 
                if($request->image != NULL){
                    // change image name to current upload time
                    $imageName = time().'.'.$request->image->extension();  
                    // save image to public path
                    $request->image->move(public_path('storage/images'), $imageName);
                    // store img path into a variable
                    $imgURL = '/storage/images/'.$imageName;
                }else{
                    // If input img is NULL then the URL would be NULL (No default img)
                    $imgURL = null;
                }
                // create new object for new room
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
