@extends('app')
@section('main-content')
<div class="row" width="100%">@include('patient._patientInfo')</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4"><h3> Détails de la demande Radiologique</h3></div>
    <div class="col-sm-8 pull-right">
      <a href="/showdemandeexr/{{ $demande->consultation->examensradiologiques->id }}" target="_blank" class="btn btn-sm btn-primary pull-right">
       <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer
      </a>&nbsp;&nbsp;
      <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
    </div>
  </div><hr>
  <div class="space-12 hidden-xs"></div><div class="space-12 hidden-xs"></div>
	<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="form-group">
      <label class="col-sm-6 control-label no-padding-right"><b>Date :</b></label>
      <div class="col-sm-6"><label class="blue">
      @if(isset($demande->consultation))
          {{ $demande->consultation->Date_Consultation }}
        @else
          {{ $demande->visite->date }}
        @endif 
      </label></div>
    </div>
  </div>
  </div><div class="space-12 hidden-xs"></div>
	<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="form-group">
      <label class="col-sm-6 control-label no-padding-right"><b>Medecin demandeur :</b></label>
      <div class="col-sm-6"><label class="blue">
      @if(isset($demande->consultation))
      {{ $demande->consultation->docteur->nom }} &nbsp;{{ $demande->consultation->docteur->prenom }}
      @else
       {{ $demande->visite->medecin->nom }} &nbsp;{{ $demande->visite->medecin->prenom }}
      @endif
      </label></div>
    </div>
  </div>
</div>
<div class="space-12 hidden-xs"></div>
<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="form-group">
      <label class="col-sm-6 control-label no-padding-right"><b>Informations cliniques pertinentes :</b></label>
      <div class="col-sm-6"><label class="blue">   {{ $demande->InfosCliniques }}  </label></div>
    </div>
  </div>
</div>
<div class="space-12 hidden-xs"></div>
<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="form-group">
      <label class="col-sm-6 control-label no-padding-right"><b>Explication de la demande de diagnostic :</b></label>
      <div class="col-sm-6"><label class="blue"> {{ $demande->Explecations }} </label></div>
    </div>
  </div>
</div>
<div class="space-12 hidden-xs"></div>
<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="form-group">
      <label class="col-sm-6 control-label no-padding-right"><b>Explication de la demande de diagnostic :</b></label>
      <div class="col-sm-6"><label class="blue"> {{ $demande->Explecations }} </label></div>
    </div>
  </div>
</div>
<div class="space-12 hidden-xs"></div>
<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="form-group">
      <label class="col-sm-6 control-label no-padding-right"><b>Informations supplémentaires pertinentes :</b></label>
      <div class="col-sm-6"><label class="blue">
        <ul class="list-inline"> 
        @foreach($demande->infossuppdemande as $index => $info)
            <li class="active"><span class="badge badge-warning">{{ $info->nom }}</span></li>
         @endforeach
        </ul>    
        </label>
       </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-12 col-xs-12 widget-container-col">
    <div class="widget-box">
      <div class="widget-header"><h5 class="widget-title"><b>Demande d'examens radiologique</b></h5></div>
      <div class="widget-body">
        <div class="widget-main">
         <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th class="center" width="5%">#</th>
                <th class="center">Nom</th>
                <th class="center"><strong>Type</strong></th>
                <th class="center"><strong><em class="fa fa-cog"></em></strong></th>
              </tr>
            </thead>
            <tbody>
               @foreach ($demande->examensradios as $index => $examen)
                @if($examen->pivot->etat === null)
                <tr id = "{{ $examen->id }}">
                  <td class="center">{{ $index }}</td>
                  <td>{{ $examen->nom }}</td>
                  <td>
                    <?php $exams = explode (',',$examen->pivot->examsRelatif) ?>
                    @foreach($exams as $id)
                    <span class="badge badge-success">{{ App\modeles\exmnsrelatifdemande::FindOrFail($id)->nom}}</span>
                    @endforeach
                  </td>
                  <td class="center" width="15%">
                    <table width="100%" height="100%" class="table table-striped table-bordered">
                    @if($examen->pivot->etat == "1")
                      @foreach (json_decode($examen->pivot->resultat) as $k=>$f)
                      <tr>
                        <td width="70%">{{ $f }}</td>
                        <td width="30%">{{-- {{URL::to("/")}} --}}
                        <button type="submit" class="btn btn-info btn-xs open-modal" value="{{ $examen->pivot->id_examenradio."/".$f }}"><i class="ace-icon fa fa-eye-slash"></i></button>
                        <a href='/Patients/{{$patient->id}}/examsRadio/{{$demande->id}}/{{$examen->pivot->id_examenradio}}/{{ $f }}' class="btn btn-success btn-xs" target="_blank"> <i class="fa fa-download"></i></a>
                        </td>
                      </tr>
                      @endforeach
	                    @else
	                      <span class="badge badge-warning">En Cours</span>
	                    @endif
                    </table>
                  </td>
                </tr>
                @endif
                @endforeach
            </tbody>
          </table>
        </div>  
      </div>
    </div>
  </div> 
</div>    
</div>
@endsection