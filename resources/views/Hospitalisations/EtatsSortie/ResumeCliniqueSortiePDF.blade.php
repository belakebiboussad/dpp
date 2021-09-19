<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/styles.css">
  <title><strong>Résumé Clinique de Sortie</strong></title>
  <style>
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
    <div>
      <header><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></header>
      <footer><img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/></footer>
      <main><br><br><br>
        <hr class="h-1"/>
        <br>
        <div>
          <strong>Etablisement : </strong><span>{{ $etablissement->nom}}</span>
        </div>
        <div>
          <strong>Service : </strong>
          <span>{{ $obj->admission->demandeHospitalisation->Service->nom }}</span>
        </div>
        <div>
        <strong>Chef de servise : </strong><span>{{ $obj->admission->demandeHospitalisation->Service->responsable->nom }} {{ $obj->admission->demandeHospitalisation->Service->responsable->prenom }}</span>
        </div>
        <br><hr/>
         <section class="table"> 
          <table class="head" style="width:100%;">
          <tbody>
          <tr>
            <td><strong>N° Matricule:</strong>
              @if($obj->patient->Type != 5 )
               <span>{{ $obj->patient->assure->matricule }}</span>
              @endif
            </td>
            <td colspan = 2><strong>N° Dossier :</strong>&nbsp;<span>{{ $obj->patient->IPP}}</span></td>
          </tr>
          <tr class="noBorder">
            <td ><strong>Nom et Prénom :</strong>&nbsp;<span>{{ $obj->patient->Nom }}{{ $obj->patient->Prenom }}</span></td>
            <td><strong>Date de naissance :<strong>&nbsp;
            <span>{{ (\Carbon\Carbon::parse($obj->patient->Dat_Naissance))->format('d/m/Y') }}</span></td>
            <td><strong>Sexe :<strong>&nbsp;<span>{{ $obj->patient->Sexe }}</span></td>
          </tr>
          <tr class="noBorder">
            <td>
              @if(isset($obj->patient->Adresse))
              <strong>Adresse :<strong>&nbsp;
              <span>{{ $obj->patient->Adresse }}</span>
              @endif
            </td>
            <td>
              @if(isset($obj->patient->commune_res))
                <strong>Commune :<strong>&nbsp;
                <span>{{ $obj->patient->commune->nom_commune }}
              @endif
            </td>
            <td>
              @if(isset($obj->patient->wilaya_res))
              <strong>Wilaya :<strong>&nbsp;
              <span>{{ $obj->patient->commune->daira->wilaya->nom }}</span>
              @endif
            </td>
          </tr>
          <tr class="noBorder">
            <td>
              <strong>Date d'hospitalisation :</strong>&nbsp;
              <span>{{ (\Carbon\Carbon::parse($obj->Date_entree))->format('d/m/Y') }}</span>
            </td>
            <td>
              <strong>Mode d'entrée :</strong>&nbsp;
              <span>
                @switch($obj->admission->demandeHospitalisation->modeAdmission)
                  @case("0")    
                    Programme
                    @break
                  @case("1")
                    Ambulatoire
                    @break
                  @case("2")
                    Urgence
                    @break  
                @endswitch  
              </span>
            </td>
            <td></td>
          </tr>
          <tr class="noBorder">
            <td><strong>Service :</strong><span> &nbsp;&nbsp;{{ $obj->admission->demandeHospitalisation->Service->nom }}</span></td>
            <td>
              <strong>Date d'entrée :</strong>&nbsp;
              <span>{{ (\Carbon\Carbon::parse($obj->Date_entree))->format('d/m/Y') }}</span>
            </td>
            <td>
              <strong>Date de Sortie :</strong>&nbsp;
              <span>{{ (\Carbon\Carbon::parse($obj->Date_Sortie))->format('d/m/Y') }}</span>
            </td>
          </tr>
           <tr><td colspan="3"></td></tr>
                <tr class="noBorder">
                      <td colspan="3"><strong>Motif d'hospitalisation :</strong><span>&nbsp;{{ $obj->admission->demandeHospitalisation->consultation->motif }}</span></td>
                </tr>
                 <tr class="noBorder">
                    <td colspan="3"><strong>Bilan Bioloqique :</strong><span> &nbsp;</span></td></td>
                </tr>
                <tr class="noBorder">
                    <td colspan="3"><strong>Bilan Radiologique : </strong> <span> &nbsp;</span></td>
                    </tr>
                <tr class="noBorder">
                      <td colspan="3"><strong>Autres Examens : </strong>  <span> &nbsp;</span></td>
                </tr>
                <tr class="noBorder">
                      <td colspan="3"><strong>Dianostic principal de sortie : </strong> <span> &nbsp;{{ $obj->diagSortie }}</span> </td>
                </tr>
                <tr class="noBorder">
                      <td colspan="3" class="first"><strong>Dianostic associé : </strong> <span> &nbsp;</span> </td>
              </tr>
          </tbody>
          </table>
        </section><hr/>
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
      </main>
    </div>
  </body>
</html>