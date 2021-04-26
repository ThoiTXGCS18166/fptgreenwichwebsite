<!DOCTYPE HTML>
<html>
<head>
    <title>The Student Adding Page For Staff</title>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
</head>
<body>
  
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1>Add Student</h1>
        </div>
      
        <?php
        if($_POST){
        
            // include database connection
            include 'config/database.php';
        
            try{
            
                // insert query
                $query = "INSERT INTO students SET StaffID=:staffid, StudentName=:studentname, StudentUsername=:studentusername, StudentPassword=:studentpassword, StudentGender=:studentgender, StudentDoB=:studentbirthday, StudentPhone=:studentphone, StudentAddress=:studentaddress, StudentMail=:studentmail, StudentStatus=:studentstatus";
        
                // prepare query for execution
                $stmt = $con->prepare($query);
        
                // posted values
                $staffid=1;
                $studentname=htmlspecialchars(strip_tags($_POST['txt-studentname']));
                $studentusername=htmlspecialchars(strip_tags($_POST['txt-studentusername']));
                $studentpassword=htmlspecialchars(strip_tags($_POST['txt-studentpassword']));
                $studentgender=htmlspecialchars(strip_tags($_POST['txt-studentgender']));
                $studentbirthday=htmlspecialchars(strip_tags($_POST['txt-studentbirthday']));
                $studentphone=htmlspecialchars(strip_tags($_POST['txt-studentphone']));
                $studentaddress=htmlspecialchars(strip_tags($_POST['txt-studentaddress']));
                $studentmail=htmlspecialchars(strip_tags($_POST['txt-studentmail']));
                $studentstatus=1;
        
                // bind the parameters
                $stmt->bindParam(':staffid', $staffid);
                $stmt->bindParam(':studentname', $studentname);
                $stmt->bindParam(':studentusername', $studentusername);
                $stmt->bindParam(':studentpassword', $studentpassword);
                $stmt->bindParam(':studentgender', $studentgender);
                $stmt->bindParam(':studentbirthday', $studentbirthday);
                $stmt->bindParam(':studentphone', $studentphone);
                $stmt->bindParam(':studentaddress', $studentaddress);
                $stmt->bindParam(':studentmail', $studentmail);
                $stmt->bindParam(':studentstatus', $studentstatus);
                
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
                <td>Student Name</td>
                <td><input type='text' name='txt-studentname' class='form-control' pattern="[^0-9]*" title="Name must not contain number" required/></td>
            </tr>
            <tr>
                <td>Student Username</td>
                <td><input type='text' name='txt-studentusername' class='form-control' pattern=".{7,30}" title="Username must contain at least 7 and maximum 30 characters" required/></td>
            </tr>
            <tr>
                <td>Student Password</td>
                <td><input type='password' name='txt-studentpassword' class='form-control' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 to 30 characters" required/></td>
            </tr>
            <tr>
                <td>Student Gender</td>
                <td><input type='text' name='txt-studentgender' class='form-control' required/></td>
            </tr>
            <tr>
                <td>Student Birthday</td>
                <td><input type='date' name='txt-studentbirthday' min="1962-06-30" max="2003-06-30" class='form-control' title="Birthday must be in between 1962-06-30 and 2003-06-30" required/></td>
            </tr>
            <tr>
                <td>Student Phone</td>
                <td><input type='text' name='txt-studentphone' class='form-control' pattern="\d*" title="Phone number must not contain letter" required/></td>
            </tr>
            <tr>
                <td>Student Address</td>
                <td><input type='text' name='txt-studentaddress' class='form-control' pattern=".{12,50}" title="Address must contain at least 12 and maximum 50 characters" required/></td>
            </tr>
            <tr>
                <td>Student Mail</td>
                <td><input type='email' name='txt-studentmail' class='form-control' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" required/></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type='submit' value='Save' class='btn btn-primary' />
                    <a href='viewstudents.php' class='btn btn-danger'>Back to view students</a>
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