<?php
    include './php/database.php';
    session_start();   
    
    // to fetch the userid from customer_login table
    $query = mysqli_query($conn, "SELECT * FROM `customer_login` WHERE userName = '$_SESSION[userName]'");
    $row = mysqli_fetch_assoc($query);
    $_SESSION['userID'] = $row['userID'];
    
//    $select_rows = mysqli_query($conn, "SELECT * FROM `cart` WHERE userID = '{$_SESSION['userID']}'");
//    $_SESSION['row_count'] = mysqli_num_rows($select_rows);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Food Menu</title>
        <link href="php/design.css" rel="stylesheet" type="text/css"/>
        <!--Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!--CSS -->
        <link href="php/design.css" rel="stylesheet" type="text/css"/>
        <!--Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
<body>
       
        <header>
            <div>
                <nav class="navbar navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">foodies</a>
                        <h6 class="px-5">
                            <a href="History_Food.php"><i class="fa-solid fa-download"></i></a>
                            <button><a href="testing.php">test</a></button>
                             <button><a href="After_Purchase.php">Detail</a></button> 
                             <a href="cart.php" class="number"><i class="fa-solid fa-cart-shopping mx-2"> Cart </i><span id="cart-item" class="cart_count bg-dark text-warning">0</span></a>       
                        </h6>
                    </div>
                </nav>            
            </div>
        </header>
        
            <!-- For pop up alert message -->

            
        <div class="container">
            <div id="message"></div>
            <div class="row my-5">
                <h3 class="text-center"><strong>Latest Update</strong></h3>
              
                    <!-- To display the product table from database -->
                    <?php
//                    $query = "SELECT * FROM `products` WHERE name IN ('Coca-Cola', 'SandWich')";
                    $query = "SELECT * FROM `products`";
                    $select_products = mysqli_query($conn, $query);
                    if(mysqli_num_rows($select_products) > 0){
                        while($row = mysqli_fetch_assoc($select_products))
                        {
                    ?>
                <div class="col-md-3 col-sm-6 my-md-0">
                    <form method="post" action="" class="form-submit">
                        <div class="card shadow">
                            <div class="box">
                                <img src="image/<?php echo $row['image']; ?>" class="img-fluid" alt="">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center"><?php echo $row['name'] ?></h5>
                                <h6 class="text-center">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </h6>
                                <p class="card-text text-center"> Juicy Burger With Oily Sauce.</p>
                                <h5 class="text-center">
                                    <small><s class="text-secondary">$511</s></small>
                                    <span class="price">$<?php echo $row['price']; ?></span>
                                </h5>
                                <input type="hidden" name="ID" class="pid" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="userID" class="pUserid" value="<?php echo $_SESSION['userID']; ?>">
                                <input type="hidden" name="product_name" class="pname" value="<?php echo $row['name']; ?>">
                                <input type="hidden" name="product_price" class="pprice" value="<?php echo $row['price']; ?>">
                                <input type="hidden" name="product_image" class="pimage" value="<?php echo $row['image']; ?>">
                                <div class="text-center my-3" ><input class="text-center  border rounded-pill border-dark pquantity" style="padding:3px; " type="hidden" value="1" min= "1" max="10" size="1"  name="quantity" class="quantity"></div>
                                <div class="text-center">
                                     <button class="btn btn-warning btn-block addItemBtn" name="add_to_cart"><i class="fa-solid fa-cart-plus"></i>&nbsp;&nbsp; Add to Card</button>
                                </div>
                           </div>
                        </div>
                    </form><br/>
                </div>        
                    <?php
                        }
                    }
                    ?>
                    
                </div>
            </div> 
            
            <script type="text/javascript">
                $(document).ready(function(){
                    $(".addItemBtn").click(function(e){
                        e.preventDefault();
                        var $form = $(this).closest(".form-submit");
                        var pid = $form.find(".pid").val();
                        var pUserid = $form.find(".pUserid").val();
                        var pname = $form.find(".pname").val();
                        var pprice = $form.find(".pprice").val();
                        var pimage = $form.find(".pimage").val();   
                        var pquantity = $form.find(".pquantity").val();
                        
                        $.ajax({
                           url : 'action.php',
                           method : 'post',
                           data : {pid:pid, pUserid:pUserid ,pname:pname, pprice:pprice, pimage:pimage, pquantity:pquantity},
                           
                           success:function(response){
                               $("#message").html(response);
                               load_cart_item_number();
                           }
                        });
                    });
                    
                    load_cart_item_number();
                    
                    function load_cart_item_number(){                
                        $.ajax({
                           url: 'action.php',
                           method: 'get',
                           data: {cartItem:"cart_item"},
                           success: function(response){
                               $("#cart-item").html(response);
                           }
                        });
                    }
                });
            </script>
    </body>
</html>
