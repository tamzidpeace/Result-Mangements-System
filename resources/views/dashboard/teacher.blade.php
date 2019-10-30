@extends('layouts.teacher')
@section('content')


<div class="row">
	<?php $i=1; ?>
	@foreach($ss as $s)
	<div class="col">
		<div class="card text-dark bg-info mb-3" style="max-width: 20rem;">
		  <div class="card-header">{{$s->course->name}}</div>
		 
		  <div class="card-body">
		  	<p>Course code - {{$s->course->code}}</p>
		  	<p>Year {{$s->year}}</p>
		    <h4 class="card-title"> Students - {{count($s->marks)}}</h4>
		    <!-- <p class="card-text">something</p> -->
		  </div>
		</div>
	</div>
	@if($i++%3==0)
		<div class="w-100"></div>
	@endif
	@endforeach
</div>


@endsection