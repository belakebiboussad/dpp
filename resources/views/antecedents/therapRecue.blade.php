<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">THERAPEUTIQUES RECUES</h3></div></div>
<div class="row">
 	<div class= "widget-box widget-color-pink">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter"><font color="black"> <i class="ace-icon fa fa-table"></i>&nbsp;<b>THERAPEUTIQUES RECUES</b></font></h5>
		 	<div class="widget-toolbar widget-toolbar-light no-border"> {{-- @if(isset($patient->therapieRecue)) hidden @endif --}}
				<a id="therapRecueAdd" class="btn-xs align-middle @if(count($patient->therapieRecue)) hidden @endif" data-toggle="modal"><i class="fa fa-plus-circle bigger-180" style="color:black"></i></a>
			</div>
	 	</div>
	 	<div class="widget-body">
			<div class="widget-main no-padding">
				<table id="therapTab" class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable">
					<thead class="thin-border-bottom">
						<tr>
							<th class="center">Médicament</th>
							<th class="center">transfusion</th>
							<th class="center">sérum</th>
						  <th class="center"><em class="fa fa-cog"></em></th>
						</tr>
					</thead>
					<tbody>
						@foreach($patient->therapieRecue as $th)
						<tr id="{{ 'trait'.$th->id }}">
							<td>
						 		@foreach($th->medicaments as $med)
									{{ $med->Nom_com }},
								@endforeach
							</td>
							<td>{{ $th->transfusion }}</td>
							<td>{{ $th->serum}}</td>
							<td class="center">
								<button type="button" class="btn btn-xs btn-info open-modalTraiRecu" value="{{ $th->id}}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>
								<button type="button" class="btn btn-xs btn-danger delete-trait" value="{{ $th->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button> 
						 </td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">@include('antecedents.ModalFoms.theraprecuModal')</div> 
