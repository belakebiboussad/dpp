<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <title>Resume Clinique de Sortie</title>
  <style>
      table 
    {
        border-collapse: collapse;
    }
    table, th, td 
    {
        border: 1px solid black;
        padding: 5px;
    }
    .center
    {
      text-align: center;
    }
    .col-sm-12
    {
      margin-bottom: 10px;
    }
    .mt-15{
        margin-top:-15px;
    }
    .mt-20{
      margin-top:-20px;
    }
    tr.noBorder td {
      border: 0;
    }
    </style>
    </head>
    <body>
    <div class="container-fluid">
            <h2 class="mt-20 center">DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</h2>
          <h4 class="center">ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</h4>
          <h4 class="center">Chemin des Glycines - ALGER</h4>
          <h4 class="center">Tél : 023-93-34</h4>
          <h5 class="mt-15 center" ><img src="img/logo.png" style="width: 60px; height: 60px" alt="logo"/></h5>
          <h5 class="mt-20 center"><span style="font-size: xx-large;"><strong>Résumé Clinique de Sortie</strong></span> </h5><br><br>  
          <div class="row">   <div class="col-sm-12"><strong>Etablisement : </strong><span>{{ (App\modeles\Lieuconsultation::find(session('lieu_id'))->nom )}}</span></div></div>
          <div class="row" ><div class="col-sm-12"><strong>Service : </strong><span>{{ $obj->admission->rdvHosp->demandeHospitalisation->Service->nom }}</span></div></div>
          <div class="row" ><div class="col-sm-12"><strong>Chef de servise : </strong><span>{{ $obj->admission->rdvHosp->demandeHospitalisation->Service->responsable->nom }} {{ $obj->admission->rdvHosp->demandeHospitalisation->Service->responsable->prenom }}</span></div>
          </div> <br><hr/>
        <section class="table"> 
          <table class="head" style="width:100%;">
          <thead> </thead>
          <tbody>
          <tr>
            <td class="first"><strong>N° Matricule:</strong>
              @if(isset($obj->patient->assure))
               <span>{{ $obj->patient->assure->matricule }}</span>
              @endif
             
            </td>
            <td colspan = 2><strong>N° Dossier :</strong><span> &nbsp;{{ $obj->patient->IPP}}</span></td>
          </tr>
          <tr class="noBorder">
               <td class="first"><strong>Nom et Prenom : </strong>&nbsp;<span> &nbsp;{{ $obj->patient->Nom }}{{ $obj->patient->Prenom }}</span></td>
                <td><strong>Date de Naissance :<strong>&nbsp;<span> &nbsp;{{ $obj->patient->Dat_Naissance }}</span></td>
                <td><strong>Sexe :<strong>&nbsp;<span> &nbsp;{{ $obj->patient->Sexe }}</span></td>
          </tr >
          <tr class="noBorder">
             <td class="first"><strong>Adresse :<strong>&nbsp;<span> &nbsp;{{ $obj->patient->Adresse }}</td>
            <td class="first"><strong>Commne :<strong>&nbsp;<span> &nbsp;{{ $obj->patient->lieuNaissance->nom_commune }}</td>
            <td><strong>Wilaya :<strong>&nbsp;<span> &nbsp;{{ $obj->patient->lieuNaissance->daira->wilaya->nom }}</span></td>
          </tr>
            <tr class="noBorder">
                <td class="first"><strong>Date d'Hospitalisation</strong><span> &nbsp;&nbsp;{{ $obj->Date_entree }}</span></td>
                <td><strong>Mode d'entrer</strong><span> &nbsp;{{ $obj->admission->rdvHosp->demandeHospitalisation->modeAdmission }}</span></td><td></td>
            </tr>
            <tr class="noBorder">
                <td class="first"><strong>Service</strong><span> &nbsp;&nbsp;{{ $obj->admission->rdvHosp->demandeHospitalisation->Service->nom }}</span></td>
                <td ><strong>Date d'entrée au Sce</strong><span> &nbsp;{{ $obj->Date_entree }}</span></td>
                 <td><strong>Date de Sortie de Sce</strong><span> &nbsp;{{ $obj->Date_Sortie }}</span></td>
            </tr>
           <tr><td colspan="3"></td></tr>
                <tr class="noBorder">
                      <td colspan="3" class="first"><strong>Motif d'Hôspitalisation</strong><span> &nbsp;{{ $obj->admission->rdvHosp->demandeHospitalisation->consultation->Motif_Consultation }}</span></td>
                </tr>
                 <tr class="noBorder">
                    <td colspan="3" class="first"><strong>Bilan Bioloqique :</strong>
                          <span> &nbsp;</span></td>
                      </td>
                </tr>
                <tr class="noBorder">
                    <td colspan="3" class="first"><strong>Bilan Radiologique : </strong>
                          <span> &nbsp;</span>
                      </td>
                </tr>
                <tr class="noBorder">
                      <td colspan="3" class="first"><strong>Autre Exmens : </strong>
                            <span> &nbsp;</span>
                        </td>
                </tr>
                <tr class="noBorder">
                      <td colspan="3" class="first"><strong>Dianostic principal de sortie : </strong> <span> &nbsp;{{ $obj->diagSortie }}</span> </td>
                </tr>
                <tr class="noBorder">
                      <td colspan="3" class="first"><strong>Dianostic associés : </strong> <span> &nbsp;</span> </td>
              </tr>
          </tbody>
          </table>
        </section><br><hr/>
        <section class="table"> 
        <table class="head" style="width:100%;">
        <thead></thead>
        <tbody> 
          <tr>  
                <td class="first"><strong>Actes: </strong>
                @foreach($obj->visites as $visite)
                     @foreach($visite->actes as $acte )
                          | <span> {{ $acte->nom }}</span>
                     @endforeach
                @endforeach
               </td>
          </tr>
           <tr>  
                <td class="first"><strong>Traitements: </strong>
                 @foreach($obj->visites as $visite)
                      @foreach($visite->traitements as $trait )
                           |<span> {{ $trait->medicament->nom }}</span>
                      @endforeach
                @endforeach  
             </td>
          </tr>
        </tbody>
        </table>
        </section><br><hr/>
  
    </body>
</html>