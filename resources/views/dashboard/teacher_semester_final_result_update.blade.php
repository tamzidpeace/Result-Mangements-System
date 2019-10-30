@extends('layouts.teacher')
@section('content')
<h3><a href="/dashboard/teacher/result/{{$mark->subject_id}}">
        << back to result sheet</a> </h3> <div class="container">

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Code:</label>
                <div class="col">
                    <p style="margin-top:5px;">{{$mark->student->code}}</p>
                </div>
            </div>

            <form action="" method="POST">
                @csrf


                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Part A:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="part_a" value="{{$mark->part_a}}"
                            placeholder="part a">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Part B:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="part_b" value="{{$mark->part_b}}"
                            placeholder="part b">
                    </div>
                </div>


                <a href="/dashboard/teacher/result"> <button type="submit" class="btn btn-primary">UPDATE</button> </a>
            </form>

            </div>
            @endsection