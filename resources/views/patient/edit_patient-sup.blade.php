@extends('app')
@section('title','modifier  le patient')
@section('page-script')
@endsection
@section('main-content')
<div class="page-header">
	<h1 style="display: inline;"><strong>modification du Patient :&nbsp;</strong>{{ $patient->getCivilite() }} {{ $patient->Nom }} {{ $patient->Prenom }}</h1>
	<div class="pull-right">
		<a href="{{route('patient.index')}}" class="btn btn-white btn-info btn-bold">
			<i class="ace-icon fa fa-arrow-circle-left bigger-120 blue"></i>
				 Chercher un Patient
		</a>
	</div>
</div>
<h4>{{$patient->situation_familiale}}</h4>
@endsection
