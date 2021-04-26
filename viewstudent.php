<!DOCTYPE HTML>
<html>
<head>
    <title>The Specific Student Viewing Page For Staff</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>View Specific Student Information</h1>
        </div>
         
        <?php
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
        
        //include database connection
        include 'config/database.php';
        
        // read current record's data
        try {
            // prepare select query
            $query = "SELECT StudentID, StaffID, StudentName, StudentUsername, StudentGender, StudentDoB, StudentPhone, StudentAddress, StudentMail, StudentStatus FROM students WHERE StudentID = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
        
            // this is the first question mark
            $stmt->bindParam(1, $id);
        
            // execute our query
            $stmt->execute();
        
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // values to fill up our form
            $studentid = $row['StudentID'];
            $staffid = $row['StaffID'];
            $studentname = $row['StudentName'];
            $studentusername = $row['StudentUsername'];
            $studentgender = $row['StudentGender'];
            $studentbirthday = $row['StudentDoB'];
            $studentphone = $row['StudentPhone'];
            $studentaddress = $row['StudentAddress'];
            $studentmail = $row['StudentMail'];
            $studentstatus = $row['StudentStatus'];

            if($studentstatus == 1) {
                $status = 'Available';
            } else {
                $status = 'Disabled';
            }
        }
        
        // show error
        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
        ?>
 
        <!--we have our html table here where the record will be displayed-->
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Student ID</td>
                <td><?php echo htmlspecialchars($studentid, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Staff ID</td>
                <td><?php echo htmlspecialchars($staffid, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Student Name</td>
                <td><?php echo htmlspecialchars($studentname, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Student Username</td>
                <td><?php echo htmlspecialchars($studentusername, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Student Gender</td>
                <td><?php echo htmlspecialchars($studentgender, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Student Birthday</td>
                <td><?php echo htmlspecialchars($studentbirthday, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Student Phone</td>
                <td><?php echo htmlspecialchars($studentphone, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Student Address</td>
                <td><?php echo htmlspecialchars($studentaddress, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Student Mail</td>
                <td><?php echo htmlspecialchars($studentmail, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Student Status</td>
                <td><?php echo htmlspecialchars($status, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='viewstudents.php' class='btn btn-danger'>Back to view students</a>
                </td>
            </tr>
        </table>
 
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>