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

  $sql="SELECT * FROM teachers WHERE TeacherUsername='".$_SESSION['login_teacherusername']."' limit 1";

  $result=mysqli_query($conn,$sql);

  if(mysqli_num_rows($result)==1) {
    while ($row = mysqli_fetch_assoc($result)) {
      $currentteacherpassword = $row["TeacherPassword"];
      $currentteacherid = $row["TeacherID"];
      $currentteachername = $row["TeacherName"];
      $currentteacherbirthday = $row["TeacherDoB"];
      $currentteacherphone = $row["TeacherPhone"];
      $currentteacheraddress = $row["TeacherAddress"];
      $currentteachermail = $row["TeacherMail"];
      $currentteachergender = $row["TeacherGender"];
    }
  }

  if(isset($_POST['btn-update'])){   
    $teacherusername=$_POST['txt-teacherusername'];
    $teachername=$_POST['txt-teachername'];
    $teacherpassword=$_POST['txt-teacherpassword'];
    $teachergender=$_POST['txt-teachergender'];
    $teacherbirthday=$_POST['txt-teacherbirthday'];
    $teacherphone=$_POST['txt-teacherphone'];
    $teacheraddress=$_POST['txt-teacheraddress'];
    $teachermail=$_POST['txt-teachermail'];
    $_SESSION['login_mail'] = $teachermail;

    $sql="SELECT * FROM teachers WHERE TeacherUsername='".$teacherusername."' limit 1";
    
    $result=mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result)==1){
      $sql = "UPDATE teachers SET TeacherName = '" .$teachername. "', TeacherPassword = '" .$teacherpassword. "', TeacherGender = '" 
            .$teachergender. "', TeacherDoB = '" .$teacherbirthday. "', TeacherPhone = '" 
            .$teacherphone. "', TeacherAddress = '" .$teacheraddress. "', TeacherMail = '" 
            .$teachermail. "' WHERE TeacherUsername = '" .$teacherusername. "'";

      $result = mysqli_query($conn, $sql);
      if ($result) {
        echo '<script>alert("The teacher information has been updated successfully.");window.location.href="home4.php"</script>';
      } else {
        echo '<script>alert("Error: The teacher updating email is already existed for another teacher account in the library database. Please check and retype the teacher updating email again.")</script>';
      }
    } else{
      echo '<script>alert("Error: The entered teacher username is not existed in the library database for updating. Please check and retype the teacher username again.")</script>';
    }
  }

  mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Personal Information Updating Page For Teacher</title>
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
  <a href="home4.php">Home</a>
  <a href="viewtbook1.php">View Books</a>
  <a href="viewtlaptop.php">View Laptops</a>
  <a href="borrowtbook.php">Borrow Books</a>
  <a href="borrowtlaptop.php">Borrow Laptops</a>
  <a href="borrowtroom.php">Rent Study Room</a>
  <a href="printtdocument.php">Print Documents</a>
  <a href="viewtbookborrowingrecords.php">View Book Borrowing Records</a>
  <a href="viewtlaptopborrowingrecords.php">View Laptop Borrowing Records</a>
  <a href="viewtroomborrowingrecords.php">View Room Borrowing Records</a>
  <a href="viewtbookprintingrecords.php">View Book Printing Records</a>
  <a class="active" href="updateteacherinfo.php">Update Info</a>
  <a href="librarychat.php"> Online Chat</a>
  <a href="about4.php">About Us</a>
  <a href="login.php">Log Out</a>
</div>

<div class="content">
  <img src="img/logo.PNG" alt="Library Logo" style="width:45%">
  <h2>The personal information updating page for teacher</h2>
  <h3>The personal information updating form for teacher</h3>

  <div class="container">
    <form action="updateteacherinfo.php" method="POST">
    <div class="row">
        <div class="col-25">
        <label for="txt-teacherid">Teacher ID</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-teacherid" name="txt-teacherid" value="<?php echo $currentteacherid;?>" readonly data-mini="true" >
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-teacherusername">Teacher Username</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-teacherusername" name="txt-teacherusername" value="<?php echo $_SESSION['login_teacherusername'];?>" readonly data-mini="true">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-teachername">Teacher Name</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-teachername" name="txt-teachername" value="<?php echo $currentteachername;?>" readonly data-mini="true">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-teacherpassword">Teacher Password</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-teacherpassword" name="txt-teacherpassword" placeholder="Enter new teacher password here" value="<?php echo $currentteacherpassword;?>" data-clear-btn="true" data-mini="true" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 to 30 characters" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-teachergender">Teacher Gender</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-teachergender" name="txt-teachergender" pplaceholder="Enter new teacher gender here" value="<?php echo $currentteachergender;?>" data-clear-btn="true" data-mini="true" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-teacherbirthday">Teacher Birthday</label>
        </div>
        <div class="col-75">
        <input type="date" id="txt-teacherbirthday" name="txt-teacherbirthday" min="1962-06-30" max="1992-06-30" value="<?php echo $currentteacherbirthday;?>" data-clear-btn="true" data-mini="true" title="Birthday must be in between 1962-06-30 and 1992-06-30" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-teacherphone">Teacher Phone</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-teacherphone" name="txt-teacherphone" placeholder="Enter new teacher phone number here" value="<?php echo $currentteacherphone;?>" data-clear-btn="true" data-mini="true" pattern="\d*" title="Phone number must not contain letter" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-teacheraddress">Teacher Address</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-teacheraddress" name="txt-teacheraddress" placeholder="Enter new teacher address here" value="<?php echo $currentteacheraddress;?>" data-clear-btn="true" data-mini="true" pattern=".{12,50}" title="Address must contain at least 12 and maximum 50 characters" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-teachermail">Teacher Mail</label>
        </div>
        <div class="col-75">
        <input type="email" id="txt-teachermail" name="txt-teachermail" placeholder="Enter new teacher mail address here" value="<?php echo $currentteachermail;?>" data-clear-btn="true" data-mini="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" required>
        </div>
    </div>
    <div class="row">
      <div class="buttonHolder">
      <input type="submit" value="Update teacher information" name="btn-update" style="background-color: #4CAF50;">
      </div>
    </div>
    </form>
    </div>
</div>



</body>
</html>