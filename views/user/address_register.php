<form  method="POST" action="address">
<div class="row"> 
            <h2 class="section-title position-relative text-uppercase  mb-4">Register Address</h2>
        </div>
    <div class="row">
        <div class="col-md-6">
            <div class="control-group">
                <label for="buildingNumber">Building/House number</label>
                <input type="text" class="form-control" name="buildingNumber" placeholder="Building/House Number" required="required"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="control-group">
                <label for="streetnumber">Street Number</label>
                <input type="text" class="form-control" name="streetNumber" placeholder="Street Number" required="required"/>
                               
            </div>
        </div>
        <div class="col-md-6">
            <div class="control-group">
                <label for="barangay">Barangay</label>
                <select class="form-control" name="barangay" id="barangay" required>
                    <option value="">Select a barangay</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="control-group">
                <label for="municipality">Municipality</label>
                <select class="form-control" name="municipality" id="municipality" required>
                    <option value="">Select a municipality</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="control-group">
                <label for="postalcode">Postal code</label>
                <input type="text" class="form-control" name="postalCode" placeholder="Postal Code" required="required"/>
            </div>
        </div>
    </div>
    <div class="row">   
        <div class="col-md-6 p-6">
            <br>
            <button type="submit" class="btn btn-primary py-2 px-4" name="register">Save</button>
        </div>
       
    </div>
    
</form>