<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The About Page For Administrator</title>
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
  <a href="updateadmininfo.php">Update Info</a>
  <a class="active" href="about1.php">About Us</a>
  <a href="login.php">Log Out</a>
</div>

<div class="content">
  <img src="img/logo.PNG" alt="Library Logo" style="width:45%">
  <h2>The about-us page for administrator</h2>
  <h3>The information about the role of administrator on this website</h3>
  <h4>About the administrator, he or she can execute all the tasks below on this website</h4>
  <p>1. View, add, update, search for the staff records in the database</p>
  <p>2. View, update, search for the book records in the database</p>
  <p>3. View, update, search for the laptop records in the database</p>
  <p>4. Update specific administrator personal information by username in the database</p>
  <p>5. Read guidance for executing the administrator tasks</p>

  <h4>Guidance for administrator on this website</h4>
  <strong>1. View, add, update, search for the staff records in the database</strong>
  <p>Go to the administrator homepage -> Choose 'View Staffs' -> View the current staff records -> Choose to whether add new record or update/view details for the current record or search for the needed record</p>
  <strong>2. View, update, search for the book records in the database</strong>
  <p>Go to the administrator homepage -> Choose 'View Books' -> View the current book records -> Choose to whether update/view details for the current record or search for the needed record</p>
  <strong>3. View, update, search for the laptop records in the database</strong>
  <p>Go to the administrator homepage -> Choose 'View Laptops' -> View the current laptop records -> Choose to whether update/view details for the current record or search for the needed record</p>
  <strong>4. Update specific administrator personal information by username in the database</strong>
  <p>Go to the administrator homepage -> Choose 'Update Info' -> Enter the needed information in the updating form -> Click on button 'Update administrator information' for updating administrator personal information</p>
  <strong>5. Read guidance for executing the administrator tasks</strong>
  <p>Go to the administrator homepage -> Choose 'About Us' -> Read guidance for executing the administrator tasks</p>
  
  <h4>FPT Greenwich Library Contact Information</h4>
  <p><strong>+ Library Address: 144 Pham Phu Thu, Ward 4, District 6, Ho Chi Minh City 700000, Vietnam</strong></p>
  <p><strong>+ Phone Number: 0866894592</strong></p>
  <p><strong>+ Mail Address: thoitxgcs18166@fpt.edu.vn</strong></p>
  <p><br></p>

</div>



</body>
</html>