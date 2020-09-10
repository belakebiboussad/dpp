@extends('app')
@section('title')
hospitalisations
@endsection
@section('style')
<style>
</style>
@endsection
@section('page-script')
<script>
$('document').ready(function(){
    jQuery('.cloturerHosp').click(function () {
      $('#dialog').modal('show');
        $('#timepicker1').timepicker();
    })
 });
</script>
@endsection
@section('main-content')
<div class="page-header">
    <h1>
      <strong>Liste des Hospitalisations :</strong>
    </h1>
  </div><!-- /.page-header -->
  <div class="row">
        <div class="col-sm-12"> 
          <a data-toggle="modal" title="Clôturer Hospitalisation" class="cloturerHosp btn btn-primary btn-xs" href="#"><i class="fa fa-sign-out" aria-hidden="true"></i>Add</a>
        </div>
  </div>
  <div class="row">
    <!-- debut -->
<div class="modal fade" id="dialog" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">close</button>
                <h4 class="modal-title" id="myModalLabel">New Event</h4>
            </div>
            <div class="modal-body">
                <div class="input-append bootstrap-timepicker">
                    <input id="timepicker1" type="text" class="input-small">
                    <span class="add-on"><i class="icon-time"></i></span>
                </div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
  <!-- end -->
  </div>

 
@endsection
