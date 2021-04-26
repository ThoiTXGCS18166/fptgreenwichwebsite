<!DOCTYPE HTML>
<html>
<head>
    <title>The Student Updating Page For Staff</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update Student Information</h1>
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
            $query = "SELECT StudentID, StaffID, StudentName, StudentUsername, StudentPassword, StudentGender, StudentDoB, StudentPhone, StudentAddress, StudentMail, StudentStatus FROM students WHERE StudentID = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
            
            // this is the first question mark
            $stmt->bindParam(1, $id);
            
            // execute our query
            $stmt->execute();
            
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // values to fill up our form
            $staffid = $row['StaffID'];
            $studentname = $row['StudentName'];
            $studentusername = $row['StudentUsername'];
            $studentpassword = $row['StudentPassword'];
            $studentgender = $row['StudentGender'];
            $studentbirthday = $row['StudentDoB'];
            $studentphone = $row['StudentPhone'];
            $studentaddress = $row['StudentAddress'];
            $studentmail = $row['StudentMail'];
            $studentstatus = $row['StudentStatus'];
        }
        
        // show error
        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
        ?>
 
        <?php
        
        // check if form was submitted
        if($_POST){
            
            try{
            
                // write update query
                // in this case, it seemed like we have so many fields to pass and 
                // it is better to label them and not use question marks
                $query = "UPDATE students 
                            SET StaffID=:staffid, StudentName=:studentname, StudentUsername=:studentusername, StudentPassword=:studentpassword, StudentGender=:studentgender, StudentDoB=:studentbirthday, StudentPhone=:studentphone, StudentAddress=:studentaddress, StudentMail=:studentmail, StudentStatus=:studentstatus
                            WHERE StudentID = :id";
        
                // prepare query for excecution
                $stmt = $con->prepare($query);
        
                // posted values
                $staffid=htmlspecialchars(strip_tags($_POST['txt-staffid']));
                $studentname=htmlspecialchars(strip_tags($_POST['txt-studentname']));
                $studentusername=htmlspecialchars(strip_tags($_POST['txt-studentusername']));
                $studentpassword=htmlspecialchars(strip_tags($_POST['txt-studentpassword']));
                $studentgender=htmlspecialchars(strip_tags($_POST['txt-studentgender']));
                $studentbirthday=htmlspecialchars(strip_tags($_POST['txt-studentbirthday']));
                $studentphone=htmlspecialchars(strip_tags($_POST['txt-studentphone']));
                $studentaddress=htmlspecialchars(strip_tags($_POST['txt-studentaddress']));
                $studentmail=htmlspecialchars(strip_tags($_POST['txt-studentmail']));
                $studentstatus=htmlspecialchars(strip_tags($_POST['txt-studentstatus']));
        
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
                $stmt->bindParam(':id', $id);
                
                // Execute the query
                if($stmt->execute()){
                    echo "<div class='alert alert-success'>Record was updated.</div>";
                }else{
                    echo "<div class='alert alert-danger'>Unable to update record because username has already existed in the database. Please try again.</div>";
                }
                
            }
            
            // show errors
            catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>
 
        <!--we have our html form here where new record information can be updated-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Staff ID</td>
                    <td><input type='number' name='txt-staffid' min="1" max="10" value="<?php echo htmlspecialchars($staffid, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Student Name</td>
                    <td><input type='text' name='txt-studentname' value="<?php echo htmlspecialchars($studentname, ENT_QUOTES);  ?>" class='form-control' pattern="[^0-9]*" title="Name must not contain number" readonly/></td>
                </tr>
                <tr>
                    <td>Student Username</td>
                    <td><input type='text' name='txt-studentusername' value="<?php echo htmlspecialchars($studentusername, ENT_QUOTES);  ?>" class='form-control' pattern=".{7,30}" title="Username must contain at least 7 and maximum 30 characters" readonly/></td>
                </tr>
                <tr>
                    <td>Student Password</td>
                    <td><input type='password' name='txt-studentpassword' value="<?php echo htmlspecialchars($studentpassword, ENT_QUOTES);  ?>" class='form-control' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 to 30 characters" required/></td>
                </tr>
                <tr>
                    <td>Student Gender</td>
                    <td><input type='text' name='txt-studentgender' value="<?php echo htmlspecialchars($studentgender, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Student Birthday</td>
                    <td><input type='date' name='txt-studentbirthday' min="1962-06-30" max="2003-06-30" value="<?php echo htmlspecialchars($studentbirthday, ENT_QUOTES);  ?>" class='form-control' title="Birthday must be in between 1962-06-30 and 2003-06-30" readonly/></td>
                </tr>
                <tr>
                    <td>Student Phone</td>
                    <td><input type='text' name='txt-studentphone' value="<?php echo htmlspecialchars($studentphone, ENT_QUOTES);  ?>" class='form-control' pattern="\d*" title="Phone number must not contain letter" readonly/></td>
                </tr>
                <tr>
                    <td>Student Address</td>
                    <td><input type='text' name='txt-studentaddress' value="<?php echo htmlspecialchars($studentaddress, ENT_QUOTES);  ?>" class='form-control' pattern=".{12,50}" title="Address must contain at least 12 and maximum 50 characters" readonly/></td>
                </tr>
                <tr>
                    <td>Student Mail</td>
                    <td><input type='email' name='txt-studentmail' value="<?php echo htmlspecialchars($studentmail, ENT_QUOTES);  ?>" class='form-control' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" readonly/></td>
                </tr>
                <tr>
                    <td>Student Status</td>
                    <td><input type='number' name='txt-studentstatus' min="0" max="1" value="<?php echo htmlspecialchars($studentstatus, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
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