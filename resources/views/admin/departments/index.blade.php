@extends('layouts.admin')
@section('content')
    <div class="container">
    <table class="table table-hover">
        <thead class="table-primary">
<tr>
    <th scope="col">Department Id</th>
    <th scope="col">Department Name</th>
    <th scope="col">Department Code</th>
    <th scope="col">Button</th>
</tr>
</thead>
<tbody>
    @foreach($departments as $department)
    <tr>
    <td>{{$department->id}}</td>
    <td>{{$department->name}}</td>
    <td>{{$department->code}} </td>

        <td><form method="post" style="display: inline;" action="/admin/departments/{{$department->id}}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">delete</button>
        </form></td></tr>


    @endforeach
  </tbody>
</table>
</div>
    <form action="/admin/departments/create">
        <button class="btn btn-primary">Create </button>
    </form>
  @endsection