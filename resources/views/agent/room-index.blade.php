<html>
    <h3>Rooms</h3>

    <table>
        <thead>
            <tr>
                <th>
                    Room Type
                </th>
                <th>
                    Monthly Rental
                </th>
                <th>
                    Deposit
                </th>
                <th>
                    Image
                </th>
                <th>
                    Status
                </th>
                <th>
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
            <tr>
                <td>
                    {{ \App\Models\Room::ROOM_TYPE_LABEL[$room->room_type] }}
                </td>
                <td>
                    {{ $room->monthly_rental }}
                </td>
                <td>
                    {{ $room->deposit }}
                </td>
                <td>
                    <img src="{{ $room->image }}" height="150" width="250">
                </td>
                <td>
                    {{ \App\Models\Room::STATUS_LABEL[$room->status] }}
                </td>
                <td>
                    <a href="{{ route('agent.room-update', $room->id) }}">Edit</a>
                    <a href="{{ route('agent.room-delete', $room->id) }}">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</html>