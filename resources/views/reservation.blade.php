<html>
    <h3>Reservation Made</h3>

        <table>
        <thead>
            <tr>
                <th>
                    Transaction ID
                </th>
                <th>
                    Contract Start Date
                </th>
                <th>
                    Contract End Date
                </th>
                <th>
                    Remark
                </th>
                <th>
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
            <tr>
                <td>
                   {{ $reservation->transaction_id }}
                </td>
                <td>
                    {{ $reservation->contract_start_date }}
                </td>
                <td>
                    {{ $reservation->contract_end_date }}
                </td>
                <td>
                    {{ $reservation->remark }}
                </td>
                <td>
                    {{ $reservation->status }}
                </td>
            </tr>
            @endforeach
        </tbody>
        @csrf
        </table>

        <button type="submit">Back</button>
</html>