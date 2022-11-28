<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reservations</title>
    </head>

    <body>
        @include('header')
        
        <div class="room" style="margin-top:150px">
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Rooms</h1>
            <hr style="width:90%;border-top: 2px groove #8c8c8c;">
        </div>

        <div class="container pb-4">
            <form method="post" action="{{ route('agent.room-create') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <table>
                    <tr>
                        <td>
                            Room Title:
                        </td>
                        <td>
                            <input name="room_title" class="form-control" type="text">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Room Type:
                        </td>
                        <td>
                        <select name="room_type" id="room_type" class="form-select">
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
                            <textarea name="room_desc" rows="4" cols="50" class="form-control"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Monthly Rental:
                        </td>
                        <td>
                            <input name="monthly_rental" type="text" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Deposit:
                        </td>
                        <td>
                        <input name="deposit" type="text" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Image:
                        </td>
                        <td>
                            <input name="image" type="file" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Remark:
                        </td>
                        <td>
                            <input name="remark" type="text" class="form-control">
                        </td>
                    </tr>
                </table>
                <button class="btn btn-primary" type="submit">Create</button>
            </form>
        </div>
    </body>
    
    @include('footer')
</html>
