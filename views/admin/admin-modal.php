                <div id="myModal" class="modal">
                <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <hr>
                        <h4 class="card-title mb-4">Product Information</h5>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="prodName">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Product Desc</label>
                                <textarea class="form-control"cols="15" rows="5" name="prodDesc"></textarea>
                            </div>
                            <div class="mb-3">
                                 <div class="input-group">
                                    <span class="input-group-text" id="">Product Price</span>
                                    <input type="number" class="form-control" style="width: 10%;" name="prodPrice">
                                    <span class="input-group-text" id="">Product Category</span>
                                    <select name="category" class="form-control">
                                        <option value="1">Tonkatsu</option>
                                        <option value="2">Bento</option>
                                        <option value="3">Silog</option>
                                        <option value="4">Teriyaki</option>
                                    </select>
                                 </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Product Image</label>
                                <input type="file" class="form-control" name="imagePath"accept="image/png, image/jpeg" />
                            </div>
                            <input type="submit" class="btn btn-primary" name="addProd" value="Add Product">
                        </form>
                    </div>
                </div>