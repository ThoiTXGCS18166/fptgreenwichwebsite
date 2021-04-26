<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The About Page For Staff</title>
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
  <a href="updatestaffinfo.php">Update Info</a>
  <a class="active" href="about2.php">About Us</a>
  <a href="login.php">Log Out</a>
</div>

<div class="content">
  <img src="img/logo.PNG" alt="Library Logo" style="width:45%">
  <h2>The about-us page for staff</h2>
  <h3>The information about the role of staff on this website</h3>
  <strong>About the staff, he or she can execute all the tasks below on this website</strong>
  <p>1. View, add, update, search for the student records in the database</p>
  <p>2. View, add, update, search for the teacher records in the database</p>
  <p>3. View, add, update, search for the outsider records in the database</p>
  <p>4. View, add, update, search for the book borrowing records in the database</p>
  <p>5. View, add, update, search for the laptop borrowing records in the database</p>
  <p>6. View, add, update, search for the room borrowing records in the database</p>
  <p>7. View, add, update, search for the book printing records in the database</p>
  <p>8. Update specific staff personal information by username in the database</p>
  <p>9. Read guidance for executing the staff tasks</p>

  <h4>Guidance for staff on this website</h4>
  <strong>1. View, add, update, search for the student records in the database</strong>
  <p>Go to the staff homepage -> Choose 'View Students' -> View the current student records -> Choose to whether add new record or update/view details for the current record or search for the needed record</p>
  <strong>2. View, add, update, search for the teacher records in the database</strong>
  <p>Go to the staff homepage -> Choose 'View Teachers' -> View the current teacher records -> Choose to whether add new record or update/view details for the current record or search for the needed record</p>
  <strong>3. View, add, update, search for the outsider records in the database</strong>
  <p>Go to the staff homepage -> Choose 'View Outsiders' -> View the current outsider records -> Choose to whether add new record or update/view details for the current record or search for the needed record</p>
  <strong>4. View, add, update, search for the book borrowing records in the database</strong>
  <p>Go to the staff homepage -> Choose 'View Book Borrowing Records' -> View the current book borrowing records -> Choose to whether add new record or update/view details for the current record or search for the needed record</p>
  <strong>5. View, add, update, search for the laptop borrowing records in the database</strong>
  <p>Go to the staff homepage -> Choose 'View Laptop Borrowing Records' -> View the current laptop borrowing records -> Choose to whether add new record or update/view details for the current record or search for the needed record</p>
  <strong>6. View, add, update, search for the room borrowing records in the database</strong>
  <p>Go to the staff homepage -> Choose 'View Room Borrowing Records' -> View the current room borrowing records -> Choose to whether add new record or update/view details for the current record or search for the needed record</p>
  <strong>7. View, add, update, search for the book printing records in the database</strong>
  <p>Go to the staff homepage -> Choose 'View Printing Records' -> View the current printing records -> Choose to whether add new record or update/view details for the current record or search for the needed record</p>
  <strong>8. Update specific staff personal information by username in the database</strong>
  <p>Go to the staff homepage -> Choose 'Update Info' -> Enter the needed information in the updating form -> Click on button 'Update staff information' for updating staff personal information</p>
  <strong>9. Read guidance for executing the staff tasks</strong>
  <p>Go to the staff homepage -> Choose 'About Us' -> Read guidance for executing the staff tasks</p>

  <h4>FPT Greenwich Library Contact Information</h4>
  <p><strong>+ Library Address: 144 Pham Phu Thu, Ward 4, District 6, Ho Chi Minh City 700000, Vietnam</strong></p>
  <p><strong>+ Phone Number: 0866894592</strong></p>
  <p><strong>+ Mail Address: thoitxgcs18166@fpt.edu.vn</strong></p>
  <p><br></p>
  
</div>



</body>
</html>