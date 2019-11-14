@extends('app_sur')
@section('page-script')
<script type="text/javascript">
	var nowDate = new Date();
	var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
  //var now = nowDate.getFullYear() + '-' + ('0'+ nowDate.getMonth()+1).slice(-2) + '-' + ('0'+ nowDate.getDate()).slice(-2);
	//var a = today.getFullYear() + '-' + ('0'+ today.getMonth()+1).slice(-2)+ '-' + ('0'+ nowDate.getDate()).slice(-2);;
	
	$('document').ready(function(){
  //  	$('#dateEntree').datepicker({
		// 	 startDate: today
		// });
		// $('#dateSortie').datepicker({
		// 	 startDate: today
		// });
		$('.timepicker').timepicker({
	 		timeFormat: 'HH:mm',
     	interval: 15,
			minTime: '08',
			maxTime: '17:00pm',
			defaultTime: '09:00',
			startTime: '08:00',
			dynamic: true,
			dropdown: true,
			scrollbar: true
		});
		$('#dateEntree').change(function(){
			  	if($('#numberofDays').is(":hidden"))
			  		 $('#numberofDays').removeAttr('hidden');
		});
		$('#serviceh').change(function(){
			$('#salle').removeAttr("disabled");
		          $.ajax({
		            url : '/getsalles/'+ $('#serviceh').val(),
		            type : 'GET',
		            dataType : 'json',
		            success : function(data){
		               if(data.length != 0){
		                	var select = $('#salle').empty();
		                    $.each(data,function(){
		                    		select.append("<option value='"+this.id+"'>"+this.nom+"</option>");
		                    });
		                }
		                else
		                {      
		                	select.html('<option value="" selected disabled>Pas de salle</option>');
		                }
		            },
		        });
    });
		$('#salle').change(function(){
			$('#lit').removeAttr("disabled");
			 $.ajax({
			 		url : '/getlits/'+ $('#salle').val(),
		       			type : 'GET',
		            		dataType : 'json',
		         			success : function(data){
		         				console.log(data);
		             	          		if(data.length != 0){
		             				var selectLit = $('#lit').empty();
		                    				$.each(data,function(){
		                    					selectLit.append("<option value='"+this.id+"'>"+this.nom+"</option>");
		                    				});
		                		     	}
		               		     	else
		                		     	{
		                    			      selectLit.html('<option value="" selected disabled>Pas de Lit</option>');
		                		     	}
		            		},
			 });
		});
    $('#numberofDays').on('change keyup', function() {
         var tt = $('#dateEntree').value;
         alert(tt);

    }); 

	})
	
</script>
@endsection
@section('main-content')
<div class="page-header">
			<h1>
				Ajouter Un RDV Hospitalisation pour   <strong>&laquo;{{$demande[0]->demandeHosp->consultation->patient->Nom}}
				 {{$demande[0]->demandeHosp->consultation->patient->Prenom}}&raquo;</strong>
			</h1>
</div><!-- /.page-header -->
<div class="space-12"></div>

<div class="row">
	<div class="col-xs-12">
		<form class="form-horizontal" role="form" method="POST" action="{{  route('admission.store') }}">
			{{ csrf_field() }}
			<input type="text" name="id_demande" value="{{$demande[0]->id}}" hidden>
			<div class="page-header">
				  	<h1>informations concernant l'hospitalisation</h1>
			</div>
			<div class="form-group row">
			  <div class="col-xs-4">
			  	<label class="col-sm-3 control-label no-padding-right" for="service">
						<strong>Service:</strong>
					</label>
					<div class="col-sm-9">
						<input type="text" id="service" name="service" placeholder="nom du service"
									 value="{{ $demande[0]->demandeHosp->Service->nom }}" class="col-xs-10 col-sm-5" disabled/>
					</div>	
   			</div>
   				<div class="col-xs-4">
					<label class="col-sm-3 control-label no-padding-right" for="motif">
						<strong>Specialite :</strong>
					</label>
					<div class="col-sm-9">
						<input type="text" id="motif" name="motifhos" value="{{$demande[0]->demandeHosp->Specialite->nom}}"
									 class="col-xs-10 col-sm-5" disabled/>
					</div>	
				</div>
   			<div class="col-xs-4">
   				<label class="col-sm-3 control-label no-padding-right" for="motif">
						<strong>Mode d'admission:</strong>
					</label>
					<div class="col-sm-9">
						<input  type="text" id="motif" name="motifhos" placeholder="Mode d'admission"
										value="{{ $demande[0]->modeAdmission }}" class="col-xs-10 col-sm-5" disabled/>
					</div>	
   			</div>
   		</div><!-- row -->
   		<div class="space-12"></div>
			<div class="row form-group">
			  <div class="col-xs-4">
			  	<label class="col-sm-3 control-label no-padding-right" for="motif">
						<strong>Medecin Traitant:</strong>
					</label>
					<div class="col-sm-9">
						<input type="text" id="motif" name="motifhos" value="{{$demande[0]->medecin->Nom_Employe}} {{$demande[0]->medecin->Prenom_Employe}}"
									 class="col-xs-10 col-sm-5" disabled/>
					</div>	
			  </div>
				<div class="col-xs-4">
   				<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="priorite">
							<strong> Priorité :</strong>
						</label>
						<div class="control-group">
							&nbsp; &nbsp;
							<label>
								<input name="priorite" class="ace" type="radio" value="1" disabled @if($demande[0]->ordre_priorite==1)checked="checked"@endif >
										<span class="lbl"> 1 </span>
									</label>&nbsp; &nbsp;
							<label>
								<input name="priorite" class="ace" type="radio" value="2" disabled @if($demande[0]->ordre_priorite==2)checked="checked"@endif>
									<span class="lbl"> 2 </span>
							</label>&nbsp; &nbsp;
							<label>
								<input name="priorite" class="ace" type="radio" value="3" disabled @if($demande[0]->ordre_priorite==3)checked="checked"@endif>
								<span class="lbl"> 3 </span>
							</label>
						</div>
				  </div>
   		  </div>
				<div class="col-xs-4">
					<label class="col-sm-3 control-label no-padding-right" for="motif">
						<strong>observation :</strong>
					</label>
					<div class="col-sm-9">
						<input type="text" id="motif" name="motifhos" value="{{$demande[0]->observation}}" class="col-xs-10 col-sm-5" disabled/>
					</div>	
				</div>
			</div><!-- row -->
			<div class="page-header">
			 	<h1>Admission</h1>
			</div>
			<div class="row form-group">
				<div class="col-xs-4">
					<label class="col-sm-4 control-label no-padding-right" for="dateEntree">
					 	<strong> Date entrée prévue : 
						</strong>
					</label>
					<div class="col-sm-8">
						<input class="col-xs-5 col-sm-5 date-picker" id="dateEntree" name="dateEntree" type="text" 
									 placeholder="Date d'entrée prévue d'hospitalisation" data-date-format="yyyy-mm-dd" required />
						<button class="btn btn-sm" onclick="$('#dateEntree').focus()">
							<i class="fa fa-calendar"></i>
					  </button>
					</div>
				</div>
				<div class="col-xs-4">
					<label class="col-sm-4 control-label no-padding-right" for="heure_rdvh" style="padding: 0.9%;">
						 	<strong> Heure entrée Prévue :</strong>
					</label>
					<div class="input-group col-sm-8" style ="width:35.8%;padding: 0.8%;">	
						<input id="heure_rdvh" name="heure_rdvh" class="form-control timepicker" type="text"  required>
						<span class="input-group-addon">
							<i class="fa fa-clock-o bigger-110"></i>
						</span>						
					</div>
				</div>
				<div id = "numberofDays" class="col-xs-4" hidden>
					<label class="col-sm-3 control-label no-padding-right" for="">
				 		<strong> Durée Prévue :</strong>
				 	</label>
				 	<div class="col-sm-9">
						<input class="col-xs-5 col-sm-5" id="" name="" type="number" placeholder="nombre de nuit(s)" min="0" max="50" value="0" required />
						<label for=""><small>nuit(s)</small></label>
					</div>	
				</div>
			</div><!-- row -->
			<div class="space-12"></div>
			<div class="row form-group">
			  <div class="col-xs-4">
			  	<label class="col-sm-4 control-label no-padding-right" for="dateSortie">
					 	<strong> Date sortie prévue :</strong>
					</label>
						<div class="col-sm-8">
							<input class="col-xs-5 col-sm-5 date-picker" id="dateSortie" name="dateSortie" type="text" 
								placeholder="Date sortie prévue d'hospitalisation" data-date-format="yyyy-mm-dd" required/>
							<button class="btn btn-sm" onclick="$('#dateSortie').focus()">
								<i class="fa fa-calendar"></i>
							 </button>
						</div>
			  </div>
			  <div class="col-xs-4">
					<div class="form-group">
						<label class="col-sm-4 control-label no-padding-right" for="heureSortiePrevue" style="padding: 0.9%;">
						 	<strong> Heure sortie Prévue :</strong>
						</label>
						<div class="input-group col-sm-8" style ="width:35.8%;padding: 0.8%;">	
							<input id="heureSortiePrevue" name="heureSortiePrevue" class="form-control timepicker" type="text"  value="10:45 AM" required>
							<span class="input-group-addon">
								<i class="fa fa-clock-o bigger-110"></i>
							</span>						
						</div>
					</div>
			  </div>
			</div>
		</form>	
	</div>
</div><!-- row	 -->
@endsection