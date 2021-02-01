<div class="container-fluid">
  <div class="page-header bg-success" style="height:40px;" >
    <h5 class ="w-25"><strong>Resumé du&nbsp;</strong><q>{{ $employe->nom}} {{ $employe->prenom }}</q></h5>
  </div>
  <table class="table table-bordered table-condensed col-sm-12 w-auto">
    <thead class="thead-light">
      <tr>
        <th colspan ="2" style="height:40px"><p class="text-center"><strong>Identification</strong></p></th>	
        <th colspan ="2" style="height:40px"><p  class="text-center"><strong>Informations</strong></p></th>
      </tr>
    </thead>
    <tbody>
    <tr>
      <td colspan="1" class ="noborders"><strong>Username:</strong></td><td colspan="1">{{ $user->name }}</td>
      <td colspan="1" class ="noborders"><strong>Nom :</strong></td><td colspan="1">{{ $employe->nom }}</td>
    </tr>
    <tr>
      <td colspan="1" class ="noborders"><strong><strong>Email :</strong></strong></td><td> {{ $user->email }}</td>
    	<td colspan="1" class ="noborders"><strong>Prenom:</strong></td> <td>{{ $employe->prenom }}</td>
    </tr>
    <tr>
      <td colspan="1" class ="noborders"><strong>Rôle :</strong></td> <td> {{ $user->role->role }}</td>
      <td colspan="1" class ="noborders"><strong>Genre:</strong></td><td>@if( $employe->sexe == 'F' ) Féminin @else Masculin @endif </td>
    </tr>
    <tr>
      <td colspan="1" class ="noborders"><strong>Compte :</strong></td><td>@if( $user->active == '1' ) Active @else Désactiver @endif</td>
      <td class ="noborders"><strong>Adress:</strong></td><td>{{ $employe->Adresse }}</td>
    </tr>	
    <tr>
      <td colspan="1" class ="noborders"><strong>Tél Fixe :</strong></td>   <td>{{ $employe->Tele_fixe }}</td>
      <td class ="noborders"><strong>Mob:</strong></td> <td>{{ $employe->tele_mobile }}</td>
    </tr>           
    </tbody>
  </table>
</div>           
    