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
                  <span class="label label-sm label-success"><strong>Conjoint(e)</strong></span>
                  @break
                @case ("1")
                             <span class="label label-sm label-success"><strong>Père</strong></span>
                          @break
                     @case ("2")
                          <span class="label label-sm label-success"><strong>Mère</strong></span>
                          @break
                     @case ("3")
                           <span class="label label-sm label-success"><strong>Frère</strong></span>                                             
                           @break
                     @case ("4")
                         <span class="label label-sm label-success"><strong>Soeur</strong></span> 
                          @break
                    @case ("5")
                      <span class="label label-sm label-success"><strong>Ascendant</strong></span>
                           @break
                    @case ("6")
                          <span class="label label-sm label-success"><strong>Grand-parent</strong></span>
                          @break
                    @case ("7")
                           <span class="label label-sm label-success"><strong>Membre de famille</strong></span>
                         @break
                    @case ("8")
                           <span class="label label-sm label-success"><strong>Ami(e)</strong></span>
                          @break             
                    @case("9")
                           <span class="label label-sm label-success"><strong>Collègue</strong></span>
                            @break 
                    @case ("10")
                      <span class="label label-sm label-success"><strong>Employeur</strong></span>
                          @break 
                    @case ("11")
                         <span class="label label-sm label-success"><strong>Employé</strong></span>
                          @break 
                    @case ("12")
                           <span class="label label-sm label-success"><strong>Tuteur</strong></span>
                          @break
                   @case ("13")
                            <span class="label label-sm label-success"><strong>Autre</strong></span>
                          @break 
                   @default
                          @break
             @endswitch 
              </td>
            <td>
              @switch( $hom->type_piece)
                @case ("0")
                  <span class="label label-sm label-success"><strong>Carte nationale d'identité</strong></span>
                  @break
                @case ("1")
                  <span class="label label-sm label-success"><strong>Permis de conduire</strong></span>
                  @break
                @case ("2")
                  <span class="label label-sm label-success"><strong>Passeport</strong></span>
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