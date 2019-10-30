@extends('layouts.teacher')
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
        @foreach($courses as $course)
        <tr>
        <td>
        {{$course->code}}
        </td>
    
             <?php
             $a = 0;
             $b =0;
             if(App\Subject::where('course_id',$course->id)->where('year',$year)->exists())
             {
                $subject = App\Subject::where('course_id',$course->id)->where('year',$year)->first();
                if($subject->teacher_id == Auth::user()->userable->id)
                {
                    $a = 1;
                }
                else
                 {
                    $b = 1;
                 }
            }
               
            ?>
            <td>
             @if($a)
                    <form method="post" action="/dashboard/teacher/unregister">
                        @csrf
                         <input type="hidden" name="year" value="{{$year}}">
                         <input type="hidden" name="course_id" value="{{$course->id}}">
                        <button type="submit" class="btn btn-danger">Unregister</button>
                    </form>

            @elseif($b)
                    <p style="display:inline;">registered</p>
            @else
                    <form method="post" action="">
                        @csrf
                        <input type="hidden" name="year" value="{{$year}}">
                         <input type="hidden" name="course_id" value="{{$course->id}}">
                        <button type="submit"class="btn btn-primary">Register</button>
                    </form>
                    
            @endif
        </td>
         </tr>
            
        @endforeach
    </tbody>
</table>
</div>
    
@endsection