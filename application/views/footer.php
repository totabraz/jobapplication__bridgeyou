
<script src="<?php echo base_url('dist/vendors-external/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/js/main.js'); ?>"></script>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirm to delete</h4>
            </div>
            <div class="modal-body">
                <p>Delete user id: <span id="modal-user-id"></span></p>
            </div>
            <div class="modal-footer">
                <a href="javascript:closeModal();" class="btn btn-default">Close</a>
                <a href="javascript:removeUser();" class="btn btn-danger">Confirm</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
