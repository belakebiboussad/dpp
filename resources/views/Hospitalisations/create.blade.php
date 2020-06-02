@extends('app')
@section('page-script')
@endsection
@section('main-content')
<div class="page-header">
	<h1> Ajouter une Hospitalisation </h1>
</div><!-- /.page-header -->
<div class="row">
<div class="col-sm-6 col-xs-6"></div>
<div class="col-sm-6 col-xs-6">
	<form class="form-horizontal" role="form" method="POST" action="{{ route('hospitalisation.store') }}">
		{{ csrf_field() }}
		<input type="text" name="id_demande" value="{{ $demande->id }}" hidden>
	</form>
</div>

</div>
@endsection