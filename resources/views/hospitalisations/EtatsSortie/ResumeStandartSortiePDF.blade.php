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
        <br><br>
        <hr class="h-1"/>
        <div>
          <h3 class="center rect"><span style="font-size: xx-large;"><strong>{{ $etat->nom}}</strong></span></h3>
        </div>
       <div>
          <table>
            <tr>
              <td>
              <strong>Etablissement :</strong>&nbsp;<span>{{ $etab->nom }}</span><br>
              <strong>Service de :</strong>&nbsp;<span>{{ $obj->admission->demandeHospitalisation->Service->nom }}</span><br>
              <strong>Chef de Service :</strong><span>{{ $obj->admission->demandeHospitalisation->Service->responsable->full_name }}</span><br>
              </td>
              <td>
                <div class="center mt-5">
                  <span><strong>Réservé au Bureau des Entrées</strong></span>
                  <hr class="hr-1"/>
                </div>
                <div><span><strong>Code Sce :</strong></span></div>
                <hr class="hr-1"/>
              </td>
            </tr>
            <tr>
              <td>
                <h5 class="rect">
                  <strong>&nbsp;&nbsp;Matricule :</strong>&nbsp; 
                  @if($obj->patient->Type != 5 )
                    <span>{{ $obj->patient->assure->matricule }}</span>
                  @endif
                </h5>&nbsp;&nbsp;&nbsp;&nbsp;
                <h5 class="rect"><strong>&nbsp;&nbsp;N° Dossier :<span> &nbsp;{{ $obj->patient->IPP}}</span></strong></h5>
                <strong>Nom et Prénoms : </strong>&nbsp;<span> &nbsp;{{ $obj->patient->full_name }}</span><br>
                <strong>Date de naissance(âge) :<strong>&nbsp;
                <span>{{ (\Carbon\Carbon::parse($obj->patient->Dat_Naissance))->format('d/m/Y') }}&nbsp;({{ $obj->patient->age }} ans)</span>
                <strong class=""> Sexe :</strong>&nbsp;&nbsp;&nbsp;<span>{{ $obj->patient->Sexe }}</span><br>
                <strong>Lieu de Naissance  :<strong>&nbsp;
                  @if(isset($obj->patient->Lieu_Naissance))
                  <span> {{ $obj->patient->lieuNaissance->nom_commune }}</span>
                   @endif
                  <br>
                  <strong>Lieu de résidence(Wilaya) :</strong>&nbsp;
                  @if(isset($obj->patient->commune_res))
                   <span>{{ $obj->patient->commune->daira->wilaya->nom }}</span>
                  @endif
                  <br>
                  <strong>Date d'admisston a l'hôpital :</strong>&nbsp;
                  <span>{{  (\Carbon\Carbon::parse($obj->admission->hospitalisation->Date_entree))->format('d/m/Y') }}</span>
                  <hr class="hr-1"/>
                    <h4 class="center mt-2"><strong>Dernier Service d'Hospitalisation</strong></h4>
                  <hr class="hr-1 mt-2"/>
                  <strong>Date d'entrée au service :</strong>&nbsp;<span>{{ $obj->Date_entree }}</span><br>
                  <strong>Médecin traitant :</strong>&nbsp;
                  <span>{{ $obj->admission->hospitalisation->medecin->full_name }}</span><br>
                  <strong>Mode de Sortie :</strong>&nbsp;
                  <span>
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
                  </span><br>
                  <strong>Date de sortie de l'Hôpital :</strong>&nbsp;
                  <span>{{ $obj->Date_Sortie }}</span>
              </td>
              <td>
                <h5><strong>CODE COMMUNDE </strong></h5>
                <h5><strong>DE NAISSANCE :</strong>
                @if(isset($obj->patient->Lieu_Naissance))
                  <span> &nbsp;{{ $obj->patient->lieuNaissance->nom_commune }}</span>
                 @endif
                 </h5>
                <h5><strong>Code WILAYA</strong></h5>
                <h5><strong>DE RESIDENSE :</strong>
                @if(isset($obj->patient->commune_res))
                  <span> &nbsp;{{ $obj->patient->commune->daira->wilaya->nom }}</span>
                @endif
                </h5>
                <hr class="hr-1"/>
                  <strong>Matricule du Praticien :</strong> <br>
                  <strong>Code Mode de Sortie :</strong>
              </td>
            </tr>
            <tr>
              <td>
                <strong>Motif d'hospitalisation :</strong>
                <span>{{ $obj->admission->demandeHospitalisation->consultation->motif }}</span><br>
                <strong>Diagnostic principale de sotie :</strong>&nbsp;
                <span>{{ $obj->diagSortie }}</span><br>
                <h5  class="center"><strong>Diagnostics associés :</strong></h5>
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
        <div class="sec-gauche">Le Chef de Service</div><div class="righte">Le Médecin traitant</div>
      </main>
    </div>
  </body>
</html>  