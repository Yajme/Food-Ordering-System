<!-- Delete -->
<div class="modal fade" id="delete<?php echo  $key['ID']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Delete Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                
            </div>
            <div class="modal-body">
			<div class="container-fluid text-center">
				<h5>Are sure you want to delete</h5>
				<?php 
				$AddressText = $key['street_number'] . ', ' . $key['building_no'] . ', ' . $key['barangay'] . ', ' . $key['municipality'] . ', ' . $key['postal_code'];
				?>
				
				<h2> <?php echo $AddressText ?> ?</h2> 
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="delete.php?id=>" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->

<!-- Edit -->
<div class="modal fade" id="edit<?php echo $key['ID']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Member</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="edit.php?id=">
				<div class="row">
                        <div class="col-md-6">
                            <div class="control-group">
                            <label for="firstname">Street Number</label>
                                <input type="text" class="form-control" name="street_number" placeholder="Street Number" required="required" value="<?php echo $key['street_number']; ?>"/>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="control-group">
                                <label for="lastname">Building Number</label>
                                <input type="text" class="form-control" name="building_no" placeholder="Building Number" required="required" value="<?php echo $key['building_no']; ?>"/>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="control-group">
                                <label for="lastname">Barangay</label>
                                <input type="text" class="form-control" name="barangay" placeholder="Barangay" required="required" value="<?php echo $key['barangay']; ?>"/>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="control-group">
                                <label for="lastname">Municipality</label>
                                <input type="text" class="form-control" name="Municipality" placeholder="Municipality" required="required" value="<?php echo $key['municipality']; ?>"/>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="control-group">
                                <label for="lastname">Postal Code</label>
                                <input type="text" class="form-control" name="postal_code" placeholder="Postal Code" required="required" value="<?php echo $key['postal_code']; ?>"/>
                            </div>
                        </div>
				</div>
				<!---->
            </div> 
			</div>
            <div class="modal-footer">	
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" name="edit" class="btn btn-warning">Save</button>
            </div>
			</form>
        </div>
    </div>
</div>
<!-- /.modal -->