<div class="widget-box">
  <div class="widget-header">
    <h5 class="widget-title">Demande d'examen radiologique</h5>
  </div>
  <div class="widget-body">
    <div class="widget-main">
      <div class="form-group">
        <label for="control-label">Informations cliniques pertinentes</label>
        <textarea class="form-control" id="infosc" name="infosc"></textarea>
            {!! $errors->first('infosc', '<small class="alert-danger"><b>:message</b></small>')!!}
      </div>
      <div class="form-group">
        <label class="control-label">Explication de la demande de diagnostic</label>
        <textarea class="form-control" id="explication" name="explication"></textarea>
       {!! $errors->first('explication', '<small class="alert-danger"><b>:message</b></small>')!!}
      </div>
      <div class="form-group infosup">
        <label class="control-label">Informations supplémentaires pertinentes</label>
        <div class="input-group col-sm-12">
        @foreach ($infossupp as $info)
          <div class="checkbox col-sm-2"><label>
           <input name="infos[]" type="checkbox" class="" value="{{ $info->id }}" /><span class="lbl">{{ $info->nom }}</span></label>
          </div>
        @endforeach 
        </div>
      </div> 
      <div class="row">
        <div class="col-sm-12">
        <div class= "widget-box widget-color-blue">
         <div class="widget-header" >
          <h5 class="widget-title bigger"><i class="ace-icon fa fa-table"></i> Examens d'imagerie</h5>
          <div class="widget-toolbar widget-toolbar-light no-border" width="5%">
             <a href="#" class="align-middle" data-toggle="modal" data-target="#ExamIgtModal">
              <i class="fa fa-plus-circle bigger-180" data-toggle="modal"></i>
            </a>
          </div>
          </div><!-- widget-header -->
          <div class="widget-body">
          <div class="widget-main no-padding">
            <table class="table nowrap dataTable table-bordered no-footer table-condensed" id="ExamsImgtab">
              <thead class="">
                <tr>
                  <th class ="hidden"></th>
                  <th class ="center" class="nsort">Examen du</th>
                   <th class ="hidden"></th>
                  <th class ="center">Type d'examen</th>
                  <th class="center" width="7%"><em class="fa fa-cog"></em></th>
                </tr>
              </thead>
              <tbody id="ExamsImg"></tbody>
            </table>
          </div>
          </div>
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>
@include('ExamenCompl.ModalFoms.ExamenImgModal')   