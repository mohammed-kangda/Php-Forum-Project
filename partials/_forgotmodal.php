<!-- Modal -->
<div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="forgotModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="forgotModalLabel">Change Your Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    
        <form action="/project/partials/_handleforgot.php" method='post'>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Enter Username</label>
                    <input type="text" class="form-control" name="loginUser" id="loginUser" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Enter New Password</label>
                    <input type="password" class="form-control" name="loginfPass" id="loginfPass">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" name="loginfcPass" id="loginfcPass">
                </div>  
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>

    </div>
  </div>
</div>