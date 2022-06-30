<div class="row">
@foreach(json_decode($specialite->appareils ,true) as $appareil)
  <?php $nom = App\modeles\appareil::FindOrFail($appareil)->nom ?>
  <div class="col-sm-6 col-xs-12">
    <button type="button" class="btn btn-lg btn-success col-sm-12 col-xs-12" data-toggle="collapse" data-target="#{{ $nom }}">Appareil {{ $nom }}</button>
    <div id="{{ $nom }}" class="collapse panel panel-primary col-sm-12 col-xs-12">
      <div class="widget-box widget-color-green">
        <div class="widget-header widget-header-small"> 
          <div class="wysiwyg-toolbar btn-toolbar center inline">
            <div class="btn-group"> 
              <a class="btn btn-sm btn-default" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i class=" ace-icon fa fa-bold"></i></a>
            </div>
             <div class="btn-group">
              <a class="btn btn-sm btn-default" data-edit="insertunorderedlist" data-original-title="Bullet list"><i class=" ace-icon fa fa-list-ul"></i></a>
              <a class="btn btn-sm btn-default" data-edit="insertorderedlist" data-original-title="Number list"><i class=" ace-icon fa fa-list-ol"></i></a>
            </div><div class="btn-group"></div>
          </div>
        </div>
        <div class="widget-body">
          <div class="widget-main no-padding">
            <input type="hidden" name="{{ $nom }}"/>
            <div class="wysiwyg-editor" contenteditable style="height:100px;"></div>
          </div>
              <div class="widget-toolbox padding-4 clearfix">
                <div class="btn-group pull-left">
                  <button class="btn btn-sm btn-default btn-white btn-round" type="button" onclick = 'removeAppareilsContent("{{ $nom }}")' disabled><i class="ace-icon fa fa-times bigger-125"></i>Annuler
                  </button>
                </div>
                <div class="btn-group pull-right">
                  <button class="btn btn-sm btn-danger btn-white btn-round" type="button" onclick = 'addAppareils("{{ $nom }}")' disabled><i class="ace-icon fa fa-floppy-o bigger-125"></i>Enregistrer
                  </button>
                </div>
              </div>
            </div>
          </div>  {{--widget-box --}}
    </div>
  </div>
    @if( $loop->iteration % 2 == 0 )
      <br/>
    @endif 
@endforeach
</div>
<div class="space-12"></div><div class="space-12 hidden-xs"></div>
<script>
function addAppareils(appareil)
{
  $("#"+appareil).each(function(i){
    if(($(this).find(".wysiwyg-editor").text()) !=" ")
      $('input:hidden[name="' + appareil + '"]').val($(this).find(".wysiwyg-editor").text());
    $(this).collapse('hide');
  });
}
function removeAppareilsContent(appareil)
{
  $("#"+appareil).each(function(i){
    $(this).find(".wysiwyg-editor").text("");
  });   
} 
$(function() {
  $('.wysiwyg-editor').on('input',function(e){
    var a = $(this).parent().nextAll("div.clearfix");
    var i = a.find("button:button").each(function(){
      $(this).removeAttr('disabled');
    });
  });
}) 
</script>