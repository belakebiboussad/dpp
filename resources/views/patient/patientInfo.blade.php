<div class="row">
	<div class="col-xs-3 col-sm-3 center">
		<span class="profile-picture">
			<img class="editable img-responsive" alt="Avatar" id="avatar2" src="{{asset('/avatars/profile-pic.jpg')}}" />
		</span><div class="space space-12"></div>
		<a href="{{ route('patient.edit', $patient->id) }}" class="btn btn-sm btn-block btn-success">
			<i class="ace-icon fa fa-pencil bigger-120"></i>
			<span class="bigger-110">Modifier</span>
		</a>
		<a class="btn btn-sm btn-block btn-primary" data-toggle="modal" data-target="#ticket">
				<i class="ace-icon fa fa-plus bigger-120"></i><span class="bigger-110">Ajouter Ticket</span>
		</a>
	</div><!-- /.col -->
	<div class="col-xs-9 col-sm-9">
		<h4 class="blue"><span class="middle">{{ $patient->getCivilite()}} {{ $patient->Nom }} {{ $patient->Prenom }}</span>
			<span class="label label-purple arrowed-in-right"><i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
			@switch($patient->Type)
		                @case(0)
			                     Assuré
			                     @break
		                @case(1)
			                     Conjoint(e)
			                     @break
		                @case(2)
			                     Ascendant
			                     @break
		                @case(3)
			                     Descendant
			                          @break  
		                @case(4)
			                     Autre 
			                     @break       
		      @endswitch  
		     </span>
			</h4>
			<div class="profile-user-info">
				<div class="profile-info-row">
					<div class="profile-info-name">Nom</div><div class="profile-info-value"><span>{{ $patient->Nom }}</span></div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name">Prénom</div><div class="profile-info-value"><span>{{ $patient->Prenom }}</span></div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name">Genre </div>
					<div class="profile-info-value">	<span>{{ $patient->Sexe =="M" ? "Masculin" : "Féminin" }}</span></div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name">né(e) le </div><div class="profile-info-value"><span>{{ $patient->Dat_Naissance }}</span></div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name"> Âge </div>
					<div class="numberCircle">{{ $patient->getAge() }}</div> <span class="blue">Ans</span>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name"> Lieu Naissance </div>
					<div class="profile-info-value">
						<i class="fa fa-map-marker light-orange bigger-110"></i><span>{{ $patient->lieuNaissance->nom_commune }}</span>
					</div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name"> Civilité </div>
					<div class="profile-info-value"><span>
						@switch($patient->situation_familiale)
					           @case("C")
						                Célibataire(e)
						                @break
						     @case("M")
						               Marié(e)
						                @break
						     @case("D")
						                Divorcé(e)
						                @break
						     @case("V")
						                Veuf(veuve)
						                @break           	
						@endswitch 
						</span>
					</div>
				</div>
				@if(($patient->Sexe =="F") && ($patient->situation_familiale == "M"))
				<div class="profile-info-row">
					<div class="profile-info-name"> Nom Fille </div>
					<div class="profile-info-value"><span>{{ $patient->nom_jeune_fille }}</span></div>
				</div>
				@endif
				<div class="profile-info-row">
					<div class="profile-info-name"> Adresse </div>
					<div class="profile-info-value">
						<i class="fa fa-map-marker light-orange bigger-110"></i>
						<span>{{ $patient->Adresse }} ,{{ $patient->commune->nom_commune}} , {{ $patient->wilaya->nom }}</span>
					</div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name"><i class="fa fa-phone"></i>Télé mobile 1 </div>
					<div class="profile-info-value"><span>{{ $patient->tele_mobile1 }}</span></div>
				</div>
				@if(isset($patient->tele_mobile2) &&($patient->tele_mobile2 != ''))
				<div class="profile-info-row">
					<div class="profile-info-name"><i class="fa fa-phone"></i>Télé mobile 2 </div>
					<div class="profile-info-value"><span>{{ $patient->tele_mobile2 }}</span></div>
				</div>
				@endif
				<div class="profile-info-row">
					<div class="profile-info-name"> Groupe Sang</div>
					<div class="profile-info-value"><span>{{ $patient->group_sang }}</span></div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name"> Rhésus </div>
					<div class="profile-info-value"><span>{{ $patient->Rihesus == "+" ? "Positif" : "Négatif" }}</span></div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name">Date Création</div>
					<div class="profile-info-value"><span>{{ $patient->Date_creation }}</span></div>
				</div>
			</div>
			<div class="hr hr-8 dotted"></div>
			@if(in_array( $patient->Type , [1,2,3,4]))
			<div class="col-sm-12 widget-container-col" id="widget-container-col-12">
				<div class="widget-box transparent" id="widget-box-12">
					<div class="widget-header"><h4 class="widget-title lighter">Les Informations du fonctionnaire</h4></div>
					<div class="widget-body">
						<div class="widget-main padding-6 no-padding-left no-padding-right">
							<div class="row">
								<div class="col-sm-3">
								<label class="inline"><span><b>Nom :</b></span><span class="lbl blue"> {{ $patient->assure->Nom}}</span></label>
								</div>
								<div class="col-sm-3">
								<label class="inline"><span><b>Prénom :</b></span><span class="lbl blue"> {{ $patient->assure->Prenom}}</span></label>
								</div>
								<div class="col-sm-3">
								<label class="inline">
								<span><b>Né(e) le :</b></span><span class="lbl blue"> {{ $patient->assure->Date_Naissance }}</span></label>
								</div>
								@if(isset($patient->assure->lieunaissance))
								<div class="col-sm-3">
								<label class="inline">	<span><b>Né(e) à :</b></span><span class="lbl blue">{{ $patient->assure->lieuNaissance->nom_commune}} </span>
									</label>
								</div>	
								@endif
							</div>
							<div class="row">
								<div class="col-sm-3">
									<label class="inline">
										<span><b>Sexe :</b></span><span class="lbl blue"> {{ $patient->assure->Sexe == "H" ? "Masculin" : "Féminin" }}</span>
									</label>
								</div>
								<div class="col-sm-3">
								<label class="inline">	<span><b>Position :</b></span><span class="lbl blue">{{ $patient->assure->Position }}</span>
								</label>
								</div>
								<div class="col-sm-6">
								<label class="inline"><span><b>Service :</b></span><span class="lbl blue">{{ $patient->assure->Service }}</span>
								</label>
								</div>
							</div>
							<div class="col-sm-3">
								<label class="inline">
									<span><b>Matricule :</b></span><span class="lbl blue"> {{ $patient->assure->matricule }}</span>
								</label>
							</div>
							<div class="col-sm-3">
								<label class="inline">
									<span><b>Grade :</b></span><span class="lbl blue"> {{ $patient->assure->grade->nom }}</span>
								</label>
							</div>
							<div class="col-sm-6">
								<label class="inline">
									<span><b>N° sécurité sociale :</b></span><span class="lbl blue"> {{ $patient->assure->NSS }}</span>
								</label>
							</div>
						</div>
					</div>
					</div>
				</div>
			@endif
	</div>
</div><div class="space-12"></div><!-- /.row -->