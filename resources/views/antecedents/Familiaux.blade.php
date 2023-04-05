<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Familiaux</h3></div></div>
<div class="row">
 	 <div class= "widget-box widget-color-green">
		<div class="widget-header" >
		<h5 class="widget-title bigger lighter"><font color="black"> <i class="ace-icon fa fa-table"></i>&nbsp;Antécédents familiaux</font></h5>
		 <div class="widget-toolbar widget-toolbar-light no-border">
			<a id="AntFamil-add" class="btn-xs align-middle" data-toggle="modal">
        <i class="fa fa-plus-circle bigger-180" style="color:black"></i></a>
		</div>
	 	</div>
	 	<div class="widget-body" id ="ATCDWidget">
			<div class="widget-main no-padding">
				<table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id ="antsFamTab">
					<thead class="thin-border-bottom">
						  <tr class ="center">
							  <th class="center" ><i class="fa fa-clock-o bigger-110" aria-hidden="true"></i>Date</th>
								<th class="center">Code CIM</th>
							  <th class="center hidden-480">Description</th>
							  <th class="center"><em class="fa fa-cog"></em></th>
						  </tr>
					</thead>
					<tbody>
					 @foreach($obj->patient->antecedants as $antcd)
						 @if($antcd->Antecedant == "Familiaux") 
						<tr id="{{ 'atcd'.$antcd->id }}">
							<td>{{ $antcd->date }}</td>
							<td>{{ $antcd->cim_code }}</td>
							<td>{{ $antcd->description }}</td>
							<td class="center"> 
								<button type="button" class="btn btn-xs btn-info open-modalFamil" data-atcd ="d"  value="{{$antcd->id}}"><i class="fa fa-edit fa-lg" aria-hidden="true"></i></button>
								<button type="button" class="btn btn-xs btn-danger delete-atcd" value="{{$antcd->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button>
							</td>
						 </tr>
						@endif
			  		@endforeach
					</tbody>
				</table>
			</div>	
		</div>
	</div>
</div>
@if(!in_array(1,$specialite->antecTypes()->pluck('id')->toArray()))
	<div class="row">@include('antecedents.ModalFoms.AntecedantModal')</div>
@endif
