<!-- Delete -->
<div class="modal fade" id="select" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Select Address</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form method="post" action="checkout">
            <div class="modal-body">
                <?php foreach($address as $addressDetails):?>
                <div class="container-fluid md-3" style="border:1px solid #cecece;border-radius: 10px;margin-bottom: 20px;padding: 20px;">
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" name="address" id="<?php echo $addressDetails['ID'] ?>" value="<?php echo $addressDetails['ID'] ?>">

                        <?php $completeAddress = $addressDetails['street_number']. ', '. $addressDetails['building_no']. ', '. $addressDetails['barangay']. ', '.$addressDetails['municipality']. ', '. $addressDetails['postal_code'];
                        $fullname = $addressDetails['firstname'] . ' ' . $addressDetails['lastname'];
                        $phone = $addressDetails['phone'];
                        ?>
                        
                        <label class="custom-control-label" for="<?php echo $addressDetails['ID'] ?>"> <?php echo '<b>'.$fullname. ' '.$phone.'</b><br>'.$completeAddress?></label>
                        </div>
                    </div>
                </div> 
                <?php endforeach;?>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" name="setAddress" class="btn btn-danger">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->