@extends('app')
@section('page-script')
	<script type="text/javascript" src="{{asset('/js/jquery-2.1.4.min.js')}}"></script>
	<script type="text/javascript">

	    $('#user-profile-3').ready(function(){      
	    });
	</script>
@endsection
@section('main-content')
	<div class="page-header" @if($user->profile_banner_url != '') style="background-image: url('{{ route('profile/banner', ['profile_banner_url' => $user->profile_banner_url]) }}');" @endif>
		<h1>Mon Profil</h1>
	</div>
	@if($user->profile_image_url != '')
  		<img class="img-thumbnail img-responsive center-block" width="180" src="{{ route('profile/image', ['profile_image_url' => $user->profile_image_url]) }}">
	@endif
	<div class="tabbable borderless" style ="border-style:none;">
		<ul class="nav nav-pills nav-justified" id="tabMenu">
		          <li  role= "presentation" class="col-md-4 active">
		         		<a data-toggle="tab" href="#edit-basic" aria-controls="edit-basic" data-toggle="tab" class="btn btn-info" >
		             		<i class="ace-icon fa fa-pencil-square-o bigger-160 red" ></i>
		             		&nbsp;<span class="bigger-160">Informations Géneral</span>
		            	</a>
		           </li>
		          <li  role= "presentation" class="col-md-4">
		           	<a  role= "presentation" data-toggle="tab" href="#edit-password"  aria-controls="edit-password" data-toggle="tab" class="btn btn-danger" >
		              		<i class="blue ace-icon fa fa-key bigger-160"></i>
		              		&nbsp;<span class="bigger-160">Modifier Mot de Passe</span>
		          		</a>
		          </li>
		</ul>
		<div class="tab-content" style ="border-style:none;">
			 <div role="tabpanel" class = "tab-pane active" id="edit-basic">
		  	 	<div class="w3-teal">
                     				<h4 class="header blue bolder smaller">Géneral</h4>
                			</div> 
				<div class="form-group">
                           			<label class="col-md-4 control-label">  <strong>Nom :</strong></label>
			                     <div class="col-md-6">
			                               <label class="blue">{{ $employe->Nom_Employe }} </label>
			                     </div>
                    			</div>
                    			<div class="space-12"></div>
                    			<div class="space-12"></div>
                    			<div class="form-group">
                           			<label class="col-md-4 control-label">  <strong>Prénom :</strong></label>
			                     <div class="col-md-6">
			                             <label class="blue">{{ $employe->Prenom_Employe }} </label>
			                     </div>
                    			</div>
                    			<div class="space-12"></div>
                    			<div class="space-12"></div>
                    			<div class="form-group">
                           			<label class="col-md-4 control-label">  <strong>Date de Naissance :</strong></label>
			                     <div class="col-md-6">
			                               <label class="blue">{{ $employe->Date_Naiss_Employe }} </label>
			                     </div>
                    			</div>
                    			<div class="space-12"></div>
                    			<div class="space-12"></div>
				<div class="form-group">
					<label class="col-md-4 control-label">  <strong>Sexe :</strong></label>
					<div class="col-md-6">
                  					<label class="blue">{{ $employe->Sexe_Employe == "M" ? "Homme" : "Femme" }} </label>
					</div>

				</div>
				<div class="space-12"></div>
                    			<div class="space-12"></div>
                    			@if( $employe->Service_Employe  != null)
				<div class="form-group">
					<label class="col-md-4 control-label">  <strong>Service :</strong></label>
					<div class="col-md-6">
                  					 <label class="blue">{{App\modeles\Service::where('id',$employe->Service_Employe )->get()->first()->nom }}</label>
					</div>
				</div>
			
				<div class="space-12"></div>
                    			<div class="space-12"></div>
				<div class="form-group">
					<label class="col-md-4 control-label">  <strong>Spécialité :</strong></label>
					<div class="col-md-6">
                  					 <label class="blue">{{ $employe->Specialite_Emploiye }} </label>
					</div>

				</div>
				<div class="space-12"></div>
                    			<div class="space-12"></div>
				@endif
				
				<div class="form-group">
					<label class="col-md-4 control-label">  <strong>Matricule :</strong></label>
					<div class="col-md-6">
                  				<label class="blue">{{ $employe->Matricule_dgsn }} </label>
					</div>
				</div>
				<div class="space-12"></div>
                    			<div class="space-12"></div>
				<div class="form-group">
					<label class="col-md-4 control-label">  <strong>Username :</strong></label>
					<div class="col-md-6">
                  					<label class="blue">{{ $user->name }} </label>
					</div>
				</div>
				<div class="space-12"></div>
                    			<div class="space-12"></div>
				<div class="form-group">
					<label class="col-md-4 control-label">  <strong>Role :</strong></label>
					<div class="col-md-6">
                  		<label class="blue"> {{ App\modeles\rol::where("id", $user->role_id)->get()->first()->role }} </label> 
					</div>
				</div>
				<hr style="width: 100%; color: blue; height: 1px; background-color:black;" />
				<h4 class="header blue bolder smaller">Contact</h4>
				<div class="form-group">
					<i class="ace-icon fa fa-mobile bigger-110"></i>
					<label class="col-md-4 control-label">  <strong>Télé mobile :</strong></label>
					<div class="col-md-6">
	                  			 	<label class="blue">{{ $employe->tele_mobile }} </label>
					</div>
				</div>
				<div class="space-12"></div>
                    			<div class="space-12"></div>
				<div class="form-group">
					
					<label class="col-md-4 control-label">  <strong>Télé fixe :</strong></label>
					<div class="col-md-6">
	                  				 <label class="blue">{{ $employe->Tele_fixe }}</label>
					</div>
				</div>
				<div class="space-12"></div>
                    			<div class="space-12"></div>
				<div class="form-group">
					<i class="fa fa-map-marker light-orange bigger-110"></i>
					<label class="col-md-4 control-label"><strong>Adresse :</strong></label>
					<div class="col-md-6">
	                  			 	<label class="blue">{{ $employe->Adresse_Employe }} </label>
					</div>
				</div>
				<div class="space-12"></div>
                    			<div class="space-12"></div>
				<div class="form-group">
					<i class="ace-icon fa fa-envelope bigger-90"></i>
					<label class="col-md-4 control-label"><strong>E-mail :</strong></label>
					<div class="col-md-6">
	                  			  	<label class="blue">{{ $user->email }} </label>
					</div>
				</div>
				<hr style="width: 100%; color: blue; height: 1px; background-color:black;" />
				<h4 class="header blue bolder smaller">Social</h4>	
				<div class="space-12"></div>
                    			<div class="form-group">
					<label class="col-md-4 control-label"><strong>Numéro de sécurité social :</strong></label>
					<div class="col-md-6">
	                  			  	    <label class="blue">{{ $employe->NSS }} </label>
					</div>
				</div>
			 </div> {{-- edit-basic --}}
			
			<div id ="edit-password" role="tabpanel" class = "tab-pane">
				@if (session('error'))
			                     <div class="alert alert-danger">
			                            {{ session('error') }}
			                     </div>
			           @endif
			           @if (session('success'))
		                        	<div class="alert alert-success">
		                                 	{{ session('success') }}
		                            	</div>
                       		 @endif
             			<form id="form-change-password" role="form" method="POST" action="{{  url('/users/changePassword')  }}"
                  onsubmit = "return checkForm(this);">
            
              {{ csrf_field() }}
              <input type="hidden" name="user_id" value="{{ $user->id }}">
              <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}"> </div>
                  
                     <div class="form-group">
                           <label class="col-md-4 control-label"><b>Mot de passe Actuel:</b></label>
                           <div class="col-md-6">
                                <input type="password"  class="form-control" id="curPassword" name="curPassword" placeholder="taper le mot de passe actuel" required/>
                                <small class="help-block"></small>
                          </div>
                     </div>
                      <div class="space-4"></div>
           
                   
                      <div class="form-group">
                           <label class="col-md-4 control-label"><b>Nouveau mot de passe:</b></label>
                           <div class="col-md-6">
                                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="taper un nouveau mot de passe" required />
                                <small class="help-block"></small>
                        </div>
                     </div>
                     <div class="space-12"></div>
           
      
               <div class="form-group">
                        <label class="col-md-4 control-label"><b>Confirmer nouveau mot de passe:</b></label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmer mot de passe" required />
                        </div>
                </div>
                <div class="space-12"></div> 
                <div class="form-group">
                <br>
                     <div class="col-md-6 col-md-offset-4">
                           <br>
                           <div class="center">
                                <button type="submit" class="btn btn-primary">
                                      <i class="ace-icon fa fa-save bigger-110"></i>
                                      Enregistrer
                                 </button>&nbsp; &nbsp; &nbsp;
                                  <button type="reset" class="btn btn-primary">
                                     <i class="ce-icon c fa fa-times-circle  bigger-110"></i>
                                      &nbsp;Annuler
                                  </button>
                                </div>
                     </div>
                </div>
            </form>
			</div>{{-- tabpanel --}}



		</div>	 {{-- tab-content  --}}
	</div>	{{-- tabbable --}}

	
@endsection


