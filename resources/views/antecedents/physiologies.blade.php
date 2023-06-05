<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Physiologiques</h3></div></div>

<div class="row">
<div class= "widget-box widget-color-blue">
	<div class="widget-header" >
	<h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i>Antécédants Physiologiques</h5>
		<div class="widget-toolbar widget-toolbar-light no-border">
			<a id="btn-addAntPhys" class="btn-xs align-middle" data-toggle="modal"><i class="fa fa-plus-circle bigger-180"></i></a>
		</div>
	</div>
	<div class="widget-body" id ="ATCDWidget">
		<div class="widget-main no-padding">
			<table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="antsPhysTab">
				<thead class="thin-border-bottom">
				  <tr>
						<th class="center">Date</th>
						<th class="center">Code CIM</th><th class ="center">Tabac</th>
						<th class ="center">Ethylisme</th><th class ="center">Hab alim</th>
						<th class="center hidden-480">Description</th>
						<th class="center"><em class="fa fa-cog"></em></th>
				  </tr>
				</thead>
				<tbody>
				 	@foreach($obj->patient->antecedants as $antcd)
						@if(($antcd->Antecedant == "Personnels") &&($antcd->typeAntecedant == "1"))
						<tr id="{{ 'atcd'.$antcd->id }}">
							<td>{{ $antcd->date }}</td><td>{{ $antcd->cim_code }}</td>
							<td>{{ $antcd->tabac === 0 ?  'Non' : 'Oui' }}</td>
							<td>{{ $antcd->ethylisme ===0 ? 'Non' : 'Oui' }}</td>
							<td>{{ $antcd->habitudeAlim }}</td><td>{{ $antcd->description }}</td>
							<td class="center"> 
								<button type="button" class="btn btn-xs btn-success Phys-open-modal" data-atcd ="c"  value="{{$antcd->id}}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>
								<button type="button" class="btn btn-xs btn-danger delete-atcd" value="{{$antcd->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></button> 
						 </td>
						</tr>
						@endif
					@endforeach
				</tbody>
			</table>
		</div>
	</div>{{-- widget-body --}}
</div>{{-- widget-box --}}
</div>{{-- row --}}
