@extends('app')
@section('page-script')
<script type="text/javascript">
  var nowDate = new Date();
  var tomorow = nowDate.getFullYear() + '-' + (nowDate.getMonth()+1) + '-' + ('0'+ (nowDate.getDate() + 2)).slice(-2);
  $(function(){
      $(".date").datepicker("setDate", tomorow);     
      $(".date_end").datepicker("setDate", tomorow);
      $('.numberDays').on('click keyup', function() {
          addDays();
      });
      $(".date").change(function(){
        addDays();
      });
      $(".date_end").change(function(){
        updateDureePrevue();
      });
  })
  </script>
@endsection
@section('main-content')
<div class="container">
        <form method="POST" role="form" action="{{ route('planning.store') }}">
             {{ csrf_field() }}
            <fieldset class="border p-2 mt-3">
                <legend class="w-auto">Type de la demande</legend>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="typeDemande" id="conges" value="" checked>
                    <label class="form-check-label" for="conges">Congés</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="typeDemande" id="recup" value="1">
                    <label class="form-check-label" for="recup">Récupération</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="typeDemande" id="cong" value="2">
                    <label class="form-check-label" for="recup">Congrès et séminaires</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="typeDemande" id="autre" value="3">
                    <label class="form-check-label" for="recup">Autre</label>
                </div>
            <fieldset class="border p-2 mt-3">
                <legend class="w-auto">Début</legend>
                  <div class="form-group row">
                      <label for="date" class="col-sm-2 col-form-label">Date</label>
                      <div class="col-sm-10">
                          <input type="text" class="date-picker date form-control" name="date" data-date-format="yyyy-mm-dd">
                      </div>
                  </div>
                   <div class="form-group row">
                      <label for="heure_deb" class="col-sm-2 col-form-label">Heure</label>
                      <div class="col-sm-10">
                          <input type="text" class="timepicker1 form-control" name="heure">
                      </div>
                  </div>
            </fieldset>
            </fieldset>
               <fieldset class="border p-2 mt-3">
                <legend class="w-auto">DUREE </legend>
                 <div class="form-group row">
                    <label for="duree" class="col-sm-2 col-form-label">Durée</label>
                    <div class="col-sm-10">
                        <input type="number" class="numberDays form-control" min="0" max="50" value="0">
                    </div>
                </div>
            </fieldset>
            <fieldset class="border p-2 mt-3">
                <legend class="w-auto">Fin</legend>
                <div class="form-group row">
                    <label for="date_end" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-10">
                        <input type="text" class="date-picker date_end form-control" name="date_end" data-date-format="yyyy-mm-dd">
                    </div>
                </div>
                <div class="form-group row">
                      <label for="heure_deb" class="col-sm-2 col-form-label">Heure</label>
                      <div class="col-sm-10">
                          <input type="text" class="timepicker1 form-control" name="heure_end">
                      </div>
                  </div>
            </fieldset>
            <fieldset class="border p-2 mt-3">
                <legend class="w-auto">Votre demande</legend>
                <div class="form-group row">
                    <label for="comment" class="col-sm-2 col-form-label">La demande</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="desc" cols="30" rows="5" required></textarea>
                    </div>
                </div>
            </fieldset>
            <div class="form-group col text-center">
                 <button type="submit" class="btn btn-sm btn-primary mt-3"><i class="ace-icon fa fa-save"></i>Enregistrer</button>
            </div>
        </form>
    </div>
@endsection