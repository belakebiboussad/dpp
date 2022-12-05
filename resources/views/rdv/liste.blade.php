<div class="col-xs-12 col-sm-12 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des rendez-vous</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th class ="center">Date</th>
						<th class ="center">Type</th>
						<th class ="center">Specialité</th>
            <th class ="center">Médcine traitant</th>
						<th class ="center">Etat</th>
						<th class ="center"><em class="fa fa-cog"></em></th>
					</tr>
				</thead>
				<tbody>
				@if($rdvs->count() > 0)
					@foreach($rdvs as $rdv)
					<tr>
						<td>{{ $rdv->date->format('Y-m-d') }}</td>
						<td>{{ $rdv->fixe ? 'Fixe' : 'Non Fixe' }}</td>
						<td>{{$rdv->specialite->nom }}</td>
            <td>{{ isset($rdv->employ_id) ? $rdv->employe->full_name :'' }}</td> 
						<td class="center">
              <span class="badge badge-{{ $rdv->getEtatID(($rdv->etat)) === 0 ? 'warning':'primary' }}">{{ $rdv->etat }}</span>
						</td>
						<td class="center">
  					 @if(Carbon\Carbon::today()->lte(Carbon\Carbon::parse($rdv->date->format('Y-m-d H:i:s'))))
              <a href="{{route('rdv.edit',$rdv->id)}}" class="btn btn-xs btn-success" title ="Modifier"><i class="fa fa-edit blue"></i></a>
              <a id="printRdv" class="btn btn-info btn-xs" data-dismiss="modal" data-id="{{ $rdv->id }}"> <i class="ace-icon fa fa-print"></i></a>
              @else
                @if($rdv->getEtatID($rdv->etat) === '')
                <a class="btn btn-bold btn-xs btn-danger" href="{{ route('rdv.destroy',$rdv->id )}}" data-method="DELETE" data-confirm="Êtes Vous Sur d'annuler Le Rendez-Vous?" data-dismiss="modal"><i class="fa fa-trash" aria-hidden="true"></i></a>
                @else
                <span class="badge badge-{{( $rdv->getEtatID($rdv->etat)) === 0 ? 'warning':'primary' }}">
                  {{ $rdv->etat }}
                </span>
                @endif
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
