@extends('app')
@section('title',"Modifier Demande d'hospitalisation")
@section('main-content')
<div > @include('patient._patientInfo',['patient'=>$demande->consultation->patient])</div><br>
<div class="page-header"> <h1 >Modification de la demande d'hospitalisation</h1>
  <div class="pull-right">
    <a href="{{route('demandehosp.index')}}" class="btn btn-white btn-info btn-bold">
      <i class="ace-icon fa fa-arrow-circle-left blue"></i>Liste des demandes d'hospitalisation
    </a>
  </div>
</div>
<div class="row">
  <div class="col-sm-12"> <h3 class="header  lighter blue">Informations concernant la consultation</h3> </div>  
</div>
<div class="row">
  <div class="col-sm-12">
    <div class="widget-box">
      <div class="widget-header"><h4 class="widget-title">Consultation</h4></div>
      <div class="widget-body">
        <div class="widget-main">
          <div class="row">
            <div class="col-sm-4 col-xs-4 float-right ">
              <label class="col-sm-2 col-xs-2 control-label no-padding-right text-right">Lieu:</label>
              <div class="col-sm-10 col-xs-10">
                <input type="text" value= "{{ $demande->consultation->lieu->nom }}" class="col-xs-12 col-sm-12" disabled/>
              </div>
            </div>
            <div class="col-sm-4 col-xs-4">
              <label class="col-sm-2 col-xs-2 control-label no-padding-right text-right">Date:</label>
              <div class="col-sm-10 col-xs-10">
                <input type="text" value="{{ $demande->consultation->date }}" class="col-xs-12 col-sm-12" disabled/>
              </div>
            </div>
            <div class="col-sm-4 col-xs-4">
              <label class="col-sm-2 col-xs-2 control-label no-padding-right text-right">Médecin:</label>
              <div class="col-sm-10 col-xs-10">
                <input type="text" value="{{ $demande->consultation->medecin->full_name }}" class="col-xs-12 col-sm-12" disabled/>
              </div>
            </div>
          </div><div class="space-12"></div>
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <label class="col-sm-1 col-xs-1 control-label no-padding-right text-right">Motif:</label>
              <div class="col-sm-11 col-xs-11">
                <textarea class="col-xs-12 col-sm-12" disabled>{{ $demande->consultation->motif }}</textarea>
              </div>
            </div>
          </div>
          <div class="space-12"></div>
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <label class = "col-sm-1 col-xs-1 control-label no-padding-right text-right" for="resume">Résumé:</label>
              <div class="col-sm-11 col-xs-11">
              <textarea class="col-xs-12 col-sm-12" disabled>{{ $demande->consultation->Resume_OBS }}</textarea>
             </div>
            </div>
          </div>
        <div class="row"><div class="col-sm-12"><h3 class="header  lighter blue">Demande d'hospitalisation </h3></div></div>
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
                    <label class="col-sm-4 control-label  text-right" for="modeAdmission">Mode d'admission : </label>
                      <div class="col-sm-8">
                               <select class="form-control" name="modeAdmission" class=" col-sm-12">
                                @foreach(App\modeles\DemandeHospitalisation::MODESADMISSION  as  $key=>$value)
                                  <option value="{{ $key}}" {{ ($demande->modeAdmission == $value) ? 'selected':'' }} >{{ $value }}</option>
                                @endforeach
                              </select> 
                      </div>
              </div>
              <div class="form-group col-sm-6">
                <label class="col-sm-4 control-label text-right" for="specialiteDemande">Specialite :</label>
                    <div class="col-sm-8">    
                          <select class="form-control" name="specialite" class="col-sm-12">
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
                          <select class="form-control" name="service" class="col-sm-12">
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
                          <input type="text" name="etat" value="{{ $demande->etat }}" class="col-sm-12" disabled />
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- widget-body -->
              </div>
            </div>
          </div><!-- row -->
          <div class="row center mb-0">
            <button class="btn btn-info btn-xs" type="submit"> <i class="ace-icon fa fa-save"></i>Enregistrer</button>&nbsp; &nbsp; 
            <button class="btn btn-warning btn-xs" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
          </div>
          </form>
        </div>
      </div><!-- widget-body -->
    </div><!-- widget-box -->
  </div>
</div>
@endsection