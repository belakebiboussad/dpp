@extends('app')
@section('title',"Modifier Demande d'hospitalisation")
@section('main-content')
<div > @include('patient._patientInfo',['patient'=>$demande->consultation->patient])</div>
<div class="page-header"><h4>Modification de la demande d'hospitalisation</h4>
  <div class="pull-right">
    <a href="{{route('demandehosp.index')}}" class="btn btn-white btn-info btn-bold">
      <i class="ace-icon fa fa-arrow-circle-left blue"></i>Liste des demandes d'hospitalisation
    </a>
  </div>
</div>
<h4 class="header lighter block blue">Informations concernant la consultation</h4>
<div class="row">
  <div class="col-sm-12">
    <div class="widget-box">
      <div class="widget-header"><h4 class="widget-title">Consultation</h4></div>
      <div class="widget-body">
        <div class="widget-main">
          <div class="row">
            <div class="col-sm-6 col-xs-6 float-right ">
              <label class="col-sm-3 col-xs-3 control-label no-padding-right text-right">Lieu:</label>
              <div class="col-sm-9 col-xs-9">
                <input type="text" value= "{{ $demande->consultation->lieu->nom }}" class="form-control" disabled/>
              </div>
            </div>
            <div class="col-sm-3 col-xs-3">
              <label class="col-sm-3 col-xs-3 control-label no-padding-right text-right">Date:</label>
              <div class="col-sm-9 col-xs-9">
                <input type="text" value="{{ $demande->consultation->date }}" class="form-control" disabled/>
              </div>
            </div>
            <div class="col-sm-3 col-xs-3">
              <label class="col-sm-3 col-xs-3 control-label no-padding-right text-right">Médecin:</label>
              <div class="col-sm-9 col-xs-9">
                <input type="text" value="{{ $demande->consultation->medecin->full_name }}" class="form-control" disabled/>
              </div>
            </div>
          </div><div class="space-12"></div>
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <label class="col-sm-1 col-xs-1 control-label no-padding-right text-right">Motif:</label>
              <div class="col-sm-11 col-xs-11">
                <textarea class="form-control" disabled>{{ $demande->consultation->motif }}</textarea>
              </div>
            </div>
          </div><div class="space-12"></div>
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <label class = "col-sm-1 col-xs-1 control-label no-padding-right text-right" for="resume">Résumé:</label>
              <div class="col-sm-11 col-xs-11">
              <textarea class="form-control" disabled>{{ $demande->consultation->Resume_OBS }}</textarea>
             </div>
            </div>
          </div>
      <h4 class="header lighter block blue">Demande d'hospitalisation</h4>
    <div class="row">
      <div class="col-sm-12">
        <div class="widget-box">
          <div class="widget-header"><h4 class="widget-title">Demande d'hospitalisation </h4></div>
          <div class="widget-body">
          <div class="widget-main">
          <form method="POST" action="{{ route('demandehosp.update',$demande->id) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="row">
            <div class="form-group col-sm-6">
              <label class="col-sm-4 control-label text-right" for="modeAdmission">Mode d'admission : </label>
              <div class="col-sm-8">
                <select class="form-control" name="modeAdmission" class="form-control">
                  @foreach($modesAdmission  as  $key=>$mode)
                  <option value="{{ $key}}" {{ ($demande->modeAdmission == $mode) ? 'selected':'' }} >{{ $mode }}</option>
                  @endforeach
                </select> 
              </div>
            </div>
            <div class="form-group col-sm-6">
              <label class="col-sm-4 control-label text-right" for="specialiteDemande">Specialite :</label>
              <div class="col-sm-8">    
                <select class="form-control" name="specialite" class="form-control">
                  @foreach($specialites as $specialite)
                  <option value="{{ $specialite->id}}" @if($demande->specialite == $specialite->id ) selected @endif>{{ $specialite->nom }}</option>
                  @endforeach 
                </select>
              </div>
            </div>
            </div>
            <div class="row">
              <div class="form_group col-sm-6">
                <label class="col-sm-4 control-label text-right" for="service">Service : </label>
                <div class="col-sm-8">
                  <select class="form-control" name="service" class="form-control">
                    <option value="" disabled>Sélectionner le service...</option>
                    @foreach($services as $service)
                    <option value="{{ $service->id }}" @if($demande->service == $service->id) selected @endif >{{ $service->nom }}</option>
                    @endforeach     
                  </select>
                </div>
              </div>
              <div class="form-group col-sm-6">
                <label class="col-sm-4 control-label text-right" for="etat">Etat :</label>
                <div class="col-sm-8">
                  <input type="text" name="etat" value="{{ $demande->etat }}" class="form-control" disabled />
                </div>
              </div>
                    </div>
                  </div>
                </div><!-- widget-body -->
              </div>
            </div>
          </div><!-- row -->
          <div class="row center mb-0">
            <button class="btn btn-info btn-xs" type="submit"> <i class="ace-icon fa fa-save"></i>Enregistrer</button>
            <button class="btn btn-warning btn-xs" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
          </div>
          </form>
        </div>
      </div><!-- widget-body -->
    </div><!-- widget-box -->
  </div>
</div>
@endsection