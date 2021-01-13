<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste des RDV :</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">{{-- <a href="#" data-target="#RDV" data-toggle="modal"></a> --}}
				<div class="fa fa-plus-circle"></div><a href="#" id="addRdv" class="btn-xs tooltip-link" ><h4><strong>RDV</strong></h4></a>
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th class ="center"><strong>Date</strong></th>
							<th class ="center"><strong>Fixe ?</strong></th>
							<th class ="center"><strong>Service</strong></th>
							<th class ="center"><strong>Médcine Traitant</strong></th>
							<th class ="center"><strong>Etat</strong></th>
							<th class ="center"><em class="fa fa-cog"></th>
						</tr>
					</thead>
					<tbody>
					@if($patient->rdvs->count() > 0)
						@foreach($patient->rdvs as $rdv)
						<tr>
							<td>{{ $rdv->Date_RDV->format('Y-m-d') }}</td>
							<td>{{ $rdv->fixe ? 'Oui' : 'Non' }}</td>
							<td>{{ $rdv->employe->Service->nom}}</td>
							<td>{{ $rdv->employe->nom }} {{ $rdv->employe->prenom }}	</td>
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
								<div class="hidden-sm hidden-xs btn-group">{{-- $rdv->Employe_ID_Employe ==Auth::user()->employee_id --}}
								@if(!(isset($rdv->Etat_RDV))  && ($rdv->employe->Specialite == Auth::user()->employ->Specialite) &&(Carbon\Carbon::today()->lte(Carbon\Carbon::parse($rdv->Date_RDV->format('Y-m-d H:i:s')))))
									<a href="{{route('rdv.edit',$rdv->id)}}" class="btn btn-xs btn-success" title ="Modifier"><i class="fa fa-edit blue"></i>&nbsp;</a>
									<a href="{{route('rdv.destroy',$rdv->id)}}" class="btn btn-xs btn-danger" data-method="DELETE" data-confirm="Etes Vous Sur d\'annuler le RDV ?" title="Annuler RDV"><i class="ace-icon fa fa-trash-o orange"></i>&nbsp;</a>
								@endif{{-- @if (\Carbon\Carbon::now()->lte($rdv->Date_RDV->format('Y-m-d H:i:s')) && ($rdv->Etat_RDV !=0))--}}
								@if (\Carbon\Carbon::now()->lte($rdv->Date_RDV->format('Y-m-d H:i:s')))
    								<a href="{{route('rdv.pdf',$rdv->id)}}" class="btn btn-xs btn-white" title="Imprimer recu"><i class="ace-icon fa fa-print"></i></a>
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
