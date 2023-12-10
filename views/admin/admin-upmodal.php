<!-- Modal for Update -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <hr>
        <h4>Update Product</h4>
        <!-- Add your form for update here -->
        <form method="post">
            <label class="form-label">Product ID</label>
            <input type="text" name="product_id" class="form-control" id="updateProductId" style="background-color: transparent; border:none;" value="<?php echo $availableProducts['ID']; ?>" readonly>
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control" name="prodName">
            <label class="form-label">Product Description</label>
            <input type="text" class="form-control" name="prodDesc">
            <label class="form-label">Product Price</label>
            <input type="number" class="form-control" name="price">
            <input type="submit" class="btn btn-primary mt-2" name="updateProd" value="Update">
        </form>
    </div>
</div>

<!-- Modal for Delete -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDeleteModal()">&times;</span>
        <hr>
        <h4>Delete Product</h4>
        <hr>
        <!-- Add your form for delete here -->
        <form method="post">
        <label class="form-label">Product ID</label>
            <input type="text" name="product_id" class="form-control" style="background-color: transparent; border:none;" id="deleteProductId" value="<?php echo $availableProducts['ID'];?>" readonly>
            <p>Are you sure you want to delete the product?</p>
            <input type="submit" class="btn btn-danger mt-2" name="deleteProd" value="Delete">
        </form>
    </div>
</div>