<div class="container-fluid">
        <div class="page-header bg-success" style="height:40px;" >
                 <h5 class ="w-25"><strong>Resumé du&nbsp;</strong><q>{{ $employe->Nom_Employe}} {{ $employe->Prenom_Employe }}</q></h5>
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
                                <td colspan="1" class ="noborders"><strong>Username:</strong></td>
                                <td colspan="1">{{ $user->name }}</td>
                                <td colspan="1" class ="noborders"><strong>Nom :</strong></td>
                                <td colspan="1">{{ $employe->Nom_Employe }}</td>
                     </tr>
                     <tr>
                           	<td colspan="1" class ="noborders"><strong><strong>Email :</strong></strong></td>
                           	<td> {{ $user->email }}</td>
                           	<td  colspan="1" class ="noborders"><strong>Prenom:</strong></td>
                        	     <td>{{ $employe->Prenom_Employe }}</td>
               	     </tr>
         		     <tr>
                           <td colspan="1" class ="noborders"><strong>Role :</strong></td>
                     	     <td> {{ $user->role->role }}</td>
                           <td colspan="1" class ="noborders"><strong>Genre:</strong></td>
                        	<td>@if ( $employe->Sexe_Employe == 'F' ) Féminin   @else  Masculin @endif </td>
               	</tr>
               	<tr>
                           <td colspan="1" class ="noborders"><strong>Compte :</strong></td>
                     	      <td>@if ( $user->active == '1' ) Active   @else Désactiver   @endif</td>
                           <td class ="noborders"><strong>Adress:</strong></td>
                           <td>{{ $employe->Adresse_Employe }}</td>
               	</tr>	
                <tr>
                          <td colspan="1" class ="noborders"><strong>Tél Fixe :</strong></td>
                          <td>{{ $employe->Tele_fixe }}</td>
                          <td class ="noborders"><strong>Mob:</strong></td>
                          <td>{{ $employe->tele_mobile }}</td>
                </tr>           
            </tbody>
         </table>
 </div>           
    