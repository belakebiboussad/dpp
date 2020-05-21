@extends('app_agent_admis')
@section('page-script')
<script type="text/javascript">
	function getAdmissions()
	{
		var op ="";
		var frag = "";
		var dt = new Date();
    var time = dt.getHours() + ":" + dt.getMinutes();
    var date = dt.getFullYear() + "-" + (dt.getMonth()+1) + "-" +	dt.getDate();          
	  $.ajax({
	          url: '/getAdmissions/'+ $("#currentday").val(),  // url : '{{URL::to('getAdmissions')}}',
	          type :'GET',
	          data:{'date':$("#currentday").val()},
	          dataType: 'JSON',
	          success:function(result,status, xhr)
	          {
	          	var admissions = $('#admis').empty();
	          	if(result.length != 0){
		          	for(var i=0;i<result.length;i++){
		          		var forms ="";
		      		    if(result[i].id_lit != null || result[i].id_lit != NULL )
		      		  	{
		      		  		frag = result[i].nom_service+'</td><td>'+result[i].nom_salle+'</td><td>'+result[i].num_lit+'</td><td><span class ="text-danger"><strong>'; 
		      		  	}else
		      		  	{
	                  frag = '</td><td><strong>/</strong></td><td<strong>/</strong></td><td><strong>/</strong></td><td><span class ="text-danger"><strong>'; 
		      		  	}
		      		 
		      		  	if(date == result[i].date_RDVh)
		      		  	{
		      		  	
		      		   		forms ='<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-backdrop="false"data-target="#'+result[i].id_admission+'"><i class="fa fa-check"></i> &nbsp; confirmer</button>'
		      		   		    +'<div class="modal fade" role="dialog" aria-hidden="true" id="'+result[i].id_admission+'">'
		                    +'<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'
		                    +'<button type="button" class="close" data-dismiss="modal">&times;</button>'
		                    +'<h4 class="modal-title">confirmer l\'entrée du patient:</h4></div>'
		                    +'<div class="modal-body"><p><span  style="color: blue;"><h3><strong>'+result[i].Nom + result[i].Prenom
		                    +'</strong></h3></span></p><br><p><h3>le &quot;<span  style="color: orange;"><strong>'+result[i].date_RDVh
		                    +'</strong></span>&quot; &nbsp;à &nbsp;<span style="color: red;"><strong>'+time+'</strong></span></h3></p></div>'
		        			  		+'<form id="hospitalisation" class="form-horizontal" role="form" method="POST"action="/hospitalisation">'
		        						+'{{ csrf_field() }}<input id="id_ad" type="text" name="id_ad" value="'+result[i].id_admission+'" hidden>'
		        				 		+'<input id="id_RDV" type="text" name="id_RDV" value="'+result[i].id+'" hidden>'
		        						+'<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">'
		        						+'<i class="ace-icon fa fa-undo bigger-120"></i>	Fermer</button><button  type="submit" class="btn btn-success">'
					        			+'<i class="ace-icon fa fa-check bigger-120"></i>Valider</button></div>'
		        						+'</form>'
		        						+'</div></div></div>';
		      		  	}
		      		  	else
		      		  	{ 
		      		  		if(result[i].etat == "programme")
		      		  			forms = '<span class="label label-sm label-danger">'+result[i].etat+'</span>';
		      		  		else
		      		  			forms = '<span class="label label-sm label-success">'+result[i].etat+'</span>';
		      		  	}
                  
	      					op+='<tr><td style="display: none;">'+result[i].id_admission+'</td><td>'+result[i].Nom + ' ' +result[i].Prenom+'</td><td>'
	      							+frag+result[i].date_RDVh+'</strong></span></td><td><span class ="text-danger"><strong>'+result[i].heure_RDVh+'</strong></span></td><td>'
	      							+forms
	      				  		+'</td></tr>';
        				}
        				$('#admis').html(op); 
        			}		 
	          }
	  });
	}
</script>
@endsection
@section('main-content')
<div class="page-content">
	<div class="row panel panel-default">
		<div class="panel-heading left" style="height: 40px; font-size: 2.3vh;">
			<strong>Rechercher une Admission</strong>
			<div class="pull-right" style ="margin-top: -0.5%;">
			</div>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-8 col-sm-8 col-xs-8">
  			  <div class="col-sm-3 col-xs-3 ">
	        	<label class="control-label center" for="" ><strong>Date :</strong></label>
	        </div>
					<div class="input-group col-sm-5 col-xs-5">
						<input type="text" id ="currentday"class="col-xs-12 col-sm-12 date-picker form-control"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd">
						<div class="input-group-addon">
    					<span class="glyphicon glyphicon-th"></span>
    				</div>
					</div>
  			</div>
  			<div class="col-md-2 col-sm-2 col-xs-2">
  			</div>
			</div>
		</div>
		<div class="panel-footer" style="height: 50px;">
	   	<button type="submit"name="filter" id="filter" class="btn btn-xs btn-primary findptient" style="vertical-align: middle" onclick = "getAdmissions();"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
		</div>
	</div><!-- panel -->
	<div class="row"><!-- <div class="col-sm-12"> --><!-- 	</div> -->
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">
					<i class="ace-icon fa fa-table"></i>
					Liste des admissions <b><span id="total_records" class = "badge badge-info numberResult" >{{ count($rdvs) }}</span></b><!-- du jour  <strong>&quot;{{ Date('Y-m-d') }}&quot;	</strong> -->
				</h5>
			</div>
		</div>
	</div>
</div><!-- page-content -->
@endsection