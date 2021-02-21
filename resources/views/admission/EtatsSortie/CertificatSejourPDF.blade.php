<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Attestation de Séjour</title>
  <style>
    table 
    {
        border-collapse: collapse;
    }
    table, th, td 
    {
        border: 1px solid black;
        padding: 5px;
    }
    .center
    {
      text-align: center;
    }
    .col-sm-12
    {
      margin-bottom: 10px;
    }
    .mt-10{
        margin-top:-10px;
    }
    .mt-15{
        margin-top:-15px;
    }
    .mt-20{
      margin-top:-20px;
    }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <h3 class="mt-20 center">DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</h3>
      <h4 class="center">ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</h4>
      <h5 class="center mt-10">Chemin des Glycines - ALGER</h5>
      <h6 class="center">Tél : 023-93-34</h6>
      <h5 class="mt-15 center" ><img src="img/logo.png" style="width: 60px; height: 60px" alt="logo"/></h5>
      <h5 class="mt-20 center"><span style="font-size: xx-large;">
        <strong>Attestation de Séjour</strong></span>
      </h5><br><br>  
      <div class="row">
        <div class="col-sm-12"><strong>
        </div>
      </div>
      <div class="row" >
        <div class="col-sm-4">
          <strong>Service :</strong><span>{{ $obj->demandeHospitalisation->Service->nom}}</span>
        </div>
        <div class="col-sm-4">dgfg</div>
        <div class="col-sm-4"> gdfg</div>
      </div>
      <div class="row" >
        <div class="col-sm-6">
          <strong>Chef de servise : </strong><span>{{ $obj->demandeHospitalisation->Service->responsable->nom}}</span>&nbs;
        </div>
        <div class="col-sm-6">
          <strong>Chef de servise : </strong><span>{{ $obj->demandeHospitalisation->Service->responsable->prenom}}</span>
        </div>
      </div><br><hr/>
    </div>
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
