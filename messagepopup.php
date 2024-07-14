<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="signInModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signInModalLabel">Sign In Modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Modal body content -->
        <p>This is the content of the Sign In modal triggered by PHP condition in another file. You can add your form or any other content here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript to close modal after 2 seconds -->
<script type="text/javascript">
$(document).ready(function(){
    // Automatically close modal after 2 seconds
    setTimeout(function() {
        $("#messageModal").modal("hide");
    }, 2000); // 2000 milliseconds = 2 seconds
});
</script>