<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Users</title>
    </head>

    <body>
        
        @include('header')
        
        <div class="room" style="margin-top:150px">
            <h1 style="font-size: 30px;color: black;font-weight: bold;text-align: center;">Users</h1>
            <div style="display:flex; justify-content:flex-end; width:100%; padding-right:100px;">
                <a href="{{ route('admin.profile-view') }}" class="btn btn-primary">Manage Profile</a>
            </div>
            <hr style="width:90%;border-top: 2px groove #8c8c8c;">
        </div>

        <div class="container pb-4">
            <div class="row">
                <div class="col-12">
                    <h2>Students</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    Name                 
                                </th>
                                <th>
                                    Student ID
                                </th>
                                <th>
                                    Total Reservations
                                </th>
                                <th>
                                    Created At
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
                            @foreach ($students as $student)
                            <tr>
                                <td>
                                    {{ $student->name }}                 
                                </td>
                                <td>
                                    {{ $student->student_id }}
                                </td>
                                <td>
                                    {{ count($student->reservations) }}
                                </td>
                                <td>
                                    {{ $student->created_at }}
                                </td>
                                <td>
                                    {{ App\Models\Student::STATUS_TEXT[$student->status] }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.view-student', $student->id) }}" class="btn btn-primary">View</a>
                                    @if ($student->status == App\Models\Student::STATUS_UNVERIFIED || $student->status == App\Models\Student::STATUS_FREEZE)
                                    <a href="{{ route('admin.users-activate-student', $student->id) }}" class="btn btn-primary">Activate</a>
                                    @elseif ($student->status == App\Models\Student::STATUS_ACTIVE)
                                    <a href="{{ route('admin.users-deactivate-student', $student->id) }}" class="btn btn-warning">Deactivate</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h2>Agents</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    Name                 
                                </th>
                                <th>
                                    Student ID
                                </th>
                                <th>
                                    Total Rooms Created
                                </th>
                                <th>
                                    Created At
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
                            @foreach ($agents as $agent)
                            <tr>
                                <td>
                                    {{ $agent->name }}                 
                                </td>
                                <td>
                                    {{ $agent->email }}
                                </td>
                                <td>
                                    {{ count($agent->rooms) }}
                                </td>
                                <td>
                                    {{ $agent->created_at }}
                                </td>
                                <td>
                                    {{ App\Models\Agent::STATUS_TEXT[$agent->status] }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.view-agent', $agent->id) }}" class="btn btn-primary">View</a>
                                    @if ($agent->status == App\Models\Agent::STATUS_UNVERIFIED || $agent->status == App\Models\Agent::STATUS_FREEZE)
                                    <a href="{{ route('admin.users-activate-agent', $agent->id) }}" class="btn btn-primary">Activate</a>
                                    @elseif ($agent->status == App\Models\Agent::STATUS_ACTIVE)
                                    <a href="{{ route('admin.users-deactivate-agent', $agent->id) }}" class="btn btn-warning">Deactivate</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    
    @include('footer')
</html>
