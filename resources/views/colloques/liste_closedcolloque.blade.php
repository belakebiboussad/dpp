@extends('app_dele')
@section('title','Colloque')
@section('main-content')
<div class="row">
<div class="col-xs-12 widget-container-col" >
     <div class="col-xs-12 widget-container-col">
    	<div class="widget-box widget-color-blue" >
    		<div class="widget-header">
		    	<h5 class="widget-title bigger lighter">
		      	<i class="ace-icon fa fa-table"></i><strong>Liste des colloques {{ ($type == "0") ? 'Médicaux ' : 'Chirurgicaux' }} Cloturés</strong>
	       	</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<div class='table_borderWrap'>
		    		<table class="table table-striped table-bordered table-hover" id="table1" aria-describedby="table1_info" role="grid">
					 <thead class="thin-border-bottom">
					  	 <tr>
						      <th><h5><strong>Semaine du</strong></h5></th>
							<th><h5><strong>Date du colloque</strong></h5></th>
							<th><h5><strong>Membres</strong></h5></th>
					        <th><h5><strong>Les demandes validées</strong></h5></th>
		  				 </tr>
				  	</thead>
				  	  <tbody id ="colloquesBody" class="bodyClass">
				  	  	@foreach( $colloques as $cle=>$col)
				  	  	<tr>
				  	  		 <td><?= date('d M Y',strtotime($col->date.' monday next week')-1);?></td>
				  	  	   	<td>{{ $col->date }}</td>
				  	  	   	<td>
							@foreach($col->employs as $i=>$med)
								<p class="text-primary">{{ $med->full_name}} {{$col->id}}</p></p> 
							@endforeach
							</td>
							<td>
								@foreach($col->demandes as $key=>$demande)
								<p class="text-primary">
									{{ $demande->consultation->patient->full_name }}&nbsp;&nbsp;
									<a  href="#" class="green btn-sm show-details-btn" title="Afficher Détails" data-toggle="collapse" id="{{ $demande->id }}"  data-target=".{{ $demande->id }} collapsed">
										<i class="fa fa-eye-slash" aria-hidden="true"></i><span class="sr-only">Details</span>
									</a>
								</p>
								<table class="collapse out budgets {{ $demande->id }}collapsed table-hover">
									<tr>
										<td style =" border: none!important;">
											<div class="profile-info-row profile-user-info-striped">
											<div class="profile-info-name"><strong>Date:</strong></div>
											<div class="profile-info-value"><span>{{ $demande->consultation->date }}</span></div>
											</div>
										</td>
										<td class="">
											<div class="profile-info-row profile-user-info-striped">
												<div class="profile-info-name"><strong>Etat:</strong></div><div class="profile-info-value"><span>{{ $demande->etat }}</span></div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="profile-info-row profile-user-info-striped">
											<div class="profile-info-name"><strong>Médecin:</strong></div>
											<div class="profile-info-value"><span>{{ $demande->DemeandeColloque->medecin->full_name }}</span>
											</div>
											</div>
										</td>
										<td>
										<div class="profile-info-row profile-user-info-striped">
											<div class="profile-info-name"><strong>Mode:</strong></div>
											<div class="profile-info-value"><span>{{ $demande->modeAdmission }}</span></div>
										</div>
										</td>
									</tr>
									<tr>
									<td>
										<div class="profile-info-row profile-user-info-striped">
											<div class="profile-info-name"><strong>Service:</strong></div>
											<div class="profile-info-value"><span>{{ $demande->Service->nom }}</span></div>
										</div>
									</td>
									<td >
										<div class="profile-info-row profile-user-info-striped">
										<div class="profile-info-name"><strong>Spécialité:</strong></div>
										<div class="profile-info-value"><span>{{ $demande->Specialite->nom }}</span></div>
										</div>
									</td>
								</tr>
								</table>
								@endforeach
							</td>
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
@endsection