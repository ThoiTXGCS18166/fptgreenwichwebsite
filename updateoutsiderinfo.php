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

  $sql="SELECT * FROM outsiders WHERE OutsiderUsername='".$_SESSION['login_outsiderusername']."' limit 1";

  $result=mysqli_query($conn,$sql);

  if(mysqli_num_rows($result)==1) {
    while ($row = mysqli_fetch_assoc($result)) {
      $currentoutsiderpassword = $row["OutsiderPassword"];
      $currentoutsiderid = $row["OutsiderID"];
      $currentoutsidername = $row["OutsiderName"];
      $currentoutsiderbirthday = $row["OutsiderDoB"];
      $currentoutsiderphone = $row["OutsiderPhone"];
      $currentoutsideraddress = $row["OutsiderAddress"];
      $currentoutsidermail = $row["OutsiderMail"];
      $currentoutsidergender = $row["OutsiderGender"];
    }
  }

  if(isset($_POST['btn-update'])){   
    $outsiderusername=$_POST['txt-outsiderusername'];
    $outsidername=$_POST['txt-outsidername'];
    $outsiderpassword=$_POST['txt-outsiderpassword'];
    $outsidergender=$_POST['txt-outsidergender'];
    $outsiderbirthday=$_POST['txt-outsiderbirthday'];
    $outsiderphone=$_POST['txt-outsiderphone'];
    $outsideraddress=$_POST['txt-outsideraddress'];
    $outsidermail=$_POST['txt-outsidermail'];

    $_SESSION['login_mail'] = $outsidermail;

    $sql="SELECT * FROM outsiders WHERE OutsiderUsername='".$outsiderusername."' limit 1";
    
    $result=mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result)==1){
      $sql = "UPDATE outsiders SET OutsiderName = '" .$outsidername. "', OutsiderPassword = '" .$outsiderpassword. "', OutsiderGender = '" 
            .$outsidergender. "', OutsiderDoB = '" .$outsiderbirthday. "', OutsiderPhone = '" 
            .$outsiderphone. "', OutsiderAddress = '" .$outsideraddress. "', OutsiderMail = '" 
            .$outsidermail. "' WHERE OutsiderUsername = '" .$outsiderusername. "'";

      $result = mysqli_query($conn, $sql);
      if ($result) {
        echo '<script>alert("The outsider information has been updated successfully.");window.location.href="home5.php"</script>';
      } else {
        echo '<script>alert("Error: The outsider updating email is already existed for another outsider account in the library database. Please check and retype the outsider updating email again.")</script>';
      }
    } else{
      echo '<script>alert("Error: The entered outsider username is not existed in the library database for updating. Please check and retype the outsider username again.")</script>';
    }
  }

  mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Personal Information Updating Page For Outsider</title>
    <style>
    * {
      box-sizing:border-box;
    }

    body {
      margin: 0;
      font-family: "Lato", sans-serif;
    }

    .sidebar {
      margin: 0;
      padding: 0;
      width: 290px;
      background-color: #f1f1f1;
      position: fixed;
      height: 100%;
      overflow: auto;
    }

    .sidebar a {
      display: block;
      color: black;
      padding: 16px;
      text-decoration: none;
    }
    
    .sidebar a.active {
      background-color: #4CAF50;
      color: white;
    }

    .sidebar a:hover:not(.active) {
      background-color: #555;
      color: white;
    }

    div.content {
      margin-left: 300px;
      padding: 1px 16px;
      height: 1000px;
    }

    input[type=text], input[type=date], input[type=number], input[type=email] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
    }

    label {
    padding: 12px 12px 12px 0;
    display: inline-block;
    }

    input[type=submit] {
      border: none;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      margin: 4px 2px;
      cursor: pointer;
      font-size: 17px;
      width: 18em;
      height: 3em;
    }

    input[type=submit]:hover {
    background-color: #45a049;
    }

    .container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    }

    .col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
    }

    .col-75 {
    float: left;
    width: 75%;
    margin-top: 6px;
    }

    /* Clear floats after the columns */
    .row:after {
    content: "";
    display: table;
    clear: both;
    }

    .buttonHolder{ 
      text-align: right;
      margin: 4px 2px;
      padding-top: 5px; 
    }

    @media screen and (max-width: 992px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      .sidebar a {float: left;}
      div.content {margin-left: 0;}
    }

    @media screen and (max-width: 500px) {
      .sidebar a {
        text-align: center;
        float: none;
      }

      .col-25, .col-75, input[type=submit] {
            width: 100%;
            margin-top: 0;
      }

      .buttonHolder{ 
        text-align: center;
      }
    }

    h2{
        text-align: center;
    }

    h3{
        text-align: center;
    }

    img {
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    </style>
</head>
<body>

<div class="sidebar">
  <a href="home5.php">Home</a>
  <a href="viewobook1.php">View Books</a>
  <a href="viewolaptop.php">View Laptops</a>
  <a href="borrowobook.php">Borrow Books</a>
  <a href="borrowolaptop.php">Borrow Laptops</a>
  <a href="borroworoom.php">Rent Study Room</a>
  <a href="printodocument.php">Print Documents</a>
  <a href="viewobookborrowingrecords.php">View Book Borrowing Records</a>
  <a href="viewolaptopborrowingrecords.php">View Laptop Borrowing Records</a>
  <a href="vieworoomborrowingrecords.php">View Room Borrowing Records</a>
  <a href="viewobookprintingrecords.php">View Book Printing Records</a>
  <a class="active" href="updateoutsiderinfo.php">Update Info</a>
  <a href="librarychat.php"> Online Chat</a>
  <a href="about5.php">About Us</a>
  <a href="index.php">Log Out</a>
</div>

<div class="content">
  <img src="img/logo.PNG" alt="Library Logo" style="width:45%">
  <h2>The personal information updating page for outsider</h2>
  <h3>The personal information updating form for outsider</h3>

  <div class="container">
    <form action="updateoutsiderinfo.php" method="POST">
    <div class="row">
        <div class="col-25">
        <label for="txt-outsiderid">Outsider ID</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-outsiderid" name="txt-outsiderid" value="<?php echo $currentoutsiderid;?>" readonly data-mini="true" >
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-outsiderusername">Outsider Username</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-outsiderusername" name="txt-outsiderusername" value="<?php echo $_SESSION['login_outsiderusername'];?>" readonly data-mini="true">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-outsidername">Outsider Name</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-outsidername" name="txt-outsidername" value="<?php echo $currentoutsidername;?>" readonly data-mini="true">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-outsiderpassword">Outsider Password</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-outsiderpassword" name="txt-outsiderpassword" placeholder="Enter new outsider password here" value="<?php echo $currentoutsiderpassword;?>" data-clear-btn="true" data-mini="true" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 to 30 characters" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-outsidergender">Outsider Gender</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-outsidergender" name="txt-outsidergender" placeholder="Enter new outsider gender here" value="<?php echo $currentoutsidergender;?>" data-clear-btn="true" data-mini="true" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-outsiderbirthday">Outsider Birthday</label>
        </div>
        <div class="col-75">
        <input type="date" id="txt-outsiderbirthday" name="txt-outsiderbirthday" min="1962-06-30" max="2003-06-30" value="<?php echo $currentoutsiderbirthday;?>" data-clear-btn="true" data-mini="true" title="Birthday must be in between 1962-06-30 and 2003-06-30" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-outsiderphone">Outsider Phone</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-outsiderphone" name="txt-outsiderphone" placeholder="Enter new outsider phone number here" value="<?php echo $currentoutsiderphone;?>" data-clear-btn="true" data-mini="true" pattern="\d*" title="Phone number must not contain letter" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-outsideraddress">Outsider Address</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-outsideraddress" name="txt-outsideraddress" placeholder="Enter new outsider address here" value="<?php echo $currentoutsideraddress;?>" data-clear-btn="true" data-mini="true" pattern=".{12,50}" title="Address must contain at least 12 and maximum 50 characters" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-outsidermail">Outsider Mail</label>
        </div>
        <div class="col-75">
        <input type="email" id="txt-outsidermail" name="txt-outsidermail" placeholder="Enter new outsider mail address here" value="<?php echo $currentoutsidermail;?>" data-clear-btn="true" data-mini="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" required>
        </div>
    </div>
    <div class="row">
      <div class="buttonHolder">
      <input type="submit" value="Update outsider information" name="btn-update" style="background-color: #4CAF50;">
      </div>
    </div>
    </form>
    </div>
</div>



</body>
</html>