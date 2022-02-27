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
						<th class ="center"><strong>Specialité</strong></th>{{-- <th class ="center"><strong>Médcine traitant</strong></th> --}}
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
						<td>{{$rdv->specialite->nom}} </td>
						<td class="center">
						@if(isset($rdv->Etat_RDV))
							@switch($rdv->Etat_RDV)
									@case(0)
     										<span class="label label-sm label-danger">Annuler</span>
      									 	@break
      									@case(1)
      										<span class="label label-sm label-success">Valider</span>
      										@break
      									@default
      										<span class="label label-sm label-success">{{ $rdv->Etat_RDV }}</span>
      										@break
							@endswitch
						@else
							<span class="label label-sm label-primary">En Cours</span>
						@endif
						</td>
						<td class="center">
							<div>
							@if(!(isset($rdv->etat))  && ($rdv->specialite_id == Auth::user()->employ->specialite) &&(Carbon\Carbon::today()->lte(Carbon\Carbon::parse($rdv->date->format('Y-m-d H:i:s')))))
							<a href="{{route('rdv.edit',$rdv->id)}}" class="btn btn-xs btn-success" title ="Modifier"><i class="fa fa-edit blue"></i>&nbsp;</a>
							<a href="{{route('rdv.destroy',$rdv->id)}}" class="btn btn-xs btn-danger" data-method="DELETE" data-confirm="Etes Vous Sur d\'annuler le RDV ?" title="Annuler RDV"><i class="ace-icon fa fa-trash-o orange"></i>&nbsp;</a>
							@endif
							@if (\Carbon\Carbon::now()->lte($rdv->date->format('Y-m-d H:i:s')))
  							<a href="{{route('rdv.print',$rdv->id)}}" class="btn btn-xs btn-white" title="Imprimer recu"><i class="ace-icon fa fa-print"></i></a>
							@endif
						     	</div>
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
