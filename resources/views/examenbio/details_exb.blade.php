@extends('app_laboanalyses')
@section('page-script')
<script>
  $('document').ready(function(){
    $("button").click(function (event) {
         which = '';
         str ='send';
         which = $(this).attr("id");
         var which = $.trim(which);
         var str = $.trim(str);
         if(which==str){
          return true;
        }
    });
});
</script>
@endsection
@section('main-content')
<div class="page-header" width="100%">
   <?php $patient = $demande->consultation->patient; ?> 
    @include('patient._patientInfo')    
</div>
<div class="content">
  <div class="row">
    <div class="col-sm-12">
      <div>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th class="center">#</th>
              <th class="center">Nom Examen</th>
              <th class="center"><em class="fa fa-cog"></em></th>
            </tr>
          </thead>
          <tbody>
              @foreach($demande->examensbios as $index => $exm)
                <tr>
                  <td class="center">{{ $index + 1 }}</td>
                  <td>{{ $exm->nom_examen }}</td>
                  <td></td>
                </tr>
              @endforeach                         
          </tbody>
        </table>
      </div>
      <form class="form-horizontal" method="POST" action="/uploadresultat" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="text" name="id_demande" value="{{ $demande->id }}" hidden>
        <div class="form-group">
          <div class="col-xs-2">
            <label for="resultat">Attacher le Résultat </label>
          </div>
          <div class="col-xs-8">
         <input type="file" id="resultat" name="resultat" class="form-control" accept="image/*,.pdf" required/>
          </div>
        </div>
        <div class="clearfix form-actions">
          <div class="col-md-offset-5 col-md-7">
            <button class="btn btn-info" type="submit"> <!--  <i class="ace-icon fa fa-upload bigger-110"></i> -->
              <i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i>
              Démarrer l'envoie
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
