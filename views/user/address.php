
<?php 
include_once '../partials/shop-header.php'; 
include_once '../../utils/location.php';

//https://psgc.gitlab.io/api/provinces/041000000/municipalities.json 
if(!isset($_COOKIE['customerid'])){
    $_SESSION['Message'] = 'Please login first';
    header('location: login');
}
if(isset($_POST['register'])){
    try{
        /**
         * This code snippet is responsible for creating an associative array called $data.
         * The array contains various user input values retrieved from the $_POST superglobal array.
         * The array keys represent the field names, while the corresponding values are obtained from the user input.
         * The array elements include:
         * - 'firstname': The user's first name.
         * - 'lastname': The user's last name.
         * - 'buildingNumber': The user's building number.
         * - 'streetNumber': The user's street number.
         * - 'barangay': The user's barangay (obtained using the Location class).
         * - 'municipality': The user's municipality (obtained using the Location class).
         * - 'postalCode': The user's postal code.
         */
        $data = array(
            'customerid' => $_COOKIE['customerid'],
            'buildingNumber' => $_POST['buildingNumber'],
            'streetNumber' => $_POST['streetNumber'],
            'barangay' => Location::Location('barangay',$_POST['barangay']),
            'municipality' => Location::Location('municipality',$_POST['municipality']),
            'postalCode' => $_POST['postalCode']
        );
        

        ExecuteObject(new CustomerController(),'user','registerAddress',$data);
        $_SESSION['Message'] = 'Address successfully registered';
    }catch(Exception $e){
        $_SESSION['errorMessage'] = $e->getMessage();
    }
}
if(isset($_POST['edit'])){
    try{
        /**
         * This code snippet is responsible for creating an associative array called $data.
         * The array contains various user input values retrieved from the $_POST superglobal array.
         * The array keys represent the field names, while the corresponding values are obtained from the user input.
         * The array elements include:
         * - 'buildingNumber': The user's building number.
         * - 'streetNumber': The user's street number.
         * - 'barangay': The user's barangay (obtained using the Location class).
         * - 'municipality': The user's municipality (obtained using the Location class).
         * - 'postalCode': The user's postal code.
         */
        $data = array(
            'customerid' => $_COOKIE['customerid'],
            'addressid' => $_POST['addressid'], // This is the hidden input field in the edit modal. It contains the address ID.
            'buildingNumber' => $_POST['buildingNumber'],
            'streetNumber' => $_POST['streetNumber'],
            'barangay' => Location::Location('barangay',$_POST['barangay']),
            'municipality' => Location::Location('municipality',$_POST['municipality']),
            'postalCode' => $_POST['postalCode']
        );
        ExecuteObject(new CustomerController(),'user','editAddress',$data);
        $_SESSION['Message'] = 'Address successfully edited';
    }catch(Exception $e){
        $_SESSION['errorMessage'] = $e->getMessage();
    }
}

if(isset($_GET['delete'])){
    try{
        ExecuteObject($Controller,'user','deleteAddress',$_GET['delete']);
        $_SESSION['Message'] = 'Address successfully deleted';
    }catch(Exception $e){
        $_SESSION['errorMessage'] = $e->getMessage();
    }
}

?>
<div class="container-fluid">         
        <div class="row px-xl-5">
            
            <div class="col-lg-7 mb-5 mx-auto">
            
                    <?php if(isset($_SESSION['Message'])){?>
                        <div class="alert alert-success" role="alert">
                            <?php 
                                echo $_SESSION['Message'];
                                unset($_SESSION['Message']); 
                                ?>
                            </div>
                    <?php }?>    
                    
                    <?php if(isset($_SESSION['errorMessage'])){ 
                        echo '<div class="alert alert-danger" role="alert">'.$_SESSION['errorMessage'].'</div>';
                        unset($_SESSION['errorMessage']);
                    }
                    ?>
                    
                    <?php 
                    if(isset($_GET['register'])){
                        include_once './address_register.php';
                    }else{
                        $Controller = new CustomerController();
                        $data = $Controller->User('getAddress',$_COOKIE['customerid']);      
                        include_once './address_list.php';
                    }
                    ?>
                    
            </div>
                        
                    
                 
            </div>
            
            <script>
                /**
                 * This function is executed when the window loads. It fetches data from an API
                 * to populate the "municipality" select element with options. It also adds an event listener
                 * to the "municipality" select element, so that when its value changes, it fetches data
                 * from another API to populate the "barangay" select element with options.
                 */
                window.onload = function() {

                    const url = 'https://psgc.gitlab.io/api/provinces/041000000/cities-municipalities.json';
                    fetch(url) 
                        .then(response => response.json())
                        .then(data =>{
                            const select = document.getElementById("municipality");

                            data.forEach(item => {
                                const option = document.createElement("option");
                                option.value = item.code;
                                option.text = item.name;
                                select.appendChild(option);
                            });

                            select.addEventListener("change",()=>{
                                const url = `https://psgc.gitlab.io/api//cities-municipalities/${select.value}/barangays.json`;
                                fetch(url) 
                                .then(response => response.json())
                                .then(data =>{
                                    const select = document.getElementById("barangay");
                                    select.innerHTML = "";
                                    data.forEach(item => {
                                        const option = document.createElement("option");
                                        option.value = item.code;
                                        option.text = item.name;
                                        select.appendChild(option);
                                    });
                                })
                                .catch(error => console.log(error));
                            
                            })
                        })
                        .catch(error => console.log(error));
                        
                }
            </script>
        </div>
        
    </div>
<?php include '../partials/shop-footer.php'?>