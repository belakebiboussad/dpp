@extends('app')
@section('main-content')
<div class="page-header">
	<h1><strong>Détails du Consultation Pour :</strong> 
		{{ $consultation->patient->Nom }} {{ $consultation->patient->Prenom }}
	</h1>
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="widget-box">
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-xs-12">
							<table id="medc_table" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th class="hidden-480">Médicament</th>
										<th class="hidden-480">Forme</th>
										<th class="hidden-480">Dosage</th>
										<th class="hidden-480"></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="widget-box">
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-xs-12">
							<div class="col-xs-6">
								<input type="text" id="id_medicament" name="id_medicament" hidden>
								<label for="nommed">Nom médicament</label>
								<input type="text" class="form-control" id="nommed" placeholder="Nom médicament...">
							</div>
							<div class="col-xs-6">
								<label for="forme">Forme</label>
								<input type="text" class="form-control" id="form" placeholder="Forme...">
							</div>
							<br><br><br><br>
							<div class="col-xs-6">
								<label for="dosage">Dosage</label>
								<input type="text" class="form-control" id="dosage" placeholder="Dosage...">
							</div>
							<br><br><br><br>
							<div class="col-xs-12">
								<label for="posologie">Posologie</label>
								<input type="text" class="form-control" id="posologie" placeholder="Posologie...">
							</div>
							<br><br><br><br>
							<div class="col-xs-12">
								<button type="button" id="addliste" class="btn btn-success pull-right">
									Ajouter a la liste
									&nbsp;<i class="fa fa-mail-forward"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">Ordonnance :</h5>
				<div class="widget-toolbar widget-toolbar-light no-border">
					<button type="button" onclick="supcolonne()" class="btn btn-white btn-danger btn-sm">
						<i class="ace-icon fa fa-trash-o bigger-120 orange"></i>
					</button>
					<button type="button" class="btn btn-white btn-purple btn-sm">
						<i class="ace-icon fa fa-pencil bigger-120 green"></i>
					</button>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-xs-12">
							<table id="ordonnance" class="table  table-bordered table-hover">
								<thead>
									<tr>
										<th></th>
										<th hidden>id</th>
										<th>Médicament</th>
										<th>Forme</th>
										<th>Dosage</th>
										<th>Posologie</th>
									</tr>
								</thead>
							</table>
							<form id="ord" method="POST" action="{{ route('ordonnace.store') }}">
								{{ csrf_field() }}
								<input type="text" name="id_consultation" value="{{ $consultation->id }}" hidden>
							</form>
							<div class="pull-right">
								<button type="button" id="terminer" class="btn btn-primary">
									Terminer
								</button>
							</div>
						</div>
					</div>			
				</div>
			</div>
		</div>
		</div>
	</div><!-- /.col -->
</div><!-- /.row -->
</div>
@endsection