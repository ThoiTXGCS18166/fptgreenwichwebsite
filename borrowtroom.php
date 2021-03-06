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

  date_default_timezone_set("Asia/Ho_Chi_Minh");
  $currentdate=date('Y-m-d');
  $currenttime=date('H:i');
  
  if(isset($_POST['btn-borrow'])){   
    $roomid=$_POST['txt-roomid'];
    $staffid=1;
    $borrowername=$_POST['txt-teacherusername'];
    $borrowertype="Teacher";
    $startdate=$_POST['txt-startdate'];
    $borrowhour="3 hours";
    $recordfee="0 USD";
    $borrowingstatus=0;
    $qrcode="troomqrcode2.png";
    $returnstatus=0;
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $submitdate=date('Y-m-d H:i:s');
    $enddate = date('Y-m-d H:i:s', strtotime($startdate)+10800);
    $borrowpriority="1";
    $bookingstatus=1;
    $borrowermail = $_SESSION['login_mail'];

    $start_date = new DateTime($startdate);
    $end_date = new DateTime($enddate);
    $borrowdate = $start_date->format('Y-m-d 23:59:59');
    $borrow_date = new DateTime($borrowdate);
    
    if($end_date > $borrow_date) {
      echo '<script>alert("The current room can not be booked at the chosen time. Please return and choose a different time to borrow the study room")</script>';
    } else {
      $sql="SELECT * FROM roomrecords WHERE RoomID='".$roomid."' AND BookingStatus = '1'";
    
      $result=mysqli_query($conn,$sql);

      if(mysqli_num_rows($result)==2){
        echo '<script>alert("The current room has enough borrowers for reservation. Please return and choose a different room to borrow.")</script>';
      } elseif(mysqli_num_rows($result)==1) {
        while ($row = mysqli_fetch_assoc($result)) {
          $startdate1 = $row["StartDate"];
          $enddate1 = $row["EndDate"];
          $startdate2 = date('Y-m-d H:i:s', strtotime($startdate1)-10800);
        }

        $datetime1 = new DateTime($startdate);
        $datetime2 = new DateTime($startdate1);
        $datetime3 = new DateTime($enddate1);
        $datetime4 = new DateTime($startdate2);

        if($datetime1 == $datetime2) {
          echo '<script>alert("The current room can not be booked at the chosen time. Please return and choose a different time to borrow the study room")</script>';
        } elseif($datetime1 > $datetime2 && $datetime1 < $datetime3) {
          echo '<script>alert("The current room can not be booked at the chosen time. Please return and choose a different time to borrow the study room")</script>';
        } elseif($datetime1 > $datetime4 && $datetime1 < $datetime2) {
          echo '<script>alert("The current room can not be booked at the chosen time. Please return and choose a different time to borrow the study room")</script>';
        } else {
          $sql="INSERT INTO roomrecords (RoomID, StaffID, BorrowerName, BorrowerType, StartDate, EndDate, BorrowHour, RecordFee, BorrowingStatus, ReturnStatus, SubmitDate, BorrowPriority, BookingStatus, BorrowerMail)
          VALUES ('$roomid', '$staffid', '$borrowername', '$borrowertype', '$startdate', '$enddate', '$borrowhour', '$recordfee', '$borrowingstatus', '$returnstatus', '$submitdate', '$borrowpriority','$bookingstatus', '$borrowermail')";   
              
          if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Request for borrowing room submitted successfully. Please often check your room borrowing record or email to come to the library on the right day to receive the needed room.")</script>';
          } else {
            echo '<script>alert("The input information is incorrect. Please return and modify the information into the form again for borrowing study room")</script>';
          }
        }
      } else {
        $sql="INSERT INTO roomrecords (RoomID, StaffID, BorrowerName, BorrowerType, StartDate, EndDate, BorrowHour, RecordFee, BorrowingStatus, ReturnStatus, SubmitDate, BorrowPriority, BookingStatus, BorrowerMail)
        VALUES ('$roomid', '$staffid', '$borrowername', '$borrowertype', '$startdate', '$enddate', '$borrowhour', '$recordfee', '$borrowingstatus', '$returnstatus', '$submitdate', '$borrowpriority','$bookingstatus', '$borrowermail')";   
            
        if ($conn->query($sql) === TRUE) {
          echo '<script>alert("Request for borrowing room submitted successfully. Please often check your room borrowing record or email to come to the library on the right day to receive the needed room.")</script>';
        } else {
          echo '<script>alert("The input information is incorrect. Please return and modify the information into the form again for borrowing study room")</script>';
        }
      }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Room Borrowing Page For Teacher</title>
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

    input[type=text], input[type=datetime-local], select {
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
      width: 12em;
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
  <a class="active" href="borrowtroom.php">Rent Study Room</a>
  <a href="printtdocument.php">Print Documents</a>
  <a href="viewtbookborrowingrecords.php">View Book Borrowing Records</a>
  <a href="viewtlaptopborrowingrecords.php">View Laptop Borrowing Records</a>
  <a href="viewtroomborrowingrecords.php">View Room Borrowing Records</a>
  <a href="viewtbookprintingrecords.php">View Book Printing Records</a>
  <a href="updateteacherinfo.php">Update Info</a>
  <a href="librarychat.php"> Online Chat</a>
  <a href="about4.php">About Us</a>
  <a href="index.php">Log Out</a>
</div>

<div class="content">
  <img src="img/logo.PNG" alt="Library Logo" style="width:45%">
  <h2>The room borrowing page for teacher</h2>
  <h3>The room borrowing form for teacher</h3>

  <div class="container">
    <form action="borrowtroom.php" method="POST">
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
        <label for="txt-roomid">Borrowed Room</label>
        </div>
        <div class="col-75">
        <select id="txt-roomid" name="txt-roomid" data-mini="true" required>
          <option value="1">Library Room 101 - Capacity 1</option>
          <option value="2">Library Room 102 - Capacity 1</option>
          <option value="3">Library Room 103 - Capacity 2</option>
          <option value="4">Library Room 104 - Capacity 2</option>
          <option value="5">Library Room 105 - Capacity 4</option>
          <option value="6">Library Room 201 - Capacity 1</option>
          <option value="7">Library Room 202 - Capacity 1</option>
          <option value="8">Library Room 203 - Capacity 2</option>
          <option value="9">Library Room 204 - Capacity 2</option>
          <option value="10">Library Room 205 - Capacity 4</option>
          <option value="11">Library Room 301 - Capacity 1</option>
          <option value="12">Library Room 302 - Capacity 1</option>
          <option value="13">Library Room 303 - Capacity 2</option>
          <option value="14">Library Room 304 - Capacity 2</option>
          <option value="15">Library Room 305 - Capacity 4</option>
        </select>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-startdate">Start Date</label>
        </div>
        <div class="col-75">
        <input type="datetime-local" id="txt-startdate" name="txt-startdate" min="<?php echo $currentdate;?>T<?php echo $currenttime;?>" data-clear-btn="true" data-mini="true" required>
        </div>
    </div>
    <div class="row">
        <div class="buttonHolder">
        <input type="submit" value="Borrow Study Room" name="btn-borrow" style="background-color: #4CAF50;">
        </div>
    </div>
    </form>
    </div>
</div>



</body>
</html>