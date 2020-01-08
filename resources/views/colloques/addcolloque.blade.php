@extends('app_dele')
@section('title','Ajouter Colloque')
@section('page-script')
<script type="text/javascript">
    var nowDate = new Date();
    var now = nowDate.getFullYear() + '-' + (nowDate.getMonth()+1) + '-' + ('0'+ nowDate.getDate()).slice(-2);
  
    $(document).ready(function() {
        window.prettyPrint && prettyPrint();
        $("#date_colloque").datepicker("setDate", now);  
        $('#liste_membre').multiselect();
        $('#reset').click(function(){
            $('#liste_membre_to').empty();       
        });

    });
    function myFunction()
    {
      if( $('#liste_membre_to').has('option').length > 0 ) {
          return true
      }
      return false;
    }
</script>
@endsection
@section('main-content')
<div class="space-12"></div>
<div class="page-header">
  <h1><strong>Ajouter un  Nouveau Colloque</strong></h1>
</div><!-- /.page-header -->
<br>
<div class="space-12"></div>
<div class="row"> 
  <div class="col-sm-12">
    <form id="creat_col" class="form-horizontal" role="form" method="POST" action="{{route('colloque.store')}}" onsubmit="return myFunction()">
      {{ csrf_field() }} 
      <div class="row">
        <div class="col-xs-5">
          <label for="liste_membre"> <h4> <strong>Liste des Medecins :</strong></h4></label>&nbsp;
          <select  id="liste_membre" class="form-control" size="7" multiple="multiple">
            @foreach( $membre as $membres)
            <option id="id_membre" value="{{$membres->id}}" >{{$membres->Nom_Employe}} {{$membres->Prenom_Employe}}</option>
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
          <label for="liste_membre_to"> <h4> <strong>&nbsp;Liste des membres :</strong></h4></label>&nbsp;
          <br>
          <select name="membres[]" id="liste_membre_to" class="form-control" size="7" multiple="multiple"></select>
        </div>
      </div>
      <div class="space-12"></div>
      <div class="space-12"></div>
      <div class="space-12"></div>
      
        <!-- ici date -->
      <div class="row">
        <div class="col-xs-7">
             <label for="date_colloque"><strong>Date du colloque :</strong></label>
            <!--  <input class="col-xs-6 col-sm-6 date-picker" id="date_colloque" name="date_colloque" placeholder="Date prévue du colloque" type="text" 
                data-date-format="yyyy-mm-dd" style="width: 300px" required />
             <button class="btn btn-sm filelink" onclick="$('#date_colloque').focus()">  <i class="ace-icon fa fa-calendar"></i></button> -->
              <input class="date-picker" id="date_colloque" name="date_colloque" type="text" 
                   placeholder="Date d'entrée prévue d'hospitalisation" data-date-format="yyyy-mm-dd" required/>
              <button class="btn btn-sm filelink" onclick="$('#date_colloque').focus()"><i class="fa fa-calendar"></i></button>
        </div>
        <div class="col-xs-4">
              <input class="col-xs-5 col-sm-5 date-picker" id="date_colloque" name="date_colloque" type="text" 
                   placeholder="Date d'entrée prévue d'hospitalisation" data-date-format="yyyy-mm-dd" required/>
              <button class="btn btn-sm filelink" onclick="$('#date_colloque').focus()"><i class="fa fa-calendar"></i></button>
        </div>
       <!--  <div class="col-xs-3"></div>
        <div class="col-xs-3"></div>
 -->

      </div>
      
      


      <div class="space-12"></div>
      <div class="space-12"></div>



      <div class="row">
          <div class="col-xs-6">
            <label for="type_colloque"><h4><b>Type du colloque :</b></h4></label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <select id="type_colloque" name="type_colloque" data-placeholder="sélectionner le type..."  style="width: 300px " required>
              <option value="" selected disabled>sélectionner le type...</option>
              @foreach( $type_c as $type)
              <option id="id_type" value="{{$type->id}}" >{{$type->type}}</option>
              @endforeach
            </select>
          </div>
      </div>
      <div class="space-12"></div>
       <div class="space-12"></div>
      <div class="row">
          <div class="col-xs-6 center">
            <div class="col-md-offset-6 col-md-7"><br/>
              <button class="btn btn-success btn-xs" type="submit" >
                <i class="ace-icon fa fa-check bigger-110"></i>Enregistrer
              </button>
              &nbsp; &nbsp; &nbsp; &nbsp;
              <button class="btn btn-xs" type="reset" id="reset">
                <i class="ace-icon fa fa-undo bigger-110"></i>Réinitialiser
              </button>
            </div>
          </div>
        </div>
    </form>
  </div>  <!-- cpl-s-12    -->
</div>  
@endsection