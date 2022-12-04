@extends('app')
@section('page-script')
<script>
$(function(){
  $('body').on('click', '.obsShow', function (e) {
    Swal.fire($(this).val());
  });
})
</script>
@endsection
@section('main-content')
<div class="page-header">@include('patient._patientInfo')</div> 
<div class="row">
    <div class="col-sm-5"><h4>Détails de la demande d'examens radiologiques</h4></div>
    <div class="col-sm-7 pull-right btn-toolbar"> 
      <a href="/drToPDF/{{ $demande->id }}" target="_blank" class="btn btn-sm btn-primary pull-right"> <i class="ace-icon fa fa-print"></i> Imprimer
      </a>
      @if((!$demande->hasResult()) && (( $obj->medecin->id == Auth::user()->employ->id)))
       <a href="{{ route('demandeexr.edit',$demande->id )}}" class="btn btn-sm btn-success pull-right"><i class="ace-icon fa fa-pencil"></i> Modifier</a>
       @endif
      <a href="{{ route('consultations.show',$obj->id)}}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>precedant</a>
    </div>
  </div><hr>
  <div class="row ">
    <div class="col-sm-7">
      @include('examenradio.partials._show')
      <div class="tabpanel">  
        <ul class = "nav nav-pills nav-justified list-group" role="tablist">
          <li class="active" role= "presentation">
            <a href="#exams" role="tab" data-toggle="tab"><i class="fa fa-image" aria-hidden="true"></i> Examens Radilogique
          </a></li>
          @if($demande->hasCCR())
          <li  role="presentation">
            <a href="#crr" role="tab" data-toggle="tab"><i class="fa fa-file" aria-hidden="true"></i> Compte rendu radiologique
            </a>
          </li>
          @endif
        </ul>
        <div class="tab-content no-border">
          <div class="tab-pane in active" id="exams">
            <div class="widget-box widget-color-blue">
              <div class="widget-header">
                <h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i>Examens radiologique demandés</h5>
              </div>
              <div class="widget-body"> 
                <div class="widget-main">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th class="center" width="5%">N°</th> <th class="center" width="30%">Nom</th>
                        <th class="center" width="7%">Type</th><th class="center" width="7%">Etat</th>
                        <th class="center" width="20%"><em class="fa fa-cog"></em></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($demande->examensradios as $index => $ex)
                      <tr id = "{{ $ex->id }}">
                        <td class="center" width="5%">{{ $index }}</td>
                        <td>{{ $ex->Examen->nom }}</td>
                        <td>{{ $ex->Type->nom }}</td>
                        <td>ssss</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div> 
          </div><!-- tab-pane -->
        </div><!-- tab-content -->
      </div>
    </div>
  </div>
@endsection