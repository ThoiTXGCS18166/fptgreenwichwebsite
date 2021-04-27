<?php
  $host="us-cdbr-iron-east-05.cleardb.net";
  $user="be790e4eb7458b";
  $password="78c739da";
  $db="heroku_0a876b33f00670d";
  
  $conn = mysqli_connect($host,$user,$password,$db);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  session_start();

  $bookid = $_SESSION['book_id'];
  $staffid = 1;
  $printername = $_SESSION['printer_name'];
  $printertype = "Teacher";
  $printingdate = $_SESSION['print_date'];
  $printingfee = "20 USD";
  $printingstatus = 0;
  $qrcode="tprintqrcode3.png";
  date_default_timezone_set("Asia/Ho_Chi_Minh");
  $submitdate = date('Y-m-d H:i:s');
  $printpriority="1";
  $bookingstatus=1;
  $paymentstatus = 1;
  $printermail = $_SESSION['login_mail'];

  $sql="INSERT INTO printings (BookID, StaffID, PrinterName, PrinterType, PrintingDate, PrintingFee, PrintingStatus, QRCode, SubmitDate, PrintPriority, BookingStatus, PaymentStatus, PrinterMail)
  VALUES ('$bookid', '$staffid', '$printername', '$printertype', '$printingdate', '$printingfee', '$printingstatus', '$qrcode', '$submitdate', '$printpriority','$bookingstatus', '$paymentstatus', '$printermail')";   
            
  if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Request for printing book submitted successfully. Please often check your book borrowing record or email notification to come to the library on the right day to receive the needed book printing document.")</script>';
  } else {
    echo '<script>alert("The input information is incorrect. Please modify the information into the form again for ordering the book printing document")</script>';
  }

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Successful Payment Page For Printing Book Of Teacher</title>
    <!-- FONT AWESOME ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/payment.css">
    <style>

    .buttonHolder{ 
      text-align: center; 
    }

    .button {
      background-color: #4CAF50;
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }

    </style>
</head>
<body>
<main id="cart-main">
    <div class="site-title text-center">
        <div><img src="img/checked.png" alt=""></div>
        <h1 class="font-title">Payment For Printing Book Was Processed Successfully For Teacher</h1>
        <div class="buttonHolder">
          <a href="home4.php" class="button">Back To Teacher Homepage</a>
        </div>
    </div>
</main>
</body>
</html>