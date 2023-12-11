<div class="row mb-3">
    <div class="col center">
        <h1>Address List</h1>
    </div>
    
</div>  
        <div class="row">
            <div class="col lg-3 mb-3">
                <button type="button" class="btn btn-primary" onclick="window.location.href='address?register'"><i class="fa-solid fa-plus"></i></button>
            </div>
        </div>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Building Number</th>
                    <th>Street Number</th>
                    <th>Barangay</th>
                    <th>Municipality</th>
                    <th>Postal Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $key): ?>
                    <tr>
                        <td><?= $key['building_no'] ?></td>
                        <td><?= $key['street_number'] ?></td>
                        <td><?= $key['barangay'] ?></td>
                        <td><?= $key['municipality'] ?></td>
                        <td><?= $key['postal_code'] ?></td>
                        <td>
                            <a href="#edit<?php echo  $key['ID']?>" class="btn btn-primary" data-toggle="modal"><i class="fa-regular fa-pen-to-square"></i></a>

                            <a href="#delete<?php echo  $key['ID']?>" class="btn btn-danger" data-toggle="modal"><i class="fa-solid fa-trash"></i></a>
                            
                        </td>
                        <?php include './address_modal.php'; ?> 
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
