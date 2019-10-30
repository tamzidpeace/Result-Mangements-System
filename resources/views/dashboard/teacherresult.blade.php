@extends('layouts.teacher')
@section('content')
<div class="container">
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th scope="col">Course</th>
                <th scope="col"> Action </th>
                <th scope="col"> Action </th>
                <th scope="col">Year</th>
            </tr>
        </thead>
        <tbody>

            @foreach($subjects as $subject)
            <tr>
                <td>
                    <div><a
                            href="/dashboard/teacher/result/{{$subject->id}}"><strong>{{$subject->course->name}}</strong></a>
                    </div>
                </td>
                <td>
                    {!! Form::open(['method' => 'get', 'action' => ['DashboardController@teacherResultOption',
                    $subject->id]]) !!}


                    <div class="form-group">
                        {!! Form::submit('Update In-Course Result', ['class' => 'btn btn-primary btn-block']) !!}
                    </div>

                    {!! Form::close() !!}
                </td>
                <td>
                    {!! Form::open(['method' => 'get', 'action' => ['DashboardController@semesterFinalResult',
                    $subject->id]]) !!}


                    <div class="form-group">
                        {!! Form::submit('Update Semester Final Result', ['class' => 'btn btn-primary btn-block']) !!}
                    </div>

                    {!! Form::close() !!}
                </td>
                <td>{{$subject->year}}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>

@endsection