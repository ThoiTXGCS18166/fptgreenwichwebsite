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

  $sql="SELECT * FROM staffs WHERE StaffUsername='".$_SESSION['login_staffusername']."' limit 1";

  $result=mysqli_query($conn,$sql);

  if(mysqli_num_rows($result)==1) {
    while ($row = mysqli_fetch_assoc($result)) {
      $currentstaffpassword = $row["StaffPassword"];
      $currentstaffid = $row["StaffID"];
      $currentstaffname = $row["StaffName"];
      $currentstaffbirthday = $row["StaffDoB"];
      $currentstaffphone = $row["StaffPhone"];
      $currentstaffaddress = $row["StaffAddress"];
      $currentstaffmail = $row["StaffMail"];
      $currentstaffgender = $row["StaffGender"];
    }
  }

  if(isset($_POST['btn-update'])){   
    $staffusername=$_POST['txt-staffusername'];
    $staffname=$_POST['txt-staffname'];
    $staffpassword=$_POST['txt-staffpassword'];
    $staffgender=$_POST['txt-staffgender'];
    $staffbirthday=$_POST['txt-staffbirthday'];
    $staffphone=$_POST['txt-staffphone'];
    $staffaddress=$_POST['txt-staffaddress'];
    $staffmail=$_POST['txt-staffmail'];

    $sql="SELECT * FROM staffs WHERE StaffUsername='".$staffusername."' limit 1";
    
    $result=mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result)==1){
      $sql = "UPDATE staffs SET StaffName = '" .$staffname. "', StaffPassword = '" .$staffpassword. "', StaffGender = '" .$staffgender. "', StaffDoB = '" .$staffbirthday. "', StaffPhone = '" 
                                            .$staffphone. "', StaffAddress = '" .$staffaddress. "', StaffMail = '" .$staffmail. "' WHERE StaffUsername = '" .$staffusername. "'";

      $result = mysqli_query($conn, $sql);
      if ($result) {
        echo '<script>alert("The staff information has been updated successfully.");window.location.href="home2.php"</script>';
      } else {
        echo '<script>alert("Error: The staff updating email is already existed for another staff account in the library database. Please check and retype the staff updating email again.")</script>';
      }
    }
    else{
      echo '<script>alert("Error: The entered staff username is not existed in the library database for updating. Please check and retype the staff username again.")</script>';
    }

  }

  mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Personal Information Updating Page For Staff</title>
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
  <a href="home2.php">Home</a>
  <a href="viewstudents.php">View Students</a>
  <a href="viewteachers.php">View Teachers</a>
  <a href="viewoutsiders.php">View Outsiders</a>
  <a href="viewbookrecords.php">View Book Borrowing Records</a>
  <a href="viewlaptoprecords.php">View Laptop Borrowing Records</a>
  <a href="viewroomrecords.php">View Room Borrowing Records</a>
  <a href="viewprintingrecords.php">View Printing Records</a>
  <a class="active" href="updatestaffinfo.php">Update Info</a>
  <a href="about2.php">About Us</a>
  <a href="login.php">Log Out</a>
</div>

<div class="content">
  <img src="img/logo.PNG" alt="Library Logo" style="width:45%">
  <h2>The personal information updating page for staff</h2>
  <h3>The personal information updating form for staff</h3>

  <div class="container">
    <form action="updatestaffinfo.php" method="POST">
    <div class="row">
        <div class="col-25">
        <label for="txt-staffid">Staff ID</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-staffid" name="txt-staffid" value="<?php echo $currentstaffid;?>" readonly data-mini="true" >
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-staffusername">Staff Username</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-staffusername" name="txt-staffusername" value="<?php echo $_SESSION['login_staffusername'];?>" readonly data-mini="true">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-staffname">Staff Name</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-staffname" name="txt-staffname" value="<?php echo $currentstaffname;?>" readonly data-mini="true">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-staffpassword">Staff Password</label>
        </div>
        <div class="col-75">
        <input type="text" placeholder="Enter new staff password here" id="txt-staffpassword" name="txt-staffpassword" value="<?php echo $currentstaffpassword;?>" data-clear-btn="true" data-mini="true" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 to 30 characters" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-staffgender">Staff Gender</label>
        </div>
        <div class="col-75">
        <input type="text" placeholder="Enter new staff gender here" id="txt-staffgender" name="txt-staffgender" value="<?php echo $currentstaffgender;?>" data-clear-btn="true" data-mini="true" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-staffbirthday">Staff Birthday</label>
        </div>
        <div class="col-75">
        <input type="date" id="txt-staffbirthday" name="txt-staffbirthday" min="1982-06-30" max="1997-06-30" value="<?php echo $currentstaffbirthday;?>" data-clear-btn="true" data-mini="true" title="Birthday must be in between 1982-06-30 and 1997-06-30" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-staffphone">Staff Phone</label>
        </div>
        <div class="col-75">
        <input type="text" placeholder="Enter new staff phone number here" id="txt-staffphone" name="txt-staffphone" value="<?php echo $currentstaffphone;?>" data-clear-btn="true" data-mini="true" pattern="\d*" title="Phone number must not contain letter" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-staffaddress">Staff Address</label>
        </div>
        <div class="col-75">
        <input type="text" placeholder="Enter new staff address here" id="txt-staffaddress" name="txt-staffaddress" value="<?php echo $currentstaffaddress;?>" data-clear-btn="true" data-mini="true" pattern=".{12,50}" title="Address must contain at least 12 and maximum 50 characters" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-staffmail">Staff Mail</label>
        </div>
        <div class="col-75">
        <input type="email" placeholder="Enter new staff mail address here" id="txt-staffmail" name="txt-staffmail" value="<?php echo $currentstaffmail;?>" data-clear-btn="true" data-mini="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" required>
        </div>
    </div>
    <div class="row">
      <div class="buttonHolder">
      <input type="submit" value="Update staff information" name="btn-update" style="background-color: #4CAF50;">
      </div>
    </div>
    </form>
    </div>
</div>



</body>
</html>