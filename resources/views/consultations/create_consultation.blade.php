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
      //crearz update delete antecant
    $("#EnregistrerAntecedant").click(function (e) {
    	var habitudeAlim = null; var tabac=null ; var ethylisme = null;
      e.preventDefault();
      var formData = {
      			Patient_ID_Patient :jQuery('#patientId').val(),	
            Antecedant         : jQuery('#Antecedant').val(),
            typeAntecedant     : jQuery('#typeAntecedant').val(),
            stypeatcd          : jQuery('#sstypeatcdc').val(),
            date : $('#dateAntcd').val(),
            descrioption : $("#description").val(),
      };
      if(formData.typeAntecedant =="Physiologiques")
      {
      	formData.habitudeAlim = $('#habitudeAlim').val();
      	formData.tabac = $("#tabac").is(":checked") ? 1:0;
      	formData.ethylisme = $("#ethylisme").is(":checked") ? 1:0;     
      }
  
      if(!($("#description").val() == ''))
      {		
      	$.ajaxSetup({
        	headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        	}
        });
        var state = jQuery('#EnregistrerAntecedant').val();
        var type = "POST";
        var atcd_id = jQuery('#atcd_id').val();
	      var ajaxurl = '/atcd/';
	      if (state == "update") {
            type = "PUT";
            ajaxurl = 'atcd/' + atcd_id;
        }
      
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var atcd = '<tr id="atcd' + data.id + '"><td class="hidden">' + data.Patient_ID_Patient + '</td><td>' + data.Antecedant + '</td><td>' + data.typeAntecedant +'</td><td>'+ data.date + '</td><td>' + data.descrioption + '</td>';
                atcd += '<td class ="center"><button class="btn btn-xs btn-info open-modal" value="' + data.id + '"><i class="fa fa-edit fa-xs" aria-hidden="true" style="font-size:16px;"></i></button>&nbsp;';
                atcd += '<button class="btn btn-xs btn-danger delete-atcd" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button></td></tr>';
                if (state == "add") {
                    jQuery('#ants-tab tbody').append(atcd);
                } else {
                    $("#atcd" + atcd_id).replaceWith(atcd);
                }
                jQuery('#modalFormData').trigger("reset");
                jQuery('#antecedantModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      }          
    });
		jQuery('#btn-add').click(function () {
  		jQuery('#EnregistrerAntecedant').val("add");
    	jQuery('#modalFormData').trigger("reset");
    	jQuery('#antecedantModal').modal('show');
  	});	
  });
		$('#ants-tab').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            colReorder: true,
            stateSave: true,
            searching:false,
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
  	function resetField()
  	{
   		 $("#description").val(' ');$('#dateAntcd').val('');       
  	}
	  function atcd()
	  {  
	    $('#description').text(" ");
	    resetField();
	    if($('#Antecedant').val() == 'Personnels')
	    {
	      $('#sous_type').css('display','block');
	    }
	    else
	    {
	      $('#sous_type').css('display','none');
	      $('#atcdsstypehide').css('display','none');
	      $('#PhysiologieANTC').css('display','none');
	      $('#typeAntecedant').val(null);
	    }
	  }
	  function atcdhide()
	  {        
	    resetField(); 
	    if($('#typeAntecedant').val() == "Pathologiques" )
	    {
	      $('#atcdsstypehide').show();$('#PhysiologieANTC').hide();
	      $('#habitudeAlim').val(null);$('#tabac').prop('checked', false); 
	      $('#ethylisme').prop('checked', false);   
	    }else
	    {
	      $('#atcdsstypehide').hide();$('#PhysiologieANTC').show();
	      $('#sstypeatcdc').prop("selectedIndex", 1);
	    }
	  }
	 
</script>
@endsection
@section('main-content')
<div id="demo">	</div>
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
			  <div class= "col-md-12 col-xs-12">
			     	@include('consultations.examenClinique')
			  </div>
			</div>  {{-- row --}}{{-- finexamenclinique --}}
			<div role="tabpanel" class = "tab-pane" id="ExamComp">
			  <div class= "col-md-12 col-xs-12">    
			     	@include('consultations.ExamenCompl')   
			  </div>{{-- <div class= "col-md-3 col-xs-9"> </div> --}}
			</div> 
	  </div>{{-- content --}}
  </div>{{-- tabpanel --}}
  <div class="space-12"></div>
  <div class="space-12"></div>
  <br><br>
  <div class="center bottom" style="bottom:0px;padding-">
			<div id="error" aria-live="polite"></div>
			<button class="btn btn-info btn-sm" type="submit" id="send">
				<i class="ace-icon fa fa-save bigger-110"></i>Enregistrer
			</button>
			&nbsp; &nbsp; &nbsp;
			<button class="btn btn-info btn-sm" type="button" id="annuler">
				<i class="ace-icon fa fa-undo bigger-110"></i>Annuler
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
<div class="row">
		@include('consultations.AntecedantModal')
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
   		 	<button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="storeord1()">Enregistrer</button>
   		 	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ord" onclick="createord('{{ $patient->Nom }} {{ $patient->Prenom }}','{{App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Nom_Employe}} {{App\modeles\employ::where("id",Auth::user()->employee_id)->get()->first()->Prenom_Employe}}')">Imprimer
		           </button>
			<button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" type="reset"> <i class="ace-icon fa fa-undo bigger-110"></i> Annuler</button>
			
   		 </div>
   		
	</div>
</div>{{-- endModal --}}
@endsection