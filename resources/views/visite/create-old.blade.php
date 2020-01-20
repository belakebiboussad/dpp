@extends('app')
@section('page-script')
<script type="text/javascript">
	$(document).ready(function() {
  	var i = 1;
  	$("#addtolist").click(function(){
  		if(! isEmpty($("#cons").val()) )
	    { 
	  	 	$( "#tabconsigne" ).append( "<tr><td>"+i+"</td><td>"+$("#cons").val()+"</td><td>"+$("#nbr_j").val()+"</td><td><input type='checkbox' value='"+$("#Matin").val()+"' checked='false'></td><td><input type='checkbox' value='"+$("#Midi").val()+"' checked='"+$("#Midi").prop('checked')+"'></td><td><input type='checkbox' value='"+$("#Soir").val()+"' checked='"+$("#Soir").prop('checked')+"'></td><td>"+"</td></tr>" );
	  	 	i = i + 1;
	   	}
  	});
  	$("#submitetatbesoin").click(function(){
			var arrayLignes = document.getElementById("tabconsigne").rows;
	  	var longueur = arrayLignes.length;
		  var produits = [];
		  for(var i=1; i<longueur; i++)
		    {
		      produits[i] = { designation: arrayLignes[i].cells[1].innerHTML, qte: arrayLignes[i].cells[2].innerHTML}
		    }
		    var champ = $("<input type='text' name ='liste' value='"+JSON.stringify(produits)+"' hidden>");
		    champ.appendTo('#etatbesoinsform');
		  	$('#etatbesoinsform').submit();
		});
	}); 
</script>
@endsection
@section('main-content')
	<div class="page-header" width="100%">
  	@include('patient._patientInfo')
	</div>
	<div class="page-header">
		<h1 style="display: inline;"><strong>Ajouter Consignes Pour la visite :</strong></h1>
		<div class="pull-right"> </div>
	</div>
	<form class="form-horizontal" action="" method="POST" name="form1" id="form1"> <!--/visite/store/{{$id_hosp}}-->
		{{ csrf_field() }}
		<input type="text" value="{{$id_hosp}}" hidden="true" name="idhosp">
		<div class="col-xs-6 col-sm-10">
			<div class="widget-box">
				<div class="widget-body">
					<div class="widget-main">										
					<input id="timepicker1" name="heurevisite" hidden="true" type="text"/>
					<form action="" id="formulaire">
						<div class="form-group">
							<label for=""class="col-sm-3 control-label no-padding-right"><b>Consigne :</b></label>
							<div class="col-sm-9">
								<input name="cons" id="cons" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-3 control-label no-padding-right"><b>Nombre de jours :</b></label>
							<div class="col-sm-9">
								<input type="number" id="nbr_j" class="form-control" min="0" value= "1" />
							</div>
						</div>
						<div align="center">
							<label class="checkbox-inline"><input type="checkbox" name="p[]" id="Matin" value="Matin" checked><b>Matin</b></label>
							<label class="checkbox-inline"><input type="checkbox" name="p[]" id="Midi" value="Midi"><b>Midi</b></label>
							<label class="checkbox-inline"><input type="checkbox" name="p[]" id="Soir" value="Soir"><b>Soir</b></label>
            </div>
            <br>
						<div class="col-md-12" align="right">
							<button type="button" id="addtolist" class="btn btn-primary btn-xs">
             		<i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>&nbsp;&nbsp;Ajouter
             	</button>
            </div>
            <hr>							        
						<div class="col-md-12">
              <div class="row">
                <div class="col-xs-12 table-responsive">
					      	<table class="table table-striped" id="tabconsigne">
							      <thead>
								     	<tr>
								     		<th scope="col" ></th>
								      		<th scope="col" >Consigne</th>
								      		<th scope="col">Nombre de jours</th>
								      		<th scope="col">Matin</th>
								       		<th scope="col">Midi</th>
								        	<th scope="col">Soir</th>
								      		<th scope="col"><em class="fa fa-cog"></em> <!-- <i id='Sup' type='button' class="glyphicon glyphicon-trash red"></i> --></th>
								      </tr>
							      </thead>				    
							      <tbody>						      	
							      </tbody>
						    	</table>
					  		</div>
							</div>
						</div>			
					</form>		
					<hr>	
					  <div align="center">
					  	<button type="submit" id="convert" class="btn btn-info"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
					 </div>		
	</form>
<!-- <script src="{{asset('/js/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
	var i = 1;
  $("#addtolist").click(function(){
  	if(! isEmpty($("#cons").val()) )
  	{
  		$( "#tabconsigne" ).append( "<tr><td>"+i+"</td><td>"+$("#cons").val()+"</td><td>"+$("#nbr_j").val()+"</td><td><input type='checkbox' value='"+$("#Matin").val()+"' checked='false'></td><td><input type='checkbox' value='"+$("#Midi").val()+"' checked='"+$("#Midi").prop('checked')+"'></td><td><input type='checkbox' value='"+$("#Soir").val()+"' checked='"+$("#Soir").prop('checked')+"'></td><td>"+"</td></tr>" );
  		i = i + 1;
  	}
	}); 
	$("#submitetatbesoin").click(function(){
		var arrayLignes = document.getElementById("tabconsigne").rows;
	  var longueur = arrayLignes.length;
	  var produits = [];
	  for(var i=1; i<longueur; i++)
	    {
	      produits[i] = { designation: arrayLignes[i].cells[1].innerHTML, qte: arrayLignes[i].cells[2].innerHTML}
	    }
	    var champ = $("<input type='text' name ='liste' value='"+JSON.stringify(produits)+"' hidden>");
	    champ.appendTo('#etatbesoinsform');
	  	$('#etatbesoinsform').submit();
	});
</script>
	 -->
@endsection
