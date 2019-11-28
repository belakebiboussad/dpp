@extends('app_agent_admis')
@section('page-script')
<script type="text/javascript">
	function getAdmissions(date)
	{
	  $.ajax({
	           
	            // url : '{{URL::to('getAdmissions')}}',
	            url: '/getAdmissions/'+ $("#currentday").val(),
	            type :'GET',
	            // data:{'date':date},
	            dataType: 'JSON',
	            success:function(result,status, xhr)
	            {
	               if(result.length != 0){
		             	  var admissions = $('#admis').empty();
		             	  $.each(result,function(){
		               					selectLit.append("<option value='"+this.id+"'>"+this.nom+"</option>");
		             				});  	
		             	}
	       				  
	            }
	  });
	}

</script>
@endsection
@section('main-content')
<div class="col-xs-12 widget-container-col" id="widget-container-col-2">
  <div class="panel-heading">
     <div class="row">
      <div class="col-md-5"></div>
      <div class="col-md-5">
  			<div class="input-group" data-provide="">
   				<input type="text" id ="currentday"class=" col-xs-12 col-sm-6 date-picker form-control" value="<?= date("Y-m-j") ?>">
   				<div class="input-group-addon">
        		<span class="glyphicon glyphicon-th"></span>
   				</div>
				</div>
  		</div>
      <div class="col-md-2">
        <button type="button" name="filter" id="filter" class="btn btn-info btn-sm"
           onclick = "getAdmissions();">
          	<i class="fa fa-search"></i> &nbsp;Rechercher
        </button>
          <!--  <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button> -->
      </div>
     </div>
    </div>
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">
				<i class="ace-icon fa fa-table"></i>
				Liste des admissions <b><span id="total_records" class = "badge badge-info numberResult" >{{ count($rdvs) }}</span></b><!-- du jour  <strong>&quot;{{ Date('Y-m-d') }}&quot;	</strong> -->
			</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
			<table class="table table-striped table-bordered table-hover" id="liste_admissions">
				<thead class="thin-border-bottom">
					<tr>
						<th style="display: none;"></th>
						<th>Patient</th>
						<th>Service</th>
						<th>Salle</th>
						<th>Lit</th>
						<th>Date prévue d'entrée</th>
						<th>Heure prévue d'entrée</th>
						<th></th>
					</tr>
				</thead>
				<tbody id ="admis">
						@foreach($rdvs as $rdv)
						<tr>
								<td style="display: none;">{{$rdv->id_admission}}</td></td>
								<td>
									{{ $rdv->admission->demandeHospitalisation->consultation->patient->Nom }}
								  {{ $rdv->admission->demandeHospitalisation->consultation->patient->Prenom }}
								</td>
								<td>
								  @if(isset($rdv->admission->id_lit))
											{{ $rdv->admission->lit->salle->service->nom }}
								  @else
									  	<strong>/</strong>
								  @endif
								</td>
								<td>
									@if(isset($rdv->admission->id_lit))
										 {{ $rdv->admission->lit->salle->nom }}
									@else
									 		<strong>/</strong>
									@endif
								</td>
								<td>
									@if(isset($rdv->admission->id_lit))
								 			{{ $rdv->admission->lit->num }}  
									@else
											<strong>/</strong>
								 	@endif
								</td>
								<td>
									<span class ="text-danger">
									<strong>{{ $rdv->date_RDVh }}</strong>
									</span>
								</td>
								<td>
										<span class ="text-danger">
											<strong>{{ $rdv->heure_RDVh }}</strong>
										</span>
								</td>
								<td>
										<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{ $rdv->admission->id }}"
										      	data-backdrop="false">
										      	<i class="fa fa-check"></i> &nbsp; confirmer
										</button>
										<!--model pop-up -->
										<div id="{{ $rdv->admission->id }}" class="modal fade" role="dialog" aria-hidden="true">
				 							<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
			        							<button type="button" class="close" data-dismiss="modal">&times;</button>
			        							<h4 class="modal-title">confirmer l'entrée du patient:</h4>
			      						  </div>
			      						  <div class="modal-body">
			        							<p>
			        								<span  style="color: blue;">
			        										<h3>
			        												<strong >{{ $rdv->admission->demandeHospitalisation->consultation->patient->Nom }}
			        														 {{ $rdv->admission->demandeHospitalisation->consultation->patient->Prenom }}
			        												</strong>
			        										</h3>
			        								</span>
			        							</p>
			        							<br>
			        							<p>
			        								<h3>
			        									le  &quot;<span  style="color: orange;"><strong>
			        									{{ $rdv->date_RDVh }}</strong></span>&quot; &nbsp;à &nbsp;<span  style="color: red;">
			        									<strong>{{Date("H:i:s")}}</strong></span>
			        								</h3>
			        							</p>			
			        						</div>
													<form id="hospitalisation" class="form-horizontal" role="form" method="POST"
													  action="{{route('hospitalisation.store')}}">{{ csrf_field() }}
				      							<input id="id_ad" type="text" name="id_ad" value="{{ $rdv->admission->id }}" hidden>
				      							<input id="id_RDV" type="text" name="id_RDV" value="{{$rdv->id}}" hidden>
			      								<div class="modal-footer">
			        								<button type="button" class="btn btn-default" data-dismiss="modal">
			        									<i class="ace-icon fa fa-undo bigger-120"></i>	Fermer
			        								</button>
			        								<button  type="submit" class="btn btn-success" >
			        								  <i class="ace-icon fa fa-check bigger-120"></i>
			        								Valider
			        							</button>
			      							</div> 
			      							</form>
												</div>
											</div>
										</div>
								</td>

						</tr>
						@endforeach		

				</tbody>
		  </table>
		  </div>
		</div><!-- widget-body -->
	</div><!-- widget-box -->
</div>
@endsection	





