@extends('app')
@section('title','Ajouter Colloque')
@section('page-script')
<script type="text/javascript">
    var nowDate = new Date();
    var now = nowDate.getFullYear() + '-' + (nowDate.getMonth()+1) + '-' + ('0'+ nowDate.getDate()).slice(-2);
    $(function() {
        window.prettyPrint && prettyPrint();
        $("#date").datepicker("setDate", now);  
        $('#liste_membre').multiselect();
        $('#reset').click(function(){
            $('#liste_membre_to').empty();       
        });
    });
    function validatFct()
    {
      if( $('#liste_membre_to').has('option').length > 0 )
        return true;
      return false;
    }
</script>
@stop
@section('main-content')
<div class="page-header"><h4>Ajouter un  nouveau colloque</h4></div>
<div class="row"> 
  <div class="col-sm-12">
    <form id="creat_col" role="form" method="POST" action="{{route('colloque.store')}}" onsubmit="return validatFct()">
      {{ csrf_field() }} 
      <div class="row">
        <div class="col-sm-5 col-xs-5">
          <label class="control-label">Médecins</label>
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
          <div class="form-group">
            <label class="control-label">Liste des membres</label>
            <select name="membres[]" id="liste_membre_to" class="form-control" multiple="multiple"></select>
           </div>
          <div class="form-group">
           <label class= "control-label no-padding-left col-sm-4 col-xs-4" >Date</label>
          <input class="col-xs-6 col-sm-4 date-picker" id="date" name="date" type="text" placeholder="Date du colloque" data-date-format="yyyy-mm-dd" required/>
            <button class="btn btn-sm filelink" onclick="$('#date').focus()"><i class="fa fa-calendar"></i></button> 
          </div>
        </div>
      </div>
      <div class="space-12 hidden-xs"></div><div class="space-12 hidden-xs"></div>
      <div class="space-12 hidden-xs"></div>
      <div class="row">
          <div class="col-sm-12">
            <div class="clearfix form-actions">
              <button class="btn btn-success btn-xs" type="submit" ><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>
              <button class="btn btn-warning btn-xs" type="reset" id="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
            </div>
          </div>
        </div>
    </form>
  </div>  <!-- cpl-s-12    -->
</div>  
@stop