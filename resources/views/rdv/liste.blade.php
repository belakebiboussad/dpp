<div class="col-xs-12 col-sm-12 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header">
			<h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i>Liste des rendez-vous</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th class ="center">Date</th><th class ="center">Fixe?</th>
						<th class ="center">Specialité</th><th class ="center">Médcine traitant</th>
            <th class ="center">Etat</th><th class ="center"><em class="fa fa-cog"></em></th>
					</tr>
				</thead>
				<tbody>
				@if($rdvs->count() > 0)
					@foreach($rdvs as $rdv)
					<tr id="{{$rdv->id}}">
						<td>{{ $rdv->date->format('Y-m-d') }}</td><td>{{ $rdv->fixe ? 'Oui' : 'Non' }}</td>
						<td>{{$rdv->specialite->nom }}</td>
            <td>{{ isset($rdv->employ_id) ? $rdv->employe->full_name :'' }}</td> 
		        <td class="center">{!! $formatStat($rdv->etat)!!}</td>
            <td class="center">
            @if($rdv->etat != "Annule")
            <a href="{{route('rdv.edit',$rdv->id)}}" class="btn btn-xs btn-success" title ="Modifier"><i class="fa fa-edit blue"></i></a>
            <a id="printRdv" href ="/rdvprint/{{ $rdv->id}}"  target="_blank"class="btn btn-info btn-xs"><i class="ace-icon fa fa-print"></i></a>
            <button type="button" class="btn btn-bold btn-xs btn-danger rdvDelete" value="{{ $rdv->id}}"><i class="fa fa-trash"></i></button>
            @endif
		</td>
	</tr>
	@endforeach
	@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@include('rdv.scripts.js')
