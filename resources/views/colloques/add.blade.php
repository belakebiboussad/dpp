@extends('app_dele')
@section('title','Ajouter Colloque')
@section('page-script')
<script type="text/javascript">
    var nowDate = new Date();
    var now = nowDate.getFullYear() + '-' + (nowDate.getMonth()+1) + '-' + ('0'+ nowDate.getDate()).slice(-2);
    $(document).ready(function() {
        window.prettyPrint && prettyPrint();
        $("#date").datepicker("setDate", now);  
        $('#liste_membre').multiselect();
        $('#reset').click(function(){
            $('#liste_membre_to').empty();       
        });
    });
    function myFunction()
    {
      if( $('#liste_membre_to').has('option').length > 0 ) {
        return true;
      }
      return false;
    }
</script>
@stop
@section('main-content')
<div class="row"><h4><strong>Ajouter un  nouveau colloque</strong></h4></div><div class="space-12 hidden-xs"></div>
<div class="row"> 
  <div class="col-sm-12">
    <form id="creat_col" role="form" method="POST" action="{{route('colloque.store')}}" onsubmit="return myFunction()">
      {{ csrf_field() }} 
      <div class="row">
        <div class="col-sm-5 col-xs-5">
          <label for="liste_membre"> <h5> <strong>Liste des médecins :</strong></h5></label>&nbsp;
          <select  id="liste_membre" class="form-control" size="7" multiple="multiple">
            @foreach( $service->employs as $med)
            <option id="id_membre" value="{{ $med->id }}" >{{ $med->full_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-2 col-xs-2">
          <br><br><br>
          <button type="button" id="liste_membre_undo" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-step-backward"></i></button>
          <button type="button" id="liste_membre_rightSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
          <button type="button" id="liste_membre_leftSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
          <button type="button" id="liste_membre_redo" class="btn btn-warning btn-block"><i class="glyphicon glyphicon-step-forward"></i></button>
        </div>            
        <div class="col-sm-5 col-xs-5">
          <label for="liste_membre_to"><h5><strong>&nbsp;Liste des membres :</strong></h5></label>&nbsp;
          <br>
          <select name="membres[]" id="liste_membre_to" class="form-control" multiple="multiple"></select>
        </div>
      </div>
      <div class="space-12 hidden-xs"></div><div class="space-12 hidden-xs"></div><div class="space-12 hidden-xs"></div>
      <div class="row">
        <div class="col-sm-7 col-xs-12">
            <label class= "control-label no-padding-left col-sm-4 col-xs-4" for="date">Date :</label>
            <input class="col-xs-6 col-sm-4 date-picker" id="date" name="date" type="text" 
                   placeholder="Date d'entrée prévue" data-date-format="yyyy-mm-dd" required/>
            <button class="btn btn-sm filelink" onclick="$('#date').focus()"><i class="fa fa-calendar"></i></button> 
        </div><div class="col-xs-5"></div>   
      </div><div class="space-12 hidden-xs"></div><div class="space-12"></div>
      <div class="row">
          <div class="col-sm-12">
            <div class="center bottom bt-0">
              <button class="btn btn-success btn-xs" type="submit" ><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp;
              <button class="btn btn-xs" type="reset" id="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Réinitialiser</button>
            </div>
          </div>
        </div>
    </form>
  </div>  <!-- cpl-s-12    -->
</div>  
@stop