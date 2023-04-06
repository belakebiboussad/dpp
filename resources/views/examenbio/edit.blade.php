@extends('app')
@section('page-script')
<script>
 $(function(){
    $('body').on('click', '.examBio-Delete', function (e) {  
      event.preventDefault();
      var exam_id = $(this).val(); 
      var formData = {
        _token: CSRF_TOKEN,
        exam_id    : $(this).val(),
        demande_id : '{{ $demande->id }}',
      };
      url='{{ route("exmbio.destroy",":slug") }}';
      url = url.replace(':slug',$(this).val());
      $.ajax({
        type: "DELETE",
        url : url,
        data: formData,
        success: function (data) {
          $("#exm-" + formData.exam_id).remove(); 
        }
      });
      
    });
   })
  </script>
@stop
@section('main-content')
<div class="row" width="100%">@include('patient._patientInfo',['patient'=>$demande->imageable->patient])</div>
<div class="content">
  <div class="page-header"><h1>Modifier la demande d'examen biologique</h1>
    <div class="pull-right">
      <a href="/dbToPDF/{{ $demande->id }}" title = "Imprimer"  target="_blank" class="btn btn-sm btn-primary pull-right"><i class="ace-icon fa fa-print"></i> Imprimer</a>
        <a href="{{ route('consultations.show',$demande->imageable_id)}}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i> precedant</a>
    </div>
  </div><div class="space-12"></div>
   <div class="row">
    <div class="col-sm-12">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th class="center">#</th><th class="center">Nom examen</th>
            <th class="center">Specialite</th><th class="center"><em class="fa fa-cog"></em></th>
          </tr>
        </thead>
        <tbody>
          @foreach($demande->examensbios as $index => $ex)
            <tr id="{{ 'exm-'.$ex->id }}">
              <td class="center">{{ $index + 1 }}</td><td>{{ $ex->nom }}</td>
              <td>{{ $ex->Specialite->nom }}</td>
              <td class="center">
                <button  data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger examBio-Delete" value="{{ $ex->id }}"> <i class="ace-icon fa fa-trash-o"></i></button> 
              </td>
            </tr>
          @endforeach                         
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-sm12">
      <div class="center" style="bottom:0px;">
      <form  method="POST" action="{{ route('demandeexb.update',$demande->id) }}" > 
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="id" value="{{ $demande->id }}" >
         <button class="btn btn-sm btn-primary" type="submit"><i class="ace-icon fa fa-save bigger-110"></i> Enregistrer</button>
      </form>
      </div>
    </div>
  </div>
</div>
@stop