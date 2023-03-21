@extends('app')
@section('page-script')
@include('examenradio.scripts.imgRequestdJS')
<script>
  $(function(){
    $('body').on('click', '.exam-Delete', function (e) {  
      event.preventDefault();
      var exam_id = $(this).val(); 
      url='{{ route("examRad.destroy",":slug") }}';
      url = url.replace(':slug',exam_id);
      $.ajax({
        type: "GET",
        url : url,
          dataType: 'json',
          data: { _token: CSRF_TOKEN } ,
          success: function (data) {
            $("#exm-" + data.id).remove(); 
          } 
      });
    });
    $("#requestImgEdit").submit(function(e){
      var arrayLignes = document.getElementById("ExamsImg").rows;
      addExamsImg(this);
      $("#requestImgEdit").submit();
    });
 })
  </script>
@endsection
@section('main-content')
<div class="container-fluid">
  <div class="page-header">@include('patient._patientInfo',['patient'=>$demande->imageable->patient])</div>
  <div class="row">
    <div class="col-sm-6"><h3>Modifier la demande d'examen Radiologique</h3></div>
    <div class="col-sm-6 pull-right">
      <a href="/drToPDF/{{ $demande->imageable->demandExmImg->id }}" target="_blank" class="btn btn-sm btn-primary pull-right"><i class="ace-icon fa fa-print"></i> Imprimer</a>
      <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning pull-right"><i class="ace-icon fa fa-backward"></i> precedant</a>
    </div>
  </div><hr>
  <div class="row">
    <div class="col-xs-12 widget-container-col">
    <form id="requestImgEdit" method="POST" action="{{ route('demandeexr.update',$demande->id) }}" >   {{ csrf_field() }} {{ method_field('PUT') }}
      <input type="hidden" name="demande_id" value="{{ $demande->id }}" >
      <div class="form-group">
        <label for="infosc">Informations cliniques pertinentes</label>
        <textarea class="form-control" id="infosc" name="infosc">{{ $demande->InfosCliniques}}</textarea>
        {!! $errors->first('infosc', '<small class="alert-danger"><b>:message</b></small>')!!}
      </div>  
      <div class="form-group">
        <label for="explication">Explication de la demande de diagnostic</label>
        <textarea class="form-control" id="explication" name="explication" >{{ $demande->Explecations}}</textarea>
       {!! $errors->first('explication', '<small class="alert-danger"><b>:message</b></small>')!!}
      </div>
      <div class="form-group">  
        <label for="infos">Informations supplémentaires pertinentes</label><br>
        @foreach($infossupp as $info)
        <div class="checkbox col-sm-2 col-xs-6 ">
          <label><input name="infos[]" type="checkbox" class="ace" value="{{ $info->id }}" {{ in_array($info->id, $demande->infossuppdemande->pluck('id')->toArray()) ? 'checked' : ''}}
              /><span class="lbl">{{ $info->nom }}</span></label>
        </div>
        @endforeach
      </div><div class="space-12"></div>
      <div class="row">
       <div class= "widget-box widget-color-blue col-xs-12">
       <div class="widget-header" >
        <h5 class="widget-title bigger lighter"><i class="ace-icon fa fa-table"></i>Examens Imagerie</h5>
        <div class="widget-toolbar widget-toolbar-light no-border" width="5%">
          <a href="#" class="align-middle" data-toggle="modal" data-target="#ExamIgtModal">
            <i class="fa fa-plus-circle bigger-180" data-toggle="modal"></i>
          </a>
        </div>
      </div>
      <div class="widget-body">
        <div class="widget-main no-padding">
          <table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="ExamsImgtab">
            <thead class="thin-border-bottom">
             <tr>
                <th class ="hidden"></th><th class ="center" class="nsort">Examen du</th>
                <th class ="hidden"></th><th class ="center">Type d'examen</th>
                <th class="center" width="5%"><em class="fa fa-cog"></em></th>
              </tr>
            </thead>
              <tbody id="ExamsImg">
                @foreach ($demande->examensradios as $index => $ex)
                  <tr id="{{ 'exm-'.$ex->id }}">
                    <td id="idExamen" hidden>{{ $ex->Examen->id }}</td>
                    <td>{{ $ex->Examen->nom }}</td>
                    <td hidden id="types">{{ $ex->Type->id }}</td>  
                    <td>{{ $ex->Type->nom }}</td>
                    <td class="center">
                     <button  data-method="DELETE" data-confirm="Etes Vous Sur ?" class="btn btn-xs btn-danger exam-Delete" value="{{ $ex->id }}"><i class="ace-icon fa fa-trash-o"></i></button> 
                   </td>
                </tr>
                @endforeach   
              </tbody>
          </table>
        </div>
      </div>
          </div>
               </div>
      </div>  <!-- widget-main -->
      <div class="row">
        <div class="col-sm12">
          <div class="center" style="bottom:0px;">
            <button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i> Enregistrer</button>
         </div>
          </div>
        </div>
        </form>
  </div>  <!-- widget-container-col -->
</div><!-- row -->
<div class="row"><div class="col-xs-12">@include('ExamenCompl.ModalFoms.ExamenImgModal')</div></div>
</div>
@endsection