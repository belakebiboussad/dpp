@extends('app_agent_admis')
@section('page-script')
<script type="text/javascript">
  $("document").ready(function(){
    $("#getadmsbtn").click(function(e){
      var op =""; var frag = "";  var dt = new Date();
      var time = dt.getHours() + ":" + dt.getMinutes();
      var date = dt.getFullYear() + "-" + (dt.getMonth()+1) + "-" +   dt.getDate();          
      var filter= new Date($("#currentday").val());
      url= '{{ route ("rdvHospi.dayRdvsHosp", ":slug") }}',
      url = url.replace(':slug',$("#currentday").val());
      $.ajax({
        url:url,//url: '/getRdvs/'+ $("#currentday").val(),
        type :'GET',
        dataType: 'JSON',
        success:function(result,status, xhr)
        {
        	var admissions = $('#rdvs').empty();
          $('#total_records').text(result.length);
          if(result.length != 0){ 
        		var disabled =(datesAreOnSameDay(dt, filter))?'':'disabled';
            for(var i=0; i<result.length; i++){
              var forms ="";
            	if(!isEmpty(result[i]['bed_reservation']))
                    frag = result[i]['bed_reservation']['lit']['salle']['service'].nom+'</td><td>'+result[i]['bed_reservation']['lit']['salle'].nom+'</td><td>'+result[i]['bed_reservation']['lit'].nom+'</td>'; 
            	else
             		frag = '<td><strong>/</strong></td><td><strong>/</strong></td><td><strong>/</strong></td><td><span class ="text-danger"><strong>'; 
            	forms ='<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-backdrop="false"data-target="#'+result[i].id
            			  +'"'+disabled+'><i class="fa fa-check"></i> &nbsp;Confirmer</button>'
                    +'<div class="modal fade" role="dialog" aria-hidden="true" id="'+result[i].id+'">'
                    +'<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'
                    +'<button type="button" class="close" data-dismiss="modal">&times;</button>'
                    +'<h4 class="modal-title">confirmer l\'entrée du patient:</h4></div>'
                    +'<div class="modal-body"><p><span style="color: blue;"><h3><strong>'+result[i]['demande_hospitalisation']['consultation']['patient'].Nom + result[i]['demande_hospitalisation']['consultation']['patient'].Prenom
                    +'</strong></h3></span></p><br><p><h3>le &quot;<span  style="color: orange;"><strong>'+result[i].date_RDVh
                    +'</strong></span>&quot; &nbsp;à &nbsp;<span style="color: red;"><strong>'+time+'</strong></span></h3></p></div>'
                    +'<form id="hospitalisation" class="form-horizontal" role="form" method="POST" action="/admission">'
                    +'{{ csrf_field() }} <input id="id_RDV" type="text" name="id_RDV" value="'+result[i].id+'" hidden>'
                    +'<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">'
                    +'<i class="ace-icon fa fa-undo bigger-120"></i>  Annuler</button><button  type="submit" class="btn btn-success">'
                    +'<i class="ace-icon fa fa-check bigger-120"></i>Valider</button></div>'
                    +'</form>'
                    +'</div></div></div>'; 
                op  +='<tr><td style="display: none;">'+result[i].id+'</td><td>'+result[i]['demande_hospitalisation']['consultation']['patient'].Nom + ' ' + result[i]['demande_hospitalisation']['consultation']['patient'].Prenom+'</td><td>'+ result[i]['demande_hospitalisation']['service'].nom +'</td><td><span class ="text-danger"><strong>'+result[i].date_RDVh +'</strong></span></td><td>'
                        +frag+'<td class="text-center">'+ forms +'</td></tr>';
                         
       			}
        		$('#rdvs').html(op);
          }        
        }
      });
			if(datesAreOnSameDay(dt, filter))
			{//get urgente demande
				$.ajax({
	        url: '/getUrgdemande/'+ $("#currentday").val(),
	        type :'GET',
	        dataType: 'JSON',
	        success:function(result,status, xhr)
	        {
	        }
      	});
			}
    })
  });
</script>
@endsection
@section('main-content')
<div class="page-content">
	<div class="row panel panel-default">
		<div class="panel-heading left" style="height: 40px; font-size: 2.3vh;">
			<strong>Rechercher une Admission</strong><div class="pull-right" style ="margin-top: -0.5%;"></div>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-8 col-sm-8 col-xs-8">
  			  <div class="col-sm-3 col-xs-3 ">
	        	<label class="control-label center" for="" ><strong>Date :</strong></label>
	        </div>
					<div class="input-group col-sm-5 col-xs-5">
						<input type="text" id ="currentday"class="col-xs-12 col-sm-12 date-picker form-control"  value="<?= date("Y-m-j") ?>" data-date-format="yyyy-mm-dd">
						<div class="input-group-addon"><span class="glyphicon glyphicon-th"></span></div>
    			</div>
  			</div>
  			<div class="col-md-2 col-sm-2 col-xs-2"></div>
			</div>
		</div>
		 <!-- onclick = "getAdmissions();" -->
		<div class="panel-footer" style="height: 50px;">
	   		<button type="submit"name="filter" id="getadmsbtn" class="btn btn-xs btn-primary findptient" style="vertical-align: middle"><i class="fa fa-search"></i>&nbsp;Rechercher</button>
		</div>
	</div><!-- panel -->
	<div class="row"><!-- <div class="col-sm-12"> --><!-- 	</div> -->
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">
					<i class="ace-icon fa fa-table"></i>
					Liste des admissions <b><span id="total_records" class = "badge badge-info numberResult" >{{ count($rdvs) }}</span></b>
					{{-- du jour  <strong>&quot;{{ Date('Y-m-d') }}&quot;</strong> --}}
				</h5>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
				<table class="table table-striped table-bordered table-hover irregular-header" id="liste_admissions">
	  		<thead class="thin-border-bottom thead-light">
	      	<tr>
	          <th rowspan="2" class="text-center"><h5><strong>Patient</strong></h5></th> 
	          <th rowspan="2" class="text-center"><h5><strong>Service</strong></h5></th>
	          <th rowspan="2" class="text-center"><h5><strong>Date Entrée</strong></h5></th>
						<th colspan="3" scope="colgroup" class="text-center"><h5><strong>Hébergement</strong></h5></th> <!-- merge four columns -->
	          <th rowspan="2" class="text-center"><em class="fa fa-cog"></th>	
	      	</tr>
	      	<tr>
	          <th scope="col" class="text-center"><h6><strong>Service</strong></h6></th>
						<th scope="col" class="text-center"><h6><strong>Salle</strong></h6></th>
						<th scope="col" class="text-center"><h6><strong>Lit</strong></h6></th>							
	      	</tr>
	  		</thead>
	  		<tbody id="rdvs">
	    	  @foreach($rdvs as $rdv)
						<tr><!-- <td >{{$rdv->id_demande}}</td> -->
							<td>{{ $rdv->demandeHospitalisation->consultation->patient->Nom }}&nbsp;{{ $rdv->demandeHospitalisation->consultation->patient->Prenom }}</td>
							<td>{{ $rdv->demandeHospitalisation->Service->nom }}</td>
							<td><span class ="text-danger"><strong>{{ $rdv->date_RDVh }}</strong></span></td>
							<td>
								@if($rdv->bedReservation)
									{{ $rdv->bedReservation->lit->salle->service->nom}}
								@else
									<strong>/</strong>
								@endif
							</td>
							<td>
							@if($rdv->bedReservation) {{ $rdv->bedReservation->lit->salle->nom}} @else <strong>/</strong>
							@endif
							</td>
							<td>
							@if($rdv->bedReservation) {{ $rdv->bedReservation->lit->nom}} @else<strong>/</strong>@endif
							</td>
							<td class="text-center">
								<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{ $rdv->id }}" data-backdrop="false"><i class="fa fa-check"></i> &nbsp;Confirmer</button>
								@include('admission.modalForm.confirmEntreeProg')
							</td>
						</tr>
						@endforeach
						@foreach($demandesUrg as $demande)
						<tr>
							<td>{{ $demande->consultation->patient->Nom }}&nbsp;{{ $demande->consultation->patient->Prenom }}</td>
							<td>{{ $demande->Service->nom }}</td>
							<td><span class ="text-danger"><strong>{{ $demande->consultation->Date_Consultation }}</strong></span></td>
							<td>@if(isset($demande->bedAffectation)) {{ $demande->bedAffectation->lit->salle->service->nom}} @else <strong>/</strong> @endif </td>
							<td>@if(isset($demande->bedAffectation)) {{ $demande->bedAffectation->lit->salle->nom}} @else <strong>/</strong> @endif </td>
							<td>@if(isset($demande->bedAffectation)) {{ $demande->bedAffectation->lit->nom}} @else <strong>/</strong> @endif </td>
							
							<td class="text-center">
								<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{ $demande->id }}" data-backdrop="false"><i class="fa fa-check"></i> &nbsp;Confirmer</button>
								@include('admission.modalForm.confirmEntreeUrg')
								
							</td>
						</tr>
						@endforeach
	      </tbody>
	      </table>	
				</div>
			</div>
		</div>
  </div>{{-- row --}}
 
</div><!-- page-content -->
@endsection