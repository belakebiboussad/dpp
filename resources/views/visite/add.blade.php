@extends('app')
@section('style')
<style type="text/css" media="screen">
  * {
      padding: 0;
      margin: 0;
    }
 .inputClass {
    padding: 0;
    display: inline-block;
  }
}
</style>
@endsection
@section('page-script')
  @include('examenradio.scripts.imgRequestdJS')
  @include('visite.scripts.scripts')
  <script type="text/javascript">
  function constChanged(cb)
  { 
    $("#"+ $(cb).data("id")).val('');
    if(cb.checked)
    {
      if($("#"+ $(cb).data("id")).prop('disabled') == true)
         $("#"+ $(cb).data("id")).prop('disabled',false);
      $("#"+ $(cb).data("id")).removeClass('hidden');
    }
    else
    {
      if($("#"+ $(cb).data("id")).prop('disabled') == false)
        $("#"+ $(cb).data("id")).prop('disabled',true);
      $("#"+ $(cb).data("id")).addClass('hidden');
    } 
  }
  $(function(){
      imgToBase64("{{ asset('/img/entete.jpg') }}", function(base64) {
               base64Img = base64; 
        });
        imgToBase64("{{ asset('/img/footer.jpg') }}", function(base64) {
             footer64Img = base64; 
       }); 
        $('#listActes').DataTable({
    processing: true,
    ordering: true,
    bInfo : false,
    searching: false,
    bLengthChange: false,
    "info":     false,
    bLengthChange: false,
    'aoColumnDefs': [{
      'bSortable': false,
      'aTargets': ['nosort'],
    }],
    'language': {
           "url": '/localisation/fr_FR.json',
         },
   });
  $('#listTraits').DataTable({
    processing: true,
    ordering: true,
    bInfo : false,
    searching: false,
    bLengthChange: false,
    "info":     false,
    'aoColumnDefs': [{
      'bSortable': false,
      'aTargets': ['nosort']
    }],
    'language': {
             "url": '/localisation/fr_FR.json',
         },
  });
  $('td.dataTables_empty').html('');
  $('#btn-addActe').click(function () {
    $('#EnregistrerActe').val("add");
    $('#addActe').trigger("reset");
    $('#acteCrudModal').html("Prescrire un Acte Médicale");
    $('#acteModal').modal('show');
  });  
    $("#EnregistrerActe").click(function (e) {
      e.preventDefault();//var periodes = [];
      if(! isEmpty($("#acte").val()) || ($("#acte").val() == ''))
        $('#acteModal').modal('toggle'); 
      var formData = {
          _token: CSRF_TOKEN,
          id_visite: $('#id').val(),
          nom:$("#acte").val(),
          type:$('#type').val(),
          code_ngap:$('#code_ngap').val(),
          description:$('#description').val(),
          nbrFJ : $('#nbrFJ').val()
      };
      var type = "POST";
      var url ='{{ route("acte.store") }}';
      var state = jQuery('#EnregistrerActe').val();
      if (state == "update") {
        type = "PUT";//var id = jQuery('#acte_id').val();
        url = '{{ route("acte.update", ":slug") }}'; 
        url = url.replace(':slug', $('#acte_id').val());
      }
      $.ajax({
        type:type,
        url:url,
        data: formData,
        dataType:'json',
        success: function (data) {
          if($('.dataTables_empty').length > 0)
            $('.dataTables_empty').remove();
          var acte = '<tr id="acte'+data.id+'"><td hidden>' + data.id_visite + '</td><td>'+data.nom + '</td><td>' +data.type + '</td><td>' + data.code_ngap + '</td><td>' + data.description + '</td><td>' + data.visite.medecin.full_name +'</td><td class ="center"><button type="button" class="btn btn-xs btn-info open-modal" value="' + data.id+'"><i class="fa fa-edit fa-xs"></i></button><button type="button" class="btn btn-xs btn-danger delete-acte" value="' + data.id +'" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></btton></td></tr>' ;
          if (state == "add")
            $( "#listActes" ).append(acte);
          else
            $("#acte" + data.id).replaceWith(acte);
          $('#acteModal form')[0].reset(); 
        }
      });
    });///edit acte
    $('body').on('click', '.open-modal', function () {
      $.get('/acte/'+ $(this).val() +'/edit', function (data) {
        $('#EnregistrerActe').val("update");$('#acteCrudModal').html("Editer un Acte Médical");
        $('#acte_id').val(data.id); $('#acte').val(data.nom);
        $('#type').val(data.type).change();$('#code_ngap').val(data.code_ngap).change();
        $('#nbrFJ').val(data.nbrFJ).change();
        $('#description').val(data.description);
        jQuery('#EnregistrerActe').val("update");   
       jQuery('#acteModal').modal('show');
      });
    });
    jQuery('body').on('click', '.delete-acte', function () {
        var id = $(this).val();
        url='{{ route("acte.destroy",":slug") }}';
        url = url.replace(':slug',id);
        $.ajax({
          type: "DELETE",
          url: url,
          data: { _token: CSRF_TOKEN },
          success: function (data) {
            $("#acte" + id).remove();
          }
        });
     });  //end of add acte
    $('#btn-addTrait').click(function () {///////////add trait
      $('#EnregistrerTrait').val("add");
      $('#traitModal').trigger("reset");
      $('#TraitCrudModal').html("Prescrire un traitement");
      $('#traitModal').modal('show');
  });  
  $("#EnregistrerTrait").click(function (e) {
    e.preventDefault();
    var periodes = [];
    if(! isEmpty($("#med_id").val()) || ($("#med_id$").val() == 0) )
      $('#traitModal').modal('toggle');
     var formData = {
      _token: CSRF_TOKEN,
      visite_id: $('#id').val(),
      med_id:$("#med_id").val(),
      posologie:$("#posologie").val(),/*periodes :periodes,*/
      nbrPJ : $('#nbrPJ').val(),
      duree : $('#dureeT').val()
    };
    var state = jQuery('#EnregistrerTrait').val();
    var type = "POST", url='{{ route("traitement.store") }}';
    if(state == "update") {
      type = "PUT";
      var id = jQuery('#trait_id').val();
      url = '{{ route("traitement.update", ":slug") }}'; 
      url = url.replace(':slug', id);
    }
    $.ajax({
      type:type,
      url:url,
      data: formData,
      dataType:'json',
      success: function (data) {  
        if($('.dataTables_empty').length > 0)
          $('.dataTables_empty').remove();
        var trait = '<tr id="trait'+data.id+'"><td hidden>'+data.visite_id+'</td><td>'+data.medicament.nom+'</td><td>'+data.posologie+'</td><td>'+data.visite.medecin.full_name+'</td><td class ="center"><button type="button" class="btn btn-xs btn-info edit-trait" value="'+data.id+'"><i class="fa fa-edit fa-xs" aria-hidden="true"></i></button><button type="button" class="btn btn-xs btn-danger delete-Trait" value="'+data.id+'" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></btton></td></tr>';
        if (state == "add")
          $( "#listTraits" ).append(trait);
        else
          $("#trait" + data.id).replaceWith(trait);
        $('#traitModal form')[0].reset();
      }
    });
  });
  $('body').on('click', '.edit-trait', function () {//edit traitement
        $.get('/traitement/' +$(this).val()+ '/edit', function (data) {
            getProducts(1,data.medicament.id_specialite,data.med_id);
            $('#trait_id').val(data.id);
            $("#med_id").removeAttr("disabled");
            $('#TraitCrudModal').html("Modifier le Traitement Médical");    
            $('#specialiteProd').val(data.medicament.id_specialite);
            $('#posologie').val(data.posologie);
            $('#nbrPJ').val(data.nbrPJ);
            $('#dureeT').val(data.duree);
            jQuery('#EnregistrerTrait').val("update");    
            jQuery('#traitModal').modal('show');
        });
  });////----- DELETE a Traitement and remove from the tabele -----////
  jQuery('body').on('click', '.delete-Trait', function () {
    var id = $(this).val();
    $.ajax({
      type: "DELETE",
      url: '/traitement/' + id,
      data :{
        "id": id,
        "_token": CSRF_TOKEN,
      },
      success: function (data) {
        $("#trait" + id).remove();
      },
      error: function (data) {
       console.log('Error:', data);
      }
    });
     }); //////////Traitement
    $("#visiteForm").submit(function(e){
      if ($( "#ExamsImg" ).length )
        addExamsImg(this);
    });
  });
</script>
@endsection
@section('main-content')
<div class="container-fluid">
<div class="row"><div class="col-sm-12">@include('patient._patientInfo',['patient'=>$obj->patient])</div></div>
<div class="content">
  <form id ="visiteForm" action="{{ route('visites.store') }}" method="POST" role="form">
     {{ csrf_field() }}
    <input type="hidden" name="id" id="id" value="{{$obj->id}}">
    <div id="prompt"></div>
    <div class="tabpanel mb-3">
      <div class="row">
        <ul class = "nav nav-pills nav-justified list-group" role="tablist" id="menu">
        <li role= "presentation" class="active col-md-4">
          <a href="#Actes" aria-controls="Actes" role="tab" data-toggle="tab" class="btn btn-success">
            <span class ="medical medical-icon-immunizations" aria-hidden="true"></span><span class="bigger-160"> Actes</span></a>
        </li>
        <li role= "presentation" class="col-md-4">
          <a href="#Trait" aria-controls="Trait" role="tab" data-toggle="tab" class="btn btn-primary">
            <span class ="medical medical-icon-health-services" aria-hidden="true"></span>
            <span class="bigger-160">Traitements</span></a>
        </li>
        <li role= "presentation" class="col-md-4">
            <a href="#ExamComp" aria-controls="ExamComp" role="tab" data-toggle="tab" class="btn btn-danger"><span class ="medical medical-icon-i-imaging-root-category"></span><span class="bigger-160">Examens Complémentaires</span></a>
        </li>
        <li role= "presentation" class="col-md-4">
          <a href="#constantes" aria-controls="" role="tab" data-toggle="tab" class="btn btn-warning">
            <span class ="medical medical-icon-i-imaging-root-category"></span><span class="bigger-160">Constantes</span></a>
        </li>
        </ul>
      </div>
      <div class="row">
        <div class ="tab-content no-border">
          <div role="tabpanel" class ="tab-pane active " id="Actes"> 
            <div class= "widget-box widget-color-green">
              <div class="widget-header">
              <h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i> Actes</h5>
              <div class="widget-toolbar widget-toolbar-light no-border" width="20%">
                <div class="fa fa-plus-circle"></div>
                <a href="#" id="btn-addActe" class="btn-xs tooltip-link"> Acte Médical</a>  
              </div>
              </div>
              <div class="widget-body" id ="ConsigneWidget">
              <div class="widget-main no-padding">
              <table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="listActes">
              <thead class="thin-border-bottom">
                <tr class ="center">
                  <th class ="hidden"></th><th class ="center sorting_disabled">Acte</th>
                  <th class ="center sorting_disabled">Type</th>
                  <th class ="center sorting_disabled">Code NGAP</th>
                  <th class ="center sorting_disabled">Application</th>
                  <th class ="center sorting_disabled">Médecin prescripteur</th>                      
                  <th class=" center nosort"><em class="fa fa-cog"></em></th>
                </tr>
              </thead>
              <tbody>
              @foreach($obj->hospitalisation->visites as $visite)
                @foreach($visite->actes as $acte )
                @if(!$acte->retire)
                <tr id="{{ 'acte'.$acte->id }}">
                  <td hidden> {{ $acte->id_visite }}</td><td> {{ $acte->nom }}</td><td> {{ $acte->type}}</td><td> {{ $acte->code_ngap}}</td><td> {{ $acte->description }}</td>
                  <td> {{ $acte->visite->medecin->full_name}}</td>
                  <td class="center nosort">
                    <button type="button" class="btn btn-xs btn-info open-modal" value="{{$acte->id}}"><i class="fa fa-edit fa-xs" aria-hidden="true"></i></button>
                    <button type="button" class="btn btn-xs btn-danger delete-acte" value="{{$acte->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button>
                  </td> 
                </tr>
                @endif
                @endforeach
              @endforeach
              </tbody>
            </table>
            </div><!-- widget-main -->
            </div><!-- widget-body -->
            </div><!-- widget-box -->
          </div><!-- actes  -->
          <div role="tabpanel" class ="tab-pane" id="Trait">
          <div class= "widget-box widget-color-blue">
            <div class="widget-header" >
              <h5 class="widget-title lighter"><i class="ace-icon fa fa-table"></i> Traitements</h5>
              <div class="widget-toolbar widget-toolbar-light no-border" width="20%">
                <div class="fa fa-plus-circle"></div>
                <a href="#" id="btn-addTrait" class="btn-xs tooltip-link"> Traitement</a>
              </div>
            </div>
            <div class="widget-body" id ="TraitementWidget">
              <div class="widget-main no-padding">
              <table class="table nowrap dataTable table-bordered no-footer table-condensed table-scrollable" id="listTraits">
                <thead class="thin-border-bottom">
                  <tr class ="center">
                    <th class ="hidden"></th>
                    <th class ="center sorting_disabled">Nom médicament</th>
                    <th class ="center sorting_disabled">Posologie</th> 
                    <th class ="center sorting_disabled">Médecin prescripteur</th> 
                    <th class=" center sorting_disabled"><em class="fa fa-cog"></em></th>
                  </tr>
                </thead>
                <tbody>
                @foreach($obj->hospitalisation->visites as $visite)
                  @foreach($visite->traitements as $trait)
                  <tr id="{{ 'trait'.$trait->id }}">
                    <td hidden> {{ $trait->visite_id }}</td><td>{{ $trait->medicament['nom'] }}</td> 
                    <td> {{ $trait->posologie}}</td><td>{{ $trait->visite->medecin->full_name}}</td>
                    <td class="center nosort">
                      <button type="button" class="btn btn-xs btn-info edit-trait" value="{{ $trait->id }}"><i class="fa fa-edit fa-xs" aria-hidden="true"></i></button>
                      <button type="button" class="btn btn-xs btn-danger delete-Trait" value="{{ $trait->id }}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button>
                    </td> 
                  </tr>
                  @endforeach
                @endforeach
                </tbody>
              </table>
              </div>
            </div><!-- widget-body -->
          </div><!-- widget-box -->
          </div><!-- Trait -->
          <div role="tabpanel" class ="tab-pane" id="ExamComp">@include('ExamenCompl.index')</div>
      
        <div role="tabpanel" class ="tab-pane" id="constantes"> 
          <table role="presentation" class="table table-striped accordion-users">
            <tbody class="files">
            @foreach($specialite->Consts as $const)
            <tr class="template-upload fade in">
              <td width="5%">
              <div class="checkbox">
                <label>
                @if((!is_null($lastVisite)) && (!is_null($lastVisite->constantes)))
                  <input name="consts[]" type="checkbox"  class="ace constante" value="{{ $const->id }}" data-id="{{ $const->id }}" onchange="constChanged(this)" @if(in_array($const->id,$lastVisite->constantes->pluck('id')->toArray())) checked="checked" @endif/>
                @else
                  <input name="consts[]" type="checkbox" class="ace constante" value="{{ $const->id }}" data-id="{{ $const->id }}"  onchange="constChanged(this)"/>
                @endif
                <span class="lbl"> {{ $const->nom }}</span>
                </label>
              </div>
              </td>
              <td>
                @if((!is_null($lastVisite)) && (!is_null($lastVisite->constantes)))
<textarea class="form-control inputClass {{ (in_array($const->id,$lastVisite->constantes->pluck('id')->toArray()))?'':'hidden'}}" name="obs[]" id="{{ $const->id }}" name="obs[]" id="{{ $const->id }}" {{ (in_array($const->id,$lastVisite->constantes->pluck("id")->toArray())) ? "":"disabled"}}>{{ ($lastVisite->constantes->find($const->id))['pivot']['obs'] }}</textarea>
                @else
                <textarea class="form-control inputClass hidden" name="obs[]" id="{{ $const->id }}" disabled></textarea>
                   
                 
                @endif
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
        </div>
        </div>
         </div><!-- tab-content -->
       </div><!-- row -->
       <div class="hr hr-dotted"></div>
      <div class="center">
        <button type="submit" class="btn btn-info btn-sm" ><i class="ace-icon fa fa-save bigger-110"></i>Enregistrer</button> 
          <a href="{{ route('visites.destroy',$obj->id) }}" data-method="DELETE" class="btn btn-sm btn-warning"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</a>    
      </div>
   
    </div><!-- tabpanel -->
  </form>
    <div class="row">@include('visite.ModalFoms.acteModal')</div><div class="row">@include('visite.ModalFoms.TraitModal')</div>
  <div class="row"><div id="bioExamsPdf" class="invisible b"> @include('consultations.EtatsSortie.demandeExamensBioPDF')</div></div>
  <div class="row"><div id="imagExamsPdf" class="invisible">@include('consultations.EtatsSortie.demandeExamensImgPDF')</div></div>
       <div class="row text-center">@include('examenradio.ModalFoms.crrPrint')</div>
</div><!-- content -->
</div>
@endsection