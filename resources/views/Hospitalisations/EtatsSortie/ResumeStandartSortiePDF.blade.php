<html>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
		<title>Ordonnance</title>
		<style>
		@media print  
    {
      a[href]:after {
      content: none !important;
       }
      @page {
      margin-top: 0;
      margin-bottom: 0;
      }
       body{
        padding-top: 72px;
      padding-bottom: 72px ;
      }
    }
    #left, #right, #middle {
      display: table-cell;
      font-size:xx-small;
   
    } 	
  	.section
		{
			margin-bottom: 20px;
		}
		.sec-gauche
		{
			float: left;
		}
		.sec-droite
		{
			float: right;
		}
			.center
			{
				text-align: center;
			}
			  .col-sm-12
			{ font-size: 14px;
				margin-bottom: 5px;
			}
			.mt-15{
	        margin-top:-15px;
			}
			.mt12{
	        padding-top:+12px;
			}
			.mt-20{
	      margin-top:-20px;
			}
			.ml-80{
      	 margin-left: +80%;
			}
		 	.ml-4{
        margin-left: +4%;
			}
			.foo{
      position: absolute;
      top: 90%;
      right: 22%;
		}

		 span {
            display: inline-block;
            padding:6px 0;font-size:14px;
            /*width:50%;*/
                    }
     .col-md-2 {
            display: inline-block;
              font-size:15px;
            width:40%;
                    }  


		.col-2{
			  width: 100%;
            float: left;
            font-size: 11px;
		}
        table.head, table.head thead{border:none;}
        table.head thead tr th{padding:1px 0;}
        table.head tr th, table.head tr td {text-align:left;}
        table.head tbody tr td{text-align:left;}
        table.head tbody tr td{padding:2px 0 2px 45px; padding-bottom: :  2px;}
        table.head tbody tr td.first{padding:2px 0;width:50%;padding-bottom:  2px;}
        table{border-collapse: collapse;text-align:center;border:1px solid #000;}
        thead {border-top:1px solid #000;}
        thead tr th, tbody tr td{padding:8px 0;font-size:14px;}
        thead tr th{border-left:0px solid #000;}
        tbody tr td{border-left:0px solid #000;}
        thead tr th.first, tbody tr td.first{text-align:left;}*/
        
    </style>
	</head>
	<body>
  	<div class="container-fluid" id="myDiv">
  		<h4 class="mt12 center">DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</h4>
      <h4 class="center">ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</h4>
			<h4 class="center">Chemin des Glycines - ALGER</h4>
			<h4 class="center">Tél : 23-93-34</h4>
			<h5 class="mt-15 center" ><img src="{{ asset('/img/logo.png') }}" style="width: 60px; height: 60px" alt="logo"/></h5>
  		<h5 class="mt-20 center"><span style="font-size: xx-large;"><strong>Resume standart de sortie</strong></span></h5>
  		<div class="row">
	    <div class="row">	<div class="col-sm-12"><strong>Etablisement : </strong><span>dfgdfgdfgdf</span></div></div>
    	<div class="row" >
        <div class="col-sm-12"><strong>Service : </strong><span>{{ $hosp->admission->rdvHosp->demandeHospitalisation->Service->nom }}</span> </div></div>
        <div class="row" >
        <div class="col-sm-12"> <strong>Chef de servise : </strong><span>{{ $hosp->admission->rdvHosp->demandeHospitalisation->Service->nom }}</span> </div></div>
       <br><hr/>
       <section class="table"> 
        <table class="head" style="width:100%;">
          <thead> </thead>
          <tbody>
            <tr>
              <td class="first"><strong>Matricule</strong><span> &nbsp;{{ $hosp->patient->assure->Matricule }}</span></td>
              <td><strong>N° Dossier</strong><span> &nbsp;{{ $hosp->patient->IPP}}</span></td>
            </tr>
            <tr>
              <td class="first"><strong>Nom et Prenom : </strong>&nbsp;<span> &nbsp;{{ $hosp->patient->Nom }}{{ $hosp->patient->Prenom }}</span></td>
              <td></td>
            </tr>
            <tr>
              <td class="first"><strong>Date de Naissance :<strong>&nbsp;<span> &nbsp;{{ $hosp->patient->Dat_Naissance }}</span></td>
              <td><strong>Sexe :<strong>&nbsp;<span> &nbsp;{{ $hosp->patient->Sexe }}</span></td>
            </tr>
            <tr>
              <td class="first"><strong>Lieu de naissance:</strong><span> &nbsp;{{$hosp->patient->lieuNaissance->nom_commune}}</span></td>
              <td></td>
            </tr>
            <tr>
                <td class="first"><strong>Adresse:</strong><span> &nbsp;{{ $hosp->patient->Adresse }}</span></td>
                <td></td>
            </tr>
            <tr>
              <td class="first"><strong>Date d'admisston a hopital</strong><span> &nbsp;{{ $hosp->admission->rdvHosp->date_RDVh }}</span></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </section><br><hr/>
      <section class="table"> 
        <table class="head" style="width:100%;">
          <thead></thead>  
          <tbody>
           <tr>
              <td class="first"> <strong> Date d'entrer au sevice:</strong>&nbsp;<span>{{ $hosp->admission->Date_entree}} &nbsp;</span></td>
              <td><strong>Medcin traitant : </strong><span>{{ $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->nom }}{{ $hosp->admission->rdvHosp->demandeHospitalisation->DemeandeColloque->medecin->prenom}}</span></td>
            </tr>
            <tr>
                <td class="first"><strong>Mode de sortie : 
                </strong>&nbsp;<span> &nbsp;{{ $hosp->modeSortie }}</span>
                </td>
                <td><strong>Date de sortie de l'hopital : </strong><span>{{ $hosp->Date_Sortie == null ? "Pas encore" : $hosp->Date_Sortie }}</span> </td>
            </tr>
             <tr>
              
            <div class="col-sm-8">
           

           </tbody>
   </table>
</section>
		  <!-- <div class="row">
		   	<div class="col-sm-12">{{-- l d-m-Y --}}
			 	  <strong> Date d'entrer au sevice</strong>&nbsp;<span> &nbsp;dfgdfgdfgdfgdfg</span>
		   	</div>
		  </div>
		  <div class="row">	<div class="col-sm-12"><strong>Medcin traitant : </strong><span>GGGGG</span></div></div>
		  <div class="row" ><div class="col-sm-12"><strong>Medcin traitant : </strong><span>dfgdfgdfgdfg</span> </div></div>
   		
          <div class="row" ><div class="col-sm-12"><strong>Mode de sortie : </strong><span>dfgdfgdfgdfg</span> </div></div>
   		 <div class="row" ><div class="col-sm-12"><strong>Date de sortie de l'hopital : </strong><span>dfgdfgdfgdfg</span> </div></div> -->  
   		  <br>
          <hr/>
          
   		 <div class="row" ><div class="col-sm-12"><strong>Motif dhospitalisation : </strong><span>{{$hosp->admission->rdvHosp->demandeHospitalisation->
           consultation->Motif_Consultation }} </span> </div></div>

   		 <div class="row" ><div class="col-sm-12"><strong>Daognostic principale de sortie : </strong>&nbsp;<span> &nbsp;{{ $hosp->diagSortie }}</span> </div></div>

   		  <div class="row" ><div class="col-sm-12"><strong>Daognostic associer : </strong><span>dfgdHHHHHHHHHHHHHHHfgdfgdfg</span> <br>
       <span>dfgdHHHHHHHHHHHHHHHfgdfgdfg</span> <br>
       <span>dfgdHHHHHHHHHHHHHHHfgdfgdfg</span> <br>

        </div></div>
   		

     


         <div class="section">
				<!-- <div class="sec-droite"><span><strong> Docteur :</strong> {{ Auth::user()->employ->nom }} {{ Auth::user()->employ->prenom }}  </span></div> -->

    	</div>
	 </div>		
			
	</body>
</html>