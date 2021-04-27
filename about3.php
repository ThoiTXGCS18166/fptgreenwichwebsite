<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The About Page For Student</title>
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
  <a href="updatestudentinfo.php">Update Info</a>
  <a href="librarychat.php"> Online Chat</a>
  <a class="active" href="about3.php">About Us</a>
  <a href="index.php">Log Out</a>
</div>

<div class="content">
  <img src="img/logo.PNG" alt="Library Logo" style="width:45%">
  <h2>The about-us page for student</h2>
  <h3>The information about the role of student on this website</h3>
  <strong>About the student, he or she can execute all the tasks below on this website</strong>
  <p>1. View the current books on this website</p>
  <p>2. View the current laptops on this website</p>
  <p>3. Borrow the current books on this website</p>
  <p>4. Borrow the current laptops on this website</p>
  <p>5. Borrow the library study room on this website</p>
  <p>6. Print the current book documents on this website</p>
  <p>7. View details for current book borrowing records and extend/cancel the record</p>
  <p>8. View details for current laptop borrowing records and cancel the record</p>
  <p>9. View details for current room borrowing records and extend/cancel the record</p>
  <p>10. View details for current book printing records and cancel the record</p>
  <p>11. Update specific student personal information by username in the database</p>
  <p>12. Chat online with the library AI chatbot on this website</p>
  <p>13. View guidance for executing the student tasks</p>

  <h4>Guidance for student on this website</h4>
  <strong>1. View the current books on this website</strong>
  <p>Go to the student homepage -> Choose 'View Books' -> View the current books -> Click on link 'View Book Details' for viewing the book details</p>
  <strong>2. View the current laptops on this website</strong>
  <p>Go to the student homepage -> Choose 'View Laptops' -> View the current laptops</p>
  <strong>3. Borrow the current books on this website</strong>
  <p>Go to the student homepage -> Choose 'Borrow Books' -> Enter the needed information in the borrowing form -> Click on button 'Borrow Book' for borrowing library book</p>
  <strong>4. Borrow the current laptops on this website</strong>
  <p>Go to the student homepage -> Choose 'Borrow Laptops' -> Enter the needed information in the borrowing form -> Click on button 'Borrow Laptop' for borrowing library laptop</p>
  <strong>5. Borrow the library study room on this website</strong>
  <p>Go to the student homepage -> Choose 'Rent Study Room' -> Enter the needed information in the borrowing form -> Click on button 'Borrow Study Room' for borrowing library study room</p>
  <strong>6. Print the current book documents on this website</strong>
  <p>Go to the student homepage -> Choose 'Print Documents' -> Enter the needed information in the printing form -> Click on button 'Print Book' for reserving library book printing document or button 'Make Payment' for making printing payment</p>
  <strong>7. View details for current book borrowing records and extend/cancel the record</strong>
  <p>Go to the student homepage -> Choose 'View Book Borrowing Records' -> View the current book borrowing records -> Choose to whether view details or extend/cancel the book borrowing record</p>
  <strong>8. View details for current laptop borrowing records and cancel the record</strong>
  <p>Go to the student homepage -> Choose 'View Laptop Borrowing Records' -> View the current laptop borrowing records -> Choose to whether view details or cancel the laptop borrowing record</p>
  <strong>9. View details for current room borrowing records and extend/cancel the record</strong>
  <p>Go to the student homepage -> Choose 'View Room Borrowing Records' -> View the current room borrowing records -> Choose to whether view details or extend/cancel the room borrowing record</p>
  <strong>10. View details for current book printing records and cancel the record</strong>
  <p>Go to the student homepage -> Choose 'View Book Printing Records' -> View the current book printing records -> Choose to whether view details or cancel the book printing record</p>
  <strong>11. Update specific student personal information by username in the database</strong>
  <p>Go to the student homepage -> Choose 'Update Info' -> Enter the needed information in the updating form -> Click on button 'Update student information' for updating student personal information</p>
  <strong>12. Chat online with the library AI chatbot on this website</strong>
  <p>Go to the student homepage -> Choose 'Online Chat' -> Enter the needed text for the sending message -> Click on button 'Enter' to send that message</p>
  <strong>13. View guidance for executing the student tasks</strong>
  <p>Go to the student homepage -> Choose 'About Us' -> View guidance for executing the student tasks</p>

  <h4>FPT Greenwich Library Contact Information</h4>
  <p><strong>+ Library Address: 144 Pham Phu Thu, Ward 4, District 6, Ho Chi Minh City 700000, Vietnam</strong></p>
  <p><strong>+ Phone Number: 0866894592</strong></p>
  <p><strong>+ Mail Address: thoitxgcs18166@fpt.edu.vn</strong></p>
  <p><br></p>

</div>



</body>
</html>