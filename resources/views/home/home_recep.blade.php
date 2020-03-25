@extends('app_recep')
@section('page-script')
<script type="text/javascript">
</script>
@endsection
@section('main-content')
<div class="page-content">
	<div class="space-12"></div>
	<div class="col-md-12 infobox-container">
		<div class="infobox infobox-green">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-user-md"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\modeles\patient::all()->count() }}</span>
				<div class="infobox-content">Patients</div>
			</div>
		</div>
		<div class="infobox infobox-blue">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-calendar-o"></i>
			</div>
			<div class="infobox-data">
				<span class="infobox-data-number">{{ App\modeles\rdv::all()->count() }}</span>
				<div class="infobox-content">Rendez-Vous</div>
			</div>
		</div>
		<div class="space-12"></div>
	</div>
</div>
@endsection