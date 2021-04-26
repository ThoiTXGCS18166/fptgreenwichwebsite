<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Homepage For Administrator</title>
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
  <a class="active" href="home1.php">Home</a>
  <a href="viewstaffs.php">View Staffs</a>
  <a href="viewbooks.php">View Books</a>
  <a href="viewlaptops.php">View Laptops</a>
  <a href="updateadmininfo.php">Update Info</a>
  <a href="about1.php">About Us</a>
  <a href="login.php">Log Out</a>
</div>

<div class="content">
  <img src="img/logo.PNG" alt="Library Logo" style="width:45%">
  <h2>The homepage for administrator</h2>

  <div class="container">
    <div class="row">
      <div class="column-33">
        <img src="img/view-staffs.jpg" alt="View staffs" width="335" height="471">
      </div>
      <div class="column-66">
        <h1 class="xlarge-font"><b>View Staff Records</b></h1>
        <button class="button" onclick="viewStaffs()" style="background-color:red">View Staffs</button>
      </div>
    </div>
  </div>
  
  <div class="container" style="background-color:#f1f1f1">
    <div class="row">
      <div class="column-66">
        <h1 class="xlarge-font"><b>View Book Records</b></h1>
        <button class="button" onclick="viewBooks()">View Books</button>
      </div>
      <div class="column-33">
          <img src="img/view-books.jpg" alt="View books" width="335" height="471">
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="column-33">
        <img src="img/view-laptops.jpg" alt="View laptops" width="335" height="471">
      </div>
      <div class="column-66">
        <h1 class="xlarge-font"><b>View Laptop Records</b></h1>
        <button class="button" onclick="viewLaptops()" style="background-color:red">View Laptops</button>
      </div>
    </div>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <div class="row">
      <div class="column-66">
        <h1 class="xlarge-font"><b>Update Personal Info</b></h1>
        <button class="button" onclick="updateAdmin()">Update Info</button>
      </div>
      <div class="column-33">
          <img src="img/update.png" alt="Update personal information" width="335" height="550" >
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="column-33">
        <img src="img/about-us.jpg" alt="About us" width="335" height="471" >
      </div>
      <div class="column-66">
          <h1 class="xlarge-font"><b>About Us</b></h1>
          <button class="button" onclick="aboutAdmin()" style="background-color:red">About Us</button>
      </div>
    </div>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <div class="row">
      <div class="column-66">
          <h1 class="xlarge-font"><b>Log Out</b></h1>
          <button class="button" onclick="logOut()">Log Out</button>
      </div>
      <div class="column-33">
          <img src="img/log-out.jpg" alt="About us" width="335" height="451" >
      </div>
    </div>
  </div>

</div>

<script>
  function viewStaffs() {
    location.replace('viewstaffs.php');
  }

  function viewBooks() {
    location.replace('viewbooks.php');
  }

  function viewLaptops() {
    location.replace('viewlaptops.php');
  }

  function updateAdmin() {
    location.replace('updateadmininfo.php');
  }

  function aboutAdmin() {
    location.replace('about1.php');
  }

  function logOut() {
    location.replace('login.php');
  }
</script>

</body>
</html>