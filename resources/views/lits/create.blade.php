@extends('app')
@section('page-script')
<script type="text/javascript">
  $('document').ready(function(){
    $('#service').change(function(){
      $('#salle_id').removeAttr("disabled");
      $.ajax({
          url : '/salles/'+ $('#service').val(),
          type : 'GET',
          dataType : 'json',
          success : function(data){
            if(data.length != 0){
                var select = $('#salle_id').empty();
                  $.each(data,function(){
                       select.append("<option value='"+this.id+"'>"+this.nom+"</option>");
                  });
            }else
              $('#salle_id').html('<option value="" disabled selected>Pas de salle</option>');
          },
      });
    })
  });
</script>
@endsection
@section('main-content')
  <div class="row"><h4><strong>Ajouter un nouveau lit</strong></h4></div>
  <div class="row">
    <div class="col-xs-12">
    <div class="widget-box" id="widget-box-1">
      <div class="widget-header">
        <h5 class="widget-title"><img src="/img/bed.png" alt="lit"><strong> Lit :</strong></h5>
        <div class="widget-toolbar widget-toolbar-light no-border">
          <i class="ace-icon fa fa-table"></i><a href="/lit"> <b>&nbsp;Liste des Lits</b></a>
        </div>
      </div>  
      <div class="widget-body">
        <div class="widget-main">
              <form class="form-horizontal" role="form" method="POST" action="{{ route('lit.store') }}">
                      {{ csrf_field() }}
                      <div class="space-12"></div> 
                       <div class="form-group">
                              <label class="col-sm-3 control-label no-padding-right" for="service">Service:</label>
                              <div class="col-sm-9">
                                 <select class="col-xs-10 col-sm-5" id="service" name="service" required>
                                    <option value="">Selectionnez....</option>
                                    @foreach($services as $service)
                                          <option value="{{ $service->id }}" {{ (isset($salle->id) && ($salle->service->id == $service->id ) ) ? 'selected ' : ''}}>{{ $service->nom }}</option>
                                      @endforeach
                                </select>
                              </div>
                      </div>
                       <div class="form-group">
                              <label class="col-sm-3 control-label no-padding-right" for="salle_id">Chambre :</label>
                              <div class="col-sm-9">
                                  <select class="col-xs-10 col-sm-5" id="salle_id" name="salle_id" required>
                                    <option value="" selected disabled>Selectionnez....</option>
                                    @if(isset($salle->id))
                                        @foreach($salle->service->salles as $chambre)
                                               <option value="{{ $chambre->id }}"  {{ ($chambre->id == $salle->id  ) ? 'selected ' : ''}}>{{ $chambre->nom }}</option>
                                          @endforeach
                                     @endif      
                                     </select>
                              </div>
                      </div>
                              <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="numlit">Numéro lit:</label>
    <div class="col-sm-9">
    <input type="number"  name="numlit" placeholder="numéro du  lit" class="col-xs-10 col-sm-5"  min="1" required />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="nom">Nom lit:</label>
    <div class="col-sm-9">
      <input type="text"  name="nom" placeholder="nom complet du lit" class="col-xs-10 col-sm-5" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="etatlit">Bloquer un lit :</label>
    <div class="col-sm-9">
      <div class="checkbox"><label><input type="checkbox" name="etat" value ="1"></label></div>
    </div>
  </div>
  <div>
          <div class="center">
            <button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp;
            <button class="btn" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
          </div>
  </div>
                </form>
                </div>
      </div>{{-- widget-body --}}
      </div> {{-- widget-box --}}
      </div> {{-- col-xs-12 --}}
      </div>
      @endsection