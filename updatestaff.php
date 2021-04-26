<!DOCTYPE HTML>
<html>
<head>
    <title>The Staff Updating Page For Administrator</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update Staff Information</h1>
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
            $query = "SELECT StaffID, AdminID, StaffName, StaffUsername, StaffPassword, StaffGender, StaffDoB, StaffPhone, StaffAddress, StaffMail, StaffStatus FROM staffs WHERE StaffID = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
            
            // this is the first question mark
            $stmt->bindParam(1, $id);
            
            // execute our query
            $stmt->execute();
            
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // values to fill up our form
            $adminid = $row['AdminID'];
            $staffname = $row['StaffName'];
            $staffusername = $row['StaffUsername'];
            $staffpassword = $row['StaffPassword'];
            $staffgender = $row['StaffGender'];
            $staffbirthday = $row['StaffDoB'];
            $staffphone = $row['StaffPhone'];
            $staffaddress = $row['StaffAddress'];
            $staffmail = $row['StaffMail'];
            $staffstatus = $row['StaffStatus'];
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
                $query = "UPDATE staffs 
                            SET AdminID=:adminid, StaffName=:staffname, StaffUsername=:staffusername, StaffPassword=:staffpassword, StaffGender=:staffgender, StaffDoB=:staffbirthday, StaffPhone=:staffphone, StaffAddress=:staffaddress, StaffMail=:staffmail, StaffStatus=:staffstatus
                            WHERE StaffID = :id";
        
                // prepare query for excecution
                $stmt = $con->prepare($query);
        
                // posted values
                $adminid=htmlspecialchars(strip_tags($_POST['txt-adminid']));
                $staffname=htmlspecialchars(strip_tags($_POST['txt-staffname']));
                $staffusername=htmlspecialchars(strip_tags($_POST['txt-staffusername']));
                $staffpassword=htmlspecialchars(strip_tags($_POST['txt-staffpassword']));
                $staffgender=htmlspecialchars(strip_tags($_POST['txt-staffgender']));
                $staffbirthday=htmlspecialchars(strip_tags($_POST['txt-staffbirthday']));
                $staffphone=htmlspecialchars(strip_tags($_POST['txt-staffphone']));
                $staffaddress=htmlspecialchars(strip_tags($_POST['txt-staffaddress']));
                $staffmail=htmlspecialchars(strip_tags($_POST['txt-staffmail']));
                $staffstatus=htmlspecialchars(strip_tags($_POST['txt-staffstatus']));
        
                // bind the parameters
                $stmt->bindParam(':adminid', $adminid);
                $stmt->bindParam(':staffname', $staffname);
                $stmt->bindParam(':staffusername', $staffusername);
                $stmt->bindParam(':staffpassword', $staffpassword);
                $stmt->bindParam(':staffgender', $staffgender);
                $stmt->bindParam(':staffbirthday', $staffbirthday);
                $stmt->bindParam(':staffphone', $staffphone);
                $stmt->bindParam(':staffaddress', $staffaddress);
                $stmt->bindParam(':staffmail', $staffmail);
                $stmt->bindParam(':staffstatus', $staffstatus);
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
                    <td>Admin ID</td>
                    <td><input type='number' name='txt-adminid' min="1" max="10" value="<?php echo htmlspecialchars($adminid, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Staff Name</td>
                    <td><input type='text' name='txt-staffname' value="<?php echo htmlspecialchars($staffname, ENT_QUOTES);  ?>" class='form-control' pattern="[^0-9]*" title="Name must not contain number" readonly/></td>
                </tr>
                <tr>
                    <td>Staff Username</td>
                    <td><input type='text' name='txt-staffusername' value="<?php echo htmlspecialchars($staffusername, ENT_QUOTES);  ?>" class='form-control' pattern=".{7,30}" title="Username must contain at least 7 and maximum 30 characters" readonly/></td>
                </tr>
                <tr>
                    <td>Staff Password</td>
                    <td><input type='password' name='txt-staffpassword' value="<?php echo htmlspecialchars($staffpassword, ENT_QUOTES);  ?>" class='form-control' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 to 30 characters" required/></td>
                </tr>
                <tr>
                    <td>Staff Gender</td>
                    <td><input type='text' name='txt-staffgender' value="<?php echo htmlspecialchars($staffgender, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Staff Birthday</td>
                    <td><input type='date' name='txt-staffbirthday' min="1982-06-30" max="1997-06-30" value="<?php echo htmlspecialchars($staffbirthday, ENT_QUOTES);  ?>" class='form-control' title="Birthday must be in between 1982-06-30 and 1997-06-30" readonly/></td>
                </tr>
                <tr>
                    <td>Staff Phone</td>
                    <td><input type='text' name='txt-staffphone' value="<?php echo htmlspecialchars($staffphone, ENT_QUOTES);  ?>" class='form-control' pattern="\d*" title="Phone number must not contain letter" readonly/></td>
                </tr>
                <tr>
                    <td>Staff Address</td>
                    <td><input type='text' name='txt-staffaddress' value="<?php echo htmlspecialchars($staffaddress, ENT_QUOTES);  ?>" class='form-control' pattern=".{12,50}" title="Address must contain at least 12 and maximum 50 characters" readonly/></td>
                </tr>
                <tr>
                    <td>Staff Mail</td>
                    <td><input type='email' name='txt-staffmail' value="<?php echo htmlspecialchars($staffmail, ENT_QUOTES);  ?>" class='form-control' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" readonly/></td>
                </tr>
                <tr>
                    <td>Staff Status</td>
                    <td><input type='number' name='txt-staffstatus' min="0" max="1" value="<?php echo htmlspecialchars($staffstatus, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='viewstaffs.php' class='btn btn-danger'>Back to view staffs</a>
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