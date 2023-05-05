<div class="row">
	<div class="col-xs-3 col-sm-3 center">
		<span class="profile-picture">
			<img class="editable img-responsive" alt="Avatar" id="avatar2" src="{{asset('/avatars/profile-pic.jpg')}}" />
		</span><div class="space space-12"></div>
		<a href="{{ route('patient.edit', $patient->id) }}" class="btn btn-sm btn-block btn-success">
			<i class="ace-icon fa fa-pencil bigger-120"></i>
			<span class="bigger-110">Modifier</span>
		</a>
    @if(Auth::user()->isIn([2,15]))
		<a class="btn btn-sm btn-block btn-primary" data-toggle="modal" data-target="#ticket"><i class="ace-icon fa fa-print bigger-120"></i>
		<span class="bigger-110">Imprimer Ticket d'ordre</span>
		</a>
    @endif
    {{--@if(Auth::user()->is(15))
			<a class="btn btn-sm btn-block" href="{{ route('rdv.create', ["patient_id"=>$patient->id]) }}"><i class="ace-icon fa fa-plus bigger-120"></i>
	<span class="bigger-110"> Rendez-Vous</span></a>@endif  --}}
	</div><!-- /.col -->
	<div class="col-xs-9 col-sm-9">
		<h4 class="blue"><span class="middle">{{ $patient->getCivilite()}} {{ $patient->full_name }}</span>
			<span class="label label-purple arrowed-in-right">{{ $patient->Type->nom }}</span>
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
				@if(isset($patient->Dat_Naissance))
				<div class="profile-info-row">
					<div class="profile-info-name">né(e) le </div><div class="profile-info-value"><span>{{ $patient->Dat_Naissance->format('Y-m-d') }}</span></div>
				</div>
				<div class="profile-info-row"><div class="profile-info-name"> Âge </div>
					<div class="numberCircle">{{ $patient->age }}</div> <span class="blue">Ans</span>
				</div>
				@endif
				@if(isset($patient->Lieu_Naissance))
				<div class="profile-info-row">
					<div class="profile-info-name"> Lieu Naissance </div>
					<div class="profile-info-value">
						<i class="fa fa-map-marker light-orange bigger-110"></i><span>{{ $patient->lieuNaissance->nom_commune }}</span>
					</div>
				</div>
				@endif
				@if(isset($patient->sf))
				<div class="profile-info-row"><div class="profile-info-name"> Civilité </div>
					<div class="profile-info-value"><span>
						@switch($patient->sf)
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
				@endif
				@if(($patient->Sexe =="F") && ($patient->sf == "M") &&(isset($patient->nom_jeune_fille)))
				<div class="profile-info-row">
					<div class="profile-info-name"> Nom Jeune Fille </div>
					<div class="profile-info-value"><span>{{ $patient->nom_jeune_fille }}</span></div>
				</div>
				@endif
				@if(isset($patient->commune_res))
				<div class="profile-info-row">
					<div class="profile-info-name"> Adresse </div>
					<div class="profile-info-value">
						<i class="fa fa-map-marker light-orange bigger-110"></i>
						<span>{{ $patient->Adresse }} ,{{ $patient->commune->nom_commune}} , {{ $patient->wilaya->nom }}</span>
					</div>
				</div>
				@endif
				@if(isset($patient->tele_mobile1) &&($patient->tele_mobile1 != ''))
				<div class="profile-info-row">
					<div class="profile-info-name"><i class="fa fa-phone"></i>Tél mobile</div>
					<div class="profile-info-value"><span>{{ $patient->tele_mobile1 }}</span></div>
				</div>
				@endif
				@if(isset($patient->tele_mobile2) &&($patient->tele_mobile2 != ''))
				<div class="profile-info-row">
					<div class="profile-info-name"><i class="fa fa-phone"></i>Tél mobile 2</div>
					<div class="profile-info-value"><span>{{ $patient->tele_mobile2 }}</span></div>
				</div>
				@endif
				@if(isset($patient->group_sang))
				<div class="profile-info-row">
					<div class="profile-info-name"> Groupe Sang</div>
					<div class="profile-info-value"><span>{{ $patient->group_sang }}</span></div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name">Rhésus</div>
					<div class="profile-info-value"><span> {{ $patient->rhesus === "+" ? "Positif" : "Négatif" }}</span>
					</div>
				</div>
				@endif
				<div class="profile-info-row">
					<div class="profile-info-name">Date Création</div>
					<div class="profile-info-value">
          <span>{{ $patient->created_at->format('Y-m-d') }}</span></div>
				</div>
			</div><div class="hr hr-8 dotted"></div>
			@if(in_array( $patient->type_id , [2,3,4,5]) && (isset($patient->assure)))
			<div class="col-sm-12 widget-container-col" id="widget-container-col-12">
				<div class="widget-box transparent" id="widget-box-12">
					<div class="widget-header"><h5 class="widget-title lighter">Informations du fonctionnaire</h5></div>
					<div class="widget-body">
						<div class="widget-main padding-6 no-padding-left no-padding-right">
							<div class="row">
								<div class="col-sm-3">
								<label class="inline"><span>Nom :</span><span class="lbl blue"> {{ $patient->assure->Nom}}</span></label>
								</div>
								<div class="col-sm-3">
								<label class="inline"><span>Prénom :</span><span class="lbl blue"> {{ $patient->assure->Prenom}}</span></label>
								</div>
								<div class="col-sm-3">
								<label class="inline">
								<span>Né(e) le :</span><span class="lbl blue"> {{ $patient->assure->Date_Naissance }}</span></label>
								</div>
								@if(isset($patient->assure->lieunaissance))
								<div class="col-sm-3">
								<label class="inline"><span>Né(e) à :</span><span class="lbl blue">{{ $patient->assure->lieuNaissance->nom_commune}} </span></label>
								</div>	
								@endif
							</div>
							<div class="row">
								<div class="col-sm-3">
									<label class="inline">
										<span>Sexe :</span><span class="lbl blue"> {{ $patient->assure->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
									</label>
								</div>
                                                  <div class="col-sm-9">
                                                  <label class="inline">
                                                  <span>N° sécurité sociale :</span><span class="lbl blue">{{ $patient->Assurs_ID_Assure }}</span>
                                                </label>        
                                              </div>
							</div>
                                  </div>
					</div>
					</div>
				</div>
			@endif
	</div>
</div>