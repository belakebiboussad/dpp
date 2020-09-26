<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Liste Des RDV :</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
				<div class="fa fa-plus-circle"></div>
				<a href="#"  data-target="#RDV" data-toggle="modal" >
					<b>RDV</b>
				</a>
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover">
					<thead class="thin-border-bottom">
						<tr>
							<th>Date RDV</th>
							<th>Nom Médcine Traitant</th>
							<th>Etat RDV</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@if($patient->rdvs->count() > 0)
							@foreach($patient->rdvs as $rdv)
								<tr>
									<td>{{ $rdv->Date_RDV }}</td>
									<td>{{ $rdv->employe->nom }} {{ $rdv->employe->prenom }}	</td>
									<td class="center">
										<span class="label label-{{$rdv->Etat_RDV == "en attente" ? "warning" : "success"}}" style="color: black;">	<b>{{ $rdv->Etat_RDV }}</b></span>
									</td>
									<td class="center">
										<div class="hidden-sm hidden-xs btn-group">
						          <a class="btn btn-xs btn-success" href="{{ route('rdv.show', $rdv->id) }}">
						           	<i class="ace-icon fa fa-hand-o-up bigger-120"></i></a>
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
<div class="row">@include('consultations.ModalFoms.rendezVous')</div>
