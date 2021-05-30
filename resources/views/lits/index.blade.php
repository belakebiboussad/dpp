@extends('app')
@section('page-script')
<script type="text/javascript">
function bedShow
</script
@endsection
@section('main-content')
<div class="page-header"><h1>Liste Des Lits :</h1></div>
<div class="row">
	<div class="col-xs-6">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des Lits </h5>
				<div class="widget-toolbar widget-toolbar-light no-border">
			  	<a href="{{ route('lit.create') }}" >
						<div class="fa fa-plus-circle bigger-90"></div><b>&nbsp;Lit</b>
			  	</a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="center">Numéro</th>
								<th class="center">Nom</th>
								<th class="center">Service</th>
								<th class="center">Chambre</th>
								<th class="center">Bloqué </th>
								<th class="center"><em class="fa fa-cog"></em></th>
							</tr>
						</thead>
						<tbody>
							@foreach($lits as $lit)
							<tr>
								<td>{{ $lit->num }}</td>
								<td>{{ $lit->nom }}</td>
								<td>{{ $lit->salle->service->nom }}</td>
								<td>{{ $lit->salle->nom }}</td>
								<td>{{ $lit->etat == 1 ? "Non" : "Oui" }}</td>
								<td class="center">
{{-- <a href="{{ route('lit.show', $lit->id) }}" class="btn btn-xs btn-success"><i class="ace-icon fa fa-hand-o-up  bigger-120"></i></a> --}}
									<button title="" class="btn btn-xs btn-success" onclick="bedShow();"><i class="ace-icon fa fa-hand-o-up  bigger-120"></i></button>
									<a href="{{ route('lit.edit', $lit->id) }}" class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil bigger-120"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-6">
	</div>
</div>
@endsection