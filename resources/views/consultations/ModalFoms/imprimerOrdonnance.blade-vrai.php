<div id="ordonnacePDF" class="modal modal fade" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog  modaldialog" >
      <div class="modal-content contmodal">
           <div class="modal-header">
                 <div class="pull-left">
                   <h4 class="modal-title" id="myModalLabel"><strong>Imprimer Ordonnance</strong></h4>
                 </div>
                <div class="pull-right">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               </div>
                <br>
           </div>
          <div class="modal-body" id ="demo">
                  <div class="row text-center" >
                            <h4><span>DIRECTION GENERAL DE LA SURETE NATIONALE</span></h4>
                         <h4><span>HOPITAL CENTRAL DE LA SÛRETE NATIONALE "LES GLYCINES"</span></h4>
                         <h5><span>12, Chemin des Glycines - ALGER</span></h5>
                         <h5><span>Tél : 23-93-34 - 23-93-58</span></h5> 
                    </div>
                   <div class="row" >
                        <div class="col-sm-12 text-center" style="text-align: center;">
                            {{-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ asset('/img/logo-40_x_40.png') }}" alt="Example Image" class="img-responsive" /> --}}
                          <img class="center-block" src="{{ asset('/img/logo-40_x_40.png') }}" alt="xxx">
                        </div>
                    </div>
              {{-- <div class="row">
                 <iframe id="ordpdf" class="preview-pane" type="application/pdf" frameborder="0" style="width:800px;position:relative;z-index:999;"></iframe>
              </div> --}}
            
        </div>
        <div class="modal-footer" style="width:100%"> 
         <button type="button" id = "pdfDownloader" class="btn btn-success btn-xs" onclick ="printOrd();">
                    <i class="ace-icon fa fa-print"></i>print PDF
            </button>
        </div>
        </div>  
 </div>
 </div>

 