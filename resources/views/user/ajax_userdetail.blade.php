<div class="container-fluid">
        <div class="page-header bg-success">
                 <h1>Resumé du l'utilisateur {{ $employe->Nom_Employe}} {{ $employe->Prenom_Employe }}</h1>
         </div>
         <table class="table table-bordered table-sm">
          <thead class="thead-light">
            <tr>
                    <th colspan ="2"><p class="text-center"><strong>Identification</strong></p></th>
                     <th colspan ="2"><p  class="text-center"><strong>Informations</strong></p></th>
            </tr>
            </thead>
            <tbody>
                     <tr>
                           <td colspan="1" class ="noborders"><label for="male"><strong>user :</strong></label></td>
                          <td colspan="1"><input type="text" class="form-control form-control-sm" value ="{{ $user->name }}" readonly/></td>
                          <td colspan="1" class ="noborders">14.21%</td>
                           <td colspan="1">Java</td>
                      </tr>
                     <tr>
                           <td colspan="1" class ="noborders"><label for="male"><strong>email :</strong></label></td>
                          <td {{ $user->email }}</td>
                           <td>11.03%</td>
                        <td>Java</td>
               </tr>
         
            </tbody>
         </table>
 </div>           
    