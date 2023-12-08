
<?php include_once '../partials/shop-header.php'; 
include_once '../../utils/location.php';

//https://psgc.gitlab.io/api/provinces/041000000/municipalities.json 

if(isset($_POST['signup'])){
    try{
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
        $Controller = new CustomerController();
        $Controller->Signup($data);
        $Controller->Login($data['username'],$data['basePassword']);
    }catch(Exception $e){
        $_SESSION['errorMessage'] = $e->getTraceAsString();
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
                function togglePassword(btn,inputName) {
                    console.log(btn);
                    var password = document.querySelector(`input[name=${inputName}]`);
                    var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    btn.textContent = type === 'password' ? 'Show' : 'Hide';
                }

                const btnBase =  document.querySelector('button[name="btnBase"]');
                const btnCompare =  document.querySelector('button[name="btnCompare"]');

                btnBase.addEventListener('click', function() {
                    togglePassword(btnBase,'basePassword');
                });

                btnCompare.addEventListener('click', function() {
                    togglePassword(btnCompare,'comparePassword');
                });
                const input = document.querySelector('input[name="username"]');
                input.addEventListener('input', function() {
                    console.log(input.value);
                });

                    //document.querySelector('input[name="basePassword"]').addEventListener('click', togglePassword);
                    //document.querySelector('input[name="comparePassword"]').addEventListener('click', togglePassword);
                           /*
                document.querySelector('#togglePassword').addEventListener('click', function(){
                    var password = document.querySelector('#password');
                    var type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.textContent = type === 'password' ? 'Show' : 'Hide';
                }); */
            </script>
            <!--to this -->
        </div>
    </div>
<?php include '../partials/shop-footer.php'?>