@extends('layouts.admin')
@section('content')
    <form  action="/admin/departments" method="post">
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Department Name:</label>
    <div class="col-sm-10">
      <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="Enter Department Name">
    </div>
  </div>
 @csrf

  <div class="form-group row">
    <label for="code" class="col-sm-2 col-form-label">Department code:</label>
    <div class="col-sm-10">
      <input type="text" name="code" class="form-control" id="inputPassword3" placeholder="Enter department code">
    </div>
  </div>



  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Create</button>
    </div>
  </div>
</form>
 @endsection