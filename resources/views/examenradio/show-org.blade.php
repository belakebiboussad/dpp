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
  <div class="row no-gutters">
    <div class="col-lg-6">
      <div class="row align-items-center justify-content-center">
        <div class="col"><h4><label><b>Etat:</b></label>&nbsp;&nbsp;&nbsp;&nbsp;<span>
          @if($demande->etat == "E")
             <span class="badge badge-warning">En Cours</span>
          @elseif($demande->etat =="V")
            <span class="badge badge-success">Validé</span>
          @elseif($demande->etat =="R")
            <span class="badge badge-danger">Rejeté</span>
          @endif
         </span>
           </h4>
         </div>
      </div>
      <div class="row align-items-center justify-content-center">
        <div class="col"><h4><label><b>Date Demande:</b></label>&nbsp;&nbsp;&nbsp;&nbsp;<span>
          @if(isset($demande->consultation))
            {{ $demande->consultation->Date_Consultation }}
          @else
            {{ $demande->visite->date }}
          @endif  
         </span></h4></div>
      </div>
      <div class="row align-items-center justify-content-center">
        <div class="col"> <h4><label><b>Informations cliniques pertinentes :</b></label>&nbsp;&nbsp;<span>{{ $demande->InfosCliniques }}</span></h4></div>
      </div>
      <div class="row align-items-center justify-content-center">
        <div class="col"><h4><label><b>Explication de la demande de diagnostic :</b></label>&nbsp;&nbsp;<span>{{ $demande->Explecations }}</span></div></h4>
      </div>
      <div class="row align-items-center justify-content-center">
          <div class="col">
            <h4>
              <label><b>Informations supplémentaires pertinentes :</b></label>
              <div>
                <ul class="list-inline"> 
                  @foreach($demande->infossuppdemande as $index => $info)
                  <li class="active"><span class="badge badge-warning">{{ $info->nom }}</span></li>
                  @endforeach
                </ul>
              </div>
            </h4>  
          </div>
      </div><div class="space-12 hidden-xs"></div>
      <div class="row align-items-center justify-content-center">
          <div class="col">
            <label><b>Examen(s) proposé(s) :</b></label>
            <div>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="center" width="5%">#</th>
                    <th class="center"><strong>Nom</strong></th>
                    <th class="center"><strong>Type</strong></th><!--  <th class="center"><strong>Resultats</strong></th> -->
                    <th class="center"><strong><em class="fa fa-cog"></em></strong></th>
                  </tr>
                </thead>
                <tbody>
                 @foreach ($demande->examensradios as $index => $examen)
                  <tr>
                    <td class="center" width="5%">{{ $index +1 }}</td>
                    <td>{{ $examen->nom }}</td>
                    <td >
                      <?php $exams = explode (',',$examen->pivot->examsRelatif) ?>
                      @foreach($exams as $id)
                      <span class="badge badge-success">{{ App\modeles\examsRelatif::FindOrFail($id)->nom}}</span>
                      @endforeach
                    </td>
                    <td class="center">
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
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>  
    <div class="col-lg-6 container"  id="dicom"  hidden="true">@include('DICOM.show')</div><!-- col-lg-6  -->
  </div>
</div>
@endsection
