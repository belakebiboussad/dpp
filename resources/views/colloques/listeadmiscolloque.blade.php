@extends('app_sur')
@section('main-content')

<?php $services= array();
$services=array_values($services);	
$salles= array();
$salles=array_values($salles);								
foreach ($lits as $lit) {
	    if (!array_key_exists($lit->salle_id, $salles)) 
			{
				$salles[$lit->salle_id]=$lit->nom_salle;
				}
		if (!array_key_exists($lit->service_id, $services)) 
			{
				$services[$lit->service_id]=$lit->nom_service;
				}

		}?>
<form id="coll" class="form-horizontal" role="form" method="POST" action="{{route('listeadmiscolloque.store')}}">{{ csrf_field() }} 
<div class="col-xs-12 page-header">
	<h1>
		Création des rendez-vous d'hospitalisation 
	</h1>
</div>
<div class="col-xs-9">
	<div class="col-md-offset-12 col-md-9">
		<button class="btn btn-info" type="submit" >
			<i class="ace-icon fa fa-check bigger-110"></i>
				    Valider
		</button>
				&nbsp; &nbsp; &nbsp; &nbsp;
		<button class="btn" type="reset">
			<i class="ace-icon fa fa-undo bigger-110"></i>
					Reset
		</button>
	</div>
</div>
<select id="demh" multiple="multiple" name="demh[]" hidden="">
	</select>
	<select id="medt" multiple="multiple" name="dat[]" hidden="">
	</select>
	<select id="medt" multiple="multiple" name="heure[]" hidden="">
	</select>
	<select id="prio" multiple="multiple" name="lit[]" hidden="">
	</select>
	
<div class="col-xs-12 widget-container-col" id="widget-container-col-1">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">
				<i class="ace-icon fa fa-table"></i>
					Liste des patients à programmer cette semaine					
			</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
			<div class='table_borderWrap'>
				<table class="table table-striped table-bordered table-hover" id="table1" aria-describedby="table1_info" role="grid">
					<thead class="thin-border-bottom">
						<tr>
							<th style="display: none;"></th>			
							<th>Patient</th>
							<th>Date prévue d'hospitalisation</th>
							<th>Heure prévue d'hospitalisation</th>
							<th>Service</th>
							<th>Salle</th>
							<th>Lit</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $d=Date::Now().' monday next week'
								?>							
						@foreach( $demandes as $i=>$demande)
						@if(date('d M Y',strtotime(($demande->date).' monday next week')-1) == date('d M Y',strtotime($d)-1))
						<tr>
							<td style="display: none;">{{$demande->id}}</td>
							<td class="center">{{$demande->Nom}} {{$demande->Prenom}} </td>
							<td><div><input class="date-picker col-xs-10 col-sm-5" id="dateentree" name="dateentree{{$i}} " placeholder="Veuillez selectionner la date prévue d'entrée" type="text" data-date-format="yyyy-mm-dd" /></div></td>
							<td><div class="input-group col-sm-9 bootstrap-timepicker" >		
						<input id="heure_rdvh" name="heure_rdvh" class="form-control" type="text" required>
							<span class="input-group-addon">
								<i class="fa fa-clock-o bigger-110"></i>
							</span>						
					</div></td>
							<td><select id="service" name="service{{$i}}" data-placeholder="selectionnez le service"
									class="selectpicker show-menu-arrow place_holder ">
									<option value="" selected disabled>selectionnez le service</option>	
									@foreach ($services as $id=>$service)
									<option value="{{$id}}" >{{$service}}</option>@endforeach</select></td>						
							<td><select id="salle" name="salle{{$i}}" data-placeholder="selectionnez la salle"
									class="selectpicker show-menu-arrow place_holder "><option value="" selected disabled>selectionnez la salle</option>
									@foreach ($salles as $id=>$salle)
									<option value="{{$id}}" >{{$salle}}</option>@endforeach</select></td>			
							<td ><select id="lit" name="lit{{$i}}" data-placeholder="selectionnez le lit"
									class="selectpicker show-menu-arrow place_holder " onchange=""><option value="" selected disabled>selectionnez le lit</option>@foreach ($lits as $lit)<option value="{{$lit->id}}" >{{$lit->num}}</option>@endforeach</select></td>
							<td><div class="hidden-sm hidden-xs btn-group"><a id="undo" name="undo{{$i}}" class="btn btn-sm  btn-warning" >
											<i class="ace-icon fa fa-undo bigger-100"></i>
											Undo
										</a>

										</div>
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
</div>
<!--</form>-->

<script type="text/javascript">
/*init time*/
var ligne = document.getElementsByTagName("tr");     
		function exist(select, val){
			for (var i = 0; i < select.length; i++) {
				if (select.options[i].value==val) return true;
			}
		
	}

	$("select").change(function () {

	var ligne = document.getElementsByTagName("tr");
     
	for (var i = 1; i < ligne.length; i++) {
		
		var selects = ligne[i].getElementsByTagName("select");
		var li, sal, serv;
		 
		
		for (var j = 0; j < selects.length; j++) {
			if (selects[j].id=="lit") {li=selects[j];}
			else if (selects[j].id=="salle") {sal=selects[j];}
					else {serv=selects[j];}
		}
		
		if ((this.name).indexOf("lit")!=-1) {
    	var choice = this.selectedIndex;
    	var valeur = this.options[choice].value;

		if (li.name!=this.name){
			for (var j=0; j<li.length; j++){
  				if (li.options[j].value == valeur )
    			 	li.remove(j);

  					}
  			for (var j = 0; j < this.length; j++) {
  				
  				if (this[j].value!=valeur && !exist(li,this[j].value)) {
  						li.options[li.options.length] = new Option (this[j].text,this[j].value, false,false);
  					} 
  			}
  				}
		else{
		
		<?php foreach ($lits as $lit ):?>
		
		if (valeur== <?php echo ($lit->id); ?>) {
			for (var s = 0; s < sal.length; s++) {
				if(sal.options[s].value==<?php echo ($lit->salle_id); ?>) sal.options[s].selected="selected";
			}

			for (var s = 1; s < serv.length; s++) {
				if(serv.options[s].value==<?php echo ($lit->service_id); ?>) serv.options[s].selected="selected";
								
			}
			
		}
			<?php endforeach ?>	

		//document.getElementById("tst").value +=lesSalles+"\n";		
			//sal.value=$lits->id_salle;
		}
	}

/*si la salle est sélectionnée*/
if ((this.name).indexOf("salle")!=-1) {
    	var choice = this.selectedIndex;
    	var valeur = this.options[choice].value;
        var cle;
		if (sal.name==this.name){
		li.options.length=1;

		

		<?php foreach ($lits as $cle=>$lit ):?>
		if (valeur== <?php echo ($lit->salle_id); ?>) {
			li.options[li.options.length] = new Option (<?php echo ($lit->num); ?>,<?php echo ($lit->id); ?>, false,false);
			
			serv.value=<?php echo ($lit->service_id);?>;
			console.log("ser.value="+serv.value+" ser.text="+serv.options[serv.selectedIndex].text);
			console.log("lit.value="+<?php echo ($lit->service_id); ?>);
			cle=" <?php echo ($lit->nom_service); ?>";
			console.log("lit.nom_service="+ cle);

		}
			<?php endforeach ?>	
		

		//document.getElementById("tst").value +=lesSalles+"\n";	
				
			//sal.value=$lits->id_salle;
		}
	}
/*si le service est sélectionnée*/
if ((this.name).indexOf("service")!=-1) {
    	var choice = this.selectedIndex;
    	var valeur = this.options[choice].value;
        
		if (serv.name==this.name){
		li.options.length=1;
		sal.options.length=1;

		

		<?php foreach ($lits as $cle=>$lit ):?>
		if (valeur== <?php echo ($lit->service_id); ?>) {
			if (!exist(sal,<?php echo ($lit->salle_id); ?>)) 
				sal.options[sal.options.length] = new Option ("<?php echo ($lit->nom_salle); ?>",<?php echo ($lit->salle_id); ?>, false,false);
			
			li.options[li.options.length] = new Option (<?php echo ($lit->num); ?>,<?php echo ($lit->id); ?>, false,false);

				}
			<?php endforeach ?>	
		
			}
		}
}    
});
    /*action botton undo*/
$("a").click(function () {

	var ligne = document.getElementsByTagName("tr");
     
	for (var i = 1; i < ligne.length; i++) {
		
		var selects = ligne[i].getElementsByTagName("select");

		if ((this.name).indexOf(i)!=-1)
			{/*clear date*/
				var d='input[id=dateentree]';
			 $(ligne[i].getElementsByTagName("td")).find(d).val("").datepicker("update");
			
			/*clear time*/
				var d='input[id=heure_rdvh]';
			 $(ligne[i].getElementsByTagName("td")).find(d).val("").timepicker("update");
			/*clear all select*/
					 for (var j = 0; j < selects.length; j++) {
					 	selects[j].options[0].selected="selected";
						
					 }}


//d.val("").datepicker("update");

	}
    
    });	
</script>	
@endsection