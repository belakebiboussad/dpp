<h4 class="header smaller lighter blue">Accouchement</h4>
<div class="row">
	<div class= "widget-box widget-color-red">
		<div class="widget-header">
<h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i> Accouchement</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
				<a id ="accAdd" class="btn-xs align-middle @if(isset($obj->patient->accouchement)) hidden @endif" data-toggle="modal" data-target="#accouchementModal">
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
						@isset($obj->patient->accouchement)
						<tr id="{{ 'acc'.$obj->patient->accouchement->id }}">
							<td>{{ $obj->patient->accouchement->etablisement }}</td>{{-- <td>{{ $obj->patient->accouchement->terme }}</td> --}}
							<td>{{ $obj->patient->accouchement->presentation }}</td>
							<td>{{ $obj->patient->accouchement->eggopenduration }}</td>
							<td>{{ $obj->patient->accouchement->workduration }}</td>
							<td>{{ $obj->patient->accouchement->expulsduration }}</td>
							<td>{{ $obj->patient->accouchement->type }} </td>
							<td>{{ $obj->patient->accouchement->incident }}</td>{{-- <td>{{ $obj->patient->accouchement->motif }}</td> --}}
							<td class="center">
								<button type="button" class="btn btn-xs btn-info open-modalacc" value="{{ $obj->patient->accouchement->id}}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>
								<button type="button" class="btn btn-xs btn-danger delete-acc" value="{{ $obj->patient->accouchement->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button> 
							</td>
						</tr>
						@endisset
					</tbody>
				</table>
			</div>
		</div>
	</div>	
</div><div class="row">@include('antecedents.ModalFoms.accouchementModal')</div>