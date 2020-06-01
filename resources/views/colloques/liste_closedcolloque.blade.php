@extends('app_dele')
@section('title','Colloque')
@section('page-script')
@endsection
@section('main-content')
<div id="" class="col-xs-12"></div>
<div class="row">
<div class="col-xs-12 widget-container-col" id="widget-container-col-1"><br/>
     <div class="col-xs-12 widget-container-col" id="widget-container-col-12">
    	<div class="widget-box widget-color-blue" id="widget-box-12">
    		<div class="widget-header">
		    	<h5 class="widget-title bigger lighter">
		      		<i class="ace-icon fa fa-table"></i><strong>Liste Des Colloques {{ ($type == 1) ? 'Médicaux ' : 'Chirurgicaux' }} Cloturé</strong>
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
	    	@foreach( $colloque as $cle=>$col)
	    	<tr>
	 	      <td>
			       <?= date('d M Y',strtotime($col["dat"].' monday next week')-1);?>
			    </td>
			    <td>
						{{$col["dat"]}}
					</td>
					<td>
					@foreach($col["membres"] as $i=>$m)
						<p class="text-primary">
							{{ $col["membres"][$i] }}</p>
						</p>  
					@endforeach
					</td>
					<td>
					@foreach($demandes as $j=>$demande)
						@if($demande->id_colloque == $col["id"])
						<p class="text-primary">
						            {{ $demande->demandeHosp->consultation->patient->Nom }}
							{{ $demande->demandeHosp->consultation->patient->Prenom }}
						            	
						            &nbsp;&nbsp;<a class="text-success">
						           <a  href="#" class="green btn-sm show-details-btn" title="Afficher Détails" data-toggle="collapse" id="{{ $j }}"  data-target=".{{$j}}collapsed">
								<i class="fa fa-eye-slash" aria-hidden="true"></i>
								<span class="sr-only">Details</span>
							</a>
						</p>
						<table class="collapse out budgets {{$j}}collapsed table-hover">
							<tr>
								<td style =" border: none!important;">
									<div class="profile-info-row profile-user-info-striped">
									<div class="profile-info-name"><strong>Date:</strong></div>
									<div class="profile-info-value">
									<span>
										{{ $demande->demandeHosp->consultation->Date_Consultation }}
									</span>
									</div>
									</div>
								</td>
								<td class="">
									 <div class="profile-info-row profile-user-info-striped">
									<div class="profile-info-name"><strong>Etat:</strong></div>
									<div class="profile-info-value">
										<span>{{ $demande->demandeHosp->etat }}</span>
									</div>
									</div>
								</td>
							</tr>
							<tr>
							<td>
									<div class="profile-info-row profile-user-info-striped">
									<div class="profile-info-name"><strong>Medecin:</strong></div>
									<div class="profile-info-value">
									<span>
										{{ $demande->medecin->Nom_Employe }} {{ $demande->medecin->Prenom_Employe }} 
									</span>
									</div>
									</div>
								</td>
								<td class="">
									<div class="profile-info-row profile-user-info-striped">
									<div class="profile-info-name"><strong>Mode:</strong></div>
									<div class="profile-info-value">
										<span>{{ $demande->demandeHosp->modeAdmission }}</span>
									</div>
									</div>
								</td>
							</tr>
								<tr>
							<td>
									<div class="profile-info-row profile-user-info-striped">
									<div class="profile-info-name"><strong>Service:</strong></div>
									<div class="profile-info-value">
									<span>{{ $demande->demandeHosp->Service->nom }}</span>
									</div>
									</div>
								</td>
								<td class="">
									<div class="profile-info-row profile-user-info-striped">
									<div class="profile-info-name"><strong>Specialité:</strong></div>
									<div class="profile-info-value">
										<span>{{ $demande->demandeHosp->Specialite->nom }}</span>
									</div>
									</div>
								</td>
							</tr>
						</table>		
						@endif
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