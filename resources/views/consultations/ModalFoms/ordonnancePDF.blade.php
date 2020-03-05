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
          .mt-10{
              margin-top:-10px;
          }
		.mt-40 {
				margin-top: -40px;	
		}
          .ml-80{
              margin-left: +80%;
          }
          .mr-12 {
                 margin-right: +12px;
           }
          /*#foo   {   position: fixed;     bottom: 50;         right: 100;      }*/
          #foo
          {
              position: absolute;
              top: 93%;
              right: 20%;
          }
	      .print {
	         display:none;
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
			<div class="col-sm-12">
	       	     <button  onclick="javascript:window.print();" class="btn btn-primary btn-xs btn-print" data-dismiss="modal" style="float:right;">
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
                <div class="row mt-10">
                    <div class="col-sm-12 text-center">
                      <span class="border border-0"><img  src="{{asset('/img/logo-60_x_60.png')}}" alt=""></span>
                      <br>
                      <span style="font-size: xx-large;"><strong>Ordonnance</strong></span>
                    </div>
                </div>
                <div class="row">
                  <div class="ml-80">
                    <span  class="medium"><strong>Fait le :&nbsp;</strong>{{ Carbon\Carbon::today()->format('Y-m-d') }}</span>
                  </div> 
                </div>  
                <br><br><br>
                <div class="row ml-2">
            	     	<div class="col-sm-12 ">
            	      	<span  class="medium"><strong>Patient(e) :&nbsp; </strong></span>{{ $patient->getCivilite()}} {{ $patient->Nom }} {{ $patient->Prenom }}., {{ $patient->getAge()}} <span>ans</span>,{{ $patient->Sexe }} 
            	          </div>
            	</div>		
	           <br>
            	 <div class="row ml-2">
            	    	<div class="col-sm-12 ">
            	      <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($patient->code_barre, 'C128')}}" alt="barcode" />
                      <br>
                     {{ $patient->code_barre }}
            	    	</div>	
            	 </div>
               <br><br><br>    
                @for ($i = 0; $i < count($medicaments); $i++)
                <div class="row ml-2">
                    <div class="col-sm-12 ">
                           <span class="medium"><strong>{{ $medicaments[$i]->Nom_com }}  {{ $medicaments[$i]->Forme }} {{ $medicaments[$i]->Dosage }}</strong></span> 
                           <br>
                           <span>{{ $posologies[$i] }}</span>
                           <br><br>
                    </div>
                </div>
              @endfor
             <div id ="foo" class="row">
                     <div class="col-sm-12">
                            <span class="medium"><strong> Docteur :</strong>{{ $employe->Nom_Employe}} {{ $employe->Prenom_Employe}}</span>
                     </div>
             </div>
          </div>
	</body>
</html>