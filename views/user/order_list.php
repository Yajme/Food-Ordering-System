
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
                <?php $controller->Order('preparingOrders',$data); ?>
                   
            </div>
            <!-- Preparing Tab End-->
            <!-- Shipping Tab Start-->

            <div class="tab-pane fade" id="tab-pane-2">
                <h4 class="mb-3">Shipping</h4>
                <?php $controller->Order('shippingOrders',$data); ?>
            </div>
            <!-- Shipping Tab End-->
            <!-- Delivered Tab Start-->
            <div class="tab-pane fade" id="tab-pane-3">
                <h4 class="mb-3">Delivered</h4>

                <?php $controller->Order('deliveredOrders',$data); ?>
            </div>
            <div class="tab-pane fade" id="tab-pane-4">
                <h4 class="mb-3">Received</h4>

                <?php $controller->Order('receivedOrders',$data); ?>
            </div>
        </div>
        <!-- Delivered Tab End-->
    