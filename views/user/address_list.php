<div class="row mb-3">
    <div class="col center">
        <h1>Address List</h1>
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
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
        </div>
