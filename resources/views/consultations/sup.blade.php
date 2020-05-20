<div class="wrap">
  <h1>Bootstrap Modal Example</h1>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#MyModal">
    Large modal
  </button>
</div>
 <div id="printThis">
<div id="MyModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">
    
    <!-- Modal Content: begins -->
    <div class="modal-content">
      
      <!-- Modal Header -->
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalLabel">Your Headings</h4>
      </div>
    
      <!-- Modal Body -->  
      <div class="modal-body">
        <div class="body-message">
          <h4>Any Heading</h4>
          <p>And a paragraph with a full sentence or something else...</p>
        </div>
      </div>
    
      <!-- Modal Footer -->
      <div class="modal-footer">
       <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
      <button id="btnPrint" type="button" class="btn btn-default">Print</button>
      </div>
    
    </div>
    <!-- Modal Content: ends -->
    
  </div>
    </div>
</div>
