@extends('app_radiologue')
@section('page-script')
<script src="{{asset('/js/jquery.min.js')}}"></script>
<script>
  $('document').ready(function(){//$("button").click(function (event) {which = '';str ='send';which = $(this).attr("id");var which = $.trim(which);var str = $.trim(str);if(which==str){ return true;}});
    $('.result').change(function() {
        var res = $(this).attr('id').replace("exm", "btn");
        if($(this).val())
          $('#'+res).removeAttr('disabled'); 
        else
          $('#'+res).attr('disabled', 'disabled');
    })
    $(".start").click( function(){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });
      var formData = new FormData();
      let TotalFiles = $("#exm-" + $(this).val())[0].files.length;//Total files
      let files = $("#exm-" + $(this).val())[0];
      for (let i = 0; i < TotalFiles; i++) {
        formData.append('files' + i, files.files[i]);
      }
      formData.append('TotalFiles', TotalFiles);
      formData.append('id_demandeexr', $('#id_demandeexr').val());
      formData.append('id_examenradio',$(this).val());
      $.ajax({
        type:'POST',
        url: "{{ url('store-file')}}",
        data: formData,
        enctype: 'multipart/form-data',// cache:false, 
        contentType: false, 
        processData: false,
        dataType : 'json', 
        success: (data) => {
          $.each(data,function(key,value) {
            $('#'+value).remove();
          });
        },
        error: function(data){
          console.log(data);
        }
      });
    });
   $(".cancel").click( function(){
        Swal.fire({
                     title: 'Annulez vous  la demande d\'Examen ?',
                     html: '<br/><h4><strong id="dateRendezVous">'+'Pourquoi?'+'</strong></h4>',
                     input: 'textarea',
                     inputPlaceholder: 'la cause d\'annulation du l\'examen',
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: 'Oui',
                     cancelButtonText: "Non",
        }).then((result) => {
                })
   });
  });
</script>
@endsection
@section('main-content')
<div class="content">
<div class="row" width="100%">@include('patient._patientInfo')</div>
<div class="space-12"></div>
<div class="row">
  <div class="col-sm-12 col-xs-12 widget-container-col">
    <div class="widget-box">
      <div class="widget-header"><h5 class="widget-title"><b>Détails de la demande d'examens radiologique :</b></h5></div>
      <div class="widget-body">
        <div class="widget-main">
          <div class="row">
            <div class="col-xs-12">
              <input type="hidden" id ="id_demandeexr" value="{{ $demande->id }}">
              <label><b>Date :</b></label>&nbsp;&nbsp;<span>
                @if(isset($demande->consultation))
                  {{ $demande->consultation->Date_Consultation }}
                @else
                  {{ $demande->visite->date }}
                @endif 
              </span><br><br>
              <label><b>Informations cliniques pertinentes :</b></label> &nbsp;&nbsp;<span>{{ $demande->InfosCliniques }}.</span>
              <br><br>
              <label><b>Explication de la demande de diagnostic :</b></label>&nbsp;&nbsp;<span>{{ $demande->Explecations }}.</span>
              <br><br><label><b>Informations supplémentaires pertinentes :</b></label>
              <div>
                <ul class="list-inline"> 
                @foreach($demande->infossuppdemande as $index => $info)
                    <li class="active"><span class="badge badge-warning">{{ $info->nom }}</span></li>
                 @endforeach
                </ul>    
              </div><br>
              <label><b>Examen(s) pertinent(s) précédent(s) relatif(s) à la demande de diagnostic :</b></label>
              <div>
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="center" width="10%">#</th>
                    <th>Nom</th>
                    <th class="center"><strong>Type</strong></th>
                    <th class="center"><strong>Attacher le Résultat</strong></th>
                    <td class="center" width="15%"><em class="fa fa-cog"></em></td>
                  </tr>
                </thead>
                <tbody>
                   @foreach ($demande->examensradios as $index => $examen)
                    @if($examen->pivot->etat === null)
                    <tr id = "{{ $examen->id }}">
                      <td class="center">{{ $index + 1 }}</td>
                      <td>{{ $examen->nom }}</td>
                      <td>
                        <?php $exams = explode (',',$examen->pivot->examsRelatif) ?>
                        @foreach($exams as $id)
                        <span class="badge badge-success">{{ App\modeles\exmnsrelatifdemande::FindOrFail($id)->nom}}</span>
                        @endforeach
                      </td>
                      <td>
                        @if(Auth::user()->role->id == 12)
                          <input type="file" id="exm-{{ $examen->id }}" name="resultat[]" class="form-control result" accept="image/*,.pdf,.dcm" multiple required/>
                        @endif
                      </td>
                      <td class="center" width="15%">
                       <!--  <form method="POST" enctype="multipart/form-data" id="ajax-file-upload" action="javascript:void(0)" > -->
                          <button  type="submit" class="btn btn-sm btn-primary start" id="btn-{{ $examen->id }}" value ="{{ $examen->id }}" disabled>
                            <i class="glyphicon glyphicon-upload glyphicon glyphicon-white"></i>
                          </button>
                          <button class="btn btn-sm btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle glyphicon glyphicon-white"></i>
                          </button>
                        <!-- </form> -->
                      </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
              </table>
              </div>
              @if(Auth::user()->role->id == 12)
              <div class="space-12"></div>
              <div class="row">
                <div class="col-sm-12">
                  <form class="form-horizontal" method="POST" action="/uploadexr" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <input type="text" name="id_demande" value="{{ $demande->id }}" hidden>
                    <div class="clearfix form-actions">
                    <div class="col-md-offset-5 col-md-7">
                      <button class="btn btn-info" type="submit"><i class="ace-icon fa fa-save bigger-110"></i>&nbsp;Enregistrer</button>
                      <a class="btn btn-warning" href="{{ URL::previous() }}"><i class="ace-icon fa fa-undo bigger-110"></i>Annuler</a>
                    </div>
                  </div>
                  </form>
                </div>
              </div>
              @endif
            </div>               
            </div>
          </div>
          </div>
        </div>
    </div>
  </div>  
</div>
@endsection