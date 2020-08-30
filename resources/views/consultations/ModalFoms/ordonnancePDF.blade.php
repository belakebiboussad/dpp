<html>
	<head>
	  <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}"/>
    <link  rel="stylesheet" href="{{ asset('/css/styles.css') }}">
    <style>
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
  	<div class="container print center" >
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
            <h5 class="mt-2"><b>ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</b></h5>
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
          <span class="border border-0"><img  src="{{asset('/img/logo-59_x_59.png')}}" alt=""></span>
          <br>
          <span style="font-size: xx-large;"><strong>Ordonnance</strong></span>
        </div>
      </div>
        <div class="row">
          <div class="ml-80">
            <span class="large"><strong><u>Fait le</u> :&nbsp;</strong>{{ Carbon\Carbon::today()->format('Y-m-d') }}</span>
          </div> 
        </div>  
        <br><br><br>
        <div class="row ml-2">
          <div class="col-sm-12 ">
            <b><u>Patient(e) :</u></b><!-- <span class="large"><strong>Patient(e) :&nbsp; </strong></span> -->     
            <b>{{ $patient->getCivilite() }} </b>  {{ $patient->Nom }} {{ $patient->Prenom }}, {{ $patient->getAge()}} <span>ans</span>,{{ $patient->Sexe }} 
          </div>
        </div>
 	      <br>
        <div class="row ml-2">
          <div class="col-sm-12 ">
            <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($patient->IPP, 'C128')}}" alt="barcode" />
            <br>
            {{ $patient->IPP }}
          </div>	
        </div>
        <br><br><br>
        <ol>  
        @for ($i = 0; $i < count($medicaments); $i++)
        <div class="row ml-2">
          <div class="col-sm-12 ">
            <li>
              <span class="large"><strong>{{ $medicaments[$i]->Nom_com }}  {{ $medicaments[$i]->Forme }} {{ $medicaments[$i]->Dosage }}</strong></span> 
              <br>
              &nbsp;&nbsp;<span>{{ $posologies[$i] }}</span>
              <br><br>
            </li>
          </div>
        </div>
        @endfor
        </ol><!-- / -->    
        <div class="row foo">
          <div class="col-sm-12">
            <span class="medium"><strong> Docteur :</strong>{{ $employe->Nom_Employe}} {{ $employe->Prenom_Employe}}</span>
          </div>
      </div>
    </div>
	</body>
</html>