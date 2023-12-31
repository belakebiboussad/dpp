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
@stop
@section('main-content')
  <div class="page-header"><h1>Ajouter un nouveau lit</h1>
     <div class="pull-right"><a href="{{ URL::previous() }}" class="btn btn-sm btn-warning"><i class="ace-icon fa fa-backward"></i> precedant</a></div>
  </div>
  <hr>
  <div class="row">
    <div class="col-xs-12">
    <div class="widget-box">
      <div class="widget-header">
        <h5 class="widget-title"><img src="/img/bed.png" alt="lit"> Lit</h5>
      </div>  
      <div class="widget-body">
        <div class="widget-main">
        <form role="form" method="POST" action="{{ route('lit.store') }}">
          {{ csrf_field() }}
          <div class="form-group row">
            <label class="col-sm-3 col-control-label" for="service">Service</label>
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
          <div class="form-group row">
            <label class="col-sm-3 col-control-label" for="salle_id">Chambre</label>
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
          <div class="form-group row">
            <label class="col-sm-3 col-control-label" for="num">Numéro</label>
            <div class="col-sm-9">
                  <input type="number"  name="num" placeholder="numéro du  lit" class="col-xs-10 col-sm-5"  min="1" required />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-control-label" for="nom">Nom</label>
            <div class="col-sm-9">
              <input type="text"  name="nom" placeholder="Nom complet du lit" class="col-xs-10 col-sm-5" />
            </div>
          </div>
          <div class="form-group row">
            <div class=" col-sm-9 col-sm-offset-3">
              <label>Bloqué
              <input name="bloq" class="ace ace-switch ace-switch-6" type="checkbox" value="1"><span class="lbl"></span>
              </label>
            </div>
          </div>
          <div class="center row">
              <button class="btn btn-xs btn-info" type="submit"><i class="ace-icon fa fa-save"></i>Enregistrer</button>
              <button class="btn btn-xs btn-danger" type="reset"><i class="ace-icon fa fa-undo"></i>Annuler</button>
            </div>
        
        </form>
                </div>
      </div>{{-- widget-body --}}
      </div> {{-- widget-box --}}
      </div> {{-- col-xs-12 --}}
      </div>
      @stop