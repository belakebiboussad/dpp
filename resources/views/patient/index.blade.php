@extends('app')
@section('title','Rechercher un patient')
@section('page-script')
<script type="text/javascript" src="{{asset('/js/live_w_locator.js')}}"></script> 
<script>
	var video = document.getElementById("interactive");
	var constraints = window.constraints = {
	  	audio: false,
		  video: true
	};
	var errorElement = document.querySelector('#errorMsg');
	$(function(){
    try {
        stream =  navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
  			App.init();
  		  Quagga.onProcessed(function(result) {
          var drawingCtx = Quagga.canvas.ctx.overlay,
            drawingCanvas = Quagga.canvas.dom.overlay;
            if (result) {
                   if (result.boxes) {
                          drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                          result.boxes.filter(function (box) {
                              return box !== result.box;
                          }).forEach(function (box) {
                              Quagga.ImageDebug.drawPath(box, {x: 0, y: 1}, drawingCtx, {color: "green", lineWidth: 2});
                          });
                   }
                  if (result.box)
                      Quagga.ImageDebug.drawPath(result.box, {x: 0, y: 1}, drawingCtx, {color: "#00F", lineWidth: 2});
                  if (result.codeResult && result.codeResult.code)
                      Quagga.ImageDebug.drawPath(result.line, {x: 'x', y: 'y'}, drawingCtx, {color: 'red', lineWidth: 3});
           }
         });
         Quagga.onDetected(function(result) {
                if (result.codeResult.code){
                    $('#IPP').val(result.codeResult.code);
                    Quagga.stop();
                    App.init();  
                    setTimeout(function(){ $('#livestream_scanner').modal('hide'); }, 1000);            
                }
          });	
  	    }).catch(function(error) {
  		    $("#scanButton").addClass('hidden');
  	    });
    } catch (err){
      $("#scanButton").addClass('hidden');
    }
  });
function errorMsg(msg, error) {
  errorElement.innerHTML += '<p>' + msg + '</p>';
  if (typeof error !== 'undefined') {
    console.error(error);
  }
}
	function getPatientdetail(id)
	{
		$.ajax({
			url : '/patientdetail/'+id,
		      type : 'GET',
		      success:function(data,status, xhr){
			      	$('#patientDetail').html(data);
        		},
          		error:function(data){
	         		 console.log("error patient details")
	        	}	
		});
	}
	var values = new Array();
	function doMerge()
	{
    $.ajax({
      type : 'get',
      url : '{{URL::to('patientsToMerge')}}',
      data:{'search':values},
      success:function(data,status, xhr){
      		$('#tablePatientToMerge').html(data.html);
      }
  });
	}
	function KeepCount() {
		if($("input:checked").length >= 2){
			$('.check:not(:checked)').attr('disabled','disabled');
			$('#FusionButton').removeClass('invisible');
			$.each( $("input:checked"), function( key, value ) {
				values.push($(this).val());
	  		$(this).parent().parent().css('background-color','#dd9900');
			});
		}else
		{
			$( "input:not(:checked)").removeAttr("disabled");
			$('#FusionButton').addClass('invisible');
			$.each( $("input:unchecked"), function( key, value ) {
				$(this).parent().parent().css('background-color','#ffffff');
			});
		}
	}
	function setField(field,value)
	{
		if($('#'+field).is("input"))
			$('#'+field).val(value);
		else
		{
			var select = $('#'+field);
			$("select option").filter(function() {
			  return $(this).val() == value; 
			}).prop('selected', true);
		}	
	}
	$(function(){
		$('.autofield').change(function() {
	      if (this.value.trim()) {
	   		  field = $(this).prop("id");
	   		}
	  });
	});
	$(function(){
		$('#Dat_Naissance').change(function(){
    	 field = $(this).prop("id");	
		});
	});
	var field ="Dat_Naissance";
	$(document).ready(function(){
		$(document).on('click','.findptient',function(event){
			event.preventDefault();
			$('#btnCreate').removeClass('hidden');$('#FusionButton').removeClass('hidden');
			$('#patientDetail').html('');$(".numberResult").html('');
	    $.ajax({
		        type : 'get',
		        url : '{{ route("patient.index") }}',
		        data:{'field':field,'value':($('#'+field).val())},
		        success:function(data,status, xhr){
			     		$('#'+field).val('');//field= "Dat_Naissance"; 
     			 		$(".numberResult").html(Object.keys(data).length);
     			 	  var table =   $("#liste_patients").DataTable ({
	     					"processing": true,
		  				 	"paging":   true,
		  				  "destroy": true,
		  					"ordering": true,
		    				"searching":false,
		    				"info" : false,
		    				"language":{"url": '/localisation/fr_FR.json'},
		   	 		    "data" : data,
		   	 		    "scrollX": true,
			        	"columns": [	
											{ data:null,title:'#', "orderable": false,searchable: false,
								    			render: function ( data, type, row ) {
			                   		if ( type === 'display' ) {
			                        		return '<input type="checkbox" class="editor-active check" name="fusioner[]" value="'+data.id+'" onClick="return KeepCount()" /><span class="lbl"></span>';
			                  		}
			                   		 return data;
								          },
								          className: "dt-body-center",
											},
											{ data:'id',title:'ID', "visible": false},
											{ data: 'Nom', title:'Nom' },
		       						{ data: 'Prenom', title:'Prenom' },
		       						{ data: 'IPP', title:'IPP'},
		       			  		{ data: null,
                        render: function ( data, type, row ) {
                          return moment(row.Dat_Naissance).format('YYYY-MM-DD');
                        },title:'Né(e) le'
                      },
										  { data: 'Sexe', title:'Sexe'},
									    { data: null,
                        render: function ( data, type, row ) {
                          return moment(row.created_at).format('YYYY-MM-DD');
                        },title:'Créer le'
                      },

									    { data:null,title:'<em class="fa fa-cog"></em>', searchable: false,
									  	"render": function(data,type,full,meta){
										    if ( type === 'display' ) {
													return  '<a onclick ="getPatientdetail('+data.id+')" style="cursor:pointer" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Résume du patient"><i class="fa fa-eye-slash fa-xs"></i></a>'+
                                  '&nbsp;<a href = "/patient/'+data.id+'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Consulter le dossier"><i class="fa fa-hand-o-up fa-xs"></i></a>'+
                                  '&nbsp;<a href ="/patient/'+data.id+'/edit" class="btn btn-info btn-xs" data-toggle="tooltip" title="modifier"><i class="fa fa-edit fa-xs"></i></a>'
								      	}
								      	return data;		
									  	}
									  }
		  		   			],
				   			"columnDefs": [
			   						{"targets": 2 ,  className: "dt-head-center priority-1" },//nom
			   						{"targets": 3 ,  className: "dt-head-center priority-2" },
			   						{"targets": 4 ,  className: "dt-head-center priority-3" },
			   						{"targets": 5 ,  className: "dt-head-center priority-4" },//dt
			   						{"targets": 6 ,	"orderable": false, className: "dt-head-center priority-5" },//sex
							 		  {"targets": 7 ,	"orderable": true, className: "dt-head-center priority-6"},//cre le
							 		  {"targets": 8 ,	"orderable":false,  className: "dt-head-center dt-body-center priority-7"}
						   	],
	    				});
     			}
    		});
	});
});	
</script>
@endsection
@section('main-content')
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
			 <div class="panel-heading left"><H4>Rechercher un patient</H4></div> 
			 <div class="panel-body">
				<div class="row">
					<div class="form-group col-sm-3"><label>Nom</label>
						<div class="input-group col-sm-12 col-xs-12">
							<input type="text" class="form-control autofield" id="Nom" placeholder="Nom du patient..." autofocus/>
							<span class="glyphicon glyphicon-search form-control-feedback"></span>
				    </div>
					</div>
					<div class="form-group col-sm-3"><label>Prénom</label> 
							<div class="input-group col-sm-12 col-xs-12">
						  	<input type="text" class="form-control autofield" id="Prenom"  placeholder="Prénom du patient..."> 
						  	<span class="glyphicon glyphicon-search form-control-feedback"></span>
			   			</div>		
					</div>
					<div class="form-group col-sm-3"><label >Né(e)</label>
						<div class="input-group col-sm-12 col-xs-12">
							<input type="text" class="form-control date-picker ltnow" id="Dat_Naissance" data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" data-toggle="tooltip" data-placement="left" title="Date Naissance">
							<span class="glyphicon glyphicon-search form-control-feedback"></span>
						</div>		
					</div>
					<div class="form-group col-sm-3"><label>IPP</label>
						<div class="input-group col-sm-12 col-xs-12">
							<input id="IPP" class="form-control autofield" placeholder="Identifiant du patient..." type="text" data-toggle="tooltip" data-placement="left" title="Code IPP du patient"/> 
				      <span class="input-group-btn"> 
								<button class="btn btn-default btn-xs" id="scanButton" type="button" data-toggle="modal" data-target="#livestream_scanner"><i class="fa fa-barcode"></i>
								</button> 
							</span>
						</div>
					</div>		
				</div>
			</div>  {{-- body --}}
			<div class="panel-footer">
		   	<button type="submit" class="btn btn-sm btn-primary findptient"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
				<div class="pull-right">
					<button type="button" class="btn btn-danger btn-sm hidden invisible" id="FusionButton"  onclick ="doMerge();"data-toggle="modal" data-target="#mergeModal" data-backdrop="false" hidden><i class="fa fa-angle-right fa-lg"></i><i class="fa fa-angle-left fa-lg"></i>&nbsp;Fusion</button>
					<a class="btn btn-primary btn-sm hidden" href="patient/create" id="btnCreate" role="button" aria-pressed="true"><i class="ace-icon  fa fa-plus-circle fa-lg bigger-120"></i>Créer</a>
				</div>		
			</div>
	 	</div><!-- panel -->
		</div>		
	</div>
 	<div class="row">
		<div class="col-md-7 col-sm-7">
			<div class="widget-box">
				<div class="widget-header widget-header-flat widget-header-small">
					<h5 class="widget-title"><i class="ace-icon fa fa-user"></i> Résultats :</h5><label><span class="badge badge-info numberResult"></span></label>
				</div>
				<div class="widget-body">
					<div class="widget-main no-padding"><table id="liste_patients" class="display responsive nowrap" cellspacing="0" width="100%"></table></div>
				</div>	
			</div>
		</div>
		<div class="col-md-5 col-sm-5"  id="patientDetail"></div>		
	</div>{{-- row --}}
	<div class="row">@include('patient.ModalFoms.mergeModal')@include('patient.ModalFoms.scanbarCodeModal')</div>
@endsection