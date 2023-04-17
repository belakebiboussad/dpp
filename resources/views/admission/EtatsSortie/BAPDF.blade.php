
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
    </style>
  </head>
  <body>
  <div class="container-fluid"><!-- <img src='img/entete2.png' alt="Entete" width="98%"/> -->
    <div class="row mt-12 center">@include('partials.etatHeader')</div><br> 
    <div class="center mt-10">
      <h3 class="text-uppercase"><b><u>{{ $etat->nom}}</u></b></h3>
      <h4 class="text-uppercase">(BILLET DE SALLE)</h4>
    </div><br> 
    <section class="table solid"> 
      <table>
      <tr>
        <td class="plh"><b>Admission N° :</b><span> {{ $rdv->id }}</span></td>
        <td class="plh"><b>Date :</b><span> {{ $date }}</span></td>
        <td class="plh"><b>Heure :</b><span> {{ Date("H:i") }}</span></td>
      </tr>
    </table>
    </section>
    @isset($patient->Assurs_ID_Assure)
    <h5><u><b>ASSURE :</b></u></h5>
    <section class="table tab">
      <table>
        <tr><td></td> <td><b>Détail :</b></td></tr>
        <tr>
          <td><b>Nom :</b><span> {{ $patient->assure->Nom }}</span></td>
          <td><b>Prénom :</b><span> {{ $patient->assure->Prenom }}</span></td>
          <td><b>Né(e) le :</b><span> {{ $patient->assure->Date_Naissance->format('d/m/Y') }}</span></td>
        </tr>
        <tr>
          <td><b>Adresse :</b><span> {{ $patient->assure->adresse }}, {{ $patient->assure->commune->nom_commune}}, {{ $patient->assure->commune->daira->wilaya->nom }}
           </span>
          </td>
        </tr>
        <tr><td><b>Tél :</b><span> {{ $patient->tele_mobile1 }}</span></td></tr>
        <tr>
          <td></td><td></td>
          <td><b>Service :</b><span> {{ $patient->assure->Service }}</span></td>
        </tr>
        <tr><td><b>N° SS :</b><span> {{ $patient->assure->NSS }}</span></td></tr>
      </table>
    </section>
    @endisset
    <h5><u><b>MALADE :</b></u></h5>
    <section class="table tab">
      <table>
        <tr>
          <td>
            <b>Qualité :</b> 
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
          </td> <td><b>Détail :</b></td>
        </tr>
        <tr>
          <td><b>Nom :</b><span> {{ $patient->Nom }}</span></td>
          <td><b>Prénom :</b><span> {{ $patient->Prenom }}</span></td>
          <td><b>Né(e) le :</b><span> {{ ($patient->Dat_Naissance)->format('d/m/Y') }}</span></td>
        </tr>
      </table>
    </section>
    <h5><u><b>ADMISSION :</b></u></h5>
    <section class="table tab">
      <table>
        <tr>
         <td><b>Service :</b><span> {{ $rdv->demandeHospitalisation->Service->nom }}</span></td>
         <td><b>Spécialité :</b><span> {{ $rdv->demandeHospitalisation->Specialite->nom }}</span></td>
        </tr>
        <tr>
          <td><b>Admis par Dr/SF :</b><span> {{ $rdv->demandeHospitalisation->consultation->medecin->full_name }}</span></td>
        </tr>
        <tr>
          <td><b>Chargé des admissions :</b><span> {{ Auth::user()->employ->Service->responsable->full_name }}</span></td>
        </tr>
       </table>
    </section>
    <h5><u><b>SORTIE :</b></u></h5>
    <section class="table tab">
      <table>
        <tr><td><b>Date :</b><span></span></td><td><b>Heure :&nbsp;</b><span></span></td><td></td></tr>
        <tr><td><b>Sortie par le médecin :</b><span></span></td></tr>
        <tr><td><b>Motif de sortie :</b><span></span></td></tr>
      </table>
    </section><br>
    <div class="sign1"><div>Alger le : {{ $date }}</div><div>{{  Auth::user()->employ->Service->nom }}</div> 
    </div>
     <div class="row text-center footer">@include('partials.etatFooter')</div>
  </div>
  </body>
</html> 