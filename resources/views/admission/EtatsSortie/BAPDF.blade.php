
<html>
  <head>
    <meta charset="utf-8">
    <title>Bullettin d'admission</title>
    <link rel="stylesheet" href="css/styles.css"/>
    <style>
      table {
        border-spacing: 0;
        width: 100%;
      }
      table >  tr > td > div {
        margin: 0 auto;
        border: 0px red solid;
      }
      .solid {border-style: solid;}
    </style>
  </head>
  <body>
  <div class="container-fluid">
    <div class="row mt-12 center"><img src='img/entete2.png' alt="Entete" width="98%"/></div>
    <br>
    <div class="center mt-10">
      <h3 class="text-uppercase"><span style="font-size: xx-large;"><strong><u>{{ $etat->nom}}</u></strong></span></h3>
      <h4 class="text-uppercase"><strong>(BILLET DE SALLE)</strong></h4>
    </div><br> 
    <section class="table solid" style="width:100%;"> 
      <table>
      <tr>
        <td style="padding-left:5px; height:40px; overflow:hidden; "><strong>Admission N° :&nbsp;</strong><span>&nbsp;{{ $obj->id }}</span></td>
        <td style="padding-left:5px; height:40px; overflow:hidden; "><strong>Date :</strong><span>&nbsp;{{ $date }}</span></td>
        <td style="padding-left:5px; height:40px; overflow:hidden; "><strong>Heure :</strong><span>&nbsp;{{ Date("H:i") }}</span></td>
      </tr>
    </table>
    </section>
    <h5><u><strong>ASSURE :</strong></u></h5>
    <section class="table tab-space" style="width:100%;">
      <table>
        <tr>
          <td><span>Qualité :&nbsp;</span><span>{{ $patient->assure->Position }}</span></td>
          <td><span>Détail :</span></td>
        </tr>
        <tr>
          <td><span>Nom :&nbsp;</span><span>{{ $patient->assure->Nom }}</span></td>
          <td><span>Prénom :&nbsp;</span><span>{{ $patient->assure->Prenom }}</span></td>
          <td><span>Né(e) le :&nbsp;</span><span>{{ \Carbon\Carbon::parse($patient->assure->Date_Naissance)->format('d/m/Y') }}</span></td>
        </tr>
        <tr>
          <td><span>Adresse :&nbsp;</span><span>{{ $patient->assure->adresse }},
          @isset($patient->assure->commune_res)
           {{ $patient->assure->commune->nom_commune }},  {{ $patient->assure->commune->daira->wilaya->nom }}
           @endisset
           </span>
          </td>
        </tr>
        <tr>
          <td><span>Tel :&nbsp;</span><span>{{ $patient->tele_mobile1 }}</span></td>
        </tr>
        <tr>
          <td><span>Matricule :&nbsp;</span><span>{{ $patient->assure->matricule }}</span></td>
          <td><span>Grade :&nbsp;</span><span>{{ $patient->assure->grade->nom }}</span></td>
          <td><span>Service :&nbsp;</span><span>{{ $patient->assure->Service }}</span></td>
        </tr>
        <tr>
          <td><span>N° SS:&nbsp;</span><span>{{ $patient->assure->NSS }}</span></td>
          <td><span>MGSN:&nbsp;</span><span>{{ $patient->assure->NMGSN }}</span></td>
        </tr>
      </table>
    </section>
    <h5><u><strong>MALADE :</strong></u></h5>
    <section class="table tab-space" style="width:100%;">
      <table>
        <tr>
          <td>
            <span>Qualité :&nbsp;</span>
            <span>
                @switch($patient->Type)
                @case(0)
                    Assuré
                    @break
                @case(1)
                    Conjoint(e)
                   @break
                @case(2)
                    Père
                    @break
                @case(3)
                    Mère
                    @break
                @case(4)
                    Enfant
                    @break
                @case(5)
                    Autre
                    @break
                @default
                  Assuré
                  @break
                @endswitch
            </span>
          </td>
          <td><span>Détail :</span></td>
        </tr>
        <tr>
          <td><span>Nom :&nbsp;</span><span>{{ $patient->Nom }}</span></td>
          <td><span>Prénom :&nbsp;</span><span>{{ $patient->Prenom }}</span></td>
          <td><span>Né(e) le :&nbsp;</span><span>{{ \Carbon\Carbon::parse($patient->Date_Naissance)->format('d/m/Y') }}</span></td>
        </tr>
      </table>
    </section>
    <h5><u><strong>ADMISSION :</strong></u></h5>
    <section class="table tab-space" style="width:100%;">
      <table>
        <tr>
         <td><span>&nbsp;Service:</span><span>&nbsp;{{ $obj->demandeHospitalisation->Service->nom }}</span></td>
         <td><span>&nbsp;Spécialité:</span><span>&nbsp;{{ $obj->demandeHospitalisation->Specialite->nom }}</span></td>
        </tr>
        <tr>
          <td><span>&nbsp;Admis par Dr/SF :</span><span>&nbsp;{{ $obj->demandeHospitalisation->consultation->medecin->full_name }}</span></td>
        </tr>
        <tr>
          <td><span>&nbsp;Chargé des admissions :</span><span>{{ Auth::user()->employ->Service->responsable->full_name }}</span></td>
        </tr>
       </table>
    </section>
    <h5><u><strong>SORTIE :</strong></u></h5>
    <section class="table tab-space" style="width:100%;">
      <table>
        <tr>
          <td><span>Date :&nbsp;</span><span></span></td>
          <td><span>Heure :&nbsp;</span><span></span></td>
          <td></td>
        </tr>
        <tr>
          <td><span>Sortie par le médecin :&nbsp;</span><span></span></td>
        </tr>
        <tr>
          <td><span>Motif de sortie :&nbsp;</span><span></span></td>
        </tr>
      </table>
    </section><br>
    <div class="row">
      <div class="right">
        <div>Alger le:  {{ $date }}</div>
        <div>{{  Auth::user()->employ->Service->nom }}</div>
    </div>
  </div><!-- fluid -->
  </body>
</html> 
