<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/styles.css">
   <title>Attestation de Séjour</title>
  <style>
    table {
        border-spacing: 0;
        width: 600px;
    }
    table >  tr > td > div {
      margin: 0 auto;
      border: 0px red solid;
    }
   
    </style>
  </head>
  <body>
    <div class="container-fluid">
    <div class="mt-12 center">@include('partials.etatHeader')</div>
    <h3 class="text-uppercase center"><b><u>{{ $etat->nom}}</u></b></h3>
    <br><br> 
    <section class="table solid" style="width:100%;">
      <table>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
        <tr>
          <td colspan="2" class="plh"><b>N° :</b><span>{{ $obj->id }}</td>
          <td class="plh"><b>Date d'admission :</b><span> {{ $obj->date->format('d/m/Y') }}</span></td>
        </tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
        <tr>
          <td class="plh"><b>Service :</b><span> {{ $obj->demandeHospitalisation->bedAffectation->lit->salle->service->nom}}</span></td>
          <td class="plh"><b>Salle :</b><span> {{ $obj->demandeHospitalisation->bedAffectation->lit->salle->num }}</span></td>
          <td class="plh"><b>Lit :</b><span> {{ $obj->demandeHospitalisation->bedAffectation->lit->num }}</span></td>
        </tr>
        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr> 
        <tr>
          <td class="plh"><b>Nom :</b><span> {{ $patient->Nom}}</span></td>
          <td class="plh"><b>Prénom :</b><span> {{ $patient->Prenom }}</span></td>
          @if(($patient->sf == "M") && ( $patient->type_id == "2") )
            <td class="plh"><b>Epoux(se)  :</b><span> {{ $patient->assure->full_name }}</span></td>
          @endif
          </tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
         <tr>
          <td class="plh"><b>Genre :</b><span> {{ $patient->Sexe }}</span></td>
          <td class="plh"><b>Né(e) le :</b><span> {{ $patient->dob->format('d/m/Y') }}</span></td>
          <td class="plh"><b>Né(e) à :</b><span> {{ is_null( $patient->pob) ? '': $patient->POB->name }}</span></td>
        </tr> 
      </table>
    </section><br>
    <div class="sign1"><div>Alger le : {{ $date }}</div><div>{{  Auth::user()->employ->Service->nom }}</div> 
    </div>
     <div class="row text-center footer">@include('partials.etatFooter')</div>
 </div>
</body>
</html>