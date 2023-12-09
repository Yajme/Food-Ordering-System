<?php $address = $controller->User('getAddress',$_COOKIE['customerid']); $address = $address[0]; //var_dump($data);?>
<div class="container-fluid">
        <div class="row">
            <h4>Order Details</h4>
        
            
        </div>
        <div class="row m-2">
        <a href="order" class="btn btn-primary">Back</a>
        </div>
    <div class="row">
        
        <div class="col">
            <table class="table table-bordered">
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                <?php foreach($data as $item){ ?>
                
                    
                <tr>
                    <td><?php echo $item['product_name']?></td>
                    <td><?php echo $item['quantity']?></td>
                    <td><?php echo $item['price']?></td>
                </tr>
                
                
                <?php } ?>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col sm-6 p-5">
            <div class="form-group">
            <label for="Name">Full Name</label>
            <input type="text" class="form-control" value="<?php echo $address['firstname']  . ' ' . $address['lastname'];?>"readonly>
            </div>
            <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" value="<?php echo $address['phone']?>"readonly>
            </div>
            <?php 
                $address_text = $address['building_no'] . ' ' . $address['street_number'] . ' ' . $address['barangay'] . ' ' . $address['municipality'] . ' ' . $address['postal_code'];
            ?>
            <div class="form-group">
                <label for="address">Address</label>
            <input type="text" class="form-control" value="<?php echo $address_text ?>"readonly>
            </div>
        </div>
    </div>
</div>
