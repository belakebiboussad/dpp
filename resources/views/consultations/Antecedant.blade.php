<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Antecedants Personnels</h3></div></div>
<div class="row">
<div class= "widget-box widget-color-blue" id="widget-box-2">
	<div class="widget-header" >
		 <h5 class="widget-title bigger lighter"><font color="black"><i class="ace-icon fa fa-table"></i>&nbsp;<b>Antecedants Pathologiques</b></font></h5>
		<div class="widget-toolbar widget-toolbar-light no-border" width="20%">
			<div class="fa fa-plus-circle"></div>
			<a href="#" id="btn-add" class="btn-xs tooltip-link" data-toggle="modal"><h4><strong>Antecedant</strong></h4></a>
		</div>
	</div>
	<div class="widget-body" id ="ATCDWidget">
		<div class="widget-main no-padding">
			<table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="antsTab">
				<thead class="thin-border-bottom">
				  <tr class ="center">
					<th class ="hidden"></th>
					<th class="center"><strong><span style="font-size:14px;">Type</span></strong></th>
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
						<td class ="hidden" >{{ $antcd->Patient_ID_Patient }}</td>
						<td>Pathologiques</td>
						<td> {{ $antcd->stypeatcd }}</td>	     
						<td>{{ $antcd->date }}</td>
						<td>{{ $antcd->cim_code }}</td>
						<td>{{ $antcd->descrioption }}</td>
						<td class="center"> 
							<button type="button" class="btn btn-xs btn-info open-modal" data-atcd ="c" id ="antPerso-edit" value="{{$antcd->id}}"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>
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
<div class= "widget-box widget-color-blue" id="widget-box-2">
	<div class="widget-header" >
		 <h5 class="widget-title bigger lighter"><font color="black"><i class="ace-icon fa fa-table"></i>&nbsp;<b>Antecedants physiologiques</b></font></h5>
		<div class="widget-toolbar widget-toolbar-light no-border" width="20%">
			<div class="fa fa-plus-circle"></div>
			<a href="#" id="btn-addAntPhys" class="btn-xs tooltip-link" data-toggle="modal"><h4><strong>Antecedant</strong></h4></a>
		</div>
	</div>
	<div class="widget-body" id ="ATCDWidget">
		<div class="widget-main no-padding">
			<table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="antsPhysTab">
				<thead class="thin-border-bottom">
				  <tr class ="center">
						<th class ="hidden"></th>
						<th class="center"><strong><span style="font-size:14px;">Type</span></strong></th>
						<th class="center"><i class="fa fa-clock-o bigger-110" aria-hidden="true"></i>
							<strong>&nbsp;<span style="font-size:14px;">Date</span></strong>
					  </th>
					  <th class="center">Code CIM</th>
						<th class="center hidden-480"><span style="font-size:14px;"><strong>Description</strong></span></th>
						<th class ="center">Tabac</th>
						<th class ="center">Ethylisme</th>
						<th class ="center">Habitude alimentaire</th>
						<th class="center"><em class="fa fa-cog"></em></th>
				  </tr>
				</thead>
				<tbody>
				 	@foreach($patient->antecedants as $antcd)
						@if(($antcd->Antecedant == "Personnels") &&($antcd->typeAntecedant == "1"))
						<tr id="{{ 'atcd'.$antcd->id }}">
							<td class ="hidden" >{{ $antcd->Patient_ID_Patient }}</td>
							<td>Physiologiques</td>  
							<td>{{ $antcd->date }}</td>
							<td>{{ $antcd->cim_code }}</td>
							<td>{{ $antcd->descrioption }}</td>
							<td>{{ $antcd->tabac ? 'Oui' : 'Non' }}</td>
							<td>{{ $antcd->ethylisme? 'Oui' : 'Non' }}</td>
							<td>{{ $antcd->habitudeAlim }}</td>
							<td class="center"> 
								<button type="button" class="btn btn-xs btn-info Phys-open-modal" data-atcd ="c" id ="antPerso-edit" value="{{$antcd->id}}"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>
								<button type="button" class="btn btn-xs btn-danger delete-atcd" value="{{$antcd->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button> 
						 </td>
						<table></table>
						</tr>
						@endif
					@endforeach
				</tbody>
			</table>
		</div>
	</div>{{-- widget-body --}}
</div>{{-- widget-box --}}
</div>{{-- row --}}
<!-- fin physiologiques -->
<div class="space-12"></div>
<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Antecedants Familliaux</h3></div></div>
<div class="row">
 	 <div class= "widget-box widget-color-green" id="widget-box-2">
		<div class="widget-header" >
		<h5 class="widget-title bigger lighter"><font color="black"> <i class="ace-icon fa fa-table"></i>&nbsp;<b>Antecedants Familliaux</b></font></h5>
		 <div class="widget-toolbar widget-toolbar-light no-border" width="20%">
			<div class="fa fa-plus-circle"></div>
			<a href="#" id="AntFamil-add" class="btn-xs tooltip-link" data-toggle="modal"><h4><strong>Antecedant</strong></h4></a>
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
							<td class ="hidden" >{{ $antcd->Patient_ID_Patient }}</td> 
							<td>{{ $antcd->date }}</td>
							<td>{{ $antcd->cim_code }}</td>
							<td>{{ $antcd->descrioption }}</td>
							<td class="center"> 
								<button type="button" class="btn btn-xs btn-info open-modalFamil" data-atcd ="d" id ="antFamil-edit" value="{{$antcd->id}}"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>
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
<div class="space-12"></div>
<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Facteurs de risque</h3></div></div>
<div class="row"><div class="col-xs-12">	<label for="infos"><b>Facteurs Généraux</b></label><br></div> </div>
<div class="row">
 	<div class="col-xs-3">
    		<div class="checkbox">
    		<input type="hidden" name="exercice" value="0">
			  <label><input name="exercice" type ="checkbox" class="ace" value="1" @if(isset($patient->facteurRisque) && ($patient->facteurRisque->exercice)) checked @endif/>
			 		<span class="lbl text-nowrap">Exercice physique</span>
			 	</label>
	      </div>   
	    </div>
		 <div class="col-xs-3">
    		<div class="checkbox">
    			<input type="hidden" name="regime" value="0">
			 		<label><input name="regime" type="checkbox" class="ace" value="1" @if(isset($patient->facteurRisque)&&($patient->facteurRisque->regime)) checked @endif/>
			 			<span class="lbl text-nowrap">Régime</span>
			 		</label>
	      </div>   
	 		</div>
	  	<div class="col-xs-3">
    		<div class="checkbox">
    			<input type="hidden" name="drogue" value="0">
					<label><input name="drogue" type="checkbox" class="ace" value="1" @if(isset($patient->facteurRisque)&&($patient->facteurRisque->drogue)) checked @endif/>
						<span class="lbl text-nowrap">Drogue</span>
					</label>
	      </div>   
	 		</div>
	 		<div class="col-xs-3">
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
    	 <div class="col-xs-12">
    	 <div class="col-xs-3">
	      <label for="autrefact"><strong>Autre élément social</strong></label>
	      <textarea class="form-control" name="autrefact">@if(isset($patient->facteurRisque)) {{ $patient->facteurRisque->autrefact }} @endif</textarea> 
	</div>
	<div class="col-xs-3">
	  <label for="statut_fam"><strong>Statut familial</strong></label>
	  <textarea class="form-control" name="statut_fam">@if(isset($patient->facteurRisque)) {{ $patient->facteurRisque->statut_fam }} @endif</textarea> 
	</div>
	<div class="col-xs-3">
	  <label for="habitat"><strong>Habitat</strong></label>
	  <textarea class="form-control" name="habitat">@if(isset($patient->facteurRisque)) {{ $patient->facteurRisque->habitat }} @endif</textarea> 
	</div>
	<div class="col-xs-3">
	      <label for="professionnel"><strong>Facteurs Professionels</strong></label>
	      <textarea class="form-control" name="professionnel">@if(isset($patient->facteurRisque)) {{ $patient->facteurRisque->professionnel }} @endif</textarea> 
	</div>
    	 </div>
    </div>
 <div class="space-12"></div>