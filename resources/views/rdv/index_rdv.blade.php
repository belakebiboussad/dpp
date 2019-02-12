@extends('app_recep')
@section('style')
@endsection
@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
                   <div class="panel panel-default">
                   &nbsp;&nbsp;&nbsp;&nbsp; <div class="panel-heading" style="margin-top:-20px">
                    <div class="left"> <strong>Liste Des Rendez-Vous</strong></div>
                    <div class="right" style ="margin-top:-25px"><a href="/choixpatient" class ="btn btn-sm btn-success" class="right"><i class="ace-icon  fa fa-plus-circle bigger-120"></i>&nbsp;Rendez-vous</a></div>
                   
                   </div>
                  <div class="panel-body">
                            {!! $planning->calendar() !!}
                        {{-- <div id="calendar"></div>                 --}}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal --> 
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
     <div class="modal-dialog" role="document">
     <div class="modal-content">
     <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
          <h5 class="modal-title" id="myModalLabel">
              Modifier Rendez-Vous <q> <strong id="patient" class="blue"></strong></q>
           </h5>
           <hr>
           <div class="row">
                <div class="col-sm-6">    
                     <i class="fa fa-phone" aria-hidden="true"></i>tel:&nbsp;<span id="patient_tel" class="blue"></span>
                </div>
                <div class="col-sm-6">
                             Age:&nbsp;<span id="" class="blue"></span>
                </div>
              </div>
     </div>
      <div class="modal-body">
      {{-- {{route('rdv.update',5)}} /rdv/5--}}
           <form id ="updateRdv" role="form" action="" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="id_rdv" id ="id_rdv"/>
                <div class="row">
                      <label for="date"><b>Date Rendez-Vous :</b></label>
                      <div class="input-group">
                                <input class="form-control date-picker" id="daterdv" name="daterdv" type="text" data-date-format="yyyy-mm-dd" required />
                                 <span class="input-group-addon">
                                 <i class="fa fa-calendar bigger-110"></i>
                          </span>
                     </div>
                </div>
           </form>   
      </div>
 
      <div class="modal-footer center">
 
        <a type="button" class="btn btn btn-primary" href="" ><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</a>
 
        <button type="button" class="btn btn btn-info" onclick="envoie();">
       <i class="ace-icon fa fa-save bigger-110" ></i> Enregistrer</button>
          <button type="button" class="btn btn-warning">
          <i class="fa fa-undo" aria-hidden="true"></i> Annuler</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">
          <i class="fa fa-trash" aria-hidden="true"></i> Supprimer</button>
      </div>
    </div>
  </div>
</div>{{-- modal --}}
@endsection
@section('page-script')
{!! $planning->script() !!}
    <script>
          function  showModal(id,title,date,tel,age) {
                alert(age);
                var CurrentDate = (new Date()).setHours(0, 0, 0, 0);
                GivenDate = (new Date(date)).setHours(0, 0, 0, 0);;
                if( CurrentDate <= GivenDate )
                {
                     $('#patient').text(title);
                     $('#updateRdv').attr('action','/rdv/'.concat(id));
                     $("#id_rdv").val(id);
                      $('#patient_tel').text(tel);
                     $("#daterdv").val(date.format('Y-MM-DD'));
                     $('#myModal').modal({
                           show: 'true'
                     }); 
                }
          }

          function envoie()
          {
                $('form#updateRdv').submit();
          }
       </script>
 @endsection