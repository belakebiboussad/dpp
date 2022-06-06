@extends('app')
@section('title','Nouvelle Consultation')
@section('style')
<style type="text/css" media="screen">
  .ghost {
        display:none !important;
  }
  .btnNext {
    float:right;
  }
  
</style>
@endsection
@section('page-script')
  <script type="text/javascript">
    $(function(){ // $(".nav-tabs a:nth-child(2)").tab("show"); 
      $('.btnNext').one('click', function () {
        $('.active').next().removeClass('ghost');
      });
    });
    $(function () {
      $('#myTab a:last').tab('show');
    });
    $(function () {   
        $('.btnNext').click(function(){
          $('.nav-pills > .active').next('li').find('a').trigger('click');
        });
        $('.btnPrevious').click(function(){
          $('.nav-pills > .active').prev('li').find('a').trigger('click');
        });
      });
    </script>
@endsection
@section('main-content')
<div class="container-fluid">
  <div class="row"><div class="col-sm-12">@include('patient._patientInfo')</div></div>
  <div class="tabpanel">
  <ul class="nav nav-pills nav-justified list-group" role="tablist">
      <li class="active">
        <a href="#Interogatoire" aria-controls="Interogatoire" role="tab" data-toggle="tab" class="btn btn-secondary btn-lg">
         <span class="bigger-160" style="font-size:10vw">Interrogatoire</span>
        </a>
      </li>
      <li class="ghost">
        <a href="#ExamClinique" aria-controls="ExamClinique" role="tab" data-toggle="tab" class="btn btn-success btn-lg">
        <span class="bigger-160" style="font-size:10vw">Examens Cliniques</span></a>
      </li>
      <li class="ghost">
        <a href="#ExamComp" aria-controls="ExamComp" role="tab" data-toggle="tab" class="btn btn-danger btn-lg">
          <span class="bigger-160" style="font-size:10vw">Examens Complémentaires</span>
        </a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade in active" id="Interogatoire">
        @include('consultations.Interogatoire')
        <a class="btn btn-primary btnNext">Next</a>
      </div>
      <div class="tab-pane fade" id="ExamClinique">
        <p>
        Quantities, numbers and stuff
        </p>
            <a class="btn btn-primary btnNext">Next</a>
            <a class="btn btn-primary btnPrevious">Previous</a>
      </div>
      <div class="tab-pane fade" id="ExamComp">
        <p>
        This is useless
        </p>
            <a class="btn btn-primary btnPrevious">Previous</a>
      </div>
    </div> 
  </div>
</div>
@endsection
