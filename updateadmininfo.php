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

  $sql="SELECT * FROM administrators WHERE AdminUsername='".$_SESSION['login_adminusername']."' limit 1";

  $result=mysqli_query($conn,$sql);

  if(mysqli_num_rows($result)==1) {
    while ($row = mysqli_fetch_assoc($result)) {
      $currentadminpassword = $row["AdminPassword"];
      $currentadminid = $row["AdminID"];
      $currentadminname = $row["AdminName"];
      $currentadminbirthday = $row["AdminDoB"];
      $currentadminphone = $row["AdminPhone"];
      $currentadminaddress = $row["AdminAddress"];
      $currentadminmail = $row["AdminMail"];
      $currentadmingender = $row["AdminGender"];
    }
  }

  if(isset($_POST['btn-update'])){   
    $adminusername=$_POST['txt-adminusername'];
    $adminname=$_POST['txt-adminname'];
    $adminpassword=$_POST['txt-adminpassword'];
    $admingender=$_POST['txt-admingender'];
    $adminbirthday=$_POST['txt-adminbirthday'];
    $adminphone=$_POST['txt-adminphone'];
    $adminaddress=$_POST['txt-adminaddress'];
    $adminmail=$_POST['txt-adminmail'];

    $sql="SELECT * FROM administrators WHERE AdminUsername='".$adminusername."' limit 1";
    
    $result=mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result)==1){
      $sql = "UPDATE administrators SET AdminName = '" .$adminname. "', AdminPassword = '" .$adminpassword. "', AdminGender = '" .$admingender. "', AdminDoB = '" .$adminbirthday. "', AdminPhone = '" 
                                            .$adminphone. "', AdminAddress = '" .$adminaddress. "', AdminMail = '" .$adminmail. "' WHERE AdminUsername = '" .$adminusername. "'";

      $result = mysqli_query($conn, $sql);
      if ($result) {
        echo '<script>alert("The administrator information has been updated successfully.");window.location.href="home1.php"</script>';
      } else {
        echo '<script>alert("Error: The administrator updating email is already existed for another administrator account in the library database. Please check and retype the administrator updating email again.")</script>';
      }
    } else{
      echo '<script>alert("Error: The entered administrator username is not existed in the library database for updating. Please check and retype the administrator username again.")</script>';
    }

  }

  mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Personal Information Updating Page For Administrator</title>
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
      width: 200px;
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
      margin-left: 200px;
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
  <a href="home1.php">Home</a>
  <a href="viewstaffs.php">View Staffs</a>
  <a href="viewbooks.php">View Books</a>
  <a href="viewlaptops.php">View Laptops</a>
  <a class="active" href="updateadmininfo.php">Update Info</a>
  <a href="about1.php">About Us</a>
  <a href="index.php">Log Out</a>
</div>

<div class="content">
  <img src="img/logo.PNG" alt="Library Logo" style="width:45%">
  <h2>The personal information updating page for administrator</h2>
  <h3>The personal information updating form for administrator</h3>

  <div class="container">
    <form action="updateadmininfo.php" method="POST">
    <div class="row">
        <div class="col-25">
        <label for="txt-adminid">Admin ID</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-adminid" name="txt-adminid" value="<?php echo $currentadminid;?>" readonly data-mini="true" >
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-adminusername">Admin Username</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-adminusername" name="txt-adminusername" value="<?php echo $_SESSION['login_adminusername'];?>" readonly data-mini="true" >
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-adminname">Admin Name</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-adminname" name="txt-adminname" value="<?php echo $currentadminname;?>" readonly data-mini="true">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-adminpassword">Admin Password</label>
        </div>
        <div class="col-75">
        <input type="text" placeholder="Enter new admin password here" id="txt-adminpassword" name="txt-adminpassword" value="<?php echo $currentadminpassword;?>" data-clear-btn="true" data-mini="true" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 to 30 characters" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-admingender">Admin Gender</label>
        </div>
        <div class="col-75">
        <input type="text" placeholder="Enter new admin gender here" id="txt-admingender" name="txt-admingender" value="<?php echo $currentadmingender;?>" data-clear-btn="true" data-mini="true" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-adminbirthday">Admin Birthday</label>
        </div>
        <div class="col-75">
        <input type="date" id="txt-adminbirthday" name="txt-adminbirthday" min="1982-06-30" max="1997-06-30" value="<?php echo $currentadminbirthday;?>" data-clear-btn="true" data-mini="true" title="Birthday must be in between 1982-06-30 and 1997-06-30" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-adminphone">Admin Phone</label>
        </div>
        <div class="col-75">
        <input type="text" placeholder="Enter new admin phone number here" id="txt-adminphone" name="txt-adminphone" value="<?php echo $currentadminphone;?>" data-clear-btn="true" data-mini="true" pattern="\d*" title="Phone number must not contain letter" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-adminaddress">Admin Address</label>
        </div>
        <div class="col-75">
        <input type="text" placeholder="Enter new admin address here" id="txt-adminaddress" name="txt-adminaddress" value="<?php echo $currentadminaddress;?>" data-clear-btn="true" data-mini="true" pattern=".{12,50}" title="Address must contain at least 12 and maximum 50 characters" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-adminmail">Admin Mail</label>
        </div>
        <div class="col-75">
        <input type="email" placeholder="Enter new admin mail address here" id="txt-adminmail" name="txt-adminmail" value="<?php echo $currentadminmail;?>" data-clear-btn="true" data-mini="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" required>
        </div>
    </div>
    <div class="row">
      <div class="buttonHolder">
      <input type="submit" value="Update administrator information" name="btn-update" style="background-color: #4CAF50;">
      </div>
    </div>
    </form>
    </div>
</div>



</body>
</html>