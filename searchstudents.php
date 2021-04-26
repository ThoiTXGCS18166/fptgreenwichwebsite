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

  if(isset($_POST['btn-search'])){
    $_SESSION['searched_studentname'] = $_POST['txt-searchedstudentname'];
    header("location: searchstudents.php");
  }

  if(isset($_POST['btn-refresh'])){
    header("location: viewstudents.php");
  }

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>The Students Searching Page For Staff</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
    <!-- custom css -->
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }

    input[type=text] {
    width: 45%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
    }

    input[type=submit] {
      border: none;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      margin: 4px 2px;
      cursor: pointer;
      font-size: 17px;
    }
    </style>
 
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>View Searched Students</h1>
        </div>

        <form action="searchstudents.php" method="POST" autocomplete="off">
            <label for="txt-searchedstudentname">Searched Student Name</label>
            <input type="text" placeholder="Enter searched student name here" id="txt-searchedstudentname" name="txt-searchedstudentname" pattern=".{1,30}" title="Student name must contain at least 1 and maximum 30 characters" data-clear-btn="true" data-mini="true">
            <input type="submit" style="background-color: DodgerBlue;" value="Search Student" name="btn-search">
            <input type="submit" style="background-color: #FF0000;" value="Refresh" name="btn-refresh">
        </form>
     
        <?php
        // include database connection
        include 'config/database.php';
        
        $action = isset($_GET['action']) ? $_GET['action'] : "";
 
        // if it was redirected from delete.php
        if($action=='deleted'){
            echo "<div class='alert alert-success'>Record was deleted.</div>";
        }
        
        // select all data
        $query = "SELECT StudentID, StaffID, StudentName, StudentUsername, StudentPhone, StudentMail, StudentStatus FROM students WHERE StudentName LIKE'%".$_SESSION['searched_studentname']."%' ORDER BY StudentID ASC";
        $stmt = $con->prepare($query);
        $stmt->execute();
        
        // this is how to get number of rows returned
        $num = $stmt->rowCount();

        echo "<br>";
        
        // link to create record form
        echo "<a href='addstudent.php' class='btn btn-primary m-b-1em'>Add New Student</a>";

        echo "<br>";
        // link to return to admin main page
        echo "<a href='home2.php' class='btn btn-primary m-b-1em'>Return To Homepage</a>";
        
        //check if more than 0 record found
        if($num>0){
        
            echo "<table class='table table-hover table-responsive table-bordered'>";//start table
 
            //creating our table heading
            echo "<tr>";
                echo "<th>Student ID</th>";
                echo "<th>Staff ID</th>";
                echo "<th>Student Name</th>";
                echo "<th>Student Username</th>";
                echo "<th>Student Phone</th>";
                echo "<th>Student Mail</th>";
                echo "<th>Status</th>";
                echo "<th>Action</th>";
            echo "</tr>";
            
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['firstname'] to
                // just $firstname only
                extract($row);

                if($StudentStatus == 1) {
                    $Status = 'Available';
                } else {
                    $Status = 'Disabled';
                }
                
                // creating new table row per record
                echo "<tr>";
                    echo "<td>{$StudentID}</td>";
                    echo "<td>{$StaffID}</td>";
                    echo "<td>{$StudentName}</td>";
                    echo "<td>{$StudentUsername}</td>";
                    echo "<td>{$StudentPhone}</td>";
                    echo "<td>{$StudentMail}</td>";
                    echo "<td>{$Status}</td>";
                    echo "<td>";
                        // read one record 
                        echo "<a href='viewstudent.php?id={$StudentID}' class='btn btn-info m-r-1em'>Read</a>";
                        
                        // we will use this links on next part of this post
                        echo "<a href='updatestudent.php?id={$StudentID}' class='btn btn-primary m-r-1em'>Edit</a>";
            
                    echo "</td>";
                echo "</tr>";
            }
        
        // end table
        echo "</table>";
            
        }
        
        // if no records found
        else{
            echo "<div class='alert alert-danger'>No records found.</div>";
        }
        ?>
         
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
 
</body>
</html>