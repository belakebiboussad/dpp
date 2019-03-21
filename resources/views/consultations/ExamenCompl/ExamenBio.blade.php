@extends('app_med')
@section('page-script')
<script src="{{asset('/js/jquery.min.js')}}"></script>
<script>
</script>
@endsection
@section('main-content')
<div class="page-header" width="100%">
   <div class="row">
    <div class="col-sm-12">
      <div class="widget-box">
        <div class="widget-body">
          <div class="widget-main">
            <label class="inline">
            <span class="blue"><strong>Nom :</strong></span>
            <span class="lbl"> {{ $consultation->patient->Nom }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Prénom :</strong></span>
            <span class="lbl"> {{ $consultation->patient->Prenom }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Sexe :</strong></span>
            <span class="lbl"> {{ $consultation->patient->Sexe == "M" ? "Masculin" : "Féminin" }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Date Naissance :</strong></span>
            <span class="lbl"> {{ $consultation->patient->Dat_Naissance }}</span>
          </label>
          &nbsp;&nbsp;&nbsp;
          <label class="inline">
            <span class="blue"><strong>Age :</strong></span>
            <span class="lbl"> {{ Jenssegers\Date\Date::parse($consultation->patient->Dat_Naissance)->age }} ans</span>
          </label>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="content">
  <div class="row">
    <div class="col-sm-12">
       <div class="col-sm-12 widget-container-col">
          @foreach($specialites as $specialite)
          <div class="widget-box transparent" id="widget-box-12">
            <div class="widget-header">
              <h4 class="widget-title lighter"> 
                {{ $specialite->specialite }}
              </h4>
            </div>
            <div class="widget-body">
              <div class="widget-main padding-6 no-padding-left no-padding-right">
                <div class="space-6"></div>
                  <div class="row">
                    <form method="POST" action="{{ route('demandeexb.store') }}">
                      {{ csrf_field() }}
                      <input name="id_consultation" value="{{ $consultation->id }}" hidden>
                      @foreach($specialite->examensbio as $exbio)
                      <div class="col-xs-3">
                        <div class="checkbox">
                          <label>
                            <input name="exm[]" type="checkbox" class="ace" value="{{ $exbio->id }}" />
                            <span class="lbl"> 
                              {{ $exbio->nom_examen }}
                            </span>
                          </label>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
              <div class="clearfix form-actions">
                <div class="col-md-offset-5 col-md-7">
                  <button type="submit" class="btn btn-info">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Enregistrer
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection