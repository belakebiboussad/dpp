@extends('app')
@section('title','Modifier Colloque')
@section('page-script')
<script type="text/javascript">
    var nowDate = new Date();
    var now = nowDate.getFullYear() + '-' + (nowDate.getMonth()+1) + '-' + ('0'+ nowDate.getDate()).slice(-2);
      $(function() {
        window.prettyPrint && prettyPrint();
        $('#liste_membre').multiselect();
        $('#reset').click(function(){
          $('#liste_membre_to').empty();       
        });
    });
    function validatFct()
    {
      if( $('#liste_membre_to').has('option').length > 0 ) 
        return true
      return false;
    }
</script>
@stop
@section('main-content')

<div class="page-header"> <h4>Modifier le colloque du &quot; {{ $colloque->date }} &quot;</h4></div>
<div class="space-12"></div>

<div class="row"> 
  <div class="col-sm-12">
    <form id="creat_col" role="form" method="POST" action="{{route('colloque.update',$colloque->id)}}" onsubmit="return validatFct()">
      {{ csrf_field() }} 
      {{ method_field('PUT') }}
      <div class="row">
        <div class="col-xs-5">
          <label class="control-label">Médecins</label>
          <select  id="liste_membre" class="form-control" size="7" multiple="multiple">
            @foreach( $listeMeds as $med)
            <option id="id_membre" value="{{$med->id}}" >{{$med->full_name}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-xs-2">
          <br><br><br>
          <button type="button" id="liste_membre_undo" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-step-backward"></i></button>
          <button type="button" id="liste_membre_rightSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
          <button type="button" id="liste_membre_leftSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
          <button type="button" id="liste_membre_redo" class="btn btn-warning btn-block"><i class="glyphicon glyphicon-step-forward"></i></button>
        </div>            
        <div class="col-xs-5">
          <label class="control-label">Liste des membres</label>
         <select name="membres[]" id="liste_membre_to" class="form-control" size="7" multiple="multiple">
            @foreach( $colloque->membres as $med)
            <option id="id_membre" value="{{$med->id}}" >{{$med->full_name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="space-12"></div> <div class="space-12"></div>
      <div class="row">
        <div class="col-xs-7">
          <label class= "control-label no-padding-left col-xs-4 col-sm-4" for="date">Date:</label>
          <input class="col-xs-4 col-sm-4 date-picker" id="date" name="date" type="text" value="{{ $colloque->date }}" data-date-format="yyyy-mm-dd" required/>
          <button class="btn btn-sm filelink" onclick="$('#date').focus()"><i class="fa fa-calendar"></i></button> 
        </div><div class="col-xs-5"></div>
      </div>
      <div class="space-12"></div><div class="space-12"></div>
      <div class="center form-actions">
              <button class="btn btn-success btn-xs" type="submit"><i class="ace-icon fa fa-save "></i>Enregistrer </button>&nbsp; &nbsp;&nbsp;
              <button class="btn btn-xs btn-warning" type="reset" id="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
        </div>
    </form>
  </div>  <!-- cpl-s-12    -->
</div>  
@stop