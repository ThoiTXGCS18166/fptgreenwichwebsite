<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Homepage For Staff</title>
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
    }

    img {
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    h2{
        text-align: center;
    }

    .container {
      padding: 64px;
    }

    .row:after {
      content: "";
      display: table;
      clear: both
    }

    .column-66 {
      float: left;
      width: 66.66666%;
      padding: 20px;
    }

    .column-33 {
      float: left;
      width: 33.33333%;
      padding: 20px;
    }

    .xlarge-font {
      font-size: 64px
    }

    .button {
      border: none;
      color: white;
      padding: 14px 28px;
      font-size: 16px;
      cursor: pointer;
      background-color: #4CAF50;
    }

    img {
      display: block;
      height: auto;
      max-width: 100%;
    }

    @media screen and (max-width: 1000px) {
      .column-66,
      .column-33 {
        width: 100%;
        text-align: center;
      }
      img {
        margin: auto;
      }
    }


    </style>
</head>
<body>

<div class="sidebar">
  <a class="active" href="home2.php">Home</a>
  <a href="viewstudents.php">View Students</a>
  <a href="viewteachers.php">View Teachers</a>
  <a href="viewoutsiders.php">View Outsiders</a>
  <a href="viewbookrecords.php">View Book Borrowing Records</a>
  <a href="viewlaptoprecords.php">View Laptop Borrowing Records</a>
  <a href="viewroomrecords.php">View Room Borrowing Records</a>
  <a href="viewprintingrecords.php">View Printing Records</a>
  <a href="updatestaffinfo.php">Update Info</a>
  <a href="about2.php">About Us</a>
  <a href="login.php">Log Out</a>
</div>

<div class="content">
  <img src="img/logo.PNG" alt="Library Logo" style="width:45%">
  <h2>The homepage for staff</h2>

  <div class="container">
    <div class="row">
      <div class="column-66">
        <h1 class="xlarge-font"><b>View Student Records</b></h1>
        <button class="button" onclick="viewStudents()">View Students</button>
      </div>
      <div class="column-33">
          <img src="img/view-students.jpg" alt="View students" width="335" height="471">
      </div>
    </div>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <div class="row">
      <div class="column-33">
        <img src="img/view-teachers.png" alt="View teachers" width="335" height="471">
      </div>
      <div class="column-66">
        <h1 class="xlarge-font"><b>View Teacher Records</b></h1>
        <button class="button" onclick="viewTeachers()" style="background-color:red">View Teachers</button>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="column-66">
        <h1 class="xlarge-font"><b>View Outsider Records</b></h1>
        <button class="button" onclick="viewOutsiders()">View Outsiders</button>
      </div>
      <div class="column-33">
          <img src="img/view-outsiders.jpg" alt="View outsiders" width="335" height="471" >
      </div>
    </div>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <div class="row">
      <div class="column-33">
        <img src="img/view-book-borrowing-records.jpg" alt="View book borrowing records" width="335" height="471">
      </div>
      <div class="column-66">
        <h1 class="xlarge-font"><b>View Book Borrowing Records</b></h1>
        <button class="button" onclick="viewbookborrowingRecords()" style="background-color:red">View Book Borrowing Records</button>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="column-66">
        <h1 class="xlarge-font"><b>View Laptop Borrowing Records</b></h1>
        <button class="button" onclick="viewlaptopborrowingRecords()">View Laptop Borrowing Records</button>
      </div>
      <div class="column-33">
          <img src="img/view-laptop-borrowing-records.jpg" alt="View laptop borrowing records" width="335" height="471" >
      </div>
    </div>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <div class="row">
      <div class="column-33">
        <img src="img/view-room-borrowing-records.png" alt="View room borrowing records" width="335" height="471">
      </div>
      <div class="column-66">
        <h1 class="xlarge-font"><b>View Room Borrowing Records</b></h1>
        <button class="button" onclick="viewroomborrowingRecords()" style="background-color:red">View Room Borrowing Records</button>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="column-66">
        <h1 class="xlarge-font"><b>View Printing Records</b></h1>
        <button class="button" onclick="viewprintingRecords()">View Printing Records</button>
      </div>
      <div class="column-33">
        <img src="img/view-printing-records.jpg" alt="View printing records" width="335" height="471">
      </div>
    </div>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <div class="row">
      <div class="column-33">
        <img src="img/update.png" alt="Update personal information" width="335" height="471">
      </div>
      <div class="column-66">
        <h1 class="xlarge-font"><b>Update Personal Information</b></h1>
        <button class="button" onclick="updateStaff()" style="background-color:red">Update Info</button>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="column-66">
        <h1 class="xlarge-font"><b>About Us</b></h1>
        <button class="button" onclick="aboutStaff()">About Us</button>
      </div>
      <div class="column-33">
          <img src="img/about-us.jpg" alt="About us" width="335" height="471" >
      </div>
    </div>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <div class="row">
      <div class="column-33">
        <img src="img/log-out.jpg" alt="Log out" width="335" height="471">
      </div>
      <div class="column-66">
        <h1 class="xlarge-font"><b>Log Out</b></h1>
        <button class="button" onclick="logOut()" style="background-color:red">Log Out</button>
      </div>
    </div>
  </div>

</div>

<script>
  function viewStudents() {
    location.replace('viewstudents.php');
  }

  function viewTeachers() {
    location.replace('viewteachers.php');
  }

  function viewOutsiders() {
    location.replace('viewoutsiders.php');
  }

  function viewbookborrowingRecords() {
    location.replace('viewbookrecords.php');
  }

  function viewlaptopborrowingRecords() {
    location.replace('viewlaptoprecords.php');
  }

  function viewroomborrowingRecords() {
    location.replace('viewroomrecords.php');
  }

  function viewprintingRecords() {
    location.replace('viewprintingrecords.php');
  }

  function updateStaff() {
    location.replace('updatestaffinfo.php');
  }

  function aboutStaff() {
    location.replace('about2.php');
  }

  function logOut() {
    location.replace('login.php');
  }

</script>

</body>
</html>