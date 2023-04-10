<?php
    include './php/database.php';
    session_start();   
    if(isset($_POST['submit']))
    {
        $_SESSION['userName'] = $_POST['userName'];
        $_SESSION['password'] = $_POST['password'];
        
        $query = mysqli_query($conn, "SELECT * FROM `customer_login` WHERE (userName = '{$_SESSION['userName']}' && password = '{$_SESSION['password']}')");
        if(mysqli_num_rows($query) > 0){
            setcookie("userName", $_SESSION['userName'], time() + (86400*30));
            setcookie("password", $_SESSION['password'], time() + (86400*30));
             $_SESSION['status'] = "Order Successfully";
                  $_SESSION['status_code'] = "success";
                 
            header("location: HomePage.php");
        }
        else
        {
            
                         $_SESSION['status'] = "Order failSuccessfully";
                  $_SESSION['status_code'] = "error";
                 
            header("location: index.php");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
 <meta charset="UTF-8">
        <title>Login Form</title>
        <link href="php/design.css" rel="stylesheet" type="text/css"/>
        <!--Jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!--CSS -->
        <link href="php/design.css" rel="stylesheet" type="text/css"/>
        <!--Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     <!--Sweet alert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body>
        <section class="vh-100 gradient-custom">
          <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                  <div class="card-body p-5 text-center">

                    <div class="mb-md-5 mt-md-4 pb-5">

                      <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                      <p class="text-white-50 mb-5">Please enter your login and password!</p>
                    <form method="post" action="index.php">
                      <div class="form-outline form-white mb-4">
                          <input type="Text" name="userName" class="form-control form-control-lg" placeholder="UserName"/>
                      </div>

                      <div class="form-outline form-white mb-4">
                          <input type="password" name="password" class="form-control form-control-lg" placeholder="Password"/>
                      </div>

                      <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

                      <button class="btn btn-outline-light btn-lg px-5" name="submit" type="submit">Login</button>
                    </form>
                      <div class="d-flex justify-content-center text-center mt-4 pt-1">
                        <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                        <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                        <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                      </div>

                    </div>

                    <div>
                      <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign Up</a>
                      </p>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        
        <!--Sweet Alert -->  
         <?php
            if(isset($_SESSION['status']) && $_SESSION['status'] != '')
            {
        ?>
            <script>
             swal({
                title: "<?php echo $_SESSION['status']; ?>",
//              text: "You clicked the button!",
                icon: "<?php echo $_SESSION['status_code']; ?>",
                button: "OK",
              }); 
            </script>
        <?php
             unset($_SESSION['status']);
            }
        ?>  
    </body>
</html>

<!--<section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                    <p class="text-white-50 mb-5">Please enter your login and password!</p>
                                    
                                    <form method="post" action="UserLogin.php">
                                        <div class="form-outline form-white mb-4">
                                            <input type="Text" name="UserName" class="form-control form-control-lg" placeholder="UserName"/>
                                        </div>
                                        <div class="form-outline form-white mb-4">
                                            <input type="password" name="Password" class="form-control form-control-lg" placeholder="Password"/>
                                        </div>
                                        <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>
                                        <button class="btn btn-outline-light btn-lg px-5" name="submit" type="submit">Login</button>
                                    </form>
                                    
                                    <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                      <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                      <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                      <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                    </div>
                                    
                                </div>
                                <div>
                                  <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign Up</a>
                                  </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
        </section>-->