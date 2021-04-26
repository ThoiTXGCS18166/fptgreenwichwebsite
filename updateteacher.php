<!DOCTYPE HTML>
<html>
<head>
    <title>The Teacher Updating Page For Staff</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update Teacher Information</h1>
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
            $query = "SELECT TeacherID, StaffID, TeacherName, TeacherUsername, TeacherPassword, TeacherGender, TeacherDoB, TeacherPhone, TeacherAddress, TeacherMail, TeacherStatus FROM teachers WHERE TeacherID = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
            
            // this is the first question mark
            $stmt->bindParam(1, $id);
            
            // execute our query
            $stmt->execute();
            
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // values to fill up our form
            $staffid = $row['StaffID'];
            $teachername = $row['TeacherName'];
            $teacherusername = $row['TeacherUsername'];
            $teacherpassword = $row['TeacherPassword'];
            $teachergender = $row['TeacherGender'];
            $teacherbirthday = $row['TeacherDoB'];
            $teacherphone = $row['TeacherPhone'];
            $teacheraddress = $row['TeacherAddress'];
            $teachermail = $row['TeacherMail'];
            $teacherstatus = $row['TeacherStatus'];
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
                $query = "UPDATE teachers 
                            SET StaffID=:staffid, TeacherName=:teachername, TeacherUsername=:teacherusername, TeacherPassword=:teacherpassword, TeacherGender=:teachergender, TeacherDoB=:teacherbirthday, TeacherPhone=:teacherphone, TeacherAddress=:teacheraddress, TeacherMail=:teachermail, TeacherStatus=:teacherstatus
                            WHERE TeacherID = :id";
        
                // prepare query for excecution
                $stmt = $con->prepare($query);
        
                // posted values
                $staffid=htmlspecialchars(strip_tags($_POST['txt-staffid']));
                $teachername=htmlspecialchars(strip_tags($_POST['txt-teachername']));
                $teacherusername=htmlspecialchars(strip_tags($_POST['txt-teacherusername']));
                $teacherpassword=htmlspecialchars(strip_tags($_POST['txt-teacherpassword']));
                $teachergender=htmlspecialchars(strip_tags($_POST['txt-teachergender']));
                $teacherbirthday=htmlspecialchars(strip_tags($_POST['txt-teacherbirthday']));
                $teacherphone=htmlspecialchars(strip_tags($_POST['txt-teacherphone']));
                $teacheraddress=htmlspecialchars(strip_tags($_POST['txt-teacheraddress']));
                $teachermail=htmlspecialchars(strip_tags($_POST['txt-teachermail']));
                $teacherstatus=htmlspecialchars(strip_tags($_POST['txt-teacherstatus']));
        
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
                    <td>Teacher Name</td>
                    <td><input type='text' name='txt-teachername' value="<?php echo htmlspecialchars($teachername, ENT_QUOTES);  ?>" class='form-control' pattern="[^0-9]*" title="Name must not contain number" readonly/></td>
                </tr>
                <tr>
                    <td>Teacher Username</td>
                    <td><input type='text' name='txt-teacherusername' value="<?php echo htmlspecialchars($teacherusername, ENT_QUOTES);  ?>" class='form-control' pattern=".{7,30}" title="Username must contain at least 7 and maximum 30 characters" readonly/></td>
                </tr>
                <tr>
                    <td>Teacher Password</td>
                    <td><input type='password' name='txt-teacherpassword' value="<?php echo htmlspecialchars($teacherpassword, ENT_QUOTES);  ?>" class='form-control' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 to 30 characters" required/></td>
                </tr>
                <tr>
                    <td>Teacher Gender</td>
                    <td><input type='text' name='txt-teachergender' value="<?php echo htmlspecialchars($teachergender, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Teacher Birthday</td>
                    <td><input type='date' name='txt-teacherbirthday' min="1962-06-30" max="1992-06-30" value="<?php echo htmlspecialchars($teacherbirthday, ENT_QUOTES);  ?>" class='form-control' title="Birthday must be in between 1962-06-30 and 1992-06-30" readonly/></td>
                </tr>
                <tr>
                    <td>Teacher Phone</td>
                    <td><input type='text' name='txt-teacherphone' value="<?php echo htmlspecialchars($teacherphone, ENT_QUOTES);  ?>" class='form-control' pattern="\d*" title="Phone number must not contain letter" readonly/></td>
                </tr>
                <tr>
                    <td>Teacher Address</td>
                    <td><input type='text' name='txt-teacheraddress' value="<?php echo htmlspecialchars($teacheraddress, ENT_QUOTES);  ?>" class='form-control' pattern=".{12,50}" title="Address must contain at least 12 and maximum 50 characters" readonly/></td>
                </tr>
                <tr>
                    <td>Teacher Mail</td>
                    <td><input type='email' name='txt-teachermail' value="<?php echo htmlspecialchars($teachermail, ENT_QUOTES);  ?>" class='form-control' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" readonly/></td>
                </tr>
                <tr>
                    <td>Teacher Status</td>
                    <td><input type='number' name='txt-teacherstatus' min="0" max="1" value="<?php echo htmlspecialchars($teacherstatus, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
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