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
                    {{--     <div id="calendar"></div> --}}                
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
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="myModalLabel">Modifier Rendez-Vous</h4>
     </div>
      <div class="modal-body">
                  A demo of changing the width of modal window <br />
                  For that, the width is specified in the modal-dialog class <br />
                 The header is also customzied.
      </div>
 
      <div class="modal-footer center">
 
        <button type="button" class="btn btn btn-primary" data-dismiss="modal"><i class="fa fa-file-text" aria-hidden="true"></i> Consulter</button>
 
        <button type="button" class="btn btn btn-info" data-dismiss="modal">
       <i class="ace-icon fa fa-save bigger-110"></i> Enregistrer</button>
 
        <button type="button" class="btn btn-danger" data-dismiss="modal">
          <i class="fa fa-times" aria-hidden="true"></i> Annuler</button>
      </div>
    </div>
  </div>
</div>{{-- modal --}}
@endsection
@section('page-script')
{!! $planning->script() !!}
    <script>
          function  showModal(id) {
              alert(id)
             $('#myModal').modal({
             show: 'true'
    }); 
          }
    </script>
 @endsection