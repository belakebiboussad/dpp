@extends('app')
@section('main-content')
<div class="row" width="100%"><?php $patient = $demande->consultation->patient; ?>@include('patient._patientInfo')</div>
<div class="content">
<div class="row"><h3>Modifier la demande d'examens biologiques :</h3> </div>
  <div class="row">
    <div class="col-sm-3"></div> <div class="col-sm-3"></div> <div class="col-sm-3"></div>
    <div class="col-sm-3">
          <a href="/showdemandeexb/{{ $demande->id }}" title = "Imprimer"  target="_blank" class="btn btn-sm btn-primary pull-right">
            <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer
          </a>&nbsp; &nbsp;
          <a href="{{ route('consultations.show',$demande->consultation)}}" class="btn btn-sm btn-warning pull-right"> <i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
  </div>
  </div> <div class="space-12"></div>
   <div class="row">
        <div class="col-sm-12">
            <div>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                        <th class="center"><strong>#</strong></th>
                        <th class="center"><strong>Nom Examen</strong></th>
                       <th><a href="" class="btn btn-primary btn-xs pull-right " data-toggle="modal"><div class="fa fa-plus-circle"></div></a> </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($demande->examensbios as $index => $exm)
                      <tr>
                        <td class="center">{{ $index + 1 }}</td>
                        <td>{{ $exm->nom_examen }}</td>
                        <td class="center">
                           <?php $id =$exm->id.'|'.$demande->id ?>
                           <form method="POST" action="{{ route('exmbio.destroy', [ 'id'=>$id]) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn  btn-danger btn-xs"><i class="ace-icon fa fa-trash-o bigger-120"></i></button>
                          </form>
                        </td>
                      </tr>
                    @endforeach                         
                </tbody>
              </table>
            </div>
            @if($demande->etat == "V")
            <label>Résultat {{ $demande->etat}}:</label>&nbsp;&nbsp;
            <span><a href='/download/{{ $demande->resultat }}'>{{ $demande->resultat }} &nbsp;<i class="fa fa-download"></i></a></span>
            @endif
        </div>
  </div>
</div>
@endsection
