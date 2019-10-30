@extends('layouts.teacher')
@section('content')
<div class="container">
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Reg No</th>
                <th scope="col">Term Test1</th>
                <th scope="col">Term Test2</th>
                <th scope="col">Term Test3</th>
                <th scope="col">Total Term Test</th>
                <th scope="col">Attendance</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($marks as $mark)
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$mark->student->reg_no}}</td>
                <td>{{$mark->tt1}}</td>
                <td>{{$mark->tt2}}</td>
                <td>{{$mark->tt3}}</td>
                <td>{{$mark->ttt}}</td>
                <td>{{$mark->attendance}}</td>
                <td>
                    <a href="/dashboard/teacher/result/in-course/edit/{{$mark->id}}" class="btn btn-primary"
                        role="button">Update</a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection