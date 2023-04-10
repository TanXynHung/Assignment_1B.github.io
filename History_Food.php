<?php
    include './php/database.php';
    session_start();   
    
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>History Food</title>
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
        
        <header>
            <div>
                <nav class="navbar navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">foodies</a>
                        <h6 class="px-5">
                            <button><a href="HomePage.php">HOME</a></button>
                            <button><a href="testing.php">test</a></button>
                             <button><a href="After_Purchase.php">Detail</a></button> 
                            <a href="History_Food.php"><i class="fa-solid fa-download"></i></a>
                                       
                        </h6>
                    </div>
                </nav>            
            </div>
        </header>
        
        <div class="container py-5 ">
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Table No</th>
                            <th scope="col">Food</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                            <?php
                            $show_order = mysqli_query($conn, "SELECT * FROM `kitchen` WHERE userID = '{$_SESSION['userID']}'");
                            if(mysqli_num_rows($show_order) > 0)
                            {
                                while($row = mysqli_fetch_assoc($show_order))
                                {
                                    ?>
                                <tbody>
                                    <tr>
                                      <th scope="row"><?php echo $row['id'] ?></th>
                                      <td><?php echo $row['id'] ?></td>
                                      <td><?php echo $row['total_products'] ?></td>
                                      <td><?php echo $row['total_price'] ?></td>
                                      <td>
                                          <?php
                                           if($row['status'] == 1)
                                           {
                                               echo '<p><a href="Action.php?id='.$row['id'].'&status=0">Cooking</a></p>';
                                           }
                                           else
                                           {
                                              echo '<p><a href="Action.php?id='.$row['id'].'&status=1">Queuing</a></p>';
                                           }
                                          ?>
                                      </td>
                                    </tr>
                              </tbody>
                              <?php
                                }
                            }
                            ?>
                  </table>
                </div>
            </div>
        </div>
    </body>
</html>
                        