<div id="homme_conf" class="tab-pane">
	<div class="row">
		<div class="col-xs-12 col-sm-3 center">
			<span class="profile-picture">
			<img class="editable img-responsive" alt="Alex's Avatar" id="avatar3" src="{{asset('/avatars/avatar-372-456324.png')}}" />
			</span>
			<div class="space space-4"></div>
			<a href="{{ route('patient.edit', $patient->id) }}" class="btn btn-sm btn-block btn-success">
				<i class="ace-icon fa fa-pencil bigger-120"></i><span class="bigger-110">Modifier Les Informations</span>
			</a>
		</div><!-- /.col -->
		<div class="col-xs-12 col-sm-9">
			<h4 class="blue">
				<span class="middle"> {{ $homme_c->nom }} {{ $homme_c->prénom }}</span>
				<span class="label label-purple arrowed-in-right"><i class="ace-icon fa fa-circle smaller-80 align-middle"></i>{{ $homme_c->mob }}</span>
			</h4>
			<div class="profile-user-info">
				<div class="profile-info-row">
					<div class="profile-info-name">Nom</div>
					<div class="profile-info-value"><span>{{ $homme_c->nom}}</span></div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name">Prénom</div>
					<div class="profile-info-value"><span>{{$homme_c->prénom }}</span></div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name">Sexe </div>
					<div class="profile-info-value"><span>{{ $patient->Sexe =="M" ? "Homme" : "Femme" }}</span>
					</div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name">Date Naissance </div>
					<div class="profile-info-value"><span>{{ $homme_c->date_naiss }}</span></div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name"> Age </div>
					<div class="profile-info-value"><span>{{ $homme_c->getAge() }} ans</span></div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name"> Lien de parenté </div>
					<div class="profile-info-value"><span>{{ $homme_c->lien_par }}</span></div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name"> Adresse </div>
					<div class="profile-info-value"><i class="fa fa-map-marker light-orange bigger-110"></i><span>{{ $homme_c->adresse }}</span></div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name"> Télé mobile  </div>
					<div class="profile-info-value"><span>{{ $homme_c->mob }}</span></div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name"> Type de la pièce </div>
					<div class="profile-info-value">
						<span>@if ($homme_c->type_piece=="CNI") Carte d'identité nationale
							@elseif ($homme_c->type_piece=="Permis") Permis de Conduire
							@else Passeport
							@endif
						</span>
					</div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name"> N° pièce </div>
					<div class="profile-info-value"><span>{{ $homme_c->num_piece }}</span></div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name">Délivré le </div>
					<div class="profile-info-value"><span>{{ $homme_c->date_deliv }}</span></div>
				</div>
				<div class="profile-info-row">
					<div class="profile-info-name"> Créer par </div>
					<div class="profile-info-value">
						<span>{{ App\modeles\employ::where("id",$homme_c->created_by)->get()->first()->Nom_Employe }}  {{ App\modeles\employ::where("id",$homme_c->created_by)->get()->first()->Prenom_Employe }}</span>
					</div>
				</div>
			</div>
		</div><!-- /.col -->
	</div><!-- /.row -->
	<div class="space-20"></div>
</div><!-- /#homme_conf -->
	