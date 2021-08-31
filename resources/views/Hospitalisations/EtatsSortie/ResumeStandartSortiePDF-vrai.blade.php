<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/styles.css">
    <title>>Résumé standard de sortie</title>
    <style type="text/css" media="screen">
     	@page {
          margin: 100px 25px;
      }
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
    <div class="container-fluid">
      <header>
        <div><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></div>
      </header>
      <footer>
        <img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/>
      </footer>
      <br><br><br><br>
      <h3 class="center"><span style="font-size: xx-large;"><strong>{{ $etat->nom}}</strong></span></h3>
      <br><br>
      <div class="row" ><div class="mb-10"> <strong>Chef de servise : </strong>
      <span>
        {{ $obj->admission->demandeHospitalisation->Service->responsable->nom }}
        {{ $obj->admission->demandeHospitalisation->Service->responsable->prenom }}
      </span>
     </div>
    </div><br>
     <section class="table"> 
      <table class="head" style="width:100%;">
        <tbody>
          <tr>
            <td class="first"><strong>Matricule :</strong>
              @if($obj->patient->Type != 5 )
                <span> &nbsp;{{ $obj->patient->assure->matricule }}</span>
              @endif
            </td>
            <td><strong>N° Dossier :</strong><span> &nbsp;{{ $obj->patient->IPP}}</span></td>
          </tr>
          <tr class="noBorder">
            <td class="first"><strong>Nom et Prénom : </strong>&nbsp;<span> &nbsp;{{ $obj->patient->Nom }}&nbsp;{{ $obj->patient->Prenom }}</span></td>
            <td></td>
          </tr>
          <tr class="noBorder">
            <td class="first"><strong>Date de naissance :<strong>&nbsp;
              <span> &nbsp;{{ $obj->patient->Dat_Naissance }}</span><span> &nbsp;({{ $obj->patient->getAge() }} ans)</span>
            </td>
            <td><strong>Sexe :<strong>&nbsp;<span> &nbsp;{{ $obj->patient->Sexe }}</span></td>
          </tr>
          <tr class="noBorder">
            <td class="first"><strong>Lieu de naissance:</strong>
              @if(isset($obj->patient->Lieu_Naissance))
                <span> &nbsp;{{ $obj->patient->lieuNaissance->nom_commune }}</span>
              @endif
            </td>
            <td>
              @if(isset($obj->patient->commune_res))
                <strong>Lieu de résidence(Wilaya):</strong><span><span> &nbsp;{{ $obj->patient->commune->daira->wilaya->nom }}</span>
              @endif
            </td>
          </tr>
          <tr class="noBorder">
            <td class="first"><strong>Adresse:</strong><span> &nbsp;{{ $obj->patient->Adresse }}</span></td><td></td>
          </tr>
          <tr class="noBorder">
            <td class="first"><strong>Date d'admisston a l'hôpital :</strong>
              <span> &nbsp;{{-- $obj->admission->rdvHosp->date_RDVh --}}
               {{ $obj->admission->hospitalisation->Date_entree }}
              </span>

            </td>
            <td></td>
          </tr>
          <tr><td colspan="2" class="center"><span  style="text-transform:uppercase">dernier service d'hospitalisation</span></td></tr>
          <tr class="noBorder">
            <td class="first"><strong>Date d'entrée au service :</strong><span> &nbsp;{{ $obj->Date_entree }}</span></td>
            <td><strong>Médecin traitant :</strong><span> &nbsp;
              {{  $obj->admission->hospitalisation->medecin->nom }}
              {{  $obj->admission->hospitalisation->medecin->prenom }}</span>
            </td>
          </tr>
          <tr class="noBorder">
            <td class="first"><strong>Mode de Sortie :</strong>
              @switch($obj->modeSortie)
                    @case(0)
                        &nbsp;Transfert
                         @break
                    @case(1)
                          &nbsp;Contre avis médical
                         @break
                    @case(2)
                         &nbsp;Décès
                         @break
                    @case(3)
                         &nbsp;Reporter
                         @break
                    @default  {{-- Domicile = null --}}
                          &nbsp;Domicile
                         @break
              @endswitch
            </td>
            <td><strong>Date de sortie de l'Hôpital :</strong><span> &nbsp;{{ $obj->Date_Sortie }}</span></td>
          </tr>
          <tr>
            <td class="first" colspan="2"><strong>Motif d'hospitalisation :</strong><span> &nbsp;{{ $obj->admission->demandeHospitalisation->consultation->motif }}</span></td>
          </tr>
          <tr class="noBorder">
            <td class="first" colspan="2"><strong>Diagnostic principale de sotie :</strong><span> &nbsp;{{ $obj->diagSortie }}</span></td>
          </tr>
          </tbody>
        </table>
      </section><br><hr/>
    </div>
  </body>
  </html>