<?php

    include './php/database.php';
    session_start();   
    
    
    //Add to cart function
//    if(isset($_POST['add_to_cart'])){
//    $userID = $_POST['userID'];
//    $product_name = $_POST['product_name'];
//    $product_price = $_POST['product_price'];
//    $product_image = $_POST['product_image'];
//    $product_quantity = $_POST['quantity'];
//    
//    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE userID = '$userID' && name = '$product_name'");
//    if(mysqli_num_rows($select_cart) > 0)
//    {
//        $_SESSION['message'] = "Product already added in cart.";
//        $_SESSION['msg_type'] = "warning";
//        header('location: HomePage.php');
//    }
//    else
//    {
//            $cart = "INSERT INTO `cart`(`userID`, `name`, `price`, `quantity`,`image`) VALUES ('$userID', '$product_name', '$product_price', '$product_quantity', '$product_image')";
//            $insert_product = mysqli_query($conn, $cart);
//
//            $_SESSION['message'] = "Product added to cart successfully.";
//            $_SESSION['msg_type'] = "success";
//            header('location: HomePage.php');
//    }
//    }
    
    if(isset($_POST['pid'])){
        $pUserid = $_POST['pUserid'];
        $pname = $_POST['pname'];
        $pprice = $_POST['pprice'];
        $pimage = $_POST['pimage'];
        $pquantity = $_POST['pquantity'];
        
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE userID = '$pUserid' && name = '$pname'");
        if(mysqli_num_rows($select_cart) > 0)
        {
            echo '<div class="alert alert-danger alert-dismissible fade show text-center mt-2" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     <strong>Item already added to your cart</strong>
                    </div>';
        }
        else
        {
            $cart = "INSERT INTO `cart`(`userID`, `name`, `price`, `quantity`,`image`) VALUES ( '$pUserid','$pname', '$pprice', '$pquantity', '$pimage')";
            $insert_product = mysqli_query($conn, $cart);

                    echo '<div class="alert alert-success alert-dismissible fade show text-center mt-2" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Item added to your cart</strong>
                   </div>';
        }
    }
    
    // function to display total cart items
    if(isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item'){
        $query = mysqli_query($conn, "SELECT * FROM `cart` WHERE userID = '{$_SESSION['userID']}'");
        $row = mysqli_num_rows($query);
        echo $row ;
    }
        

    //To remove the items form cart
    if(isset($_GET['removeID']))
    {
        $id = $_GET['removeID'];
        $query = mysqli_query($conn, "DELETE FROM `cart` WHERE id=$id");
        if($query){
            header('location: cart.php');
            exit();
        }
        else
        {
              die(mysqli_errno($conn));
        }
    }
    
        //To update the quantity items form cart
        if(isset($_POST['update']))
        {
            $id = $_POST['id'];
            $quantity = $_POST['quantity'];

            $query = mysqli_query($conn, "UPDATE `cart` SET `quantity`='$quantity' WHERE id = $id");
            header("location: cart.php");
        }   
        
        //add all the orders to kitchen database
//        if(isset($_POST['order_btn']))
//        {
//            $userID = $_POST['userID'];
//            $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
//            $product_total = 0;
//            if(mysqli_num_rows($cart_query))
//            {
//                while($product_item = mysqli_fetch_assoc($cart_query))
//                {
//                    $product_name[] = $product_item['name'] . '('.$product_item['quantity'].')';
//                    $product_price = number_format($product_item['price'] * $product_item['quantity']);
//                    $product_total += $product_price;
//                }
//            }
//            
//            $total_product = implode(',', $product_name);
//            $detail_query = mysqli_query($conn, "INSERT INTO `kitchen`(`userID`, `total_products`, `total_price`) VALUES ('$userID','$total_product','$product_total')");
//            $delete = mysqli_query($conn, "DELETE FROM `cart` WHERE userID = $userID");
//            header("location:After_Purchase.php");
//        }
        
        if(isset($_POST['order_btn'])){
            $id= $_POST['id'];
             $userID = $_POST['userID'];
             $name = $_POST['name'];
             $price = $_POST['name'];
             $quantity = $_POST['price'];
             $total_price = $_POST['quantity'] * $_POST['price'];

             $cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE id = $id");
             if($cart){
                  echo "hihi"; 
                  $cart_query = ("INSERT INTO `kitchen`(`userID`,`total_products`, `total_price`) VALUES ('$userID','$name','$total_price')");
                  $haha = mysqli_query($conn,  $cart_query);
                 $delete = mysqli_query($conn, "DELETE FROM `cart` WHERE id = $id");
                  header("location:cart.php");
             }
             else{
                  
                 echo "hahha";
                  header("location:cart.php");
             }
        }
        
        //for enable and disable function
//        $id = $_GET['id'];
//        $status = $_GET['status'];
//        $q = "UPDATE `kitchen` SET `status` = $status WHERE id = $id";
//        mysqli_query($conn, $q);
//        header('location:History_Food.php');
        
        
            
    // to fetch the enable/disable function from kitchen table
    $query = mysqli_query($conn, "SELECT * FROM `kitchen` WHERE userID = '$_SESSION[userID]' ORDER BY `id` DESC");
    $row = mysqli_fetch_assoc($query);
    $_SESSION['id'] = $row['id'];