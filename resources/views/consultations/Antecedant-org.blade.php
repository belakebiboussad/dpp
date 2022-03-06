<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Antécédents personnels</h3></div></div>
<div class="row">
<div class= "widget-box widget-color-blue">
	<div class="widget-header">
		 <h5 class="widget-title bigger lighter"><font color="black"><i class="ace-icon fa fa-table"></i>&nbsp;<b>Pathologiques</b></font></h5>
		<div class="widget-toolbar widget-toolbar-light no-border">
			<a  id="btn-add" class="btn-xs align-middle" data-toggle="modal"><i class="fa fa-plus-circle bigger-180" style="color:black"></i></a>
		</div>
	</div>
	<div class="widget-body" id ="ATCDWidget">
		<div class="widget-main no-padding">
			<table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="antsTab">
				<thead class="thin-border-bottom">
				  <tr class ="center">
					<th class ="hidden"></th>	<!-- <th class="center"><strong><span style="font-size:14px;">Type</span></strong></th> -->
					<th class="center"><strong><span style="font-size:14px;">Nature</span></strong></th>
					<th class="center"><i class="fa fa-clock-o bigger-110" aria-hidden="true"></i>
						<strong>&nbsp;<span style="font-size:14px;">Date</span></strong>
				   	</th>
				   	<th class="center">Code CIM</th>
					<th class="center hidden-480"><span style="font-size:14px;"><strong>Description</strong></span></th>
					<th class="center"><em class="fa fa-cog"></em></th>
				  </tr>
				</thead>
				<tbody>
				 @foreach($patient->antecedants as $antcd)
					@if(($antcd->Antecedant == "Personnels") &&($antcd->typeAntecedant == "0"))
					<tr id="{{ 'atcd'.$antcd->id }}">
						<td class ="hidden" >{{ $antcd->pid }}</td><!-- 	<td>Pathologiques</td> -->
						<td> {{ $antcd->stypeatcd }}</td>	     
						<td>{{ $antcd->date }}</td>
						<td>{{ $antcd->cim_code }}</td>
						<td>{{ $antcd->description }}</td>
						<td class="center"> 
							<button type="button" class="btn btn-xs btn-info open-modal" data-atcd ="c"  value="{{$antcd->id}}"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>
							 <button type="button" class="btn btn-xs btn-danger delete-atcd" value="{{$antcd->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
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
<div class="space-12"></div>
<div class="row"><!-- Physiologiques -->
<div class= "widget-box widget-color-danger">
	<div class="widget-header" >
		 <h5 class="widget-title bigger lighter"><font color="black"><i class="ace-icon fa fa-table"></i>&nbsp;<b>Physiologiques</b></font></h5>
		<div class="widget-toolbar widget-toolbar-light no-border">
			<a id="btn-addAntPhys" class="btn-xs align-middle" data-toggle="modal"><i class="fa fa-plus-circle bigger-180" style="color:black"></i></a>
		</div>
	</div>
	<div class="widget-body" id ="ATCDWidget">
		<div class="widget-main no-padding">
			<table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="antsPhysTab">
				<thead class="thin-border-bottom">
				  <tr class ="center">
						<th class ="hidden"></th><!-- 	<th class="center"><strong><span style="font-size:14px;">Type</span></strong></th> -->
						<th class="center"><i class="fa fa-clock-o bigger-110" aria-hidden="true"></i>
							<strong>&nbsp;<span style="font-size:14px;">Date</span></strong>
					  </th>
					  <th class="center">Code CIM</th>
						<th class="center hidden-480"><span style="font-size:14px;"><strong>Description</strong></span></th>
						<th class ="center">Tabac</th>
						<th class ="center">Ethylisme</th>
						<th class ="center">Hab alim</th>
						<th class="center"><em class="fa fa-cog"></em></th>
				  </tr>
				</thead>
				<tbody>
				 	@foreach($patient->antecedants as $antcd)
						@if(($antcd->Antecedant == "Personnels") &&($antcd->typeAntecedant == "1"))
						<tr id="{{ 'atcd'.$antcd->id }}">
							<td class ="hidden" ></td><!-- <td>Physiologiques</td>   -->
							<td>{{ $antcd->date }}</td>
							<td>{{ $antcd->cim_code }}</td>
							<td>{{ $antcd->description }}</td>
							<td>{{ $antcd->tabac === 0 ?  'Non' : 'Oui' }}</td>
							<td>{{ $antcd->ethylisme ===0 ? 'Non' : 'Oui' }}</td>
							<td>{{ $antcd->habitudeAlim }}</td>
							<td class="center"> 
								<button type="button" class="btn btn-xs btn-info Phys-open-modal" data-atcd ="c"  value="{{$antcd->id}}"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>
								<button type="button" class="btn btn-xs btn-danger delete-atcd" value="{{$antcd->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
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
<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Antécédents familiaux</h3></div></div>
<div class="row">
 	 <div class= "widget-box widget-color-green">
		<div class="widget-header" >
		<h5 class="widget-title bigger lighter"><font color="black"> <i class="ace-icon fa fa-table"></i>&nbsp;<b>Antécédents familiaux</b></font></h5>
		 <div class="widget-toolbar widget-toolbar-light no-border">
			<a id="AntFamil-add" class="btn-xs align-middle" data-toggle="modal"><i class="fa fa-plus-circle bigger-180" style="color:black"></i></a>
		</div>
	 	 </div>
	 	 <div class="widget-body" id ="ATCDWidget">
			<div class="widget-main no-padding">
				<table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id ="antsFamTab">
					<thead class="thin-border-bottom">
						  <tr class ="center">
							<th class ="hidden"></th>
							  <th class="center" ><i class="fa fa-clock-o bigger-110" aria-hidden="true"></i>
								<strong>&nbsp;<span style="font-size:14px;">Date</span></strong>
							  </th>
							  <th class="center">Code CIM</th>
							  <th class="center hidden-480"><span style="font-size:14px;"><strong>Description</strong></span></th>
							  <th class="center"><em class="fa fa-cog"></em></th>
						  </tr>
					</thead>
					<tbody>
					 @foreach($patient->antecedants as $antcd)
						 @if($antcd->Antecedant == "Familiaux") 
						<tr id="{{ 'atcd'.$antcd->id }}">
							<td class ="hidden" >{{ $antcd->pid }}</td> 
							<td>{{ $antcd->date }}</td>
							<td>{{ $antcd->cim_code }}</td>
							<td>{{ $antcd->description }}</td>
							<td class="center"> 
								<button type="button" class="btn btn-xs btn-info open-modalFamil" data-atcd ="d"  value="{{$antcd->id}}"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>
								<button type="button" class="btn btn-xs btn-danger delete-atcd" value="{{$antcd->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button>
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
<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Facteurs de risque</h3></div></div>
<div class="row"><div class="col-sm-12"><label for="infos"><b>Facteurs Généraux</b></label></div> </div>
<div class="row">
 	<div class="col-sm-3 col-xs-6">
		<div class="checkbox">
		<input type="hidden" name="exercice" value="0">
	  <label><input name="exercice" type ="checkbox" class="ace" value="1" @if(isset($patient->facteurRisque) && ($patient->facteurRisque->exercice)) checked @endif/>
	 		<span class="lbl text-nowrap">Exercice physique</span>
	 	</label>
    </div>   
  </div>
  <div class="col-sm-3 col-xs-6">
		<div class="checkbox">
			<input type="hidden" name="regime" value="0">
	 		<label><input name="regime" type="checkbox" class="ace" value="1" @if(isset($patient->facteurRisque)&&($patient->facteurRisque->regime)) checked @endif/>
	 			<span class="lbl text-nowrap">Régime</span>
	 		</label>
    </div>   
	</div>
	<div class="col-sm-3 col-xs-6">
		<div class="checkbox">
			<input type="hidden" name="drogue" value="0">
			<label><input name="drogue" type="checkbox" class="ace" value="1" @if(isset($patient->facteurRisque)&&($patient->facteurRisque->drogue)) checked @endif/>
				<span class="lbl text-nowrap">Drogue</span>
			</label>
    </div>   
	</div>
	<div class="col-sm-3 col-xs-6">
		<div class="checkbox">
		<input type="hidden" name="sedentarite" value="0">
		<label><input name="sedentarite" type="checkbox" class="ace" value="1" @if(isset($patient->facteurRisque)&&($patient->facteurRisque->sedentarite)) checked @endif/>
	 		<span class="lbl text-nowrap">Sédentarité</span>
	 	</label>
	  </div>   
	</div>
</div>
<div class="space-12"></div>
<div class="row">
      <div class="col-sm-3 col-xs-6">
	      <label for="autrefact" class="text-nowrap"><strong>Autre éléments sociaux</strong></label>
	      <textarea class="form-control" name="autrefact">@if(isset($patient->facteurRisque)) {{ $patient->facteurRisque->autrefact }} @endif</textarea> 
			</div>
	<div class="col-sm-3 col-xs-6">
	      <label for="statut_fam"><strong>Statut familial</strong></label>
		<textarea class="form-control" name="statut_fam">@if(isset($patient->facteurRisque)) {{ $patient->facteurRisque->statut_fam }} @endif</textarea> 
	</div>
	<div class="col-sm-3 col-xs-6">
	      <label for="habitat"><strong>Habitat</strong></label>
		<textarea class="form-control" name="habitat">@if(isset($patient->facteurRisque)) {{ $patient->facteurRisque->habitat }} @endif</textarea> 
	</div>
	<div class="col-sm-3 col-xs-6">
	      <label for="professionnel" class="text-nowrap"><strong>Facteurs professionnels</strong></label>
	      <textarea class="form-control" name="professionnel">@if(isset($patient->facteurRisque)) {{ $patient->facteurRisque->professionnel }} @endif</textarea> 
	</div>
</div>