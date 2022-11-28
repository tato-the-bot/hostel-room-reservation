<html>
    <h3>Room Update - Form</h3>
    <form method="post" action="{{ route('agent.room-update' , $room->id) }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <table>
            <tr>
                <td>
                    Room Title:
                </td>
                <td>
                    <input name="room_title" type="text" value="{{ $room->room_title ?? old('room_title') }}">
                    <p></p>
                </td>
            </tr>
            <tr>
                <td>
                    Room Type:
                </td>
                <td>
                <select name="room_type" id="room_type" value="{{ $room->room_type }}">
                    <option value="">Select Room Type</option>
                    <option value="big_room" {{ "big_room" == $room->room_type ? 'selected' : '' }} >Big Room</option>
                    <option value="medium_room" {{ "medium_room" == $room->room_type ? 'selected' : '' }}>Medium Room</option>
                    <option value="single_room" {{ "single_room" == $room->room_type ? 'selected' : '' }}>Single Room</option>
                </select>
                </td>
            </tr>
            <tr>
                <td>
                    Room Description:
                </td>
                <td>
                    <textarea name="room_desc" rows="4" cols="50" value="{{ $room->room_desc ?? old('room_desc') }}">{{ $room->room_desc ?? old('room_desc') }}</textarea>
                </td>
            </tr>
            <tr>
                <td>
                    Monthly Rental:
                </td>
                <td>
                    <input name="monthly_rental" type="text" value="{{ $room->monthly_rental ?? old('monthly_rental') }}">
                </td>
            </tr>
            <tr>
                <td>
                    Deposit:
                </td>
                <td>
                <input name="deposit" type="text" value="{{ $room->deposit ?? old('deposit') }}">
                </td>
            </tr>
            <tr>
                <td>
                    Image:
                </td>
                <td>
                    <img src='{{ $room->image }}' style="width:320px; height:240px;">
                    <input name="image" type="file" value="{{ $room->image ?? old('image') }}">
                </td>
            </tr>
            <tr>
                <td>
                    Remark:
                </td>
                <td>
                    <input name="remark" type="text" value="{{ $room->remark ?? old('remark') }}">
                </td>
            </tr>
        </table>
        <button type="submit">Update</button>
    </form>
</html>