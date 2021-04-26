<!DOCTYPE HTML>
<html>
<head>
    <title>The Specific Teacher Viewing Page For Staff</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>View Specific Teacher Information</h1>
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
            $query = "SELECT TeacherID, StaffID, TeacherName, TeacherUsername, TeacherGender, TeacherDoB, TeacherPhone, TeacherAddress, TeacherMail, TeacherStatus FROM teachers WHERE TeacherID = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
        
            // this is the first question mark
            $stmt->bindParam(1, $id);
        
            // execute our query
            $stmt->execute();
        
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // values to fill up our form
            $teacherid = $row['TeacherID'];
            $staffid = $row['StaffID'];
            $teachername = $row['TeacherName'];
            $teacherusername = $row['TeacherUsername'];
            $teachergender = $row['TeacherGender'];
            $teacherbirthday = $row['TeacherDoB'];
            $teacherphone = $row['TeacherPhone'];
            $teacheraddress = $row['TeacherAddress'];
            $teachermail = $row['TeacherMail'];
            $teacherstatus = $row['TeacherStatus'];

            if($teacherstatus == 1) {
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
                <td>Teacher ID</td>
                <td><?php echo htmlspecialchars($teacherid, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Staff ID</td>
                <td><?php echo htmlspecialchars($staffid, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Teacher Name</td>
                <td><?php echo htmlspecialchars($teachername, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Teacher Username</td>
                <td><?php echo htmlspecialchars($teacherusername, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Teacher Gender</td>
                <td><?php echo htmlspecialchars($teachergender, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Teacher Birthday</td>
                <td><?php echo htmlspecialchars($teacherbirthday, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Teacher Phone</td>
                <td><?php echo htmlspecialchars($teacherphone, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Teacher Address</td>
                <td><?php echo htmlspecialchars($teacheraddress, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Teacher Mail</td>
                <td><?php echo htmlspecialchars($teachermail, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Teacher Status</td>
                <td><?php echo htmlspecialchars($status, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='viewteachers.php' class='btn btn-danger'>Back to view teachers</a>
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