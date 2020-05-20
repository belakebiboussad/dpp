<<<<<<< HEAD
@extends('app_med')
@section('style')
<style>
	thead th {
		  font-size: 0.6em;
		  padding: 1px !important;
		  height: 15px;
	}
</style>
@endsection
=======
@extends('app')
@section('style')
<style>
	.datatable-scroll {
   		 overflow-x: auto;
  		  overflow-y: visible;
	}
	.marked {
		background-color: #ccc;
	}
</style>
@endsection
@section('page-script')
{{-- <script type="text/javascript" src="{{asset('/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{ asset('/js/datatables.js') }}"></script> --}}
<script type="text/javascript">
	  $('document').ready(function(){
	           $('#example').DataTable({
	  		        "processing": true,
     			      "serverSide": false,
     			      "searching":false,
	  	        	"scrollY":"420px",
              	"scrollCollapse": true,
              	"paging":false,
                "dom": 't',
              	"createdRow": function( row, data, dataIndex ) {
                        		if ( data[ 3 ] == "Inp" )
                            		$(row).css('color', 'green')
                        		else 
                           		 $(row).css('color', 'blue')

                	        if ( data[7] > 0 ) $(row).css('font-weight', 'bold')                        
                 		   }, 
	  		"language": {
                		"url": '/localisation/fr_FR.json'
                		},
	  	});
	});
	function showConsult(consultId, thisObj)
  {
     $(".marked").removeClass("marked");
     thisObj.addClass("marked");
     $.ajax({
               type : 'get',
                url: '{{ route("consultdetailsXHR") }}',
                data:{ 'id':consultId },
                success:function(data,status, xhr){
                          $('#consultDetail').html(data.html);  //alert(data.html);     
                }
     });
                   
  }

</script>
@stop
>>>>>>> dev
@section('main-content')
<div class="page-header">
<h1><strong>Résumé  du Consultation Pour :</h1>
<?php $patient = $consultation->patient; ?>
  @include('patient._patientInfo', $patient)
</div>
<div class="row">
	<div class="col-sm-7 alert alert-block alert-info voffsetright">
		<div class="content voffsetright">
			<span style="font:bold 14px verdana;">Résumé de la Consultation</span>
			{{-- <span"style="font:bold 12px verdana;">&nbsp;"{{ $consultation->Date_Consultation }}"</span> --}}			
		</div>
	</div>
	<div class="col-sm- 5 alert alert-block alert-info">
		<div class="content voffsetleft center">
		<span style="font:bold 14px verdana;">Liste des consultations </span>
		</div>
	</div>
</div>
<<<<<<< HEAD
<div class="row">
		<div class="col-sm-7">
		<div id="accordion" class="accordion-style1 panel-group ">
	           <div class="row">
			<div class="col-sm-12">
			<div class="widget-box">
			<div class="widget-header" >
                        		<h4 class="widget-title">
                        			<font color="black"><strong>Interogatoire</strong></font>                        			
                        		</h4>
                        	</div>		
               		<div class="widget-body">
				<div class="widget-main">
					<div class="row">
						<div class="col-xs-12">
							<label for="Motif_Consultation"><strong>Motif de la Consultation :</strong></label>
							<textarea type="text" id="Motif_Consultation" style="width:100%; height: 8%;" readonly >{{ $consultation->Motif_Consultation }}</textarea>
						</div>
					</div>{{-- row	 --}}
					@if(isset($consultation->histoire_maladie))
					<div class="row">
						<div class="col-xs-12">
							<label for="histoire_maladie"><strong>Histoire de la maladie :</strong></label>
							<textarea type="text" id="histoire_maladie" style="width:100%; height: 8%;" readonly >{{ $consultation->histoire_maladie }}</textarea>
						</div>
					</div>
					@endif
					@if(isset($consultation->Diagnostic))
					<div class="row">
						<div class="col-xs-12">
							<label for="Diagnostic"><strong>Diagnostic:</strong></label>
							<textarea type="text" id="Diagnostic" style="width: 100%; height: 8%;" readonly >{{ $consultation->Diagnostic }}</textarea>
						</div>
					</div>
					@endif
					@if(isset($consultation->Resume_OBS))
					<div class="row">
						<div class="col-xs-12">
							<label for="Resume_OBS"><span class="bigger-120"><b>Résumé:</b></span></label><textarea type="text" id="Resume_OBS" style="width: 100%; height: 10%;" readonly >{{ $consultation->Resume_OBS }}</textarea>
						</div>
					</div>
					@endif

				</div>{{-- widget-main--}}
			</div>{{-- widgetbody --}}
			</div>	{{-- widgetbox --}}
			</div>	{{-- sm-12 --}}
		</div>	{{-- row --}}

	           {{-- examenclique --}}
		@if(isset($exmclin) )
		<div class="panel panel-default">
			<div class="panel-heading">
			<h4 class="panel-title">
			<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#ExamClinique" aria-expanded="false"><i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>&nbsp;<h4 style ="display: inline-block;">Examen Clinique</h4>
			</a>
			</h4>
			</div>
			<div class="panel-collapse collapse"  id="ExamClinique" aria-expanded="false" style="height:200px;" >
			<div class="panel-body">
				<div class="row">
				<div class="col-md-3">
				<label for="taille"><span class="bigger-120"><b>Taille:</b></span></label>
				<input type="text" id="taille" style="width: 30%; height: 10%;" readonly value="{{$exmclin->taille}}"/>
					<span><strong>m</strong></span>
				</div>
				<div class="col-md-3">
					<label for="poids"><span class="bigger-120"><b>Poids:</b></span></label>
					<input type="text" id="poids" style="width: 25%; height: 10%;" readonly value="{{$exmclin->poids}}"/>
						<span><strong>Kg</strong></span>
				</div>
				<div class="col-md-3">
					<label for="imc"><span class="bigger-120"><b>IMC:</b></span></label>
					<input type="text" id="imc" style="width: 25%; height: 10%;" readonly value="{{$exmclin->IMC}}"/>
=======
<div class="row" style = "margin-top:-2%">
	<div class="col-sm-7" id="consultDetail">
	 @include('consultations.inc_consult')
	</div>
	<div class="col-sm-5">
		<table id="example" class="display dataTable table table-striped table-bordered table-condensed" width="100%" data-page-length="25" role="grid">
		<thead>
		<tr role="row">
			<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Position: activate to sort column descending" style="width:20%">Date</th>
			<th tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width:45%">Medecin</th>
			<th data-orderable="false" class="sorting_disabled" rowspan="1" colspan="1" aria-label="Start date" style="width:45%;">Service</th>
			<th style="width:5%;"></th>
		</tr>
		</thead>
		<tbody>
		@foreach($consults as $consult)
		<tr  role="row" class="even">
			<td class="center" width="20%">
				<div class="action-buttons">
					{{$consult->Date_Consultation}}
>>>>>>> dev
				</div>
			</td>
			<td class="center" width="30%">
				<div class="action-buttons">
				<span >
				 {{ $consult->docteur->Nom_Employe }} {{ $consult->docteur->Prenom_Employe  }}
				</span>
				</div>
			</td>
			<td class="center" width="45%">
				<div class="action-buttons">
				<span >{{$consult->docteur->service->nom}}</span>
				</div>
<<<<<<< HEAD
				</div>
				<div class="row">
				<div class="col-md-12">	
				<label for="Etat"><span class="bigger-120"><b>Etat Générale:</b></span></label>
				<textarea type="text" id="Etat" style="width:100%; height: 10%;" readonly >{{ $exmclin->Etat }}</textarea>
				</div>
				</div>
			</div>
			</div>
		</div>
		@endif
		@if(isset($consultation->demandeexmbio))
		          <div id="friends" class="tab-pane">
                    			<div>
		                        <table class="table table-striped table-bordered">
		                          <thead>
		                            <tr>
		                              <th class="center">#</th>
		                              <th>Date</th>
		                              <th>Etat</th>
		                              <th></th>
		                            </tr>
		                          </thead>
		                          <tbody>
		                          @foreach($consultation->demandeexmbio as $index => $demande)
		                            <tr>
		                              <td class="center">{{ $index +1 }}</td>
		                              <td>{{ $demande->DateDemande }}</td>
		                              <td>
		                                @if($demande->etat == "E")
		                                  En Attente
		                                @elseif($demande->etat == "V")
		                                  Validé
		                                @else
		                                  Rejeté
		                                @endif
		                              </td>
		                              <td class="center">
		                                <a href="{{ route('demandeexb.show', $demande->id_demandeexb) }}">
		                                  <i class="fa fa-eye"></i>
		                                </a>
		                              </td>
		                            </tr>
		                          @endforeach               
		                          </tbody>
		                        </table>
                     	 </div>
                    </div><!-- /#friends -->
                   
		@endif
		@if(isset($examensimg)  && count($examensimg) !=0)	
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false">
				<i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>&nbsp;<h4 style ="display: inline-block;">Examen Radiologique</h4>
				<a/>
				</h4>	
			</div>
			<div class="panel-collapse collapse" id="collapseThree" aria-expanded="false" style="height: 0px;">						
			<div class="panel-body">
			<div class="widget-box widget-color-blue ui-sortable-handle" id="widget-box-2">
			<div class="widget-body">
			<div class="widget-main no-padding">
			<table class="table table-striped table-bordered table-hover">
				<thead class="thead-dark">
					<tr>
						<th class ="text-center">
						<span class="medical medical-icon-mri-pet" aria-hidden="true"></span>
						<span class="bigger-120"><b>Nom examen</b></span> 	
						</th>					
						<th class="text-center hidden-480"><span class="bigger-120"><b>Type examen</b></span></th>
					</tr>
				</thead>
				<tbody>
				@foreach ($examensimg as  $key => $value)
					@foreach ($examensimg->$key as  $value) 
					@if($value !=null)
                				<tr>
						<td class=""><a href="#">
						{{ App\modeles\examenimagrie::FindOrFail($value)->nom }}</a>
						</td>
						<td>
							{{$key}}
						</td>
					</tr>
					@endif
					@endforeach
				@endforeach
				</tbody>
			</table>
			</div>
			</div>	{{-- widgetbody --}}
			</div>{{-- widget-box --}}
			</div>	{{-- panel-body --}}
			</div>
		</div>
		@endif
		@if(isset($ordonnance->medicamentes )  && count($ordonnance->medicamentes ) !=0)
		<div class="row">
			<div class="col-sm-12">
			<div class="widget-box">
				<div class="widget-header" >
	                        		<h4 class="widget-title">
	                        			<i class="orange ace-icon fa fa-medkit bigger-120"></i><font color="black"><strong>Ordonnance</strong></font>    
	                        		</h4>
	                        		<div class="widget-toolbar no-border my-right-float">
	                        			<a href="/showordonnance/{{ $ordonnance->id }}" target="_blank" class="btn btn-primary my-right-float">
					                     <i class="fa fa-eye"></i>&nbsp;Visualiser Ordonnance
					           </a>
	                        		</div>
	                        	</div>	
				<div class="widget-body">
					<div class="widget-main">
						<div class="row">
							<div class="col-xs-12">
								<div class="space-12"></div>		
								<table class="table table-striped table-bordered">
		                                      				<thead>
			                                        				<tr>
							                                           <th class="center">#</th>
							                                           <th><strong>Nom</strong></th>
							                                           <th><strong>Dosage</strong></th>
							                                           <th><strong>Forme</strong></th>
							                                           <th><strong>Posologie</strong></th>
						                                           </tr>
		                                     				 </thead>
		                                      				<tbody>
						                                           @foreach($ordonnance->medicamentes as $index => $med)
						                                           <tr>
							                                          <td>{{ $index + 1 }}</td>
							                                          <td>{{ $med->Nom_com }}</td>
							                                          <td>{{ $med->Dosage }}</td>
							                                          <td>{{ $med->Forme }}</td>
							                                          <td>{{ $med->pivot->posologie }}</td>
						                                           </tr>
						                                           @endforeach
						                                </tbody>
					                                </table>
					                           
					                      </div>
					           </div>
					</div>
				</div>
			</div>
			</div>
		</div>	
		@endif
	           {{-- @if(isset($medicaments)  && count($medicaments) !=0)
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
				<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#Trait" aria-expanded="false">
				<i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>&nbsp;<h4 style ="display: inline-block;">Traitement</h4>
				<a/>
				</h4>	
			</div>
			<div class="panel-collapse collapse" id="Trait" aria-expanded="false" style="height: 0px;">					
			<div class="panel-body">
			<div class="widget-main no-padding">
			<table class="table table-striped table-bordered table-hover">
				<thead class="thead-ligh">
				<tr>
				<th class ="text-center">
			      	<i class="fa fa-medkit fa-2x pull-left"></i>
				<span class="bigger-120"><b>Nom Medicament</b></span> 	
				</th>					
				<th class="text-center hidden-480"><span class="bigger-120"><b>Forme</b></span></th>
				<th class="text-center hidden-480"><span class="bigger-120"><b>Dosage</b></span></th>
				</tr>
				</thead>
				<tbody>
					@foreach ($medicaments as  $key => $value)
					<tr>
					<td>{{ App\modeles\medicament::FindOrFail($medicaments[$key][0])->Nom_com }}</td>
					<td>{{ App\modeles\medicament::FindOrFail($medicaments[$key][0])->Forme }}
					</td>
					<td class ="danger">{{ $value[1] }}</td>
					</tr>	
					@endforeach
				</tbody>
				</table>
				</div>
			</div>widgetbody
			</div>widgetbox
			</div>
		</div>
		@endif --}}
	</div>
	</div> 	{{-- details consult  7--}}
	<div class="col-sm-5">
		<div class="table-responsive">
		{{-- <table id="simple-table" class="table table-striped table-bordered table-hover table-condensed"> --}}
		<table id="simple-table" class="table table-striped table-bordered table-hover table-condensed">
			<thead>
				<tr> 	{{-- <th  width="5%">#</th> --}}
					<th class="text-center" width="15%"><strong>Date</strong></th>
					<th class="text-center" width="40%"><strong>Motif</strong></th>
					<th class="text-center" width="20%"><strong>Medecin</strong></th>
					<th class="text-center" width="20%" ><strong>Lieu consultation</strong></th>
					<th  class="text-center" width="5%"></th>
				</tr>
			</thead>
		</table>
		 <div class="bodycontainer scrollable" style="margin-top: -2.9%;">
			 <table class="table table-hover table-striped table-condensed table-scrollable">
				<tbody>
				@foreach($consults as $i=>$consult)
					<tr class="{!! ( $consult->id == $consultation->id) ? 'success' : '' !!}">{{-- <td width="5%">{{ ++ $i }}</td> --}}
						<td class="center" width="15%">
							<div class="action-buttons">
								<span>{{$consult->Date_Consultation}}</span>
							</div>
						</td>
						<td class="center" width="40%">
							<div class="action-buttons" >
								<span >{{$consult->Motif_Consultation}}</span>
							</div>
						</td>
						<td class="center" width="20%">
							<div class="action-buttons">
							<span >
							{{ $consult->Nom_Employe }} 
							 {{ $consult->Prenom_Employe }}	
							</span>
							</div>
						</td>
						<td class="center" width="20%">
							<div class="action-buttons">
								<span >{{$consult->Nom}}</span>
							</div>
						</td>
						<td class="center"  width="5%">
							<div class="action-buttons my-right-float">
								{{-- <button onclick="showConsult({{ $consult->id }} ,{{ $i }})"> 
								<i class="fa fa-hand-o-up fa-xs"></i></button> --}}
							           <a class="btn btn-xs btn-success" href="/consultations/detailcons/{{$consult->id}}">	
                            							<i class="ace-icon fa fa-hand-o-up fa-xs"></i>
                           						</a>
							</div>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		</div>
	</div> {{-- liste consults --}}
	</div>

=======
			</td>
			<td class="center"  width="5%">
			<div class="action-buttons">
			<button onclick="showConsult({{ $consult->id }},$(this));"> 
					  <i class="fa fa-eye"></i></button>		 
			</div>
			</td>	
		</tr>
		@endforeach
		</tbody>
		</table>	
	</div>
>>>>>>> dev
</div>
@endsection