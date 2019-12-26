@extends('app')
@section('title')
  	Nouvelle Consultation
@endsection
@section('style')
<style>
	.modalord {
	        width:104.7% !important;
	        right:-16% !important;
	        left:-2.5% !important;
	        top:-3.1% !important;
	}
	.modal-body
	{
	        top: -1px !important;
	}
	.modal-footer {
		  background-color: transparent;
		  position: absolute;
		  right:2px;		
  		  bottom: 0px;
	}
	.modal.modal-wide .modal-dialog {
	  width: 95%;
	  height:1000px;
	}
	.modal-wide .modal-body {
	  overflow-y: auto;
	}
	iframe {
	    display: block;
	    width: 800px;
	    height: 700px;
	    margin: 0 auto;
	    border: 0;
	}
	/*fin*/

	.dataTables_wrapper {
	        font-family: tahoma;
	        font-size: 10px;
	        position: relative;
	        clear: both;
	        zoom: 1;
	        zoom: 1;
	}
	.btn-transparent {
	      background: transparent;
	      color: #F2F2F2;
	      -webkit-transition: background .2s ease-in-out, border .2s ease-in-out;
	      -moz-transition: background .2s ease-in-out, border .2s ease-in-out;
	      -o-transition: background .2s ease-in-out, border .2s ease-in-out;
	      transition: background .2s ease-in-out, border .2s ease-in-out;
	      border: 2px solid #4992B7;
	}
	.btn-transparent:hover {
	        color: white;
	        background-color: rgba(255,255,255,0.2);
	}
</style>
@endsection
@section('page-script')    
<script>
	function isNumeric (evt) {
		var theEvent = evt || window.event;
		var key = theEvent.keyCode || theEvent.which;
		key = String.fromCharCode (key);
		var regex = /[0-9]|\./;
		if ( !regex.test(key) ) {
		        theEvent.returnValue = false;
		        if(theEvent.preventDefault) theEvent.preventDefault();
		}
	}
    	$('document').ready(function(){
    		$( 'ul.nav li' ).on( 'click', function() {
		           $(this).siblings().addClass('filter');
		});
		$('.wysiwyg-editor').on('input',function(e){
		           a = $(this).parent().nextAll("div.clearfix");
		           var i = a.find("button:button").each(function(){
			           $(this).removeAttr('disabled');
		            });
		});
		$('.select2').css('width','400px').select2({allowClear:true})
           		$('#select2-multiple-style .btn').on('click', function(e){
	           		var target = $(this).find('input[type=radio]');
	                	var which = parseInt(target.val());
	             	if(which == 2) $('.select2').addClass('tag-input-style');
	                  	else $('.select2').removeClass('tag-input-style');
           		});
    		$(function() {
		           var checkbox = $("#isOriented");  // Get the form fields and hidden div
		           var hidden = $("#hidden_fields");  // Setup an event listener for when the state of the    // checkbox changes.
		           checkbox.change(function() {
		                if (checkbox.is(':checked')) {
		                     // Show the hidden fields.
		                     hidden.show();
		                    } else {
		                                hidden.hide();
		                                $("#lettreorientaioncontent").val("");
		                      }
		            })
		}); 
    		$(".two-decimals").change(function(){
      			this.value = parseFloat(this.value).toFixed(2);
     		 });
    		$("button").click(function (event) {
		           which = '';
           			str ='send';
           			which = $(this).attr("id");
           			var which = $.trim(which);
           			var str = $.trim(str);
          			 if(which==str){
                   			return true;
          			}
      		});
    		$("#btnCalc").click(function(event){
          			  event.preventDefault();
     		 });
    		 $('#medc_table').DataTable({
		           processing: true,
		           //serverSide: true,
		            ordering: true,
		            bInfo : false,
		           searching: false,
		           pageLength: 5,         
		           bLengthChange: false,
		           nowrap:true,
		           "language": {
		                     "url": '/localisation/fr_FR.json'
		           },
		           ajax: '/getmedicaments',
		                      columns: [
		                          {data: 'Nom_com'},
		                          {data: 'Forme'},
		                          {data: 'Dosage'},
		                          {data: 'action', name: 'action', orderable: false, searchable: false}
		                      ]
		});
    		$('#Ordonnance').on('show.bs.modal', function () {
             		  $('.modal-content').css('height',$( window ).height()*0.95);
     		 });
    	});
    	 function ajaxfunc(patientid)
           {        
                     var habitudeAlim = null; var tabac=null ; var ethylisme = null;
                     var antecedant = $('#Antecedant').val();
                     var typeAntecedant = $('#typeAntecedant').val();
                     var soustype = $('#sstypeatcdc').val();    
                     var dateATCD = $('#dateAntcd').val()
                    var description = $("#description").val();               
                      if(typeAntecedant =="Physiologiques")
                     {
                            habitudeAlim= $('#habitudeAlim').val();
                            tabac = $("#tabac").is(":checked") ? 1:0;
                            ethylisme = $("#ethylisme").is(":checked") ? 1:0;
                     }
                    if (description === "")
                    {

                    }else{
                            $.ajax({
                                     headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                     type:'POST',
                                    url:'/AddANTCD',
                                    data:{ antecedant:antecedant,typeAntecedant:typeAntecedant,soustype:soustype,dateATCD:dateATCD,description:description,patientid:patientid,habitudeAlim:habitudeAlim,tabac:tabac,ethylisme:ethylisme 
                                    },
                                   success:function(data){
                                          $("#msg").html(data.msg);
                                    }
                               }); 
                               $('#ants-tab').append("<tr><td>"+$('#Antecedant').val()+"</td><td>"+$('#dateAntcd').val()+"</td><td>"+$('#description').val()+"</td><td></td></tr>");  
                               resetField(); 
                    }
             }
</script>
@endsection
@section('main-content')
<div class="page-header" width="100%">
  	@include('patient._patientInfo')
</div>
<div class="content" style="height:800px;">
{{-- style="height:800px;" --}}
<form  class="form-horizontal" action="{{ route('consultations.store') }}" method="POST" role="form" id ="consultForm" novalidate>
	 {{ csrf_field() }}
	 <input type="hidden" name="id" value="{{$patient->id}}">
	<div id="prompt"></div>
	<div class="tabpanel">
	<ul class = "nav nav-pills nav-justified list-group" role="tablist" id="menu">
	<li role= "presentation" class="active col-md-4">
	           <a href="#Interogatoire" aria-controls="Interogatoire" role="tab" data-toggle="tab" class="btn btn-secondary btn-lg">
	                     <i class="fa fa-commenting" aria-hidden="true"></i>
	                     <span class="bigger-160"> Interogatoire</span></a>
	</li>
	<li role= "presentation"  class="col-md-4">
	           <a href="#ExamClinique"  ria-controls="ExamClinique" role="tab" data-toggle="tab" class="btn btn-success btn-lg"> 
	           <span class="bigger-160">Examen Clinique</span></a>
	</li>
	<li role= "presentation" class="col-md-4">
	          <a href="#ExamComp" aria-controls="ExamComp" role="tab" data-toggle="tab" class="btn btn-danger btn-lg">
	         		<span class="bigger-160">Examen Complémentaire</span>
		</a>
	</li>
           </ul>
           <div class ="tab-content"  style = "border-style: none;" >
           	<div role="tabpanel" class = "tab-pane active " id="Interogatoire"> 
		           <div class= "col-md-12 col-xs-12">
		                      @include('consultations.Interogatoire')
		           </div>  {{--  <div class= "col-md-3 col-xs-9"> </div> --}}
		</div>
		<div role="tabpanel" class = "tab-pane" id="ExamClinique">
		           <div class="row">
		                     <div class= "col-md-12 col-xs-12">
		                              	@include('consultations.examenClinique')
		                     </div>
		           </div>  {{-- row --}}
		</div> {{-- finexamenclinique --}}
		<div role="tabpanel" class = "tab-pane" id="ExamComp">
		           <div class= "col-md-12 col-xs-12">    
		                     	@include('consultations.ExamenCompl')   
		           </div>{{-- <div class= "col-md-3 col-xs-9"> </div> --}}
		</div> 
           </div>{{-- content --}}
          	</div>{{-- tabpanel --}}
           <div class="center" style="bottom:0px;padding-">
		<div id="error" aria-live="polite"></div>
		<button class="btn btn-info" type="submit" id="send">
			<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
		</button>
		&nbsp; &nbsp; &nbsp;
		<button class="btn btn-info" type="button" id="annuler">
			<i class="ace-icon fa fa-undo-110"></i>Annuler
		</button> 
	</div>	{{-- center --}}
</form>
<!-- Modal -->
<div>
	@include('consultations.LettreOrientation')
</div>
{{-- endModal --}}
<!-- Modal -->
<div>
	@include('consultations.DemadeHospitalisation')
</div>
</div>{{-- content --}}
<div id="Ordonnance" class="modal modalord" role="dialog" aria-hidden="true">
  	<div class="modal-dialog modal-lg" role="document">
    		<div class="modal-content">
		    	<div class="modal-header">
		           	<button type="button" class="close" data-dismiss="modal">&times;</button>
		         		<h4 class="modal-title">Ordonnance</h4>
		          		@include('patient._patientInfo')
		    	</div>
      			<div class="modal-body">
  		    	       @include('consultations.Ordonnance')    
      			</div>
   		 </div>
   		 <div class="pull-right" align="right" style="bottom:0; padding-right:13px">
   		 	<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="storeord1()">Enregistrer</button>
   		 	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ord" onclick="createord('{{ $patient->Nom }} {{ $patient->Prenom }}','{{App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Nom_Employe}} {{App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Prenom_Employe}}')">Imprimer
		           </button>
			<button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
			
   		 </div>
   		
	</div>
</div>
{{-- endModal --}}
@endsection