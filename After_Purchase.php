<?php
    include './php/database.php';
    session_start();   
    
    // to fetch the enable/disable function from kitchen table
    $query = mysqli_query($conn, "SELECT * FROM `kitchen` WHERE userID = '$_SESSION[userID]' ORDER BY `id` DESC");
    $row = mysqli_fetch_assoc($query);
    $_SESSION['id'] = $row['id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>After Purchase</title>
        <link href="php/design.css" rel="stylesheet" type="text/css"/>
        <script src="js/script.js" type="text/javascript"></script>
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <!--Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container" style='margin-top:200px'>
            <div class="row justify-content-center">
                <div class="col-lg-6 bg-light">
                    <h1 class="text-center text-danger">Thank you</h1>
                    <h1 class="text-center text-success">Your Order Placed Successful!</h1>
<!--                    <div class="text-center p-3 ">
                        <h5 class="bg-danger text-light"><b>Products: </b><?php echo $_SESSION['total_products']; ?></h5>
                        <h5 class=""><b>Service Charge: </b>Free</h5>
                        <h5 class=""><b>Amount Payable: </b>RM <?php echo number_format($_SESSION['total_price'],2); ?></h5>
                        <h5 class=""><b>Table no: </b><?php echo $row['id']; ?></h4>
                        <button class="btn btn-success"><a href="HomePage.php" style="text-decoration: none" class='text-light'>Continue Shooping</a></button>
                    </div>-->

                    <?php
                        $show_food = mysqli_query($conn, "SELECT * FROM `kitchen` WHERE userID = '{$_SESSION['userID']}' && id = '{$_SESSION['id']}'");
                        if(mysqli_num_rows($show_food) > 0)
                        {
                            while($row = mysqli_fetch_assoc($show_food))
                            {
                            ?>
                                <h5 class="bg-danger text-light text-center"><b>Products: </b><?php echo $row['total_products']; ?></h5>
                                <h5 class="text-center"><b>Service Charge: </b>Free</h5>
                                <h5 class="text-center"><b>Amount Payable: </b>RM <?php echo number_format($row['total_price'],2); ?></h5>
                                <h5 class="text-center"><b>Table no: </b><?php echo $row['id']; ?></h5>
                                <div class="text-center">
                                    <button class="btn btn-success"><a href="HomePage.php" style="text-decoration: none" class='text-light'>Continue Shooping</a></button>
                                </div>   
                        <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
