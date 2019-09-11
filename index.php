<?php
require_once('header.php');

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SERVER['REQUEST_URI'] != '/welcome.php'){
    header("location: welcome.php");
    exit;
}
?>

<div>
    <form action="index.php" method="post">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-3 ">
                    <h1>Registeration</h1>
                    <p>Fill up the form</p>

                    <hr class="mb-3">
                    <label for="firstName"><b>First Name</b></label>
                    <input class="form-control" type="text" id="firstName" name="firstName" required>

                    <label for="lasttName"><b>Last Name</b></label>
                    <input class="form-control" type="text" id="lastName" name="lastName" required>

                    <label for="userEmail"><b>Email Address</b></label>
                    <input class="form-control" type="email" id="userEmail" name="userEmail" required>

                    <label for="password"><b>Password</b></label>
                    <input class="form-control" type="password" id="password" name="password" required>
                    
                    <hr class="mb-3">
                    <input class="btn btn-primary form-control" type="submit" id="btnRegister" name="register_user" value="Sign up">
                </div>
            </div>
        </div>   
    </form>


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>

    $(function(){

        $('#btnRegister').click(function(e){
            
            var valid = this.form.checkValidity();
            if(valid){
            
                e.preventDefault();

                var firstName   = $('#firstName').val();
                var lastName    = $('#lastName').val();
                var userEmail   = $('#userEmail').val();
                var password    = $('#password').val();
               
                $.ajax({
                    type: 'POST',
                    url:   'process.php',
                    dataType: 'json',
                    data: {firstName:firstName, lastName:lastName, userEmail:userEmail, password:password, register:true},
                    success: function(data){

                        console.log(data)                        
                        if(data.type == 2){
                            Swal.fire({
                                title: 'Done!',
                                text: data.msg,
                                type: 'success',
                            
                            });
                        }else{
                            Swal.fire({
                                title: 'Failed!',
                                text: data.msg,
                                type: 'error',                            
                            });
                        }
                        
                    },
                    error: function(data){
                        Swal.fire({
                        title: 'Error!',
                        text: 'There were errors while saving the data...',
                        type: 'error'
                        
                        });
                    }
                });
                
            }else{
               
            }
            
        });

        $('#btn_login').click(function(e){
            var valid = this.form.checkValidity();
            if(valid){
                e.preventDefault();

                var userEmail   = $('#loginEmail').val();
                var password    = $('#loginPassword').val();
               
                $.ajax({
                    type: 'POST',
                    url:   'process.php',
                    data: {userEmail:userEmail, password:password, signin:true},
                    success: function(data){

                        if(data == 'valid'){
                            Swal.fire({
                                title: 'Done!',
                                text: "Login succeed.",
                                type: 'success',
                            
                            });
                            //window.setTimeout(function(){location.reload()},2000)
                        }else{
                            Swal.fire({
                                title: 'Failed!',
                                text: "Invalid User Account...",
                                type: 'error',
                            
                            });
                        }
                        
                    },
                    error: function(data){
                        Swal.fire({
                        title: 'Error!',
                        text: 'There were errors while saving the data...',
                        type: 'error'
                        
                        });
                    }
                });

            }
        })


        
    })
</script>    
</body>
</html>