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
    <form  id="userAdd" action="{{ url('/users/store') }}" method="POST">
      {{ csrf_field() }}
      <h4 class="header block blue">Informations adminstratives</h4>
      <div class="row">
      <div class="form-group col-sm-6 {{ $errors->has('nom') ? 'has-error' : '' }}">
      <label class="col-sm-3 control-label" for="nom">Nom<span class="red">*</span></label>
        <div class="col-sm-6">
          <input type="text" id="nom" name="nom" placeholder="Nom..." class="form-control"  value="{{ old('nom') }}" alpha/>
            {!! $errors->first('nom', '<small class="alert-danger">:message</small>') !!}
        </div>
      </div>
      <div class="form-group col-sm-6 {{ $errors->has('prenom') ? 'has-error' : '' }}">
        <label class="col-sm-3 control-label" for="prenom">Prénom</label>
        <div class="col-sm-6">
          <input class="form-control" type="text"  name="prenom" placeholder="Prénom..." Autocomplete="off" required/>
        </div>
      </div>
      </div>
      <div class="row">
        <div class="form-group col-sm-6 {{ $errors->has('datenaissance') ? 'has-error' : '' }}">
          <label class="col-sm-3 control-label" for="datenaissance">Né(e) le</label>
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
          <label class="control-label col-sm-3 col-xs-3" for="nss">NSS</label>{{-- pattern="^\[0-9]{2}+' '+\[0-9]{4}+' '+\[0-9]{4}+' '+\[0-9]{2} $" --}}
          <div class="col-sm-6">
            <input type="text" class="form-control nssform"  name="nss"  placeholder="XXXXXXXXXXXX">
          </div>
        </div>
      </div>
      <h4 class="header block blue">Contact</h4>
      <div class="row">
        <div class="form-group col-sm-6">
          <label class="control-label col-sm-3 col-xs-3" for="adresse">Adresse</label>
          <div class="col-sm-6">
            <input type="text" name="adresse" placeholder="Adresse..." class="form-control"/>
          </div>
        </div>
        <!-- <div class="form-group col-sm-6 {{ $errors->has('mail') ? 'has-error' : '' }}">
          <label for="mail" class="control-label col-sm-3 ">E-Mail</label>
          <div class="col-sm-6">
            <input type="email" class="form-control" name="mail" placeholder="E-Mail..." autocomplete="off">
          </div>
        </div> -->
        <div class="form-group col-sm-6 {{ $errors->has('mail') ? 'has-error' : '' }}">
          <label for="mail" class="control-label col-sm-3 ">E-Mail</label>
          <div class="input-group col-sm-6">
            <span class="input-group-addon fa fa-at" id="email-addon"></span>
            <input class="form-control" type="email" name="mail" required="required" placeholder="Email" value="{{ old('mail') }}" aria-describedby="email-addon">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-sm-6 {{ $errors->has('fixe') ? 'has-error' : '' }}">
          <label class="control-label col-sm-3" for="fixe">Fixe</label>
          <div class="input-group col-sm-6">
            <span class="input-group-addon"><i class="ace-icon fa fa-phone"></i></span>
            <input type="tel" class="form-control telfixe" name="fixe">
          </div>
        </div>
        <div class="form-group col-sm-6 {{ $errors->has('mobile') ? 'has-error' : '' }}">
          <label class="control-label col-sm-3" for="mobile">Mob</label>
          <div class="input-group col-sm-6">
            <span class="input-group-addon"><i class="ace-icon fa fa-phone"></i></span>
            <input type="tel" name="mobile" class ="form-control mobile" required/>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>  
</div>
@stop