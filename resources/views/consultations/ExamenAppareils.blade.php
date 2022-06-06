<div class="row">
@foreach(json_decode($specialite->appareils,true) as $appareil)
  <?php $app = App\modeles\appareil::FindOrFail($appareil)?>
  <div class="col-sm-6 col-xs-12">
    <button type="button" class="btn btn-lg btn-success col-sm-12 col-xs-12" data-toggle="collapse" data-target="#{{ $app->id }}">Appareil {{ $app->nom }}</button>
    <div id="{{ $app->id }}" class="collapse panel panel-primary col-sm-12 col-xs-12">
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
            <input type="hidden" name="{{ $app->nom }}"/>
            <div class="wysiwyg-editor" contenteditable style="height:100px;"></div>
          </div>
          <div class="widget-toolbox padding-4 clearfix">
            <div class="btn-group pull-left"><!-- onclick = 'removeAppareilsContent("{{-- $app->id --}}")' -->
              <button class="btn btn-sm btn-default btn-white btn-round appar-delete" type="button" value="{{ $app->id }}" disabled>
                <i class="ace-icon fa fa-times bigger-125"></i>Annuler
              </button>
            </div>
            <div class="btn-group pull-right">
              <button class="btn btn-sm btn-danger btn-white btn-round appareilSave"  type="button"  value = "add" data-id="{{ $app->id }}" disabled>
                <i class="ace-icon fa fa-floppy-o bigger-125"></i>Enregistrer
              </button>
            </div>
          </div>
        </div>
      </div>{{--widget-box --}}
    </div>
  </div>
  @if($loop->iteration %2 == 0 )
    <div class="col-sm-12"></div><div class="col-sm-12"></div>
  @endif 
@endforeach
</div>
<script>
function removeAppareilsContent(appareil)
{
  $("#"+appareil).each(function(i){
    $(this).find(".wysiwyg-editor").text("");
  });   
} 
$(function() {
  $('.wysiwyg-editor').on('input',function(e){
    /*
    var elem = $(this).parent().nextAll("div.clearfix");
    elem.find("button:button").each(function(){
       $(this).removeAttr('disabled');
    });
    */
    $("input.appareilSave:button").removeAttr('disabled');
  });
  $(".appareilSave").click(function (e) {
    e.preventDefault();
    $.ajaxSetup({
          headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    if($("#"+ $(this).data('id')).find(".wysiwyg-editor").text() != "")
    {
      var formData = {//_token: CSRF_TOKEN,
          cons_id:'{{ $consult->id }}',
          appareil_id:$(this).data('id'),
          description:$("#"+ $(this).data('id')).find(".wysiwyg-editor").text()
      };
      var type = "POST", url = '';
      if ($(this).val() == "update") {
        type = "PUT";
        url = '{{ route("appreilExamClin.update", ":slug") }}'; 
        url = url.replace(':slug',$(this).data('id'));
      }else
      {
        url ="{{ route('appreilExamClin.store') }}";
        $(this).val("update");
      }
      $.ajax({
            type: type,
            url: url,
            data: formData,
            success: function (data) {
              $("#"+ data.appareil_id).collapse('hide');
            },
            error : function(data){
              alert("data");
            }
      }); 
    } 
  });
  $(".appar-delete").click(function (e) {
    e.preventDefault();
    alert($(this).val());
  });

}) 
</script>