<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/styles.css">
    <title>Résumé standard de sortie</title>
    <style type="text/css" media="screen">
      @page {
          margin: 100px 25px;
      }
      table 
      {
        border-collapse: collapse;
        width:100%,
      }
      table, th, td 
      {
        border: 1px solid black;
        padding: 2px 8px;
      }
    h2.rect {
      border:2px solid black;
      height:50px;
      line-height:45px; 
    } 
     h5.rect {
      border:2px solid black;
      display: inline-block;
      height:40px;
      line-height:35px;
      width:47%;
    }
    </style>    
  </head>
  <body>
    <div>
      <header><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></header>
      <footer><img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/></footer>
      <main> 
        <div><hr class="h-1"/></div><div><h2 class="center rect"><b>{{ $etat->nom}}</b></h2></div>
       <div>
          <table>
            <tr>
              <td>
              <div><b>Etablissement </b> : <span>{{ $etab->nom }}</span></div>
              <div><b>Service de</b> : <span> {{ $obj->admission->demandeHospitalisation->Service->nom }}</span></div>
             <div><b>Chef de Service</b>  : <span> {{ $obj->admission->demandeHospitalisation->Service->responsable->full_name }}</span>
             </div>
              </td>
              <td><div class="mt-5"><b>Réservé au Bureau des Entrées</b><hr class="hr-1"/></div><div><b>Code Sce</b> :</div><hr class="hr-1"/></td>
            </tr>
            <tr>
              <td>
                <h5 class="rect center"><b>Matricule</b> : {{ is_null($obj->patient->NSS) ?  '' : $obj->patient->NSS  }}</h5>&nbsp;&nbsp;&nbsp;&nbsp;
                <h5 class="rect center"><b>N° Dossier</b> : <span> {{ $obj->patient->IPP}}</span></h5>
                <div><b>Nom et Prénoms</b> : <span> {{ $obj->patient->full_name }}</span></div>
                <div><b>Date de naissance(âge)</b> : <span> {{ $obj->patient->Dat_Naissance->format('d/m/Y') }} ({{ $obj->patient->age }} ans)
                </span></div>
                <div><b class=""> Sexe</b> : <span> {{ $obj->patient->Sexe }}</span></div>
                <div><b>Lieu de Naissance</b>  :  <span> {{ is_null($obj->patient->Lieu_Naissance) ? '' :  $obj->patient->lieuNaissance->nom_commune }}</span></div>
                <div><b>Lieu de résidence(Wilaya)</b> : {{ is_null($obj->patient->commune_res) ? '' :  $obj->patient->commune->daira->wilaya->nom }} </div>
                <div><b>Date d'admisston a l'hôpital</b> : <span> {{ $obj->admission->hospitalisation->date->format('d/m/Y') }}</span></div>
              <hr class="hr-1"/><h4 class="center mt-2"><b>Dernier Service d'Hospitalisation</b></h4><hr class="hr-1 mt-2"/>
                <div><b>Date d'entrée au service</b> : <span> {{ $obj->date->format('d/m/y') }}</span> </div>
                <div><b>Médecin traitant</b> : <span> {{ $obj->admission->hospitalisation->medecin->full_name }}</span></div>
                <div><b>Mode de Sortie</b> :
                  <span>
                    @switch($obj->modeSortie)
                      @case(0)
                          Transfert
                          @break
                      @case(1)
                          Contre avis médical
                          @break
                      @case(2)
                          Décès
                          @break
                      @case(3)
                          Reporter
                          @break
                      @default 
                          Domicile
                          @break
                    @endswitch  
                  </span>
                  </div>
                  <div><b>Date de sortie de l'Hôpital</b> : <span> {{ $obj->Date_Sortie->format('d/m/y') }}</span> </div>
                 </td>
              <td>
                    <h5><b>CODE COMMUNDE </b></h5>
                    <h5><b>DE NAISSANCE</b> : <span> {{ is_null($obj->patient->Lieu_Naissance) ? '' : $obj->patient->lieuNaissance->nom_commune }}</span> </h5>
                   <h5><b>Code WILAYA</b></h5>
                    <h5><b>DE RESIDENSE</b> : <span>{{ is_null($obj->patient->commune_res) ? '' : $obj->patient->commune->daira->wilaya->nom }}</span></h5>
                    <hr class="hr-1"/>
                    <div><b>Matricule du Praticien</b> :</div><div><b>Code Mode de Sortie</b> :</div> 
              </td>
            </tr>
            <tr>
                    <td><div><b>Motif d'hospitalisation</b> : <span>{{ $obj->admission->demandeHospitalisation->consultation->motif}}</span></div>
                    <div><b>Diagnostic principale de sotie</b> : <span> {{ $obj->diagSortie }}</span></div>
                    <div><h5 class="center"><b>Diagnostics associés :</b></h5><ol class="list"><li>1-</li><li>2-</li><li>3-</li></ol></div>
                    </td><td><div>CIM 10 DP :</div><div>CIM 10 - DA1</div><div>CIM 10 - DA2</div><div>CIM 10 - DA3</div></td>
            </tr>
          </table>
        </div><div class="sec-gauche">Le Chef de Service</div><div class="right">Le Médecin traitant</div>
      </main>
    </div>
  </body>
</html>  