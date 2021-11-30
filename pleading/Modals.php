<!-- Modals Department -->
<div class="Modals">
    <!--Create Pleadingl -->
<div class="modal fade" id="bmmodals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lgl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Create Book-Mark</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <div class="container-fluid">
             <form id="bookmarkform">
  <div class="">
    <label for="bookMarkN" class="font-weight-bold">Book-Mark Title</label>
    <input type="text" class="form-control" id="bookMarkN" placeholder="Enter Book-Mark Title" >
<!--    <label for="bookMarkN" class="form-label ">Start page </label>-->
    <input type="hidden" id="pdfpageNo" class="form-control" >
     <input type="hidden" id="bids">
    </div>
                 <button type="button" id="createbm" class="btn btn-sm text-white my-4">Create Book-Mark</button>
             </form>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
    
    
    
    
    
<!-- Modal 
<div class="modal fade" id="bmmodals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create BookMark</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
             <form id="bookmarkform">
  <div class="">
    <label for="bookMarkN" class="form-label ">Book-Mark Title</label>
    <input type="text" class="form-control" id="bookMarkN" placeholder="Enter Book-Mark Title" >
    <label for="bookMarkN" class="form-label ">Start page </label>
    <input type="hidden" id="pdfpageNo" class="form-control" >
     <input type="hidden" id="bids">
    <button type="button" class="btn btn-sm text-white my-4">Create Book-Mark</button>
  </div>
             </form>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>-->




<!-- Modal -->
<div class="modal fade" id="EditDelM" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit BookMark</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div id="editBM">
              
          </div>
      </div>
      <div class="modal-footer">
          
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>



<!-- Sub BookmarkModal -->
<div class="modal fade" id="AddSubBM"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Sub BookMark</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="container-fluid" id="dysubbookmark">
            
      </div>
      <div class="modal-footer">
          
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>

</div>