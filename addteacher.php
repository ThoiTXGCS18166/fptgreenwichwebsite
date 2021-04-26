<!DOCTYPE HTML>
<html>
<head>
    <title>The Teacher Adding Page For Staff</title>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
</head>
<body>
  
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1>Add Teacher</h1>
        </div>
      
        <?php
        if($_POST){
        
            // include database connection
            include 'config/database.php';
        
            try{
            
                // insert query
                $query = "INSERT INTO teachers SET StaffID=:staffid, TeacherName=:teachername, TeacherUsername=:teacherusername, TeacherPassword=:teacherpassword, TeacherGender=:teachergender, TeacherDoB=:teacherbirthday, TeacherPhone=:teacherphone, TeacherAddress=:teacheraddress, TeacherMail=:teachermail, TeacherStatus=:teacherstatus";
        
                // prepare query for execution
                $stmt = $con->prepare($query);
        
                // posted values
                $staffid=1;
                $teachername=htmlspecialchars(strip_tags($_POST['txt-teachername']));
                $teacherusername=htmlspecialchars(strip_tags($_POST['txt-teacherusername']));
                $teacherpassword=htmlspecialchars(strip_tags($_POST['txt-teacherpassword']));
                $teachergender=htmlspecialchars(strip_tags($_POST['txt-teachergender']));
                $teacherbirthday=htmlspecialchars(strip_tags($_POST['txt-teacherbirthday']));
                $teacherphone=htmlspecialchars(strip_tags($_POST['txt-teacherphone']));
                $teacheraddress=htmlspecialchars(strip_tags($_POST['txt-teacheraddress']));
                $teachermail=htmlspecialchars(strip_tags($_POST['txt-teachermail']));
                $teacherstatus=1;
        
                // bind the parameters
                $stmt->bindParam(':staffid', $staffid);
                $stmt->bindParam(':teachername', $teachername);
                $stmt->bindParam(':teacherusername', $teacherusername);
                $stmt->bindParam(':teacherpassword', $teacherpassword);
                $stmt->bindParam(':teachergender', $teachergender);
                $stmt->bindParam(':teacherbirthday', $teacherbirthday);
                $stmt->bindParam(':teacherphone', $teacherphone);
                $stmt->bindParam(':teacheraddress', $teacheraddress);
                $stmt->bindParam(':teachermail', $teachermail);
                $stmt->bindParam(':teacherstatus', $teacherstatus);
                
                // Execute the query
                if($stmt->execute()){
                    echo "<div class='alert alert-success'>Record was saved.</div>";
                }else{
                    echo "<div class='alert alert-danger'>Unable to save record because new username/email has already existed in the database.</div>";
                }
                
            }
            
            // show error
            catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>
 
    <!-- html form here where the product information will be entered -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Teacher Name</td>
                <td><input type='text' name='txt-teachername' class='form-control' pattern="[^0-9]*" title="Name must not contain number" required/></td>
            </tr>
            <tr>
                <td>Teacher Username</td>
                <td><input type='text' name='txt-teacherusername' class='form-control' pattern=".{7,30}" title="Username must contain at least 7 and maximum 30 characters" required/></td>
            </tr>
            <tr>
                <td>Teacher Password</td>
                <td><input type='password' name='txt-teacherpassword' class='form-control' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 to 30 characters" required/></td>
            </tr>
            <tr>
                <td>Teacher Gender</td>
                <td><input type='text' name='txt-teachergender' class='form-control' required/></td>
            </tr>
            <tr>
                <td>Teacher Birthday</td>
                <td><input type='date' name='txt-teacherbirthday' min="1962-06-30" max="1992-06-30" class='form-control' title="Birthday must be in between 1962-06-30 and 1992-06-30" required/></td>
            </tr>
            <tr>
                <td>Teacher Phone</td>
                <td><input type='text' name='txt-teacherphone' class='form-control' pattern="\d*" title="Phone number must not contain letter" required/></td>
            </tr>
            <tr>
                <td>Teacher Address</td>
                <td><input type='text' name='txt-teacheraddress' class='form-control' pattern=".{12,50}" title="Address must contain at least 12 and maximum 50 characters" required/></td>
            </tr>
            <tr>
                <td>Teacher Mail</td>
                <td><input type='email' name='txt-teachermail' class='form-control' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" required/></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type='submit' value='Save' class='btn btn-primary' />
                    <a href='viewteachers.php' class='btn btn-danger'>Back to view teachers</a>
                </td>
            </tr>
        </table>
    </form>
          
    </div> <!-- end .container -->
      
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>