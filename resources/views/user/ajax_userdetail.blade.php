<div class="container-fluid">
        <div class="page-header bg-success" style="height:40px;" >
                 <h5 class ="w-25">Resumé du l'utilisateur {{ $employe->Nom_Employe}} {{ $employe->Prenom_Employe }}</h5>
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
                           <td colspan="1" class ="noborders">user :</td>
                          <td colspan="1">{{ $user->name }}</td>
                          <td colspan="1" class ="noborders">nom :</td>
                           <td colspan="1">{{ $employe->Nom_Employe }}</td>
                      </tr>
                     <tr>
                           	<td colspan="1" class ="noborders">email :</td>
                     	<td {{ $user->email }}</td>
                           	<td  colspan="1" class ="noborders">prenom:</td>
                        	<td>{{ $employe->Prenom_Employe }}</td>
               	</tr>
         		<tr>
                           	<td colspan="1" class ="noborders">role :</td>
                     	<td {{ $role->role }}</td>
                           	<td colspan="1" class ="noborders">sexe:</td>
                        	<td> {{ $employe->Sexe_Employe }}</td>
               	</tr>
               	<tr>
                           	<td colspan="1" class ="noborders">compte :</td>
                     	<td> {{ $user->active}}</td>
                           	<td>11.03%</td>
                        	<td>Java</td>
               	</tr>	
            </tbody>
         </table>
 </div>           
    