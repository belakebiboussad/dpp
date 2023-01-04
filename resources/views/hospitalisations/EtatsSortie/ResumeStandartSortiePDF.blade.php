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
    h3.rect {
      border:3px solid black;
      height:50px;
      line-height:45px; /* centrage vertical */
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
        <br><hr class="h-1"/>
        <div>
          <h3 class="center rect"><span style="font-size: xx-large;"><b>{{ $etat->nom}}</b></span></h3>
        </div>
       <div>
          <table>
            <tr>
              <td>
              <b>Etablissement :</b> <span>{{ $etab->nom }}</span><br>
              <b>Service de :</b><span> {{ $obj->admission->demandeHospitalisation->Service->nom }}</span><br>
              <b>Chef de Service :</b><span> {{ $obj->admission->demandeHospitalisation->Service->responsable->full_name }}</span><br>
              </td>
              <td>
                <div class="mt-5">
                  <b>Réservé au Bureau des Entrées</b><hr class="hr-1"/>
                </div>
                <div><b>Code Sce :</b></div><hr class="hr-1"/>
              </td>
            </tr>
            <tr>
              <td>
                <h5 class="rect"><b>&nbsp;&nbsp;Matricule :</b>
                  @if($obj->patient->Type != 5 )
                    <span> {{ $obj->patient->assure->matricule }}</span>
                  @endif
                </h5>&nbsp;&nbsp;&nbsp;&nbsp;
                <h5 class="rect"><b>&nbsp;&nbsp;N° Dossier :</b><span> {{ $obj->patient->IPP}}</span></h5>
                <b>Nom et Prénoms : </b><span> {{ $obj->patient->full_name }}</span><br>
                <b>Date de naissance(âge) :</b>
                <span> {{ $obj->patient->Dat_Naissance->format('d/m/Y') }} ({{ $obj->patient->age }} ans)</span>
                <b class=""> Sexe :</b><span> {{ $obj->patient->Sexe }}</span><br>
                <b>Lieu de Naissance  :</b>&nbsp;
                  @if(isset($obj->patient->Lieu_Naissance))
                  <span> {{ $obj->patient->lieuNaissance->nom_commune }}</span>
                   @endif
                  <br>
                  <b>Lieu de résidence(Wilaya) :</b>
                  @if(isset($obj->patient->commune_res))
                   <span> {{ $obj->patient->commune->daira->wilaya->nom }}</span>
                  @endif
                  <br>
                  <b>Date d'admisston a l'hôpital :</b>
                  <span> {{ hospitalisation->date->format('d/m/Y') }}</span>
                  <hr class="hr-1"/>
                    <h4 class="center mt-2"><b>Dernier Service d'Hospitalisation</b></h4>
                  <hr class="hr-1 mt-2"/>
                  <b>Date d'entrée au service :</b><span> {{ $obj->date->format('d/m/y') }}</span><br>
                  <b>Médecin traitant :</b>
                  <span> {{ $obj->admission->hospitalisation->medecin->full_name }}</span><br>
                  <b>Mode de Sortie :</b>&nbsp;
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
                      @default  {{-- Domicile = null --}}
                          Domicile
                          @break
                    @endswitch  
                  </span><br>
                  <b>Date de sortie de l'Hôpital :</b>
                  <span> {{ $obj->Date_Sortie->format('d/m/y') }}</span>
              </td>
              <td>
                <h5><b>CODE COMMUNDE </b></h5>
                <h5><b>DE NAISSANCE :</b>
                @if(isset($obj->patient->Lieu_Naissance))
                  <span> {{ $obj->patient->lieuNaissance->nom_commune }}</span>
                 @endif
                 </h5>
                <h5><b>Code WILAYA</b></h5>
                <h5><b>DE RESIDENSE :</b>
                @if(isset($obj->patient->commune_res))
                  <span> {{ $obj->patient->commune->daira->wilaya->nom }}</span>
                @endif
                </h5>
                <hr class="hr-1"/>
                  <b>Matricule du Praticien :</b><br>
                  <b>Code Mode de Sortie :</b>
              </td>
            </tr>
            <tr>
              <td>
                <b>Motif d'hospitalisation :</b>
                <span>{{ $obj->admission->demandeHospitalisation->consultation->motif }}</span><br>
                <b>Diagnostic principale de sotie :</b>
                <span> {{ $obj->diagSortie }}</span><br>
                <h5  class="center"><b>Diagnostics associés :</b></h5>
                <ol class="list">
                  <li>1-</li>
                  <li>2-</li>
                  <li>3-</li>
                </ol>
              </td>
              <td>
                CIM 10 DP : <br>
                CIM 10 - DA1 <br>
                CIM 10 - DA2  <br>
                CIM 10 - DA3  <br>
              </td>
            </tr>
          </table>
        </div> <!--     </section> -->
        <div class="sec-gauche">Le Chef de Service</div><div class="right">Le Médecin traitant</div>
      </main>
    </div>
  </body>
</html>  