<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Antecedants Personnels</h3></div></div>
<div class="row">
<div class= "widget-box widget-color-blue" id="widget-box-2">
	<div class="widget-header" >
		 <h5 class="widget-title bigger lighter"><font color="black"><i class="ace-icon fa fa-table"></i>&nbsp;<b>Antecedants Personnels</b></font></h5>
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
					@if($antcd->Antecedant == "Personnels")
					<tr id="{{ 'atcd'.$antcd->id }}">
						<td class ="hidden" >{{ $antcd->Patient_ID_Patient }}</td>   {{-- <td>{{ $antcd->Antecedant }}</td>--}}
						<td>{{ $antcd->typeAntecedant }}</td>
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
   <div class="row">
        <div class="col-xs-12">
      	 	<label for="infos"><b>Facteurs Généraux</b></label><br>
		{{-- @foreach($infossupp as $info)<div class="col-xs-2"><div class="checkbox">
		 <label><input name="infos[]" type="checkbox" class="ace" value="{{ $info->id }}" /><span class="lbl">{{ $info->nom }}</span>   </label>
	        	 </div>   </div>	@endforeach --}}
		</div>
    </div>
    <div class="row">
    	<div class="col-xs-2">
    		<div class="checkbox">
			 <label><input name="tabac" id ="tabac" type="checkbox" class="ace" value="" /><span class="lbl">Tabac</span></label>
	      </div>   
	 </div>
	 <div class="col-xs-2">
    		<div class="checkbox">
			 <label><input name="exercice" id="exercice" type ="checkbox" class="ace" value="" /><span class="lbl text-nowrap">Exercice physique</span></label>
	      </div>   
	 </div>
	 <div class="col-xs-2">
    		<div class="checkbox">
			 <label><input name="enolysme" id="enolysme" type="checkbox" class="ace" value="" /><span class="lbl text-nowrap">Enolysme</span></label>
	      </div>   
	 </div>
	 <div class="col-xs-2">
    		<div class="checkbox">
			 <label><input name="regime" id="regime" type="checkbox" class="ace" value="" /><span class="lbl text-nowrap">Régime</span></label>
	      </div>   
	 </div>
	  <div class="col-xs-2">
    		<div class="checkbox">
			 <label><input name="drogue" id="drogue" type="checkbox" class="ace" value="" /><span class="lbl text-nowrap">Drogue</span></label>
	      </div>   
	 </div>
	 <div class="col-xs-2">
    		<div class="checkbox">
			 <label><input name="sedentarite" id="sedentarite" type="checkbox" class="ace" value="" /><span class="lbl text-nowrap">Sédentarité</span></label>
	      </div>   
	 </div>
    </div>
    <div class="space-12"></div>
    <div class="row">
    	 <div class="col-xs-12">
    	 <div class="col-xs-3">
	      <label for="explication"><strong>Autre élément social</strong></label><textarea class="form-control" id="autre" name="autre"></textarea> 
	</div>
	<div class="col-xs-3">
	      <label for="explication"><strong>Statut familial</strong></label><textarea class="form-control" id="statut_fam" name="statut_fam"></textarea> 
	</div>
	<div class="col-xs-3">
	      <label for="explication"><strong>Habitat</strong></label><textarea class="form-control" id="habitat" name="habitat"></textarea> 
	</div>
	<div class="col-xs-3">
	      <label for="explication"><strong>Facteurs Professionels</strong></label><textarea class="form-control" id="professionnel" name="professionnel"></textarea> 
	</div>
    	 </div>
    </div>
 <div class="space-12"></div>
<div class="row">
	 <div class= "widget-box widget-color-danger" id="widget-box-2">
		<div class="widget-header" >
		<h5 class="widget-title bigger lighter"><font color="black"> <i class="ace-icon fa fa-table"></i>&nbsp;<b>Facteurs de risque</b></font></h5>
		 <div class="widget-toolbar widget-toolbar-light no-border" width="20%">
			<div class="fa fa-plus-circle"></div>
			<a href="#" id="AntFamil-add" class="btn-xs tooltip-link" data-toggle="modal"><h4><strong>facteur</strong></h4></a>
		</div>
		</div>
	</div>
</div>
	

