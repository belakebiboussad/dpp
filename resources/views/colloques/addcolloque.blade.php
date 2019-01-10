@extends('app_dele')
@section('page-script')
<script type="text/javascript">
    $(document).ready(function() {
           window.prettyPrint && prettyPrint();
          $('#liste_membre').multiselect();
          $('#reset').click(function(){
                $('#liste_membre_to').empty();       
                 });
        });
     function myFunction(){
        select = document.getElementById('liste_membre_to'); // or in jQuery use: select = this;
        if(select.value )
            return select.value;
         return false;
    }
</script>
@endsection
@section('main-content')
<br>
     <form id="creat_col" class="form-horizontal" role="form" method="POST" action="{{route('colloque.store')}}" onsubmit="return myFunction()">
        {{ csrf_field() }} 
  {{--               <div id="wrap" class="container">     --}}        
           <div class="row">
                <div class="col-xs-5">
                      <label for="liste_membre"> <h4> <b>Liste des Medecins:</b></h4></label>&nbsp;
                            <select  id="liste_membre" class="form-control" size="7" multiple="multiple">
                                      @foreach( $membre as $membres)
                                     <option id="id_membre" value="{{$membres->id}}" >{{$membres->Nom_Employe}} {{$membres->Prenom_Employe}}
                                      </option>
                                    @endforeach
                            </select>
                </div>
                <div class="col-xs-2">
                <br><br><br>
                {{-- <i class="fas fa-step-backward"></i> --}}
                <button type="button" id="liste_membre_undo" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-step-backward"></i></button>
                       <button type="button" id="liste_membre_rightSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <button type="button" id="liste_membre_leftSelected" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <button type="button" id="liste_membre_redo" class="btn btn-warning btn-block"><i class="glyphicon glyphicon-step-forward"></i></button>
                </div>
                        
                        <div class="col-xs-5">
                           <label for="liste_membre_to"> <h4> <b>&nbsp;Liste des membres:</b></h4></label>&nbsp;
                           <br>
                            <select name="membres[]" id="liste_membre_to" class="form-control" size="7" multiple="multiple" required></select>
                        </div>
                    </div>
                    <div class="space-12"></div>
                    <div class="space-12"></div>
                    <div class="row">
                                  <div class="col-xs-6">
                                                <label for="date_colloque"><h4><b>Date du colloque:</b></h4></label>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                <input class="date-picker" id="date_colloque" name="date_colloque" placeholder="Veuillez selectionner la date prévue du colloque" type="text" data-date-format="yyyy-mm-dd" style="width: 300px" required />
                                                 <button class="btn" onclick="$('#date_colloque').focus()">  <i class="ace-icon fa fa-calendar bigger-110"></i></button>
                                </div>
                    </div>
                    <div class="space-12">  </div>
                    <div class="row">
                            <div class="col-xs-6">
                                <label for="type_colloque"><h4><b>Type du colloque:</b></h4></label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                <select id="type_colloque" name="type_colloque" data-placeholder="sélectionner le type..."  style="width: 300px " required>
                                                <option value="" selected disabled>sélectionner le type...</option>
                                            @foreach( $type_c as $type)
                                            <option id="id_type" value="{{$type->id}}" >{{$type->type}}
                                            </option>
                                            @endforeach
                              </select>
                            </div>
                    </div>
                    <div class="space-12">  </div>
                    <div class="row">
                               <div class="col-xs-6">
                                    <div class="col-md-offset-6 col-md-7"><br/>
                                    <button class="btn btn-success" type="submit" >
                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                      Créer
                                  </button>
                                    &nbsp; &nbsp; &nbsp; &nbsp;
                                  <button class="btn" type="reset" id="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                    Réinitialiser
                                  </button>
                                </div>
                              </div>

                    </div>
         {{-- </div> --}}

@endsection