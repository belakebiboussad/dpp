@extends('app')
@section('title','Modifier  l\'utilisateur')
@section('page-script')
<script type="text/javascript">
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
      var formData = { _token: CSRF_TOKEN, id:'{{$user->id}}',
        password: $("#newPassword").val()
      };
      $.ajax({
        type: "POST",
        url: "{{ url('reset_password_')}}",
        data:formData,
        success:function(data,status, xhr){}
      });
    });
  });
</script>
@stop
@section('main-content')
<div class="page-header">
    <h1>Modification les données du l'utilisateur  <q class="blue">{{ $user->employ->full_name }} </q></h1>
    <div class="pull-right">
      <a href="{{route('users.index')}}" class="btn btn-white btn-info btn-bold">
        <i class="ace-icon fa fa-arrow-circle-left blue"></i> Rechercher</a>
    </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <form role="form" action="{{  route('employs.update', $user->employ->id) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      <input type="hidden" name="id" value="{{ $user->employ->id }}">
      <div class="form-group" id="error" aria-live="polite">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>
       <h4 class="header lighter block blue">Informations adminstratives</h4>
      <div class="row">
        <div class="form-group col-sm-6 {{ $errors->has('nom') ? 'has-error' : '' }}">
          <label class="col-sm-3 control-label no-padding-right" for="nom">Nom</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="nom" value="{{ $user->employ->nom }}"  required/>
          </div>
        </div>
        <div class="form-group col-sm-6 {{ $errors->has('prenom') ? 'has-error' : '' }}" >
          <label class="col-sm-3 control-label no-padding-right" for="prenom">Prénom</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="prenom" value="{{ $user->employ->prenom }}" required/>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-sm-6 {{ $errors->has('datenaissance') ? 'has-error' : '' }}">
          <label class="col-sm-3 control-label" for="datenaissance">Né(e) le</label>
          <div class="col-sm-6">
            <input class="form-control date-picker ltnow" type="text" name="datenaissance" value="{{ $user->employ->Date_Naiss }}"  data-date-format="yyyy-mm-dd" autocomplete="off" required/>
            {!! $errors->first('datenaissance', '<small class="alert-danger">:message</small>') !!}
          </div>  
        </div>
        <div class="form-group col-sm-6{{ $errors->has('lieunaissance') ? 'has-error' : '' }}">
            <label class="col-sm-3 control-label" for="lieunaissance">Né(e) à</label>
            <div class="col-sm-6">
                <input class="form-control autoCommune" type="text" id="lieunaissance" name="lieunaissance" value="{{ $user->employ->Lieu_Naissance }}"  required/>
            </div>  
        </div>
      </div>
      <div class="row">
        <div class="form-group col-sm-6">
          <label class="control-label col-sm-3">Genre</label>
          <div class="col-sm-6">
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
        <div class="form-group col-sm-6 {{ $errors->has('nss') ? 'has-error' : '' }}">
          <label class="col-sm-3 control-label" for="nss">NSS</label>
          <div class="col-sm-6"><input type="text" class="form-control nssform" name="nss" value="{{ $user->employ->NSS }}" ></div>
        </div>
      </div>
      <h4 class="header lighter block blue">Contact</h4>
      <div class="row">
        <div class="form-group col-sm-6 {{ $errors->has('adresse') ? 'has-error' : '' }}">
          <label class="col-sm-3 control-label" for="adresse">Adresse</label>
          <div class="col-sm-6">
            <input class="form-control " type="text" name="adresse" value="{{ $user->employ->Adresse }}" />
          </div>  
        </div>
        <div class="form-group col-sm-3{{ $errors->has('mobile') ? 'has-error' : '' }}">
          <label class="control-label col-sm-5" for="mobile">Mob</label>
          <div class="input-group col-sm-7">
            <span class="input-group-addon"><i class="ace-icon fa fa-phone"></i></span>
            <input type="tel" class="form-control mobile" name="mobile"  value="{{ $user->employ->tele_mobile }}"  required />
          </div>  
        </div>
        <div class="form-group col-sm-3 {{ $errors->has('fixe') ? 'has-error' : '' }}">
          <label class="col-sm-5 control-label no-padding-right " for="fixe">Fixe</label>
          <div class="input-group col-sm-7">
            <span class="input-group-addon"><i class="ace-icon fa fa-phone"></i></span>
            <input type="tel" class="form-control telfixe" name="fixe" value="{{ $user->employ->Tele_fixe }}" >
          </div>    
        </div>
      </div>
      <h4 class="header lighter block blue">Information de poste</h4>
      <div class="row">
        <div class="form-group col-sm-4 {{ $errors->has('matricule') ? 'has-error' : '' }}">
          <label class="col-sm-3 control-label" for="matricule">Matricule</label>
          <div class="col-sm-7 col-sm-offset-1">
          <input type="text" class="form-control"  name="matricule" value="{{ $user->employ->matricule }}"  maxlength =5 minlength =5>
          </div>  
        </div>
        <div class="form-group col-sm-4 {{ $errors->has('service') ? has-error : '' }}">
          <label class="col-sm-3 control-label" for="service">Service</label>
          <div class="col-sm-7">
            <select class="form-control" name="service">
              <option value="" disabled>--Selectionner--</option>   
              @foreach($services as $key=>$value)
              <option value="{{ $key }}" {{ ($user->employ->service_id == $key)? 'Selected' :'' }}>{{ $value->nom }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group col-sm-4 {{ $errors->has('specialite') ? 'has-error' : '' }}">
          <label class="col-sm-3 control-label" for="specialite">Spécialité :</label>
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
      <hr>
      <div class="form-group col-md-6 col-md-offset-5">
        <button type="submit" class="btn btn-sm btn-primary"><i class="ace-icon fa fa-save"></i>Enregistrer</button>
      </div>
    </form>
  </div>
</div>
@stop