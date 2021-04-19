<script type="text/javascript">
$('document').ready(function(){
   $("#accordion" ).accordion({
      collapsible: true ,
      heightStyle: "content",
      animate: 250,
      header: ".accordion-header"
  }).sortable({
      axis: "y",
      handle: ".accordion-header",
      stop: function( event, ui ) {
        ui.item.children( ".accordion-header" ).triggerHandler( "focusout" );
      }
  });
  

});
</script>
<div class="row">
<div class="col-sm-6">
    <h3 class="header blue lighter smaller">
        <i class="ace-icon fa fa-list smaller-90"></i>
        Sortable Accordion
    </h3>

    <div id="accordion" class="accordion-style2 ui-accordion ui-widget ui-helper-reset ui-sortable" role="tablist">
        <div class="group" style="">
            <h3 class="accordion-header ui-accordion-header ui-state-default ui-accordion-icons ui-sortable-handle ui-corner-all" role="tab" id="ui-id-23" aria-controls="ui-id-24" aria-selected="false" aria-expanded="false" tabindex="-1"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>Section 1</h3>

            <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-24" aria-labelledby="ui-id-23" role="tabpanel" style="display: none;" aria-hidden="true">
                <p>
                    Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
                </p>
            </div>
        </div>

        <div class="group">
            <h3 class="accordion-header ui-accordion-header ui-state-default ui-accordion-icons ui-sortable-handle ui-state-hover ui-corner-all" role="tab" id="ui-id-25" aria-controls="ui-id-26" aria-selected="false" aria-expanded="false" tabindex="0"><span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>Section 2</h3>

            <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" id="ui-id-26" aria-labelledby="ui-id-25" role="tabpanel" aria-hidden="true" style="display: none;">
                <p>
                    Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
suscipit faucibus urna.
                </p>
            </div>
        </div>
    </div><!-- #accordion -->
</div><!-- ./span -->

</div><!-- ./row -->