
<?php include_once '../partials/shop-header.php'; 
include_once '../../utils/location.php';

//https://psgc.gitlab.io/api/provinces/041000000/municipalities.json 
function ExecuteSignup(ISignup $signup,$params){
    try{
        return $signup->Signup($params);
    }catch(Exception $e){
        throw $e;
    }
}
function ExecuteLogin(ILogin $Interface,$params=null){
    return $Interface->Login($params[0],$params[1]);
}
if(isset($_POST['signup'])){
    /**
     * This code block handles the signup process for a user.
     * It retrieves the necessary data from the $_POST array and validates the password.
     * If the password matches, it creates a new CustomerController object and calls the Signup method,
     * followed by the Login method to log in the user.
     * Finally, it redirects the user to the index.php page.
     * If any exception occurs during the process, it stores the error message in the $_SESSION['errorMessage'] variable.
     */
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
         * - 'phone': The user's phone number.
         * - 'email': The user's email address.
         * - 'username': The user's username.
         * - 'basePassword': The user's base password.
         * - 'comparePassword': The user's password for comparison.
         */
        $data = array(
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'buildingNumber' => $_POST['buildingNumber'],
            'streetNumber' => $_POST['streetNumber'],
            'barangay' => Location::Location('barangay',$_POST['barangay']),
            'municipality' => Location::Location('municipality',$_POST['municipality']),
            'postalCode' => $_POST['postalCode'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'username' => $_POST['username'],
            'basePassword' => $_POST['basePassword'],
            'comparePassword' => $_POST['comparePassword']
        );
        if($data['basePassword'] != $data['comparePassword']){
            throw new Exception('Password does not match');
        }

        ExecuteSignup(new CustomerController(),$data);
        ExecuteLogin(new CustomerController(),array($data['username'],$data['basePassword']));
        header('location: index.php');
    }catch(Exception $e){
        $_SESSION['errorMessage'] = $e->getMessage();
    }
}
?>
<div class="container-fluid">         
        <div class="row px-xl-5 mx-auto"> 
            <h2 class="section-title position-relative text-uppercase mx-auto mb-4">signup</h2>
        </div>
        
        <?php if(isset($_SESSION['errorMessage'])){ ?>
                <div class="alert alert-danger" role="alert">
                    <p class="help-block text-danger">
                       
                    <?php echo $_SESSION['errorMessage'];
                    unset($_SESSION['errorMessage']);
                     ?>
                            
                        
                        
                    </p>
                </div>
            <?php }?>
        <div class="row px-xl-5">
            <!--how do i center from this -->
            <div class="col-lg-7 mb-5 mx-auto">
                    <?php if(isset($_SESSION['Message'])){?>
                        <p class="help-block text-success">
                            <?php echo $_SESSION['Message'];
                            unset($_SESSION['Message']); 
                            ?>
                        </p>
                    <?php }?>    
                    <p class="help-block text-danger">
                    <?php if(isset($_SESSION['errorMessage'])){ 
                        echo $_SESSION['errorMessage'];
                        unset($_SESSION['errorMessage']);
                    }
                    ?>
                    </p>
                    <form  method="POST" action="signup">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="control-group">
                            <label for="firstname">First Name</label>
                                <input type="text" class="form-control" name="firstname" placeholder="First name" required="required"/>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="control-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" name="lastname" placeholder="Last name" required="required"/>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                           <div class="col-md-12">
                                <label for="address">Address</label>
                            </div>
                            <div class="control-group">
                            
                                <input type="text" class="form-control" name="buildingNumber" placeholder="Building/House Number" required="required"/>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="control-group">
                            <label for="streetnumber"></label>
                                <input type="text" class="form-control" name="streetNumber" placeholder="Street Number" required="required"/>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="control-group">
                            <select class="form-control" name="barangay" id="barangay" required>
                                <option value="">Select a barangay</option>
                            </select>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="control-group">
                            <select class="form-control" name="municipality" id="municipality" required>
                                <option value="">Select a municipality</option>
                            </select>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="control-group">
                                <input type="text" class="form-control" name="postalCode" placeholder="Postal Code" required="required"/>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="control-group">
                                <input type="text" class="form-control" name="phone" placeholder="Phone" required="required"/>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                            <input type="username" class="form-control" name="username" placeholder="username"
                                required="required"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" name="email" placeholder="Email"
                                required="required"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        
                        <div class="control-group">
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="basePassword"placeholder="Password">
                                <div class="input-group-append">
                                    <button id="togglePassword" class="btn btn-outline" name="btnBase" type="button">Show</button>
                                </div>
                            </div>
                           
                            
                        </div>
                        <br>
                        <div class="control-group">
                        <div class="input-group">
                                <input type="password" class="form-control" name="comparePassword"id="password" placeholder="Confirm Password">
                                <div class="input-group-append">
                                    <button id="togglePassword" class="btn btn-outline" name="btnCompare"type="button">Show</button>
                                </div>
                        </div>
                        </div>
                        
                        <p class="float-right">Already have account? <a href="login" class="float-right"> Sign in</a></p>
                            
                        <br>
                        <button type="submit" class="btn btn-primary py-2 px-4" name="signup">Signup</button>
                    </form>
                    
            </div>
            <div class="col-lg-7 mb-5">
            
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
                /**
                 * Toggles the visibility of a password input field.
                 *
                 * @param {Element} btn - The button element that triggers the toggle.
                 * @param {string} inputName - The name attribute of the password input field.
                 */
                function togglePassword(btn, inputName) {
                    console.log(btn);
                    var password = document.querySelector(`input[name=${inputName}]`);
                    var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    btn.textContent = type === 'password' ? 'Show' : 'Hide';
                }

                const btnBase = document.querySelector('button[name="btnBase"]');
                const btnCompare = document.querySelector('button[name="btnCompare"]');

                btnBase.addEventListener('click', function() {
                    togglePassword(btnBase, 'basePassword');
                });

                btnCompare.addEventListener('click', function() {
                    togglePassword(btnCompare, 'comparePassword');
                });

                const input = document.querySelector('input[name="username"]');
                input.addEventListener('input', function() {
                    console.log(input.value);
                });
            </script>
            <!--to this -->
        </div>
    </div>
<?php include '../partials/shop-footer.php'?>