<div id="dialog" title="Confimer">
    <hr>
      <div class="row center"><h4>Confirmez-vous le rendez-vous?</h4></div>
      <div class="space-12"></div>
      <div class="row center"><h4><b id="dateRendezVous"></b></h4></div>
      @if( Auth::user()->role_id ==1)
              <div class="row center">
                     <div class="col-xs-12">
                           <div class="checkbox">
                                   <label><input name="fixe" type="checkbox" class="ace" value="1" />
                                         <span class="lbl">&nbsp; Fixe</span>
                                  </label>
                          </div>
                     </div>
               </div> 
       @endif
    <br>
</div>