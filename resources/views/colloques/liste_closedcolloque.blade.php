@extends('app_dele')
@section('title','Colloque')
@section('main-content')
<div class="row">
<div class="col-xs-12 widget-container-col" >
     <div class="col-xs-12 widget-container-col">
    	<div class="widget-box widget-color-blue" >
    		<div class="widget-header">
		    	<h5 class="widget-title bigger lighter">
		      	<i class="ace-icon fa fa-table"></i><strong>Liste Des Colloques {{ ($type == 0) ? 'Médicaux ' : 'Chirurgicaux' }} Cloturé</strong>
	       	</h5>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
				<div class='table_borderWrap'>
		    		<table class="table table-striped table-bordered table-hover" id="table1" aria-describedby="table1_info" role="grid">
					 <thead class="thin-border-bottom">
					  	 <tr>
						      <th><h4><strong>Semaine du</strong></h4></th>
							<th><h4><strong>Date du colloque</strong></h4></th>
							<th><h4><strong>Membres</strong></h4></th>
					        <th><h4><strong>Les demandes validées</strong></h4></th>
		  				 </tr>
				  	</thead>
				  	  <tbody id ="colloquesBody" class="bodyClass">
				  	  	@foreach( $colloques as $cle=>$col)
				  	  	<tr>
				  	  		 <td><?= date('d M Y',strtotime($col->date.' monday next week')-1);?></td>
				  	  	   	<td>{{ $col->date }}</td>
				  	  	   	<td>
							@foreach($col->employs as $i=>$med)
								<p class="text-primary">{{ $med->nom}} {{ $med->prenom}} {{$col->id}}</p></p> 
							@endforeach
							</td>
							<td>
								@foreach($col->demandes as $key=>$demande)
								<p class="text-primary">
									{{ $demande->consultation->patient->Nom }} {{ $demande->consultation->patient->Prenom }} &nbsp;&nbsp;
									<a  href="#" class="green btn-sm show-details-btn" title="Afficher Détails" data-toggle="collapse" id="{{ $demande->id }}"  data-target=".{{ $demande->id }}collapsed">
										<i class="fa fa-eye-slash" aria-hidden="true"></i><span class="sr-only">Details</span>
									</a>
								</p>
								<table class="collapse out budgets {{ $demande->id }}collapsed table-hover">
									<tr>
										<td style =" border: none!important;">
											<div class="profile-info-row profile-user-info-striped">
											<div class="profile-info-name"><strong>Date:</strong></div>
											<div class="profile-info-value">
												<span>{{ $demande->consultation->Date_Consultation }}</span>
											</div>
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
											<div class="profile-info-name"><strong>Medecin:</strong></div>
											<div class="profile-info-value"><span>{{ $demande->DemeandeColloque->medecin->nom }} {{ $demande->DemeandeColloque->medecin->prenom }} </span>
											</div>
											</div>
										</td>
										<td class="">
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
									<td class="">
										<div class="profile-info-row profile-user-info-striped">
										<div class="profile-info-name"><strong>Specialité:</strong></div>
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