@extends('layouts.admin')
@section('content')
<div class="container">
    <table class="table table-hover">
        <thead class="table-primary">
<tr>
    <th scope="col">Course id</th>
    <th scope="col">Course Name</th>
    <th scope="col">Course Code</th>
    <th scope="col">Button</th>
</tr>
</thead>
<tbody>
    @foreach($courses as $course)
    <tr>
  <td>{{$course->id}}</td>
   <td>{{$course->name}}</td>
    <td>{{$course->code}}</td>
    <td>
        <form method="post" style="display: inline;" action="/admin/courses/{{$course->id}}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
    <div style="margin-left:40%;">{{$courses->links()}}</div>
    <form action="/admin/courses/create">
        <button class="btn btn-primary">Create </button>
    </form>
  @endsection