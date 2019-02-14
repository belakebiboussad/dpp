@extends('app')
@section('main-content')
<div class="page-header">
	<h1>Liste Des Chambres :</h1>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">
					<i class="ace-icon fa fa-table"></i>
					Liste Des Chambres :
				</h5>
				<div class="widget-toolbar widget-toolbar-light no-border">
				 <span class="glyphicon glyphicon-plus blue icon-3x" aria-hidden="true"></span>
				<a href="/createsalle" class ="btn-sky"> <b>Ajouter Une Chambre</b></a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th width="5%">N°</th>
								<th width="15%">Nom De La Chambre</th>
								<th width="10%">Max  Lits</th>
								<th width="10%">n° Bloc</th>
								<th>Etage</th>
								<th>Etat</th>
								<th>Service</th>
								<th  width="30%"></th>
							</tr>
						</thead>
						<tbody>
								@foreach($salles as $salle)
								<tr>
									<td width="5%">{{ $salle->num }}</td>
									<td width="15%">{{ $salle->nom }}</td>
									<td width="10%">{{ $salle->max_lit }}</td>
									<td width="10%">{{ $salle->bolc }}</td>
									<td>{{ $salle->etage }}</td>
									<td>{{ $salle->etat }}</td>
									<td >{{ App\modeles\service::where("id",$salle->service_id)->get()->first()->nom }}</td>
									<td width="30%">
									<div >
									<div  class="hidden-sm hidden-xs btn-group pull-right">
									<a href="/lit/create/{{ $salle->id }}" class="btn btn-xs btn-grey pull-right">
									<i class="ace-icon fa fa-plus bigger-120"></i>
									Lit
									</a>
									&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
									<a  href="{{ route('salle.show', $salle->id) }}" class="btn btn-xs btn-success pull-right">
									<i class="ace-icon fa fa-hand-o-up bigger-120"></i>Détails
									</a>
									&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
									<a   href="{{ route('salle.edit', $salle->id) }}" class="btn btn-xs btn-info pull-right">
									<i class="ace-icon fa fa-pencil bigger-120"></i>Modifier
									</a>
												
								</div>
								</div>
								</td>
								</tr>
								@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection