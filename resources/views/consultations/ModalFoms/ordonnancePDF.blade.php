<!DOCTYPE html>
<html>
<head>
    <title hide> Ordonnance</title>
<style>
    .numberCircle {
        width: 45px;
        line-height: 45px;
        border-radius: 50%;
        text-align: center;
        font-size: 40px;
        border: 2px solid #666;
    }
    .print {
  display:none
}
 @media print {
  .print {display:block}
  .btn-print {display:none;}
}
</style>
</head>
<body>
      <div class="row">
             <button  onclick="javascript:window.print()" class="btn btn-primary btn-xs btn-print" style="float:right;">
                      <strong>Imprimer</strong>
                </button>
      </div>
        <div class="container  center">  
  <div class="row" center>
    <div class="col-sm-4">
      <div class="row">
          <div class="col-sm-12">
                <div class="content" style="text-align:center;">
                     <span class="with-margin" style="text-align:center;">DIRECTION GENERAL DE LA SURETE NATIONALE</span>
                </div>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-12">
                <div class="content" style="text-align:center;">
                      <span class="with-margin" style="text-align:center;">HOPITAL CENTRAL DE LA SURETE NATIONAL "LES GLYCINES"</span>
                </div>
        </div>
      </div>
      </div>
     <div class="col-sm-4 center">
          <div class="row">
                <div class="col-sm-12">
                     <div class="content with-margin" style="text-align:center;">
                          <span class="with-margin" style="text-align:center;">Chemin des Glycines - ALGER</span>
                      </div>
                </div>
           </div>
          <div class="row center ">
          <div class="col-sm-12 center">
                <div class="content center" style="text-align:center;" >
                      <span class="with-margin" style="text-align:center;">Tél : 23-93-34</span>
                </div>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="row">
          <div class="col-sm-12">
                <div class="content" style="text-align:center;">
                      <span class="border border-0"><img  src="{{asset('/img/logo-60_x_60.png')}}" alt="">
                      </span>
                </div>
           </div>
      </div>
    </div>
    
  </div>
  
</div>
    </body>
    </html>