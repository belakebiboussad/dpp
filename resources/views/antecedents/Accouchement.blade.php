<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Accouchement</h3></div></div>
<div class="row">
	<div class= "widget-box widget-color-red">
		<div class="widget-header">
		 <h5 class="widget-title bigger lighter"><font color="black"><i class="ace-icon fa fa-table"></i>&nbsp;<b>Accouchement</b></font></h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
				<a id ="accAdd" class="btn-xs align-middle @if(isset($patient->accouchement)) hidden @endif" data-toggle="modal" data-target="#accouchementModal">
					<i class="fa fa-plus-circle bigger-180"></i>
				</a>
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="accouchTab">
					<thead class="thin-border-bottom">
					  <tr>
					  <th class ="center">Lieu</th>{{--   <th class ="center">Terme</th> --}}
					  <th class ="center">Presentation</th>
					  <th class ="center">D.Ouv Oeuf</th><!-- Durée Ouverture de l'Oeuf(h) -->
					  <th class ="center">D. Trav</th><!-- Durée du Travail(h) -->
					  <th class ="center">D. Expul</th><!-- Durée du l'Expulsion(h) -->
 						<th class="center">Type</th>	
 						<th class="center">Incidents</th><!-- <th class="center">Motif</th> -->
 						<th class="center"><em class="fa fa-cog"></em></th>
					  </tr>
					</thead>
					<tbody>
						@isset($patient->accouchement)
						<tr id="{{ 'acc'.$patient->accouchement->id }}">
							<td>{{ $patient->accouchement->etablisement }}</td>{{-- <td>{{ $patient->accouchement->terme }}</td> --}}
							<td>{{ $patient->accouchement->presentation }}</td>
							<td>{{ $patient->accouchement->eggopenduration }}</td>
							<td>{{ $patient->accouchement->workduration }}</td>
							<td>{{ $patient->accouchement->expulsduration }}</td>
							<td>{{ $patient->accouchement->type }} </td>
							<td>{{ $patient->accouchement->incident }}</td>{{-- <td>{{ $patient->accouchement->motif }}</td> --}}
							<td class="center">
								<button type="button" class="btn btn-xs btn-info open-modalacc" value="{{ $patient->accouchement->id}}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>
								<button type="button" class="btn btn-xs btn-danger delete-acc" value="{{ $patient->accouchement->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button> 
							</td>
						</tr>
						@endisset
					</tbody>
				</table>
			</div>
		</div>
	</div>	
</div><div class="row">@include('antecedents.ModalFoms.accouchementModal')</div>