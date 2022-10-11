@extends('app')
@section('page-script')
<script>
 $(function(){
    $('body').on('click', '.examBio-Delete', function (e) {  
      event.preventDefault();
      var exam_id = $(this).val(); 
      var formData = {
        exam_id    : $(this).val(),
        demande_id : '{{ $demande->id }}',
      };
      $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') }
      });
      url='{{ route("exmbio.destroy",":slug") }}';
      url = url.replace(':slug',$(this).val());
      $.ajax({
        type: "DELETE",
        url : url,
        data: formData,
        success: function (data) {
          $("#exm-" + data.id_examenbio).remove(); 
        },
        error: function (data) {
          console.log('Error:', data); 
        } 
      });
      
    });
   })
  </script>
@endsection
@section('main-content')
<div class="row" width="100%">@include('patient._patientInfo',['patient'=>$demande->consultation->patient])</div>
<div class="content">
<div class="row"><h3>Modifier la demande d'examen biologique :</h3> </div>
  <div class="row">
    <div class="col-sm-3"></div> <div class="col-sm-3"></div> <div class="col-sm-3"></div>
    <div class="col-sm-3">
      <a href="/dbToPDF/{{ $demande->id }}" title = "Imprimer"  target="_blank" class="btn btn-sm btn-primary pull-right">
        <i class="ace-icon fa fa-print"></i>&nbsp;Imprimer
      </a>&nbsp; &nbsp;
      <a href="{{ route('consultations.show',$demande->consultation)}}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i>&nbsp; precedant</a>
    </div>
  </div><div class="space-12"></div>
  <div class="row">
    <div class="col-sm-12">
      <div>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th class="center">#</th>
              <th class="center">Nom examen</th>
               <th class="center">Specialite</th>
              <th class="center"><em class="fa fa-cog"></em></th>
            </tr>
          </thead>
          <tbody>
              @foreach($demande->examensbios as $index => $ex)
                <tr id="{{ 'exm-'.$ex->id }}">
                  <td class="center">{{ $index + 1 }}</td>
                  <td>{{ $ex->nom }}</td>
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
  </div>
  <div class="row">
    <div class="col-sm12">
      <div class="center" style="bottom:0px;">
      <form class="form-horizontal" method="POST" action="{{ route('demandeexb.update',$demande->id) }}" > 
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="hidden" name="demande_id" value="{{ $demande->id }}" >
         <button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>&nbsp;Enregistrer</button>
      </form>
      </div>
    </div>
  </div>
</div>
@endsection