<div class="col-xs-12 col-sm-12 widget-container-col" id="widget-container-col-2">
	<div class="widget-box widget-color-blue" id="widget-box-2">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">
				<i class="ace-icon fa fa-table"></i>Gardes Malades/Hommes de Confiance
			</h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
				<div class="fa fa-plus-circle"></div>{{-- <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> --}}
					<a href="#" data-target="#gardeMalade" class="btn-xs tooltip-link" data-toggle="modal"  data-toggle="tooltip" data-original-title="Ajouter un Correspondant" >
						<strong>Ajouter un Correspondant</strong>
					</a>
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
			<table id="listeGardes" class="table nowrap dataTable no-footer" style="width:100%">
          <thead>
            <tr>
              <th hidden></th>
              <th class ="center"><strong>Nom</strong> </th>
              <th class ="center"><strong>Prénom</strong></th>
              <th class ="center"><strong>né(e) le</strong></th>
              <th class ="center"><strong>Adresse</strong></th>
              <th class ="center"><strong>Tél</strong></th>
              <th class ="center"><strong>Relation</strong></th>
              <th class ="center"><strong>Type Pièce</strong></th>
              <th class ="center"><strong>N°</strong></th>
              <th class ="center"><strong>date délevrance</strong></th>
              <th class="nsort"><em class="fa fa-cog"></em></th>
            </tr>
          </thead>
        <tbody>
        @foreach($correspondants as $hom)
          <tr id="{{ 'garde'.$hom->id }}">
            <td hidden>{{ $hom->id_patient }}</td>
            <td>{{ $hom->nom }}</td>
            <td>{{ $hom->prenom }}</td>
            <td>{{ $hom->date_naiss }}</td>
            <td>{{ $hom->adresse }}</td>
            <td>{{ $hom->mob }}</td>
            <td>{{ $hom->lien_par }}</td>
            <td>{{ $hom->type_piece }}</td>
            <td>{{ $hom->num_piece }}</td>
            <td>{{ $hom->date_deliv }}</td>
            <td class="center nosort">
             	<button type="button" class="btn btn-xs btn-success show-modal" value="{{ $hom->id }}" data-cmd="show">
              	<i class="ace-icon fa fa-hand-o-up fa-xs"></i>
              </button>
         		  <button type="button" class="btn btn-xs btn-info open-modal" value="{{ $hom->id }}" data-cmd="edit">
              	<i class="fa fa-edit fa-xs"></i>
              </button>
               <button type="button" class="btn btn-xs btn-danger delete-garde" value="{{$hom->id}}" data-confirm="Etes Vous Sur de supprimer?"><i class="fa fa-trash-o fa-xs"></i></button>
					</td>
          </tr>
        @endforeach
        </tbody>
       </table>
				 </div>  <!-- widget-main --> 
		     </div> <!-- widget-body -->
	</div>     <!-- widget-box	 -->
  </div> <!-- widget-container  -->