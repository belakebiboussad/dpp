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
    <div class="container-fluid">
      <header>
        <div><img src="img/entete.jpg" class="center thumb img-icons mt-25" alt="entete"/></div>
      </header>
      <footer>
        <img src="img/footer.png" alt="footer" class="center thumb img-icons" width="100%"/>
      </footer>
      <main> <!-- Wrap the content of your PDF inside a main tag -->
        <br><br><br>  
        <hr class="h-1"/>
        <div>
          <h3 class="center rect"><span style="font-size: xx-large;"><strong>{{ $etat->nom}}</strong></span></h3>
        </div>
         <section class="table"> 
          <table>
            <tr>
              <td>
              <table class="brd-0">
                <tr class="noBorder">
                  <td>
                    <table class="brd-0">
                      <tr class="noBorder"><td><span><strong>Etablissement :</strong> {{ $etablissement->nom}}</span></td></tr>
                      <tr class="noBorder"><td><span><strong>Service de :</strong> {{ $obj->admission->demandeHospitalisation->Service->nom }}</span></td></tr>
                      <tr class="noBorder">
                        <td>
                          <span><strong>Chef de Service :</strong> {{ $obj->admission->demandeHospitalisation->Service->responsable->nom }}
                               {{ $obj->admission->demandeHospitalisation->Service->responsable->prenom }}
                          </span>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                </table>
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
                    @else
                      /
                    @endif
                  </h5>&nbsp;&nbsp;&nbsp;&nbsp;
                  <h5 class="rect">
                    <strong>&nbsp;&nbsp;N° Dossier :<span> &nbsp;{{ $obj->patient->IPP}}</span></strong>
                  </h5>
                  <strong>Nom et Prénoms : </strong>&nbsp;<span> &nbsp;{{ $obj->patient->Nom }}&nbsp;{{ $obj->patient->Prenom }}</span><br>
                  <strong>Date de naissance(âge) :<strong>&nbsp;
                  <span> &nbsp;{{ $obj->patient->Dat_Naissance }} &nbsp;({{ $obj->patient->getAge() }} ans)</span>
                  <strong class="tab-space"> Sexe :<strong>&nbsp;<span> &nbsp;{{ $obj->patient->Sexe }}</span>
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
                </td>
            </tr>
            <!--<tr></tr>
            <tr></tr>
            <tr></tr>
 -->
          </table>
        </section>
      </main>

    </div>
  </body>
</html>  