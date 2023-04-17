@extends('app')
@section('main-content')
<div class="page-header"><h1>Réservations</h1></div>
<div class="col-sm-6">
  <form method="POST" role="form" action ="{{ route('reservation.update',1)}}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <input type="hidden" name ="Affect" class ="affect" value="0">
   <div class="form-group row">
    <label for="service_id">Service :</label>
    <select id="service_id" class="form-control selectpicker"/>
      <option value="" selected>Selectionnez un service</option>
      @foreach($services as $service)
      <option value="{{ $service->id }}">{{ $service->nom }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group row">
    <label for="salle">Salle :</label>
    <select id="salle_id" class="form-control selectpicker"/>
      <option value="" selected disabled>Selectionnez  une salle</option>
    </select>
  </div>
  <div class="form-group row">
    <label for="lit_id">Lit :</label>
    <select id="lit_id" name="lit_id" class="form-control selectpicker"/>
      <option value="" selected disabled>Selectionnez un lit</option>
    </select>
  </div>
  <div class="form-group mb-0">
    <button type="submit" class="btn btn-xs btn-success">getReservations</button>
  </div>
</form>
</div>
<div class="col-sm-6">
</div>
@stop
@section('page-script')
<script type="text/javascript">
  $(function(){
    $("#service_id").change(function(){
      if($(this ).val() != "")
      {
        var formData = { id: $(this).val() };
        var url = "{{ route('service.index') }}"; //supprimer dans index serviceController
        $.ajax({
              url : url,
              type:'GET',
              data:formData,
              success: function(data, textStatus, jqXHR){
                var select = $('#salle_id').empty();
                if(data.length != 0){
                      select.append('<option value="">Selectionnez une salle</option>');   
                      $.each(data,function(){
                        select.append('<option value="'+this.id+'">'+this.nom+'</option>');
                     });
                }else
                  select.append('<option value="" selected disabled>Pas de salle</option>');
              },
        });
      }
    });
    $("#salle_id").change(function(){
      if($(this ).val() != "")
      {
        var formData = { id:  $(this).val() };
        $.ajax({
                url : '/getNotResBedsTeste',
                type : 'GET',
                data:formData,
                success: function(data, textStatus, jqXHR){ 
                  var selectLit = $('#lit_id').empty();                      
                  if(data.length != 0){
                    selectLit.append("<option value=''>Selectionnez un lit</option>");
                    $.each(data,function(){
                      selectLit.append("<option value='"+this.id+"'>"+this.nom+"</option>");
                    });
                  }
                },
        });
      }
    }); 
  });
</script>
@stop