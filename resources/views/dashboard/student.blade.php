@extends('layouts.student')
@section('content')


<div class="row">
	<?php $i=1; ?>
	@foreach($cgpas as $cgpa)
	<div class="col">
		<div class="card text-dark bg-info mb-3" style="max-width: 20rem;">
		  <div class="card-header">Semester {{$cgpa->semester}}</div>
		 
		  <div class="card-body">
			@if($cgpa->gpa!=0.00)
		  	<p>GPA in this semester - {{$cgpa->gpa}}</p>
			@else
			<p>No results for this semester</p>
			@endif
		  	<!-- <p>Year {</p> -->
		    <!-- <h4 class="card-title"> Students - </h4> -->
		    <!-- <p class="card-text">something</p> -->
		  </div>
		</div>
	</div>
	@if($i++%3==0)
		<div class="w-100"></div>
	@endif
	@endforeach
	<div class="col">
		<div class="card text-dark bg-danger mb-3" style="max-width: 20rem;">
		  <div class="card-header">CGPA</div>
		 
		  <div class="card-body">
					<p style="color:white;">Your Current CGPA is - {{$ccgpa}}</p>
		  </div>
		</div>
	</div>
</div>


@endsection