@extends('layouts.admin')
@section('content')
    <form  action="/admin/courses" method="post">
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Course Name:</label>
    <div class="col-sm-10">
      <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="Enter Course Name">
    </div>
  </div>
 @csrf
  <div class="form-group row">
    <label for="code" class="col-sm-2 col-form-label">Course code:</label>
    <div class="col-sm-10">
      <input type="text" name="code" class="form-control" id="inputPassword3" placeholder="Enter Course code">
    </div>
  </div>

  <div class="form-group row">
    <label for="semester" class="col-sm-2 col-form-label">Semester:</label>
    <div class="col-sm-10">
      <input type="text" name="semester" class="form-control" id="inputPassword3" placeholder="Enter semester">
    </div>
  </div>

  <div class="form-group row">
    <label for="dept_id" class="col-sm-2 col-form-label">Department id:</label>
    <div class="col-sm-10">
      <input type="text" name="department_id" class="form-control" id="inputPassword3" placeholder="Enter department_id">
    </div>
  </div>

  
  <div class="form-group row">
    <label for="dept_id" class="col-sm-2 col-form-label">Credit</label>
    <div class="col-sm-10">
      <input type="text" name="credit" class="form-control" id="inputPassword3" placeholder="Enter credit" required>
    </div>
  </div>
  



  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Create</button>
    </div>
  </div>
</form>
@endsection