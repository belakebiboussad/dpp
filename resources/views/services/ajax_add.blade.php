<div class="row"><h4><strong>Ajouter un nouveau service</strong></h4></div>
<div class="row">
  <div class="col-xs-12">
    <div class="widget-box">
      <div class="widget-header"><h5 class="widget-title"><strong>Ajouter un nouveau service </strong></h5></div>
      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" role="form" method="POST">
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="nom"><strong> Nom : </strong></label>
              <div class="col-sm-9">
                <input type="text" id="nom" placeholder="Nom du dervice" class="col-xs-12 col-sm-12"/>
              </div>
            </div>  <div class="space-12 hidden-xs"></div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="type"><strong>Type:</strong></label>
              <div class="col-sm-9">
                <select id="type" class="selectpicker show-menu-arrow col-xs-12 col-sm-12" required >
                  <option value="0">Médicale</option>
                  <option value="1">Chirurgical</option>
                  <option value="2">Fonctionnel</option>
                </select> 
              </div>
            </div><div class="space-12 hidden-xs"></div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="type"><strong>Chef:</strong></label>
              <div class="col-sm-9">
                <select id="responsable_id" class="selectpicker show-menu-arrow col-xs-12 col-sm-12">
                  <option value="" selected disabled>Selectionner le chef du service</option>
                  @foreach ($users as $user)
                  <option value="{{ $user->employ->id}}"> {{ $user->employ->full_name }}</option>
                  @endforeach
                </select> 
              </div>
            </div><div class="space-12 hidden-xs"></div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="hebergement"><strong> Hébergement: </strong></label>
              <div class="col-sm-9">
                <label>
                  <input name="hebergement" value="0" type="radio" class="ace" checked/><span class="lbl">Non</span></label>&nbsp;&nbsp;
                <label>
                  <input name="hebergement" value="1" type="radio" class="ace"/><span class="lbl">Oui</span></label>&nbsp;&nbsp;&nbsp;                
              </div>
            </div>
            <div class="space-12 hidden-xs"></div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="urgence"><strong> Urgence: </strong></label>
              <div class="col-sm-9">
                <label>
                  <input name="urgence" value="0" type="radio" class="ace" checked /><span class="lbl">Non</span></label>&nbsp;&nbsp;
                <label>
                  <input name="urgence" value="1" type="radio" class="ace"/><span class="lbl">Oui</span></label>&nbsp;&nbsp;&nbsp;                
              </div>
            </div>
            <div class="row center">
              <button class="btn btn-xs btn-info" type="button" id="serv-save"><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button>&nbsp; &nbsp; &nbsp;
              <button class="btn btn-xs" type="reset"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(function(){
  $("#serv-save").click(function(e){
    e.preventDefault();
    var formData = {
      _token : CSRF_TOKEN,
      nom    : $('#nom').val(),
      type    : $('#type').val(),
      responsable_id    : $('#responsable_id').val(),
      hebergement    : $("input[name='hebergement']:checked").val(),
      urgence    : $("input[name='urgence']:checked").val(),
    };
     var url = "{{ route('service.store') }}";
     $.ajax({
            type: "POST",
            url: url,
            data: formData,
            success: function (data) {
                /*
                var service = '<tr id="' + data.id + '"><td>'+ data.nom + '</td><td>' +data.presentation +'</td><td>'+ data.eggopenduration +'</td><td>'
                + data.workduration +'</td><td>' + data.expulsduration +'</td><td>'
                + data.Type +'</td><td>' + data.incident +'</td>';
                acc += '<td class ="center"><button class="btn btn-xs btn-info open-modalacc" value="' + data.id + '"><i class="fa fa-edit fa-lg" aria-hidden="true" ></i></button>&nbsp;';
                acc += '<button class="btn btn-xs btn-danger delete-acc" value="' + data.id + '" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-lg"></i></button></td></tr>';;
                */
                var type= "";
                switch(data.type)
                {
                  case "0":
                    type="Médicale";
                    break;
                  case "1":
                    type="Chirurgicale";
                    break;
                  case "2":
                    type="Fonctionnel";
                    break;
                  default:
                    break;
                }
                 var medecin = (isEmpty(data.responsable)) ? '' : data.responsable.full_name ;
                var service = '<tr id="' + data.id + '"><td>'+ data.nom + '</td><td>' + type +'</td><td>'+ medecin +'</td><td>'+ (data.hebergement == 1) ? "Oui":"Non";
                    service +='</td><td>' + (data.urgence == 1) ? "Oui":"Non" +'</td></tr>';
               
                $('#serivesTable' +' tbody').append(service);

                $('#ajaxPart').html("");
            }
      });  
  });
});

</script>