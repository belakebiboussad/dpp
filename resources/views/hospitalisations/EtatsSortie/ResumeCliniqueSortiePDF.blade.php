<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/styles.css">
  <title><b>Résumé Clinique de Sortie</b></title>
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
        <hr class="h-1"/><br>
        <div><b>Etablisement : </b><span>{{ $etab->nom}}</span></div>
        <div>
          <b>Service : </b>
          <span>{{ $obj->admission->demandeHospitalisation->Service->nom }}</span>
        </div>
        <div><b>Chef de servise : </b><span>{{ $obj->admission->demandeHospitalisation->Service->responsable->full_name }}</span></div>
        <br><hr/>
         <section class="table"> 
          <table class="head" style="width:100%;">
          <tbody>
          <tr>
            <td></td>
            <td colspan = 2><b>N° Dossier :</b><span> {{ $obj->patient->IPP}}</span></td>
          </tr>
          <tr class="noBorder">
            <td ><b>Nom et Prénom :</b><span> {{ $obj->patient->full_name }}</span></td>
            <td><b>Date de naissance :</b>
            <span> {{ $obj->patient->dob->format('d/m/Y') }}</span></td>
            <td><b>Sexe :</b><span> {{ $obj->patient->Sexe }}</span></td>
          </tr>
          <tr class="noBorder">
            <td>
              @if(isset($obj->patient->Adresse))
              <b>Adresse :</b><span> {{ $obj->patient->Adresse }}</span>
              @endif
            </td>
            <td>
              @if(isset($obj->patient->commune_res))
                <b>Commune :</b><span> {{ $obj->patient->commune->name }}
              @endif
            </td>
            <td>
              @if(isset($obj->patient->wilaya_res))
              <b>Wilaya :</b><span> {{ $obj->patient->commune->daira->wilaya->nom }}</span>
              @endif
            </td>
          </tr>
          <tr class="noBorder">
            <td><b>Date d'hospitalisation :</b><span> {{ $obj->date->format('d/m/Y') }}</span></td>
            <td><b>Mode d'entrée :</b>
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
            <td><b>Service :</b><span> {{ $obj->admission->demandeHospitalisation->Service->nom }}</span></td>
            <td>
              <b>Date d'entrée :</b><span> {{ $obj->date->format('d/m/Y') }}</span>
            </td>
            <td><b>Date de Sortie :</b><span> {{ $obj->Date_Sortie->format('d/m/Y') }}</span></td>
          </tr>
           <tr><td colspan="3"></td></tr>
                <tr class="noBorder">
                      <td colspan="3"><b>Motif d'hospitalisation :</b><span>&nbsp;{{ $obj->admission->demandeHospitalisation->consultation->motif }}</span></td>
                </tr>
                 <tr class="noBorder">
                    <td colspan="3"><b>Bilan Bioloqique :</b><span></span></td></td>
                </tr>
                <tr class="noBorder">
                    <td colspan="3"><b>Bilan Radiologique : </b><span> </span></td>
                    </tr>
                <tr class="noBorder">
                      <td colspan="3"><b>Autres Examens : </b><span> </span></td>
                </tr>
                <tr class="noBorder">
                      <td colspan="3"><b>Dianostic principal de sortie : </b> <span> &nbsp;{{ $obj->diagSortie }}</span> </td>
                </tr>
                <tr class="noBorder">
                      <td colspan="3" class="first"><b>Dianostic associé : </b> <span> </span></td>
              </tr>
          </tbody>
          </table>
        </section><hr/>
        <section class="table"> 
        <table class="head" style="width:100%;">
        <thead></thead>
        <tbody> 
          <tr>  
                <td class="first"><b>Actes: </b>
                @foreach($obj->visites as $visite)
                     @foreach($visite->actes as $acte )
                          | <span> {{ $acte->nom }}</span>
                     @endforeach
                @endforeach
               </td>
          </tr>
           <tr>  
            <td class="first"><b>Traitements: </b>
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