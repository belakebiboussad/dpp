@extends('app')
@section('title','Ajouter un patient')
@section('page-script')
 <script>
 $(function(){
 	
 })
</script>
@endsection
@section('main-content')
<div class="container-fluid">
  <div>
  	<h4><strong>Ajouter un nouveau patient</strong></h4>
  	<div class="pull-right">
			<a href="{{route('patient.index')}}" class="btn btn-white btn-info btn-bold">
				<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i> Rechercher un patient
			</a>
		</div>
  </div>
  <div class="row tabs">
		<form class="form-horizontal" id ="addPatientForm" action="{{ route('patient.store') }}" method="POST" role="form">
	    {{ csrf_field() }}
	    <div class="row">
				<div class="col-sm-12">
					<div class="form-group" id="error" aria-live="polite">
					@if (count($errors) > 0)
				  <div class="alert alert-danger">
						<ul>
						@foreach ($errors->all() as $error)
					 	  <li>{{ $error }}</li>
						@endforeach
						</ul>
					</div>
					@endif
					</div>
	   		 	<ul class="nav nav-pills nav-justified list-group" role="tablist" id="menuPatient">
			  	 	<li class="active">
			   			<a data-toggle="tab" href="#Assure" class="jumbotron" onclick="copyPatientInfo(null);"><span class="bigger-130"><strong>Assuré(e)</strong></span></a>
						</li>
						<li ><a class="jumbotron" data-toggle="tab" href="#Patient"><span class="bigger-130"><strong>Patient</strong></span></a></li>
			 		</ul>
			 		<div class="tab-content">
						<div id="Assure" class="tab-pane in active">@include("assurs.addAssure")</div>
						<div id="Patient" class="tab-pane fade">@include('patient.addPatient')</div>
		  		</div>	<!-- col-sm-12 -->
			</div><!-- row -->
		</form>
	</div>
</div>
 @endsection