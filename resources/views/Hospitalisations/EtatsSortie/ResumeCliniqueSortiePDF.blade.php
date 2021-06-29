<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/styles.css">
  <title><strong>Résumé Clinique de Sortie</strong></title>
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
   </style>
  </head>
  <body>
    <div class="container-fluid"><!-- <h4 class="mt-20 center">DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</h4> -->
    @include('partials.etatHeader')
    <h3 class="center mt-10"><span style="font-size: xx-large;"><strong>{{ $etat->nom}}</strong></span></h3><!-- mt-20,mt-5 -->
    <div class="row">   <div class="mb-10"><strong>Etablisement : </strong><span>{{ $etablissement->nom}}</span></div></div>
    <div class="row" ><div class="mb-10"><strong>Service : </strong><span>{{ $obj->admission->demandeHospitalisation->Service->nom }}</span></div></div>
    <div class="row" ><div class="mb-10"><strong>Chef de servise : </strong><span>{{ $obj->admission->demandeHospitalisation->Service->responsable->nom }} {{ $obj->admission->demandeHospitalisation->Service->responsable->prenom }}</span></div>
    </div><br><hr/>
        <section class="table"> 
          <table class="head" style="width:100%;">
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
               <td class="first"><strong>Nom et Prénom : </strong>&nbsp;<span> &nbsp;{{ $obj->patient->Nom }}{{ $obj->patient->Prenom }}</span></td>
                <td><strong>Date de naissance :<strong>&nbsp;<span> &nbsp;{{ $obj->patient->Dat_Naissance }}</span></td>
                <td><strong>Sexe :<strong>&nbsp;<span> &nbsp;{{ $obj->patient->Sexe }}</span></td>
          </tr >
          <tr class="noBorder">
            <td class="first">
              @if(isset($obj->patient->Adresse))
              <strong>Adresse :<strong>&nbsp;
              <span> &nbsp;{{ $obj->patient->Adresse }}</span>
              @endif
            </td>
            <td class="first">
              @if(isset($obj->patient->commune_res))
                <strong>Commune :<strong>&nbsp;
                <span> &nbsp;{{ $obj->patient->commune->nom_commune }}
              @endif
            </td>
            <td>
              @if(isset($obj->patient->wilaya_res))
              <strong>Wilaya :<strong>&nbsp;
              <span> &nbsp;{{ $obj->patient->commune->daira->wilaya->nom }}</span>
              @endif
            </td>
          </tr>
            <tr class="noBorder">
                <td class="first"><strong>Date d'hospitalisation</strong><span> &nbsp;&nbsp;{{ $obj->Date_entree }}</span></td>
                <td><strong>Mode d'entrée</strong><span> &nbsp;{{ $obj->admission->demandeHospitalisation->modeAdmission }}</span></td><td></td>
            </tr>
            <tr class="noBorder">
                <td class="first"><strong>Service</strong><span> &nbsp;&nbsp;{{ $obj->admission->demandeHospitalisation->Service->nom }}</span></td>
                <td ><strong>Date d'entrée au Service</strong><span> &nbsp;{{ $obj->Date_entree }}</span></td>
                 <td><strong>Date de Sortie du Service</strong><span> &nbsp;{{ $obj->Date_Sortie }}</span></td>
            </tr>
           <tr><td colspan="3"></td></tr>
                <tr class="noBorder">
                      <td colspan="3" class="first"><strong>Motif d'hospitalisation</strong><span> &nbsp;{{ $obj->admission->demandeHospitalisation->consultation->motif }}</span></td>
                </tr>
                 <tr class="noBorder">
                    <td colspan="3" class="first"><strong>Bilan Bioloqique :</strong><span> &nbsp;</span></td></td>
                </tr>
                <tr class="noBorder">
                    <td colspan="3" class="first"><strong>Bilan Radiologique : </strong> <span> &nbsp;</span></td>
                    </tr>
                <tr class="noBorder">
                      <td colspan="3" class="first"><strong>Autres Examens : </strong>  <span> &nbsp;</span></td>
                </tr>
                <tr class="noBorder">
                      <td colspan="3" class="first"><strong>Dianostic principal de sortie : </strong> <span> &nbsp;{{ $obj->diagSortie }}</span> </td>
                </tr>
                <tr class="noBorder">
                      <td colspan="3" class="first"><strong>Dianostic associé : </strong> <span> &nbsp;</span> </td>
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