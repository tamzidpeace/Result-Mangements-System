@extends('layouts.teacher')
@section('content')
<div class="container">
  <table class="table table-hover">
    <thead class="table-primary">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Code</th>        
        <th scope="col">Part A</th>
        <th scope="col">Part B</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      @foreach($marks as $mark)
      <tr>
        <th scope="row">{{$i++}}</th>
        <td>{{$mark->student->code}}</td>
        <td>{{$mark->part_a}}</td>
        <td>{{$mark->part_b}}</td>
        <td>
          <a href="/dashboard/teacher/result/semester-final/edit/{{$mark->id}}" class="btn btn-primary" role="button">Update</a>
        </td>

      </tr>
      @endforeach
    </tbody>
  </table>

</div>
@endsection