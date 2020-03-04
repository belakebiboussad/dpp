<html>
	<head>
	  <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}"/>
       <style>
       	.mt-2 {
 					 margin-top: -2px !important;
				}
				.mt-3 {
 				  margin-top: +5px !important;
				}
				.mt-30 {
					margin-top: -40px;	
				}
	      .print {
	         display:none;
	      }
	      .mr-12 {
	      	margin-right: 12px;
	      }
	      @media print {
	        .print {display:block}
	        .btn-print {display:none;}
	      }
	      .ml-80{
	      	margin-left:80%;
	      }
	      .ml-2{
	      	margin-left:2%;
	      }
	      @page { size: auto;  margin: 0mm; }
    </style>
	</head>
	<body>
		<div class="row">
			<div class="col-sm-12">
	  	  <button  onclick="javascript:window.print()" class="btn btn-primary btn-xs btn-print mr-12" style="float:right;">
	    		 <i class="ace-icon fa fa-print"></i>Imprimer
	    	</button>
    	</div>
  	</div>
  	<div class="container  center">
    	<div class="row mt-3">
        <div class="col-sm-12">
          <div class="content text-center">
            <h4><strong>DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</strong></h4>
          </div>
        </div>
      </div>
      <div class="row m-2">
        <div class="col-sm-12">
          <div class="content text-center">
            <h5 class="mt-2"><b>ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE</b></h5>
          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-sm-12 text-center"> 
          <h5 class="mt-2"><strong> Chemin des Glycines - ALGER</strong></h5>
        </div>
       </div>
      <div class="row mt-2">
          <div class="col-sm-12 text-center">
              <h5 class="mt-2"><strong>Tél : 023-93-34</strong></h5>
          </div>
      </div>
      <div class="row m-2">
        <div class="col-sm-12 text-center">
          <span class="border border-0"><img  src="{{asset('/img/logo.png')}}" width="60" height="60" alt=""></span>
        </div>
      </div>
     <!--  <hr class="mt-30"> -->
      <div class="row text-center">
        <h3><strong>Ordonnance</strong></h3>
      </div>
      <div class="row">
        <div class="ml-80">
          <span><strong>Fait le :&nbsp;</strong>{{ Carbon\Carbon::today()->format('Y-m-d') }}</span>
        </div> 
      </div>  
      <div class="space-12"></div>
      <div class="space-12"></div>
      <br><br><br>
      <div class="row ml-2">
	     	<div class="col-sm-12 ">
	      	<span><strong>Patient(e) :&nbsp; </strong></span>{{ $patient->getCivilite()}} {{ $patient->Nom }} {{ $patient->Prenom }}., {{ $patient->getAge()}} <span>ans</span>,{{ $patient->Sexe }} 
			  </div>
			</div>		
	    <br>
	    <div class="row ml-2">
	    	<div class="col-sm-12 ">
	      	<img src="data:image/png;base64,{{DNS1D::getBarcodePNG($patient->code_barre, 'C128')}}" alt="barcode" />
	    	</div>	
	    </div>
      </div>
      <div class="row">
      	<!-- Bonjour -->
      </div>
    </div>
    
	</body>
</html>