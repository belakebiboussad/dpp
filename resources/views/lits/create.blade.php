@extends('app')
@section('page-script')
<script type="text/javascript">
      $(function(){
              $('#service').change(function(){
                      $('#salle_id').removeAttr("disabled");
                      $.ajax({
                            url : '/salles/'+ $('#service').val(),
                            type : 'GET',
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
  <div class="page-header"><h4>Ajouter un nouveau lit</h4></div>
  <div class="row">
    <div class="col-xs-12">
    <div class="widget-box">
      <div class="widget-header">
        <h5 class="widget-title"><img src="/img/bed.png" alt="lit"> Lit :</h5>
        <div class="widget-toolbar widget-toolbar-light no-border">
          <i class="ace-icon fa fa-table"></i><a href="/lit">Lits</a>
        </div>
      </div>  
      <div class="widget-body">
        <div class="widget-main">
              <form class="form-horizontal" role="form" method="POST" action="{{ route('lit.store') }}">
                      {{ csrf_field() }}
                       <div class="form-group">
                              <label class="col-sm-3 control-label" for="service">Service :</label>
                              <div class="col-sm-9">
                                 <select class="col-xs-10 col-sm-5" id="service" name="service" required>
                                    <option value="">Selectionnez....</option>
                                    @foreach($services as $service)
                                          <option value="{{ $service->id }}" {{ (isset($salle->id) && ($salle->service->id == $service->id ) ) ? 'selected ' : ''}}>{{ $service->nom }}
                                          </option>
                                      @endforeach
                                </select>
                              </div>
                      </div>
                       <div class="form-group">
                              <label class="col-sm-3 control-label" for="salle_id">Chambre :</label>
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
                            <label class="col-sm-3 control-label" for="num">Numéro:</label>
                            <div class="col-sm-9">
                                  <input type="number"  name="num" placeholder="numéro du  lit" class="col-xs-10 col-sm-5"  min="1" required />
                            </div>
                      </div>
                      <div class="form-group">
                              <label class="col-sm-3 control-label " for="nom">Nom : </label>
                                <div class="col-sm-9">
                                        <input type="text"  name="nom" placeholder="Nom complet du lit" class="col-xs-10 col-sm-5" />
                                </div>
                      </div>
                      <div class=" col-sm-9 col-sm-offset-3">
                              <label>Bloqué :
                            <input name="bloq" class="ace ace-switch ace-switch-6" type="checkbox" value="1"><span class="lbl"></span>
                          </label>
                       </div>
                    <div>
                            <div class="center">
                              <button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save"></i>Enregistrer</button>&nbsp; &nbsp;
                              <button class="btn btn-danger" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
                            </div>
                    </div>
                </form>
                </div>
      </div>{{-- widget-body --}}
      </div> {{-- widget-box --}}
      </div> {{-- col-xs-12 --}}
      </div>
      @endsection