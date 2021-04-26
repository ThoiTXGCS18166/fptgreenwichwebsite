<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Homepage For Outsider</title>
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
  <a class="active" href="home5.php">Home</a>
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
  <a href="updateoutsiderinfo.php">Update Info</a>
  <a href="librarychat.php"> Online Chat</a>
  <a href="about5.php">About Us</a>
  <a href="login.php">Log Out</a>
</div>

<div class="content">
  <img src="img/logo.PNG" alt="Library Logo" style="width:45%">
  <h2>The homepage for outsider</h2>

  <div class="container">
    <div class="row">
      <div class="column-66">
        <h1 class="xlarge-font"><b>View Books</b></h1>
        <button class="button" onclick="viewBooks()">View Books</button>
      </div>
      <div class="column-33">
          <img src="img/view-books.jpg" alt="View books" width="335" height="471">
      </div>
    </div>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <div class="row">
      <div class="column-33">
        <img src="img/view-laptops.jpg" alt="View laptops" width="335" height="471">
      </div>
      <div class="column-66">
        <h1 class="xlarge-font"><b>View Laptops</b></h1>
        <button class="button" onclick="viewLaptops()" style="background-color:red">View laptops</button>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="column-66">
        <h1 class="xlarge-font"><b>Borrow Books</b></h1>
        <button class="button" onclick="borrowBooks()">Borrow Books</button>
      </div>
      <div class="column-33">
          <img src="img/borrow-book.jpg" alt="Borrow books" width="335" height="471">
      </div>
    </div>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <div class="row">
      <div class="column-33">
        <img src="img/borrow-laptop.png" alt="Borrow laptops" width="335" height="471">
      </div>
      <div class="column-66">
        <h1 class="xlarge-font"><b>Borrow Laptops</b></h1>
        <button class="button" onclick="borrowLaptops()" style="background-color:red">Borrow Laptops</button>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="column-66">
        <h1 class="xlarge-font"><b>Rent Study Room</b></h1>
        <button class="button" onclick="borrowRooms()">Rent Study Room</button>
      </div>
      <div class="column-33">
          <img src="img/borrow-room.jpg" alt="Borrow books" width="335" height="471">
      </div>
    </div>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <div class="row">
      <div class="column-33">
        <img src="img/print-documents.jpg" alt="Print Documents" width="335" height="471">
      </div>
      <div class="column-66">
        <h1 class="xlarge-font"><b>Print Documents</b></h1>
        <button class="button" onclick="printDocuments()" style="background-color:red">Print Documents</button>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="column-66">
        <h1 class="xlarge-font"><b>View Book Borrowing Records</b></h1>
        <button class="button" onclick="viewbookborrowingRecords()">View Book Borrowing Records</button>
      </div>
      <div class="column-33">
          <img src="img/borrow-book.jpg" alt="View book borrowing records" width="335" height="471">
      </div>
    </div>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <div class="row">
      <div class="column-33">
        <img src="img/borrow-laptop.png" alt="View laptop borrowing records" width="335" height="471">
      </div>
      <div class="column-66">
        <h1 class="xlarge-font"><b>View Laptop Borrowing Records</b></h1>
        <button class="button" onclick="viewlaptopborrowingRecords()" style="background-color:red">View Laptop Borrowing Records</button>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="column-66">
        <h1 class="xlarge-font"><b>View Room Borrowing Records</b></h1>
        <button class="button" onclick="viewroomborrowingRecords()">View Room Borrowing Records</button>
      </div>
      <div class="column-33">
          <img src="img/borrow-room.jpg" alt="View room borrowing records" width="335" height="471">
      </div>
    </div>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <div class="row">
      <div class="column-33">
        <img src="img/print-documents.jpg" alt="View book printing records" width="335" height="471">
      </div>
      <div class="column-66">
        <h1 class="xlarge-font"><b>View Book Printing Records</b></h1>
        <button class="button" onclick="viewbookprintingRecords()" style="background-color:red">View Book Printing Records</button>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="column-66">
        <h1 class="xlarge-font"><b>Update Personal Info</b></h1>
        <button class="button" onclick="updateOutsider()">Update Info</button>
      </div>
      <div class="column-33">
          <img src="img/update.png" alt="Update personal information" width="335" height="471" >
      </div>
    </div>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <div class="row">
      <div class="column-33">
        <img src="img/online-chat.jpg" alt="Online chat" width="335" height="471">
      </div>
      <div class="column-66">
        <h1 class="xlarge-font"><b>Online Chat</b></h1>
        <button class="button" onclick="onlineChat()" style="background-color:red">Online Chat</button>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="column-66">
        <h1 class="xlarge-font"><b>About Us</b></h1>
        <button class="button" onclick="aboutOutsider()">About Us</button>
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
  function viewBooks() {
    location.replace('viewobook1.php');
  }

  function viewLaptops() {
    location.replace('viewolaptop.php');
  }

  function borrowBooks() {
    location.replace('borrowobook.php');
  }

  function borrowLaptops() {
    location.replace('borrowolaptop.php');
  }

  function borrowRooms() {
    location.replace('borroworoom.php');
  }

  function printDocuments() {
    location.replace('printodocument.php');
  }

  function viewbookborrowingRecords() {
    location.replace('viewobookborrowingrecords.php');
  }

  function viewlaptopborrowingRecords() {
    location.replace('viewolaptopborrowingrecords.php');
  }

  function viewroomborrowingRecords() {
    location.replace('vieworoomborrowingrecords.php');
  }

  function viewbookprintingRecords() {
    location.replace('viewobookprintingrecords.php');
  }

  function updateOutsider() {
    location.replace('updateoutsiderinfo.php');
  }

  function onlineChat() {
    location.replace('chatbot.php');
  }

  function aboutOutsider() {
    location.replace('about5.php');
  }

  function logOut() {
    location.replace('login.php');
  }

</script>

</body>
</html>