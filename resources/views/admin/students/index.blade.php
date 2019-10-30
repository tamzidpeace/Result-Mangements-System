@extends('layouts.admin')
@section('content')
    <div class="container">
    <table class="table table-hover">
        <thead class="table-primary">
<tr>
    <th scope="col">Student Id</th>
    <th scope="col"> Name</th>
    <th scope="col">Registration No</th>
    <th scope="col">Code</th>
    <th scope="col">Session</th>
    <th scope="col">Button</th>
</tr>
</thead>
<tbody>
    @foreach($students as $student)
    <tr>
    <td>{{$student->id}}</td>
     <td>{{$student->user->name}}</td>
    <td>{{$student->reg_no}}</td>
    <td>{{$student->code}}</td>
     <td>{{$student->session}} </td>
     <td>
        <form method="post" style="display: inline;" action="/admin/students/{{$student->id}}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">delete</button>
        </form>
      </td>

    </tr>
    @endforeach
  </tbody>
</table>
<div style="margin-left:40%;">{{$students->links()}}</div>
  </div>
@endsection