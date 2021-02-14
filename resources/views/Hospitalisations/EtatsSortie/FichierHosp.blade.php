<html>
	<head>
		<meta charset="utf-8">
		<title>fich hospital</title>
		<style>
  		@media print {
	      .print {display:block}
	      .btn-print {display:none;}
	    }
    	.section
			{
				margin-bottom: 20px;
			}
			.sec-gauche
			{
				float: left;
			}
			.sec-droite
			{
				float: right;
			}
			.center
			{
				text-align: center;
			}
			.col-sm-12
			{
				margin-bottom: 10px;
			}
			.mt-15{
	        margin-top:-15px;
			}
			.mt12{
	        padding-top:+12px;
			}
			.mt-20{
	      margin-top:-20px;
			}
			.ml-80{
      	 margin-left: +80%;
			}
			.ml-4{
        margin-left: +4%;
			}
			.foo{
      position: absolute;
      top: 90%;
      right: 22%;
		}
    </style>
	</head>
	<body>
  	<div class="container-fluid" >
  		<h4 class="mt12 center">DIRECTION GENERAL DE LA SÛRETÉ NATIONALE</h4>
      <h4 class="center">ETABLISSEMENT HOSPITALIER DE LA SÛRETÉ NATIONALE"LES GLYCINES"</h4>
			<h4 class="center">Chemin des Glycines - ALGER</h4>
			<h4 class="center">Tél : 023-93-34</h4>
			<h5 class="mt-15 center" ><img src="{{ asset('/img/logo.png') }}" style="width: 60px; height: 60px" alt="logo"/></h5>
  		<h5 class="mt-20 center"><span style="font-size: xx-large;"><strong>Ordonnance</strong></span></h5>
  		<div class="row">


  			
			
			</div>

			@foreach($medecins as $medecin)
										{{$medecin->nom }} {{$medecin->prenom }} 
			@endforeach


{{ $patient->Nom }}
         @foreach($patients as $p)
            
                   @endforeach

@foreach($hosp as $g)

                   
     <tr>
        <td> {{ $p->Nom }}</td>
        <td>{{ $p->Prenom }}</td>
        <td>{{ $p->Sexe }}</td>
        <td>{{ $p->Dat_Naissance }}</td>
        <td>{{ $p->Date_entree }}</td>
        <td>{{ $p->Date_Prevu_Sortie }}</td>
        <td>
          <a href="/visite/create/{{$p->id}}" class="btn btn-xs btn-success">
            <i class="ace-icon fa fa-sign-in bigger-120"></i>Ajouter une visite
          </a>
        </td>
      </tr>
      @endforeach 
			<div class="section">
				<div class="sec-droite"><span><strong> Docteur :</strong> {{ Auth::user()->employ->nom }} {{ Auth::user()->employ->prenom }}  </span></div>
    	</div>
			
			
	</body>
</html>