@extends('app')
@section('title','Ajouter un Utilisateure')
@section('main-content')
<div class="container-fluid">
  <div class="page-title"><h1>Ajouter un nouveau utilisateur</h1></div>
  <div class="pull-right">
    <a href="{{route('users.index')}}" class="btn btn-white btn-info btn-bold">
      <i class="ace-icon fa fa-arrow-circle-left blue"></i> Rechercher</a>
  </div>
  <div class="row">
  <div class="col-sm-12">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
    </div>
    @endif

    <form  id="userAdd" action="{{ route('users.store') }}" method="POST">
      {{ csrf_field() }}
      <h4 class="header block blue">Informations adminstratives</h4>
      <div class="row">
      <div class="form-group col-sm-6 {{ $errors->has('nom') ? 'has-error' : '' }}">
      <label class="col-sm-3 control-label required" for="nom">Nom</label>
        <div class="col-sm-6">
          <input type="text" id="nom" name="nom" placeholder="Nom..." class="form-control"  value="{{ old('nom') }}" required/>{!! $errors->first('nom', '<small class="alert-danger">:message</small>')!!}
        </div>
      </div>
      <div class="form-group col-sm-6 {{ $errors->has('prenom') ? 'has-error' : '' }}">
        <label class="col-sm-3 control-label required" for="prenom">Prénom</label>
        <div class="col-sm-6">
          <input class="form-control" type="text"  name="prenom" placeholder="Prénom..." Autocomplete="off" value="{{ old('prenom') }}" required/>
        </div>
      </div>
      </div>
      <div class="row">
        <div class="form-group col-sm-6 {{ $errors->has('datenaissance') ? 'has-error' : '' }}">
          <label class="col-sm-3 control-label required" for="datenaissance">Né(e) le</label>
          <div class="col-sm-6">
            <input class="form-control date-picker ltnow" type="text" name="datenaissance" placeholder="Date Naissance..." data-date-format="yyyy-mm-dd" autocomplete ="off" required/>
          </div>
        </div>
        <div class="form-group col-sm-6 {{ $errors->has('lieunaissance') ? 'has-error' : '' }}">
            <label class="col-sm-3 control-label" for="lieunaissance">Né(e) à</label>
            <div class="col-sm-6">
              <input class="form-control autoCommune" type="text" id="lieunaissance" name="lieunaissance" placeholder="Lieu Naissance..." Autocomplete="off"/>
            </div>
          </div>
      </div>
      <div class="row">
        <div class="form-group col-sm-6 {{ $errors->has('sexe') ? 'has-error' : '' }}">
          <label class="col-sm-3 control-label" for="sexe">Genre</label>
          <div class="col-sm-6">
            <div class="radio">
              <label><input name="sexe" value="M" type="radio" class="form-control ace" checked /><span class="lbl"> Masculin</span></label>
              <label><input name="sexe" value="F" type="radio" class="form-control ace" /><span class="lbl"> Féminin</span></label>
            </div>
          </div>  
        </div>
        <div class="form-group col-sm-6 {{ $errors->has('nss') ? 'has-error' : '' }}">
          <label class="control-label col-sm-3 col-xs-3 required" for="nss">NSS</label>{{-- pattern="^\[0-9]{2}+' '+\[0-9]{4}+' '+\[0-9]{4}+' '+\[0-9]{2} $" --}}
          <div class="col-sm-6">
            <input type="text" class="form-control nssform"  name="nss"  placeholder="XXXXXXXXXXXX" required>
          </div>
        </div>
      </div>
      <h4 class="header block blue">Contact</h4>
      <div class="row">
        <div class="form-group col-sm-6">
          <label class="control-label col-sm-3 col-xs-3" for="adresse">Adresse</label>
          <div class="input-group col-sm-6 {{ $errors->has('adresse') ? 'has-error' : '' }}">
            <span class="input-group-addon fa fa-home"></span>
          <input type="text" name="adresse" placeholder="Adresse..." class="form-control"/>
          </div>
        </div>
        <div class="form-group col-sm-6 {{ $errors->has('email') ? 'has-error' : '' }}">
          <label for="mail" class="control-label col-sm-3">E-Mail</label>
          <div class="input-group col-sm-6">
            <span class="input-group-addon fa fa-at"></span>
            <input class="form-control" type="email" name="email" placeholder="Email" value="{{ old('email') }}" aria-describedby="email-addon">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-sm-6 {{ $errors->has('fixe') ? 'has-error' : '' }}">
          <label class="control-label col-sm-3" for="fixe">Fixe</label>
          <div class="input-group col-sm-6">
            <span class="input-group-addon fa fa-phone"></span>
            <input type="tel" class="form-control telfixe" name="fixe">
          </div>
        </div>
        <div class="form-group col-sm-6 {{ $errors->has('mobile') ? 'has-error' : ''}}">
          <label class="control-label col-sm-3 required" for="mobile">Mob</label>
          <div class="input-group col-sm-6">
            <span class="input-group-addon fa fa-phone"></span>
            <input type="tel" name="mobile" class ="form-control mobile" value="{{ old('mobile') }}" required/>
          </div>
        </div>
      </div><h4 class="header block blue">Fonction</h4>
      <div class="row">
        <div class="form-group col-sm-3 {{ $errors->has('matricule') ? 'has-error' : '' }}">
          <label class="col-sm-3 control-label" for="matricule">Matricule</label>
          <div class="col-sm-9">
          <input type="text" class="form-control" name="matricule" placeholder="Matricule..." value="{{ old('matricule') }}" maxlength =5 minlength =5>
          </div>  
        </div>
          <div class="form-group col-sm-3 {{ $errors->has('role') ? 'has-error' : '' }}">
          <label for="role" class="control-label col-sm-3 required">Rôle</label>
          <div class="col-sm-9">
          <select id="role" name="role" class="form-control" required>
            <option value="" selected disabled>Sélectionner...</option>
            @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->nom }}</option>
            @endforeach
          </select>
          </div>
        </div>
        <div class="form-group col-sm-3 hidden" id="specialite">
          <label for="specialite" class="control-label col-sm-3">Spécialité</label>
          <div class="col-sm-9">
            <select name="specialite" class="form-control">
                <option  value="" selected disabled>Sélectionner...</option>
                @foreach($specialites as $specialite)
                <option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
                @endforeach
              </select>
          </div> 
        </div>
        <div class="form-group col-sm-3 {{ $errors->has('service') ? has-error : '' }}">
          <label class="col-sm-3 control-label required" for="service">Service</label>
          <div class="col-sm-9">
            <select class="form-control" name="service" required>
              <option value="" selected disabled>--Selectionner--</option>   
              @foreach($services as $service)
              <option value="{{ $service->id }}">{{ $service->nom }}</option>
              @endforeach
            </select>
        </div>
        </div>
      </div>
      <h4 class="header block blue">Informations de compte</h4>
      <div class="row">
        <div class="form-group col-sm-4 {{ $errors->has('username') ? 'has-error' : '' }}">
          <label class="control-label col-xs-3 required" for="username">Login</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="username" placeholder="Nom utilisateur..." readonly onfocus="this.removeAttribute('readonly');" autocomplete="off" value="{{ old('username') }}" required>
        </div>
        </div>
        <div class="form-group col-sm-4 {{ $errors->has('password') ? 'has-error' : '' }}">
          <label for="password" class="control-label col-sm-3 required">Password</label>
          <div class="col-sm-6">
            <input type="password" autocomplete="off" class="form-control" name="password" placeholder="Mot de passe..."  autocomplete="off" required>
          </div>
        </div>
      </div><hr/>
      <div class="row form-group col-md-6 col-md-offset-5">
      <button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-save"></i>Enregistrer</button>
      <a href="{{ route('home') }}" class="btn btn-sm btn-warning text-decoration-none"><i class="ace-icon fa fa-undo"></i>Annuler</a>
    </div>
    </form>
  </div>
</div>  
</div>
@stop