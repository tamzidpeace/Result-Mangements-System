@extends('layouts.student')
@section('content')
    <div class="container">
    <table class="table table-hover">
            <thead class="table-primary">
    <tr>
        <th scope="col">Course code</th>
        <th scope="col">Register/Unregister</th>
    </tr>
    </thead>
    <tbody>
    @foreach($subjects as $subject)
    <tr>
    <td>
    <div>{{$subject->course->code}}</div>
     </td>
    <?php
        $a=0;
        if(\App\Mark::where('year',$year)->
        where('student_id',\Auth::user()->userable->id)->
        where('subject_id',$subject->id)->exists())
        $a=1;      
        
    ?>
    <td> 
    @if($a==0)
    <div><a href="/dashboard/student/register/{{$subject->id}}?year={{$year}}" class="btn btn-primary" role ="button">
        register</a></div>
    @else
    <div><a href="/dashboard/student/unregister/{{$subject->id}}?year={{$year}}" class="btn btn-danger" role ="button">unregister</a></div>
    @endif
    </td>
    </tr>
    @endforeach

</tbody>
</table>
    </div>
@endsection