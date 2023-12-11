
       <!-- Order List -->

       <!-- Order Tabs Start-->
        <div class="nav nav-tabs mb-4 p-3">
            <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Preparing</a>
            <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Shipping</a>
            <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Delivered</a>
            <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-4">Received</a>
        </div>
        <!-- Order Tabs End-->

        <!-- Order Tab Content-->
        <div class="tab-content">
            <!-- Preparing Tab Start-->
            <div class="tab-pane fade show active" id="tab-pane-1">
                <h4 class="mb-3">Preparing</h4>
                <div class="row">
                    <div class="col mb-3 lg-3">
                    <select class="form-control" name="preparing" id="listing">
                        <option value="">Select a option</option>
                        <option value="5">Show 5 orders</option>
                        <option value="10">Show 10 orders</option>
                        <option value="*">Show all</option>
                    </select>       
                    </div>
                </div>
               
                <?php 
                if(isset($_GET['show']) && isset($_GET['preparing'])){
                    $controller->Order('preparingOrders',array($data,$_GET['show']) );
                }else{
                    $controller->Order('preparingOrders',$data); 
                }
               
                ?>
            </div>
            <!-- Preparing Tab End-->
            <!-- Shipping Tab Start-->

            <div class="tab-pane fade" id="tab-pane-2">
                <h4 class="mb-3">Shipping</h4>
                <div class="row">
                    <div class="col mb-3 lg-3">
                    <select class="form-control" name="shipping" id="listing">
                        <option value="">Select a option</option>
                        <option value="5">Show 5 orders</option>
                        <option value="10">Show 10 orders</option>
                        <option value="*">Show all</option>
                    </select>       
                    </div>
                </div>
                <?php
                if(isset($_GET['show']) && isset($_GET['shipping'])){
                    $controller->Order('shippingOrders',array($data,$_GET['show']));
                }else{
                    $controller->Order('shippingOrders',$data);
                }
                 
                ?>
            </div>
            <!-- Shipping Tab End-->
            <!-- Delivered Tab Start-->
            <div class="tab-pane fade" id="tab-pane-3">
                <h4 class="mb-3">Delivered</h4>
                <div class="row">
                    <div class="col mb-3 lg-3">
                    <select class="form-control" name="delivered" id="listing">
                        <option value="">Select a option</option>
                        <option value="5">Show 5 orders</option>
                        <option value="10">Show 10 orders</option>
                        <option value="*">Show all</option>
                    </select>       
                    </div>
                </div>
                <?php 
                if(isset($_GET['show']) && isset($_GET['delivered'])){
                     $controller->Order('deliveredOrders',array($data,$_GET['show'])); 
                }else{
                    $controller->Order('deliveredOrders',$data); 
                }
                ?>
            </div>
            <div class="tab-pane fade" id="tab-pane-4">
                <h4 class="mb-3">Received</h4>
                <div class="row">
                    <div class="col mb-3 lg-3">
                    <select class="form-control" name="received" id="listing">
                        <option value="">Select a option</option>
                        <option value="5">Show 5 orders</option>
                        <option value="10">Show 10 orders</option>
                        <option value="*">Show all</option>
                    </select>       
                    </div>
                </div>
                <?php 
                if(isset($_GET['show']) && isset($_GET['received'])){
                    $controller->Order('receivedOrders',array($data,$_GET['show'])); 
                }else{
                    $controller->Order('receivedOrders',$data);
                }
                 ?>
            </div>
        </div>
        <!-- Delivered Tab End-->
    <script>
        
                    window.onload = function () {
                const options = document.querySelectorAll('#listing');

                for (let i = 0; i < options.length; i++) {
                    options[i].addEventListener('change', (event) => {
                        const value = event.target.value;
                        const name = event.target.name;
                        window.location.href = `order?show=${value}&${name}`;
                    });
                }
            };

    </script>