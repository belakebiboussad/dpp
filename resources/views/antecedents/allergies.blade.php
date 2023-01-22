<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Allergies</h3></div></div>
<div class="row">
  @foreach($allergies as $al)
  <div class="col-xs-4 col-sm-2">
    <div class="checkbox">
      <label>
        <input name="exmsbio[]" type="checkbox" class="ace allerg" value="{{ $al->id }}" {{  (in_array($al->id, $patient->Allergies->pluck('id')->toArray()))? 'checked' : '' }} />
        <span class="lbl"> {{ $al->nom }} </span> 
      </label>
    </div>
  </div>
  @endforeach
</div> 
<script type="text/javascript">
$(function(){
   $('.allerg').bind('click', function() {
      var ajaxurl = '/allergie/';
      var type = "POST";
      if(!$(this).is(':checked'))
      {
        var type = "DELETE";
        ajaxurl += $(this).val();
      }
      var formData = { _token: CSRF_TOKEN,allergie_id : $(this).val(),pid : '{{ $patient->id }}',};
      $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            success: function (data) {}
      });
   });
})
</script>
