@extends('app')
@section('title','Ajouter un Fonctionnaire')
@section('page-script')
<script>
	$('#submitButton').click(function () {
		  $('input:invalid').each(function () {
				// Find the tab-pane that this element is inside, and get the id
				var $closest = $(this).closest('.tab-pane');
				var id = $closest.attr('id'); // Find the link that corresponds to the pane and have it show
        $('.nav a[href="#' + id + '"]').tab('show');// Only want to do it once
        return false;
    });
});
</script>
@endsection
@section('main-content')
	<div class="container-fluid">
		  <div class="page-header"><h1>Ajouter un nouveau fonctionnaire</h1></div>
		<form class="form-horizontal" id = "addPAtient" action="{{ route('assur.store') }}" method="POST" role="form">
			  {{ csrf_field() }}
			  @include('assurs.addAssure')
			 <div class="hr hr-dotted"></div>
			<div class="row">
				<div class="center">
					<button class="btn btn-info" id="submitButton" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
				</div>
			</div>	
		</form>
	</div>
@endsection