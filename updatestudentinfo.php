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

  $sql="SELECT * FROM students WHERE StudentUsername='".$_SESSION['login_studentusername']."' limit 1";

  $result=mysqli_query($conn,$sql);

  if(mysqli_num_rows($result)==1) {
    while ($row = mysqli_fetch_assoc($result)) {
      $currentstudentpassword = $row["StudentPassword"];
      $currentstudentid = $row["StudentID"];
      $currentstudentname = $row["StudentName"];
      $currentstudentbirthday = $row["StudentDoB"];
      $currentstudentphone = $row["StudentPhone"];
      $currentstudentaddress = $row["StudentAddress"];
      $currentstudentmail = $row["StudentMail"];
      $currentstudentgender = $row["StudentGender"];
    }
  }

  if(isset($_POST['btn-update'])){   
    $studentusername=$_POST['txt-studentusername'];
    $studentname=$_POST['txt-studentname'];
    $studentpassword=$_POST['txt-studentpassword'];
    $studentgender=$_POST['txt-studentgender'];
    $studentbirthday=$_POST['txt-studentbirthday'];
    $studentphone=$_POST['txt-studentphone'];
    $studentaddress=$_POST['txt-studentaddress'];
    $studentmail=$_POST['txt-studentmail'];
    $_SESSION['login_mail'] = $studentmail;

    $sql="SELECT * FROM students WHERE StudentUsername='".$studentusername."' limit 1";
    
    $result=mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result)==1){
      $sql = "UPDATE students SET StudentName = '" .$studentname. "', StudentPassword = '" .$studentpassword. "', StudentGender = '" 
            .$studentgender. "', StudentDoB = '" .$studentbirthday. "', StudentPhone = '" 
            .$studentphone. "', StudentAddress = '" .$studentaddress. "', StudentMail = '" 
            .$studentmail. "' WHERE StudentUsername = '" .$studentusername. "'";

      $result = mysqli_query($conn, $sql);
      if ($result) {
        echo '<script>alert("The student information has been updated successfully.");window.location.href="home3.php"</script>';
      } else {
        echo '<script>alert("Error: The student updating email is already existed for another student account in the library database. Please check and retype the student updating email again.")</script>';
      }
    } else{
      echo '<script>alert("Error: The entered student username is not existed in the library database for updating. Please check and retype the student username again.")</script>';
    }
  }

  mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Personal Information Updating Page For Student</title>
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
  <a href="home3.php">Home</a>
  <a href="viewsbook1.php">View Books</a>
  <a href="viewslaptop.php">View Laptops</a>
  <a href="borrowsbook.php">Borrow Books</a>
  <a href="borrowslaptop.php">Borrow Laptops</a>
  <a href="borrowsroom.php">Rent Study Room</a>
  <a href="printsdocument.php">Print Documents</a>
  <a href="viewsbookborrowingrecords.php">View Book Borrowing Records</a>
  <a href="viewslaptopborrowingrecords.php">View Laptop Borrowing Records</a>
  <a href="viewsroomborrowingrecords.php">View Room Borrowing Records</a>
  <a href="viewsbookprintingrecords.php">View Book Printing Records</a>
  <a class="active" href="updatestudentinfo.php">Update Info</a>
  <a href="librarychat.php"> Online Chat</a>
  <a href="about3.php">About Us</a>
  <a href="index.php">Log Out</a>
</div>

<div class="content">
  <img src="img/logo.PNG" alt="Library Logo" style="width:45%">
  <h2>The personal information updating page for student</h2>
  <h3>The personal information updating form for student</h3>

  <div class="container">
    <form action="updatestudentinfo.php" method="POST">
    <div class="row">
        <div class="col-25">
        <label for="txt-studentid">Student ID</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-studentid" name="txt-studentid" value="<?php echo $currentstudentid;?>" readonly data-mini="true" >
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-studentusername">Student Username</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-studentusername" name="txt-studentusername" value="<?php echo $_SESSION['login_studentusername'];?>" readonly data-mini="true">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-studentname">Student Name</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-studentname" name="txt-studentname" value="<?php echo $currentstudentname;?>" readonly data-mini="true">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-studentpassword">Student Password</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-studentpassword" name="txt-studentpassword" placeholder="Enter new student password here" value="<?php echo $currentstudentpassword;?>" data-clear-btn="true" data-mini="true" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 to 30 characters" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-studentgender">Student Gender</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-studentgender" name="txt-studentgender" placeholder="Enter new student gender here" value="<?php echo $currentstudentgender;?>" data-clear-btn="true" data-mini="true" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-studentbirthday">Student Birthday</label>
        </div>
        <div class="col-75">
        <input type="date" id="txt-studentbirthday" name="txt-studentbirthday" min="1962-06-30" max="2003-06-30" value="<?php echo $currentstudentbirthday;?>" data-clear-btn="true" data-mini="true" title="Birthday must be in between 1962-06-30 and 2003-06-30" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-studentphone">Student Phone</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-studentphone" name="txt-studentphone" placeholder="Enter new student phone number here" value="<?php echo $currentstudentphone;?>" data-clear-btn="true" data-mini="true" pattern="\d*" title="Phone number must not contain letter" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-studentaddress">Student Address</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-studentaddress" name="txt-studentaddress" placeholder="Enter new student address here" value="<?php echo $currentstudentaddress;?>" data-clear-btn="true" data-mini="true" pattern=".{12,50}" title="Address must contain at least 12 and maximum 50 characters" required>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-studentmail">Student Mail</label>
        </div>
        <div class="col-75">
        <input type="email" id="txt-studentmail" name="txt-studentmail" placeholder="Enter new student mail address here" value="<?php echo $currentstudentmail;?>" data-clear-btn="true" data-mini="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" required>
        </div>
    </div>
    <div class="row">
      <div class="buttonHolder">
      <input type="submit" value="Update student information" name="btn-update" style="background-color: #4CAF50;">
      </div>
    </div>
    </form>
    </div>
</div>



</body>
</html>