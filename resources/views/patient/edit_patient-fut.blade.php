@extends('app')
@section('page-script')
<script>
</script>
@endsection
@section('main-content')
<div class="container-fluid">
<div class="row">
<div class="page-header">
	<h1>Ajouter Un Patient</h1>
</div>
<form class="form-horizontal" id = "editPatient" action="{{ route('patient.update') }}" method="POST" role="form" autocomplete="off" onsubmit="return checkFormAddPAtient(this);">
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
		</div>
	</div>
	<ul class="nav nav-pills nav-justified list-group" role="tablist" id="menuPatient">
   		 <li class="active"><a data-toggle="tab" href="#Patient">
   		 	<span class="bigger-130"><strong>Patient</strong></span></a>
   		 </li>
    		<li><a data-toggle="tab" href="#Assure">
    			<span class="bigger-130"><strong>Assure</strong></span></a>
    		</li>
  	</ul>
    <div class="tab-content">
    <div id="Patient" class="tab-pane fade in active">
            <div class="row">
            </div> {{-- row --}}
      </div> {{-- tab-pane --}}
      <div id="Assure" class="tab-pane fade">
      </div>    {{-- tab-pane --}}
      </div>
      {{-- tab-content --}}
      </form>
      @endsection