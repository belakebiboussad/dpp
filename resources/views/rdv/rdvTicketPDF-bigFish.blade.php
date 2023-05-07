<!doctype html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
      .mt-5 {  margin-top: -5px !important; }
      .mt-10 {  margin-top: -10px !important; }
      .mt-50 { margin-top:-50px; }
      .mtp5 {  margin-top: 5px !important; }
      .center {  text-align: center;}
      .lh01 { line-height: 0.1;}
      .pt-21 { padding-top:-21px !important;}
      .pt-10 { padding-top:-10px  !important ;}
      .mt-10 {  margin-top:-10px; }
      .imgCenter{
        text-align: center;
        width:13%;
        height:13%;
      }
      #container {
        display: table;
      }
      #row  {
        display: table-row;
      }
      #left {
        display: table-cell;
        font-size:xx-small; /* padding: 5px;*/
        margin-top: +4px !important;
        padding-top:+4px !important;
      }   
      #parent {
            width:100%;
            height:70px;/*110px*/
            border: 0.5px solid black !important;
            border-radius: 5px !important;
            font-size:xx-small;
      }
    </style>
  </head>
  <body>
       <div class="content center mt-50 lh01"> @include('partials.etatHeader-min')</div>
       <div><hr class ="mt-10"></div>
       <div class="content center pt-21"><h4>Rendez-Vous de Consultation</h4></div><br>
       <div class=" mt-10 pt-10">Rendez-vous dans la Spécialitè &quot;<b>{{ $rdv->specialite->nom}}</b>&quot;</div> 
       <div> <b> {{ ( $rdv->fixe) ? "Le" : "A partir du" }}</b><u> {{ $rdv->date->format('d/m/Y') }}</u></div>
       <div ><b>Nom : </b><span>{{ $rdv->patient->Nom}}</span></div>
        <div> <b>Prenom : </b><span>{{ $rdv->patient->Prenom}}</span> </div>
        <div id="container" class="mt-5">
        <div id ="row">
          <div id="left"><img src="<?= $img->encoded ?>"/><br><b>IPP :</b><span>{{ $rdv->patient->IPP }}</span></div>
        </div>
        <div id ="parent" class="mtp5"> <span> Le jour de votre consultation</span>
             <ul> 
            <li>Rapportez ce Ticket </li>
            <li>Raportez tous les documents Médicaux en votre possession (résultats d'analyses, radiographies,etc.)</li>
            <li>En arrivant à l'hôpital recupéré votre ticket d'ordre depuis la borne.</li>
          </ul> 
        </div>
        </div>
   </body>
</html>
