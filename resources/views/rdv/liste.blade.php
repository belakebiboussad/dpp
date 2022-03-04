<div class="col-xs-12 col-sm-12 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des rendez-vous :</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
				<thead class="thin-border-bottom">
					<tr>
						<th class ="center"><strong>Date</strong></th>
						<th class ="center"><strong>Type</strong></th><!-- <th class ="center"><strong>Service</strong></th> -->
						<th class ="center"><strong>Specialité</strong></th>
                                            <th class ="center"><strong>Médcine traitant</strong></th>
						<th class ="center"><strong>Etat</strong></th>
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
                                         <td>{{ $rdv->employe->full_name }}</td> 
						<td class="center">
                                                  <span class="badge badge-{{ $rdv->getEtatID(($rdv->etat)) === 0 ? 'warning':'primary' }}">{{ $rdv->etat }}</span>
						</td>
						<td class="center">
						@if(($rdv->getEtatID($rdv->etat) === '')&&(Carbon\Carbon::today()->lte(Carbon\Carbon::parse($rdv->date->format('Y-m-d H:i:s')))))
                                                    <a href="{{route('rdv.edit',$rdv->id)}}" class="btn btn-xs btn-success" title ="Modifier"><i class="fa fa-edit blue"></i>&nbsp;</a>
                                                    <a id="printRdv" class="btn btn-info btn-xs"  data-dismiss="modal" data-id="{{ $rdv->id }}"> <i class="ace-icon fa fa-print"></i></a>
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
@include('rdv.scripts.print')
