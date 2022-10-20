<div class="col-xs-12 col-sm-12 widget-container-col">
	<div class="widget-box widget-color-blue">
		<div class="widget-header">
			<h5 class="widget-title bigger lighter">
        <i class="ace-icon fa fa-table"></i>Gardes malade/Homme de confiance
      </h5>
			<div class="widget-toolbar widget-toolbar-light no-border">
        <a href="#" id="btn-addCores" class="btn-xs tooltip-link align-middle">
          <i class="fa fa-plus-circle bigger-180"></i>
        </a>
			</div>
		</div>
		<div class="widget-body">
			<div class="widget-main no-padding">
			<table id="listeGardes" class="table nowrap dataTable no-footer" style="width:100%">
        <thead>
          <tr>
            <th hidden></th>
            <th class ="center sorting_disabled">Nom</th><th class ="center sorting_disabled">Prénom</th>
            <th class ="center sorting_disabled">né(e) le</th><th class ="center sorting_disabled">Adresse</th>
            <th class ="center sorting_disabled">Tél</th><th class ="center sorting_disabled">Qualité</th>
            <th class ="center sorting_disabled">Type Pièce</th><th class ="center sorting_disabled">N°</th>
            <th class ="center sorting_disabled">Date de délivrance</th><th class="sorting_disabled center"><em class="fa fa-cog"></em></th>
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
            <td class ="center">
              @switch($hom->lien_par)
                @case ("0")
                  <span class="label label-sm label-success"><b>Conjoint(e)</b></span>
                  @break
                @case ("1")
                             <span class="label label-sm label-success"><b>Père</b></span>
                          @break
                     @case ("2")
                          <span class="label label-sm label-success"><b>Mère</b></span>
                          @break
                     @case ("3")
                           <span class="label label-sm label-success"><b>Frère</b></span>                                             
                           @break
                     @case ("4")
                         <span class="label label-sm label-success"><b>Soeur</b></span> 
                          @break
                    @case ("5")
                      <span class="label label-sm label-success"><b>Ascendant</b></span>
                           @break
                    @case ("6")
                          <span class="label label-sm label-success"><b>Grand-parent</b></span>
                          @break
                    @case ("7")
                           <span class="label label-sm label-success"><b>Membre de famille</b></span>
                         @break
                    @case ("8")
                           <span class="label label-sm label-success"><b>Ami(e)</b></span>
                          @break             
                    @case("9")
                           <span class="label label-sm label-success"><b>Collègue</b></span>
                            @break 
                    @case ("10")
                      <span class="label label-sm label-success"><b>Employeur</b></span>
                          @break 
                    @case ("11")
                         <span class="label label-sm label-success"><b>Employé</b></span>
                          @break 
                    @case ("12")
                           <span class="label label-sm label-success"><b>Tuteur</b></span>
                          @break
                   @case ("13")
                            <span class="label label-sm label-success"><b>Autre</b></span>
                          @break 
                   @default
                          @break
             @endswitch 
              </td>
            <td>
              @switch( $hom->type_piece)
                @case ("0")
                  <span class="label label-sm label-success"><b>Carte nationale d'identité</b></span>
                  @break
                @case ("1")
                  <span class="label label-sm label-success"><b>Permis de conduire</b></span>
                  @break
                @case ("2")
                  <span class="label label-sm label-success"><b>Passeport</b></span>
                  @break
                @default
                  @break
              @endswitch
              </td>
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