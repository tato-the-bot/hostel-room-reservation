<html>
    <h3>Room - Form</h3>
    <form method="post" action="{{ route('agent.room-create') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <table>
            <tr>
                <td>
                    Room Title:
                </td>
                <td>
                    <input name="room_title" type="text">
                </td>
            </tr>
            <tr>
                <td>
                    Room Type:
                </td>
                <td>
                <select name="room_type" id="room_types">
                    <option value="">Select Room Type</option>
                    <option value="big_room">Big Room</option>
                    <option value="medium_room">Medium Room</option>
                    <option value="single_room">Single Room</option>
                </select>
                </td>
            </tr>
            <tr>
                <td>
                    Room Description:
                </td>
                <td>
                    <textarea name="room_desc" rows="4" cols="50"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    Monthly Rental:
                </td>
                <td>
                    <input name="monthly_rental" type="text">
                </td>
            </tr>
            <tr>
                <td>
                    Deposit:
                </td>
                <td>
                <input name="deposit" type="text">
                </td>
            </tr>
            <tr>
                <td>
                    Image:
                </td>
                <td>
                    <input name="image" type="file">
                </td>
            </tr>
            <tr>
                <td>
                    Remark:
                </td>
                <td>
                    <input name="remark" type="text">
                </td>
            </tr>
        </table>
        <button type="submit">Create</button>
</html>