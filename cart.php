<?php
    include './php/database.php';
    session_start();   
    
    $count_price = mysqli_query($conn, "SELECT * FROM `cart` WHERE userID = '{$_SESSION['userID']}'");
    $grand_price = 0;
    if(mysqli_num_rows($count_price)){
        while($row = mysqli_fetch_assoc($count_price)){
            $price = ($row["price"] * $row["quantity"]);
            $grand_price += $price;
        }
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cart</title>
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
                <!-- For pop up alert message -->
<?php
            if(isset($_SESSION['message']))
            {
        ?>
            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                <strong>Hey! </strong><?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
             echo $_SESSION['message'];
             unset($_SESSION['message']);
            }
        ?>  
                
        <div class="container-fluid">
            <div class="row px-5">
                <div class="col-md-7">
                    <div class="shopping-cart">
                        <a href="History_Food.php"><i class="fa-solid fa-download"></i></a>
                        <button><a href="testing.php">test</a></button>
                        <button><a href="HomePage.php">HOME</a></button>
                         <button><a href="After_Purchase.php">Detail</a></button> 
                        <h6>My Cart</h6>
                        <hr>
                        <?php
                        $show_product = mysqli_query($conn, "SELECT * FROM `cart` WHERE userID = '{$_SESSION['userID']}'");
                        $total_price = 0;
                        if(mysqli_num_rows($show_product) > 0){
                            while($row = mysqli_fetch_assoc($show_product))
                            {
                                $total_price = $row["quantity"] * $row["price"];
                            ?>
                        <form action="Action.php" method="post">
                            <div class="border rounded my-3">
                                <div class="row ">
                                    <div class="col-md-3">
                                        <img src="./image/<?php echo $row["image"]; ?>" class="img-fluid mt-3">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <h5 class="pt-2 mt-3" name="name"><?php echo $row["name"]; ?></h5>
                                        <small class="text-secondary">Seller: Tan</small>
                                        <h5 class="pt-2" name="price">$<?php echo $row["price"]; ?></h5>
                                        <button type="submit" name="update" class="btn btn-warning button">Update</button>
                                        <button class="btn btn-danger"><a href="Action.php? removeID=<?php echo $row['id'];?>" class="text-light" onclick="return confirm('Are you sure?')" >Remove</a></button>
                                    </div>
                                    <div class="col-md-3 py-5 mt-2">
                                        <strong>qty:</strong><input class="mx-3 text-center" type="number" name="quantity" value="<?php echo $row["quantity"]; ?>" min= "1" max="10" size="1">
                                        <br><br><h5>Total: $<?php echo $total_price; ?></h5>
                                    </div>
                                </div>  
                            </div>
                        </form>
                        <?php
                            }
                        }    
                        ?>
                    </div>            
                </div>
                
                <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
                    <div class="pt-4">
                        <h6>PRICE DETAILS</h6>
                        <hr>
                        <form action="Action.php" method="post">
                        <div class="row price-detail">
                            <div class="col-md-6">
                                <?php
                                    $show_items = mysqli_query($conn, "SELECT * FROM `cart` WHERE userID = '{$_SESSION['userID']}'");
                                    $total = mysqli_num_rows($show_items);
                                   if(isset($total)){  
                                       echo "<h6>Price ($total items)</h6>";
                                   }
                                   else{
                                        echo "<h6>Price(0 items)</h6>";
                                   }
                                   
                                   if($total > 0){
                                       while($row = mysqli_fetch_assoc($show_items))
                                       {
                                        ?>
                                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                  <input type="hidden" name="userID" value="<?php echo $_SESSION['userID']; ?>">
                                  <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                                  <input type="hidden" name="price" value="<?php echo $row["quantity"] * $row["price"]; ?>">
                                  <input type="hidden" name="quantity" value="<?php echo $row['quantity']; ?>">
                                <?php
                                       }
                                   }
                                ?>
                                <h6>Service Charge</h6>
                                <hr>
                                <h6>Amount Payable</h6>
                            </div>
                                <div class="col-md-6">                                  
                                    <h6>$<?php echo $grand_price ?></h6>
                                    <h6 class="text-success">Free</h6>
                                    <hr>
                                    <h6>$<?php echo $grand_price ?></h6>
                            </div>
                             <button class="btn btn-success mt-5 <?php echo ($grand_price > 1)?"":"disabled"; ?>" name="order_btn" value="order now"><i class="fa-regular fa-credit-card"></i>&nbsp;&nbsp; Order</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
