@extends('app')
@section('page-script')
<script type="text/javascript">
function bedShow(id){
 	$.get('/lit/'+id, function (data, status, xhr) {
	  $('#lit').html(data.html);
	});
}
</script>
@endsection
@section('main-content')
<div class="page-header"><h4>Lits :</h4></div>
<div class="row">
	<div class="col-xs-7">
		<div class="widget-box widget-color-blue">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Détails des lits </h5>
				<div class="widget-toolbar widget-toolbar-light no-border">
			  	<a href="{{ route('lit.create') }}" ><i class="fa fa-plus-circle bigger-120"></i> Lit</a>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="center">Numéro</th><th class="center">Nom</th>
								<th class="center">Service</th><th class="center">Chambre</th>
								<th class="center">Bloqué </th><th class="center">Affecté</th>
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
								<td>{{ $lit->bloq == 1 ? "Oui" : "Non" }}</td>
                                                            <td>{{ $lit->affectation == 1 ? "Oui" : "Non" }}</td>
								<td class="center">
	 								<button title="" class="btn btn-xs btn-success" onclick="bedShow('{{$lit->id}}');"><i class="ace-icon fa fa-hand-o-up"></i></button>
									<a href="{{ route('lit.edit', $lit->id) }}" class="btn btn-xs btn-info">
										<i class="ace-icon fa fa-pencil"></i>
									</a>
									<a href="{{ route('lit.destroy', $lit->id) }}" class="btn btn-xs btn-danger smalltext" data-method="DELETE" data-confirm="Etes Vous Sur ?"><i class="ace-icon fa fa-trash-o fa-xs"></i>
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
	<div class="col-xs-5" id="lit">
	</div>
</div>
@endsection