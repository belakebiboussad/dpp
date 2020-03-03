<!DOCTYPE html>
<html>
  <head>
    <title hide> Ordonnance</title> 
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}"/>
    <script src="{{asset('/js/bootstrap.min.js')}}"></script>
    <style>
      .print {
         display:none
      }
      @media print {
        .print {display:block}
        .btn-print {display:none;}
      }
      @page { size: auto;  margin: 0mm; }
    </style>
</head>
<body>
  
  <div class="row">
    <button  onclick="javascript:window.print()" class="btn btn-primary btn-xs btn-print" style="float:right;">
      <strong>Imprimer</strong>
    </button>
  </div>
  <div class="container  center">  
      <div class="space-12"></div>
      <div class="row" center>
        <div class="col-sm-4">
          <div class="row">
            <div class="col-sm-12">
              <div class="content" style="text-align:center;">
                <span class="with-margin">DIRECTION GENERAL DE LA SURETE NATIONALE</span>
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
        <div class="col-sm-4">
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
      <hr>
      <div class="row" style="text-align:center;" >
        <h1>Ordonnance</h1>
      </div>
       <div class="row">
          <div class="float-right">
            <span> Fait le:</span>
          </div>
       </div>
    </div>
    
    </body>
    </html>