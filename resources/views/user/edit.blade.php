@extends('app')
@section('page-script')
<script>
function check(input) {
  $('#newPassword, #password_confirm').on('keyup', function () {
  	if ($('#newPassword').val() == $('#password_confirm').val()) {
    	$('#message').html('correspond').css('color', 'green');
    	$('#passwordResetbtn').removeAttr("disabled"); 
  	} else {
    		$('#message').html('ne correspond pas').css('color', 'red');
    		$('#passwordResetbtn').prop('disabled', true);; 
  	}
});
}
$(function(){
	$('#passwordResetbtn').click(function(e){
		var formData = {
				id:'{{$user->id}}',
				password: $("#newPassword").val()
		};
		$.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
		$.ajax({
    	type: "POST",
 			url: "{{ url('admin/password/reset')}}",
    	data:formData,
    	success:function(data,status, xhr){
   	  }
		});
	});
});
</script>
@endsection
@section('main-content')
<div class="page-header"><h4>Modification de : {{ $user->name }}</h4></div>
<div class="row">
	<div class="col-sm-9 col-xs-12">
		<div id="edit-info">
			<form class="form-horizontal" role="form" action="{{  route('employs.update', $user->employ->id) }}" method="POST">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<input type="hidden" name="id" value="{{ $user->employ->id }}">
        <h4 class="header lighter block blue">Informations adminstratives</h4>
				<div class="row">
					<div class="col-xs-6 col-sm-6">
						<div class="form-group {{ $errors->has('nom') ? "has-error" : "" }}">
							<label class="col-sm-3 control-label" for="nom">Nom :</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="nom" value="{{ $user->employ->nom }}"  required/>
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6">
						<div class="form-group {{ $errors->has('prenom') ? "has-error" : "" }}" >
							<label class="col-sm-3 control-label" for="prenom">Prénom :</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="prenom" value="{{ $user->employ->prenom }}" required/>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
						<div class="col-xs-6 col-sm-6">
						<div class="form-group {{ $errors->has('datenaissance') ? "has-error" : "" }}">
							<label class="col-sm-3 control-label" for="datenaissance">Né(e) le :</label>
							<div class="col-sm-9">
								<input class="form-control date-picker ltnow" type="text" name="datenaissance" value="{{ $user->employ->Date_Naiss }}"  data-date-format="yyyy-mm-dd" autocomplete="off" required/>
								{!! $errors->first('datenaissance', '<small class="alert-danger">:message</small>') !!}
							</div>	
						</div>
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="form-group {{ $errors->has('lieunaissance') ? "has-error" : "" }}">
							<label class="col-sm-3 control-label" for="lieunaissance">Né(e) à :</label>
							<div class="col-sm-9">
									<input class="form-control autoCommune" type="text" id="lieunaissance" name="lieunaissance" value="{{ $user->employ->Lieu_Naissance }}"  required/>
							</div>	
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<div class="col-sm-3 ml-auto align-top">
							<label class="control-label pull-right mt-0">Genre :</label>
						</div>
						<div class="col-sm-9">
								<label class="inline">
								<input name="sexe" value="M" type="radio" class="ace" {{ $user->employ->sexe == "M" ? "checked" : "" }}/>
								<span class="lbl middle"> Masculin</span>
								</label>&nbsp; &nbsp;
								<label class="inline">
								<input name="sexe" value="F" type="radio" class="ace" {{ $user->employ->sexe == "F" ? "checked" : "" }}/>
								<span class="lbl middle"> Féminin</span>
								</label>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6">
						<div class="form-group {{ $errors->has('nss') ? "has-error" : "" }}">
						<label class="col-sm-3 control-label" for="nss">NSS :</label>
						<div class="col-sm-9"><input type="text" class="form-control nssform" name="nss" value="{{ $user->employ->NSS }}" ></div>
						</div>
					</div>
				</div>
			  <h4 class="header lighter block blue">Contact</h4>
				<div class="row">
					<div class="col-xs-12 col-sm-6">
						<div class="form-group {{ $errors->has('adresse') ? "has-error" : "" }}">
							<label class="col-sm-3 control-label" for="adresse">Adresse :</label>
							<div class="col-sm-9">
								<input class="form-control " type="text" name="adresse" value="{{ $user->employ->Adresse }}" />
							</div>	
						</div>	
					</div>
					<div class="col-xs-12 col-sm-3">
						<div class="form-group {{ $errors->has('mobile') ? "has-error" : "" }}">
							<label class="control-label col-sm-5" for="mobile">Tél mob :</label>
							<div class="input-group col-sm-7">
                <span class="input-group-addon"><i class="ace-icon fa fa-phone"></i></span>
							  <input type="tel" class="form-control mobile" name="mobile"  value="{{ $user->employ->tele_mobile }}"  required />
							</div>	
						</div>
					</div>
					<div class="col-xs-12 col-sm-3">
						<div class="form-group {{ $errors->has('fixe') ? "has-error" : "" }}">
							<label class="col-sm-5 control-label no-padding-right " for="fixe">Tél Fixe :</label>
							<div class="input-group col-sm-7">
								<span class="input-group-addon"><i class="ace-icon fa fa-phone"></i></span>
                <input type="tel" class="form-control telfixe" name="fixe" value="{{ $user->employ->Tele_fixe }}" >
							</div>		
						</div>
					</div>
				</div>
				<h4 class="header lighter block blue">Information de poste</h4>
				  <div class="row">
					<div class="col-xs-12 col-sm-4">
						<div class="form-group {{ $errors->has('mat') ? "has-error" : "" }}">
							<label class="col-sm-5 control-label" for="mat">Matricule :</label>
							<div class="col-sm-7">
							<input type="text" class="form-control"  name="mat" value="{{ $user->employ->Matricule_dgsn }}"  maxlength =5 minlength =5>
							</div>	
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="form-group {{ $errors->has('service') ? "has-error" : "" }}">
							<label class="col-sm-5 control-label" for="service">Service :</label>
							<div class="col-sm-7">
								<select class="form-control" name="service">
									<option value="" disabled>--Selectionner--</option>		
									@foreach($services as $key=>$value)
									<option value="{{ $key }}" {{ ($user->employ->service_id == $key)? 'Selected' :'' }}>{{ $value->nom }}</option>
									@endforeach
							</select>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4">
						<div class="form-group {{ $errors->has('specialite') ? "has-error" : "" }}">
							<label class="col-sm-5 control-label" for="specialite">Spécialité :</label>
							<div class="col-sm-7">
							<select class="form-control" name="specialite">
								<option value="" >Selectionner</option>
								@foreach($specialites as $key=>$value)
								<option value="{{ $key }}" {{ ($user->employ->specialite == $key) ? 'Selected':'' }}>{{ $value->nom}}</option>	
								@endforeach
							</select>
							</div>
						</div>
					</div>	   
				</div>
				<div class="form-group col text-center">
					<button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-save"></i>Enregistrer</button>
				</div>
			</form>
		</div>
	</div><!-- col-sm-8 -->
	<div class="col-sm-3 col-xs-12 well well-sm">
		<div class="w-120 p-3 mb-2" ><h4 class="center">Informations d'authentification</h4></div>
		<form class="form-horizontal" action="{{route('users.update',$user->id)}}" method="POST">
			{{ csrf_field() }}
  		{{ method_field('PUT') }}
  		<div class="form-group">
				<label class="col-sm-4 control-label" for="username">Login	:</label>
				<div class="col-sm-8 input-group">
				  <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
				 	<input type="text" name="username" placeholder="Username" value="{{ $user->name }}" class="col-xs-11 col-sm-11" required/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label" for="email">Email :</label>
				<div class="col-sm-8 input-group">
			  	<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
			    <input type="email" name="email" value="{{ $user->email }}" class="col-xs-11 col-sm-11"/>
			    {!! $errors->first('email', '<small class="alert-danger">:message</small>') !!}
			  </div>
			</div>
			<div class="form-group">
			<label class="col-sm-4 control-label" for="role">Rôle :</label>
			<div class="col-sm-8 input-group">
				<div class="input-group-addon"><i class="menu-icon fa fa-tags"></i></div>
			  <select class="col-xs-11 col-sm-11" name="role" required>
					@foreach ($roles as $key=>$role)
					<option value="{{ $key }}"	 @if( $key == $user->role_id) selected @endif >{{ $role->role }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label" for="active">Compte :</label>
			<div class="col-sm-8 input-group">
				<input type="checkbox"  {{ ($user->active) ?'checked':'' }} Disabled>
				@if( $user->active)
				<span class="label label-info arrowed">&nbsp; Active</span>
				@else
				<span class="label label-danger arrowed">&nbsp; Desactivé</span>
				@endif
			</div>
		</div>
		<div class="form-group">
			@if( $user->active)
				<label class ="pull-right col-xs-11 col-sm-11">Désactiver ce Compte :
					<input type="checkbox" name="desactiveCompt" class="collapse" checked data-toggle="toggle" data-on="Non" data-off="Oui" data-size="mini" data-onstyle="primary" data-offstyle="danger"  value="0"> 
          <span class="lbl middle"></span>
        </label>
			@else
				<label class ="pull-right col-xs-11 col-sm-11"> Activer le Compte :
				<input type="checkbox" name="activeCompt" class="collapse" checked data-toggle="toggle" data-on="<i class='fa fa-play'></i> Oui" data-off="<i class='fa fa-pause'></i> Non" data-size="mini" data-onstyle="primary" data-offstyle="danger"  value="1">
				</label>
			@endif
		</div>
		<div class="row center">
			<div class=" col-xs-10 col-sm-10  col-sm-offset-1">
				<div class="form-group">
					@if(Auth::user()->is(4))
						<button id="btnResetPassword" class="btn btn-sm btn-primary btn-block" data-toggle="modal" data-target="#passwordReset" type="button"><i class="ace-icon fa fa-edit"></i>Changer le mot de passe </button>
					@endif
				</div>
			</div>
		</div>
		<div class="form-actions center">
			<button class="btn btn-sm btn-info" type="submit"><i class="ace-icon fa fa-save"></i>Enregistrer</button>&nbsp;
			<button class="btn  btn-sm btn-warning" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
		</div>
  </form>
	</div>	
</div><div class="row">@include('user.ModalFoms.changeUserPassword')
</div>
@endsection