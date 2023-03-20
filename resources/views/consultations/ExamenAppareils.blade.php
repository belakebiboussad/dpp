<div class="row">
@foreach(json_decode($specialite->appareils,true) as $appareil)
  <?php $app = App\modeles\appareil::FindOrFail($appareil)?>
  <div class="col-sm-6 col-xs-12">
    <h4 class="header blue">Appareil {{ $app->nom }}</h4>
    <div class="widget-box widget-color-green">
      <div class="widget-header widget-header-small">
        <div class="wysiwyg-toolbar btn-toolbar"></div>
      </div>
      <div class="widget-body">
        <div class="widget-main no-padding">
          <input type="hidden" name="{{ $app->nom }}"/>
          <div class="wysiwyg-editor" id="{{ $app->id }}" contenteditable="true">
          <div style="text-align: left;"></div></div>
        </div>
        <div class="widget-toolbox padding-4 clearfix">
          <div class="btn-group pull-left">
            <button class="btn btn-sm btn-default btn-white btn-round appar-delete" value="{{ $app->id }}" disabled>
              <i class="ace-icon fa fa-times bigger-125"></i> Annuler</button>
          </div>
          <div class="btn-group pull-right">
            <button class="btn btn-sm btn-danger btn-white btn-round appareilSave" value = "add" data-id="{{ $app->id }}" disabled>
              <i class="ace-icon fa fa-floppy-o bigger-125"></i> Enregistrer</button>
          </div>
        </div>
      </div>
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
    var elem = $(this).parent().nextAll("div.clearfix");
    elem.find('.appareilSave').removeAttr('disabled');
  });// begin teste
  $('.wysiwyg-editor').css({'height':'100px'}).ace_wysiwyg({//#editor2
      toolbar_place: function(toolbar) {
        return $(this).closest('.widget-box')
          .find('.widget-header').prepend(toolbar)
          .find('.wysiwyg-toolbar').addClass('inline');
      },
      toolbar:
      [
        'bold',
        'italic',
        'strikethrough',
        'underline',
        null,
        'insertunorderedlist',
        'insertorderedlist',
        ,null,
        {name:'createLink', className:'btn-pink'},
        'unlink',
        null,
        'justifyleft',
        'justifycenter',
        'justifyright',

      ],
      speech_button: false
    });
  // end teste
  $(".appareilSave").click(function (e) {
    e.preventDefault();
    if($("#"+ $(this).data('id')).text() != "")
    {
      var type = "POST",
      url ="{{ route('appreilExamClin.store') }}";  
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
      var state = $(this).val();
      var formData = {
          cons_id:'{{ $obj->id }}',
          appareil_id:$(this).data('id'),
          description:$("#"+ $(this).data('id')).text()
      };
      if (state == "update") {
        type = "PUT";
        url = '{{ route("appreilExamClin.update", ":slug") }}'; 
        url = url.replace(':slug',$(this).data('id'));
      }else
        $(this).val("update");
      $.ajax({
            type: type,
            url: url,
            data: formData,
            success: function (data) {
              if(state == "add")      
                $("#"+ data).parent().parent().find('.appar-delete').removeAttr('disabled');
            },
            error : function(data){
              alert("data");
            }
      });  
    }
  });
  $(".appar-delete").click(function (e) {
    e.preventDefault();
    var formData = {
        appareil_id  : $(this).val(),
        cons_id : '{{ $obj->id }}',
    };
    url='{{ route("appreilExamClin.destroy",":slug") }}';
    url = url.replace(':slug',$(this).val());
    $.ajax({
      type: "DELETE",
      url : url,
      data: formData,
      success: function (data) {
        $("#"+ data).text("");
        $("#" + data).parent().parent().find(":button").each(function(i){
          $(this).attr('disabled','disabled');
          if($(this).val() == "update")
            $(this).val("add");
        });   
      },
      error: function (data) {
        console.log('Error:', data);
      }
    });
  });
}) 
</script>