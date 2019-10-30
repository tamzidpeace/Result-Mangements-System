@extends('layouts.teacher')
@section('content')
    <h3><a href="/dashboard/teacher/result/{{$mark->subject_id}}"> << back to result sheet</a></h3>
    <div class="container">

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Registration No:</label>
        <div class="col" >
                <p style="margin-top:5px;">{{$mark->student->reg_no}}</p>
        </div> 
        </div>

        <form action="" method="POST">
            @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Term test1:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="tt1" value="{{$mark->tt1}}" placeholder="tt1">
        </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Term test2:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="tt2"value="{{$mark->tt2}}" placeholder ="tt2">
        </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Term test3:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="tt3"value="{{$mark->tt3}}" placeholder ="tt3">
        </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Total term test:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="ttt"value="{{$mark->ttt}}" placeholder ="ttt">
        </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Part A:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="part_a"value="{{$mark->part_a}}" placeholder ="part a">
        </div>
        </div>

         <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Part B:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="part_b"value="{{$mark->part_b}}" placeholder ="part b">
        </div>
        </div>

         <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Attendance:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="attendance"value="{{$mark->attendance}}" placeholder ="attendance">
        </div>
        </div>

         <div class="form-group row">
            <label for="name"  class="col-sm-2 col-form-label">Total:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="total"value="{{$mark->total}}" placeholder="total">
        </div>
        </div>

            <a href="/dashboard/teacher/result"> <button type="submit" class="btn btn-primary">UPDATES</button> </a> 
        </form>

    </div>
  @endsection