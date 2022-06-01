<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Mére</h3></div></div>
<div class="row">
	<div class= "widget-box widget-color-pink">
		<div class="widget-header">
		 <h5 class="widget-title bigger lighter"><font color="black"><i class="ace-icon fa fa-table"></i>&nbsp;<b>Informations sûr la mére</b></font></h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
				<a id ="motherAdd" class="btn-xs align-middle @if(isset($patient->mother)) hidden @endif" data-toggle="modal" data-target="#motherModal">
					<i class="fa fa-plus-circle bigger-180"></i>
				</a>
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="motherTab">
					<thead class="thin-border-bottom">
					  <tr>
						<th class="center"><h5><strong>Age</strong></h5></th>
						<th class="center"><strong>Poids(kg)</strong></th>
					  	<th class="center">Taille(cm)</th>
						<th class="center hidden-480"><strong>Group Sang</strong></th>
						<th class="center"><em class="fa fa-cog"></em></th>
					  </tr>
					</thead>
					<tbody>
					  @isset($patient->mother)
						<tr id="{{ 'mother'.$patient->mother->id }}">
						 <td>{{ $patient->mother->age }}</td>
						 <td>{{ $patient->mother->motWeight }}</td>
						 <td>{{ $patient->mother->motHeight }}</td>
						 <td>{{ $patient->mother->gs }}{{ $patient->mother->rh }}</td>
						 <td class="center">
						 	<button type="button" class="btn btn-xs btn-info open-modalmoth" value="{{ $patient->mother->id}}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>
							<button type="button" class="btn btn-xs btn-danger delete-mother" value="{{ $patient->mother->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button> 
						 </td>
						</tr>
						@endisset
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div><!-- mere -->
<div class="row">@include('antecedents.ModalFoms.motherModal')</div>