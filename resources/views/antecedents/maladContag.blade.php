<div class="row"><div class="col-sm-12"><h3 class="header smaller lighter blue">Maladie Contagieuse</h3></div></div>
<div class="row">
 @foreach($deseases as $des)
  <div class="col-xs-4 col-sm-2">
    <div class="checkbox">
      <label>
        <input name="exmsbio[]" type="checkbox" class="ace desContag" value="{{ $des->CODE_DIAG }}"/>
        <span class="lbl"> {{ $des->NOM_MALADIE }} </span> 
      </label>
       </div>
  </div>
  @endforeach
</div> 
<script type="text/javascript">
$(function(){
   $('.desContag').bind('click', function() {
      var ajaxurl = '/maladies/';
      var type = "POST";
      if(!$(this).is(':checked'))
      {
        var type = "DELETE";
        ajaxurl += $(this).val();
      }
     var formData = { _token: CSRF_TOKEN, maladie_id : $(this).val(),pid : '{{ $patient->id }}',};
    
      $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            success: function (data) {}
      });
      
   });
})
</script>

