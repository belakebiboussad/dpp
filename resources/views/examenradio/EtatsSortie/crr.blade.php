<!DOCTYPE html>
<html lang="en">
<head>
  	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<title>CRR</title>
    	<link rel="stylesheet" href="{{ asset('css/print.css') }}"  />	
    </head>
<body>
	 <h3 class="center" id="tutelle">{{ $etab->tutelle }}</h3>
  	 <h4 class="mt-3 center"  >{{ $etab->nom }}</h4>
  	 <h5 class="mt-3 center">{{ $etab->adresse }}</h5>
  	 <h5 class="mt-3 center" >Tél : {{ $etab->tel }} - {{ $etab->tel2 }}</h5>  
      	<h5 class="center mt-3"  >
            @if(isset($path_img))
                  <img src="{{ $path_img }}"  alt="logo" width="80" />
             @else
                  <img src="img/{{ $etab->logo }}" alt="logo" style="width: 80px; height: 80px"/>
             @endif
        </h5>
	<hr class="mt-2"/>
  	<div class="row" style ="margin-top: -0.8em;" ><div class="col-sm-12 center"><h3><u>Compte-rendu radiologique</u></h3></div></div>
   	<br/><br/>
	<div class="row">
    		<div class="center solid"><b><span style="font-size:20px;">Indication </span></b>
   		</div>
  	</div><br/>
  	  <div class="row"><div class="col-xs-12"><p  style="font-size:16px;">&nbsp;
    	@if(isset($crr))
      		{{ $crr->indication }}
      	@else
      	      {{ $indication }}
    @endif
  </p></div>
  </div>
   <div class="row">
    <div class="center solid"><b><span style="font-size:20px;">Technique de réaliation</span></b>
   </div>
  </div><br>
  <div class="row"><div class="col-xs-12"><p style="font-size:16px;">&nbsp;
    	@if(isset($crr))
      		{{ $crr->indication }}
      	@else
      	      {{ $indication }}
    @endif
  </p></div>
  </div>
   <div class="row">
    <div class="center solid"><b><span style="font-size:20px;">Résultat</span></b>
   </div>
  </div><br>
  <div class="row"><div class="col-xs-12"><p  style="font-size:16px;">&nbsp;
    	@if(isset($crr))
      		{{ $crr->result }}
      	@else
      	      {{ $result }}
    @endif
  </p></div>
  </div>
     <div class="row">
    <div class="center solid"><b><span style="font-size:20px;">Synthèse Conclusion</span></b>
   </div>
  </div><br>
  <div class="row"><div class="col-xs-12"><p  style="font-size:16px;">&nbsp;
    	@if(isset($crr))
      		{{ $crr->conclusion }}
      	@else
      	      {{ $conclusion }}
    @endif
  </p></div>
  </div>
</body>

</html>