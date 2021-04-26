<?php
  $host="localhost";
  $user="root";
  $password="";
  $db="library";
  
  $conn = mysqli_connect($host,$user,$password,$db);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  session_start();
  
  $sql="SELECT BookID, BookName, AuthorName, BookLength, BookImage FROM books WHERE BookName='".$_SESSION['printed_bookname']."'";

  $result=mysqli_query($conn,$sql);

  if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bookid = $row["BookID"];
        $bookname = $row["BookName"];
        $authorname = $row["AuthorName"];
        $booklength = $row["BookLength"];
        $bookimage = $row['BookImage'];
    }
  } else {
    echo '<script>alert("The printed book name is unidentified.")</script>';
  }

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Paypal Book Printing Payment Page For Student</title>
    <link type="text/css" rel="stylesheet" href="css/payment.css"/>
</head>
<body>
    <main id="cart-main">
        <div class="site-title text-center">
            <h1 class="font-title">Printed Book</h1>
        </div>
        <div class="container">
            <div class="grid">
                <div class="col-1">
                    <div class="flex item justify-content-between">
                        <div class="flex">
                            <div class="img text-center">
                            <?php echo $bookimage ? "<img src='uploads/{$bookimage}' style='width:500px;' />" : "No image found.";  ?>
                            </div>
                            <div class="title">
                                <h3>Book Name: <?php echo $bookname;?></h3>
                                <h3>Book Author: <?php echo $authorname;?></h3>
                            </div>
                        </div>
                        <div>
                            <a href="printsdocument.php"> << Cancel the book printing process</a>
                        </div>
                        <div class="price">
                            <h3 class="text-red">| Book Printing Price For Student: $20</h3>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="subtotal text-center">
                        <h3>Price Details</h3>
                        <ul>
                            <li class="flex justify-content-between">
                                <label for="price">Printed Book Fee: $20</label>
                            </li>
                            <li class="flex justify-content-between">
                                <label for="price">Reservation Charges : </label>
                                <span>Free</span>
                            </li>
                            <hr>
                            <li class="flex justify-content-between">
                                <label for="price">Total : </label>
                                <span class="text-red font-title">$20</span>
                            </li>
                        </ul>
                        <div id="paypal-payment-button">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript" src="https://www.paypal.com/sdk/js?client-id=AZKC7AZR9p6ZvDwPXG-cEE8xPMs8FOBItI_zdpiY8lSwlM4Tn0_fvkwvLCW_y1yZzjsfzURpX5hgnWWz&disable-funding=credit,card"></script>
    <script type="text/javascript" src="js/studentpayment.js"></script>
    
</body>
</html>