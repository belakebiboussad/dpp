@extends('app_sur')
@section('page-script')
<script type="text/javascript">
	var nowDate = new Date();
	var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
	$('document').ready(function(){
		$('#date').datepicker({ startDate: today });
		$('.timepicker').timepicker({
			// timeFormat: 'h:mm p',
			timeFormat: 'HH:mm:ss',
    			interval: 15,
			minTime: '08',
			maxTime: '21:00pm',
			defaultTime: '08',
			 startTime: '08:00',
			 dynamic: true,
			 dropdown: true,
			 scrollbar: true
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

	})
	
</script>
@endsection
@section('main-content')
@foreach($demande as $demandes)
		<div class="page-header">
			<h1>
				Ajouter Un RDV Hospitalisation pour   <strong>&laquo;{{$demandes->Nom}} {{$demandes->Prenom}}&raquo;</strong>
			</h1>
		</div><!-- /.page-header -->
		<div class="space-12"></div>
		<div class="space-12"></div><div class="space-12"></div>
		<div class="row">
			<div class="col-xs-12">
			{{-- {{ route('admission.store') }} --}}
			<form class="form-horizontal" role="form" method="POST" action="{{  route('admission.store') }}">
			
					{{ csrf_field() }}
					<input type="text" name="id_demande" value="{{$demandes->id_demande}}" hidden>
					<div class="page-header">
				  	<h1>informations concernant l'hospitalisation</h1>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="service">
							<strong> 
								Service :
							</strong>
						</label>
						<div class="col-sm-9">
							<input type="text" id="service" name="service" placeholder="Motif De L'hospitalisation" value="{{ $demandes->nomService }}" class="col-xs-10 col-sm-5" disabled/>
						</div>
					</div>
					<div class="space-12"></div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="motif">
							<strong> 
								Motif De L'hospitalisation :
							</strong>
						</label>
						<div class="col-sm-9">
							<input type="text" id="motif" name="motifhos" placeholder="Motif De L'hospitalisation" value="{{ $demandes->motif }}" class="col-xs-10 col-sm-5" disabled/>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="priorite">
							<strong> Priorité :</strong>
						</label>
						<div class="control-group">
							&nbsp; &nbsp;
							<label>
								<input name="priorite" class="ace" type="radio" value="1" disabled @if($demandes->ordre_priorite==1)checked="checked"@endif >
								<span class="lbl"> 1 </span>
							</label>&nbsp; &nbsp;
							<label>
								<input name="priorite" class="ace" type="radio" value="2" disabled @if($demandes->ordre_priorite==2)checked="checked"@endif>
								<span class="lbl"> 2 </span>
							</label>&nbsp; &nbsp;
							<label>
								<input name="priorite" class="ace" type="radio" value="3" disabled @if($demandes->ordre_priorite==3)checked="checked"@endif>
								<span class="lbl"> 3 </span>
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="motif">
							<strong>observation :</strong>
						</label>
						<div class="col-sm-9">
							<input type="text" id="motif" name="motifhos" placeholder="Motif De L'hospitalisation" value="{{$demandes->observation}}" class="col-xs-10 col-sm-5" disabled/>
						</div>
					</div>
					<div class="page-header">
				  	<h1>Admission</h1>
					</div>
					<div class="space-12"></div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="date">
						 	<strong> Date entrée prévue : 
							</strong>
						</label>
						<div class="col-sm-9">
						{{-- date-picker --}}
							<input class="col-xs-5 col-sm-5 " id="date" name="date" type="text" placeholder="Date prévue d'hospitalisation" data-date-format="yyyy-mm-dd" required />
							<button class="btn btn-sm" onclick="$('#date').focus()">
								<i class="fa fa-calendar"></i>
							 </button>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="heure_rdvh" style="padding: 0.9%;">
						 	<strong> Heure  entrée Prévue :</strong>
						</label>
						<div class="input-group col-sm-9" style ="width:34.5%;padding: 0.8%;">	
							<input id="heure_rdvh" name="heure_rdvh" class="form-control timepicker" type="text"  required>
							<span class="input-group-addon">
								<i class="fa fa-clock-o bigger-110"></i>
							</span>						
						</div>
					</div>
					<div class="space-12"></div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="dateSortie">
						 	<strong> Date sortie prévue : 
							</strong>
						</label>
						<div class="col-sm-9">
							{{-- date-picker	 --}}
							<input class="col-xs-5 col-sm-5" id="dateSortie" name="dateSortie" type="text" placeholder="Date sortie prévue d'hospitalisation" data-date-format="yyyy-mm-dd" required />
							<button class="btn btn-sm" onclick="$('#dateSortie').focus()">
								<i class="fa fa-calendar"></i>
							 </button>
						</div>
					</div> 
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="serviceh">
						 	<strong> 
						 		Service d'hospitalisation : 
							</strong>
						</label>
						<div class="col-sm-9">
						<select id="serviceh" name="serviceh" data-placeholder="selectionnez le service d'hospitalisation" class="selectpicker show-menu-arrow place_holde col-xs-5 col-sm-5" required>
							<option value="" selected disabled>selectionnez le service d'hospitalisation</option>
							@foreach($services as $service)
								<option value="{{ $service->id }}">{{ $service->nom }}</option>
							@endforeach
						</select>
						</div>
					</div>
					<div class="space-12"></div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="salle">
						 	<strong> 
						 		Salle d'hospitalisation : 
							</strong>
						</label>
						<div class="col-sm-9">
							<select id="salle" name="salle" data-placeholder="selectionnez la salle d'hospitalisation" class="selectpicker show-menu-arrow place_holder col-xs-10 col-sm-5" disabled required>
							<option value="" selected>selectionnez la salle d'hospitalisation
							</option>
						</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label" for="heure_rdvh">
						 	<strong> 
						 		Lit d'hospitalisation : 
							</strong>
						</label>
						<div class="col-sm-9">
							<select id="lit" name="lit" data-placeholder="selectionnez le lit" class="selectpicker show-menu-arrow place_holder col-xs-10 col-sm-5" onchange="" disabled required>
								<option value="" selected disabled>selectionnez le lit
								</option>
							</select>
						</div>
							
					</div>
					<div class="col-md-offset-3 col-md-9">
						<button class="btn btn-info" type="submit">
							<i class="ace-icon fa fa-save bigger-110"></i>
							Enregistrer
						</button>
						&nbsp; &nbsp; &nbsp;
						<button class="btn" type="reset">
							<i class="ace-icon fa fa-undo bigger-110"></i>
							Annuler
						</button>
					</div>
						
				</form>
			</div>
		</div>
	@endforeach
@endsection