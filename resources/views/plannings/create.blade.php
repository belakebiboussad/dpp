@extends('app')
@section('main-content')
<div class="container">
        <form method="POST" class="form-horizontal" role="form" action="{{ route('planning.store') }}">
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
            </fieldset>
               <fieldset class="border p-2 mt-3">
                <legend class="w-auto">Début</legend>
                     <div class="form-group row">
                            <label for="date" class="col-sm-2 col-form-label">Date début</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="date form-control" id="date" name="date">
                            </div>
                        </div>
            </fieldset>
              <fieldset class="border p-2 mt-3">
                <legend class="w-auto">Fin</legend>
                 <div class="form-group row">
                            <label for="date_end" class="col-sm-2 col-form-label">Date fin</label>
                            <div class="col-sm-10">
                                <input type="datetime-local" class="date form-control" id="date_end" name="date_end">
                            </div>
                        </div>
            </fieldset>
            <fieldset class="border p-2 mt-3">
                <legend class="w-auto">Votre demande</legend>
                <div class="form-group row">
                    <label for="comment" class="col-sm-2 col-form-label">La demande</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="comment" id="comment" cols="30" rows="5" value="" required></textarea>
                    </div>
                </div>
            </fieldset>
            <div class="form-group col text-center">
                 <button type="submit" class="btn btn-sm btn-primary mt-3"><i class="ace-icon fa fa-save"></i>Enregistrer</button>
            </div>
        </form>
    </div>
@endsection