<!DOCTYPE HTML>
<html>
<head>
    <title>The Outsider Updating Page For Staff</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update Outsider Information</h1>
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
            $query = "SELECT OutsiderID, StaffID, OutsiderName, OutsiderUsername, OutsiderPassword, OutsiderGender, OutsiderDoB, OutsiderPhone, OutsiderAddress, OutsiderMail, OutsiderStatus, PaymentStatus FROM outsiders WHERE OutsiderID = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
            
            // this is the first question mark
            $stmt->bindParam(1, $id);
            
            // execute our query
            $stmt->execute();
            
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // values to fill up our form
            $staffid = $row['StaffID'];
            $outsidername = $row['OutsiderName'];
            $outsiderusername = $row['OutsiderUsername'];
            $outsiderpassword = $row['OutsiderPassword'];
            $outsidergender = $row['OutsiderGender'];
            $outsiderbirthday = $row['OutsiderDoB'];
            $outsiderphone = $row['OutsiderPhone'];
            $outsideraddress = $row['OutsiderAddress'];
            $outsidermail = $row['OutsiderMail'];
            $outsiderstatus = $row['OutsiderStatus'];
            $paymentstatus = $row['PaymentStatus'];
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
                $query = "UPDATE outsiders 
                            SET StaffID=:staffid, OutsiderName=:outsidername, OutsiderUsername=:outsiderusername, OutsiderPassword=:outsiderpassword, OutsiderGender=:outsidergender, OutsiderDoB=:outsiderbirthday, OutsiderPhone=:outsiderphone, OutsiderAddress=:outsideraddress, OutsiderMail=:outsidermail, OutsiderStatus=:outsiderstatus, PaymentStatus=:paymentstatus
                            WHERE OutsiderID = :id";
        
                // prepare query for excecution
                $stmt = $con->prepare($query);
        
                // posted values
                $staffid=htmlspecialchars(strip_tags($_POST['txt-staffid']));
                $outsidername=htmlspecialchars(strip_tags($_POST['txt-outsidername']));
                $outsiderusername=htmlspecialchars(strip_tags($_POST['txt-outsiderusername']));
                $outsiderpassword=htmlspecialchars(strip_tags($_POST['txt-outsiderpassword']));
                $outsidergender=htmlspecialchars(strip_tags($_POST['txt-outsidergender']));
                $outsiderbirthday=htmlspecialchars(strip_tags($_POST['txt-outsiderbirthday']));
                $outsiderphone=htmlspecialchars(strip_tags($_POST['txt-outsiderphone']));
                $outsideraddress=htmlspecialchars(strip_tags($_POST['txt-outsideraddress']));
                $outsidermail=htmlspecialchars(strip_tags($_POST['txt-outsidermail']));
                $outsiderstatus=htmlspecialchars(strip_tags($_POST['txt-outsiderstatus']));
                $paymentstatus=htmlspecialchars(strip_tags($_POST['txt-paymentstatus']));
        
                // bind the parameters
                $stmt->bindParam(':staffid', $staffid);
                $stmt->bindParam(':outsidername', $outsidername);
                $stmt->bindParam(':outsiderusername', $outsiderusername);
                $stmt->bindParam(':outsiderpassword', $outsiderpassword);
                $stmt->bindParam(':outsidergender', $outsidergender);
                $stmt->bindParam(':outsiderbirthday', $outsiderbirthday);
                $stmt->bindParam(':outsiderphone', $outsiderphone);
                $stmt->bindParam(':outsideraddress', $outsideraddress);
                $stmt->bindParam(':outsidermail', $outsidermail);
                $stmt->bindParam(':outsiderstatus', $outsiderstatus);
                $stmt->bindParam(':paymentstatus', $paymentstatus);
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
                    <td>Outsider Name</td>
                    <td><input type='text' name='txt-outsidername' value="<?php echo htmlspecialchars($outsidername, ENT_QUOTES);  ?>" class='form-control' pattern="[^0-9]*" title="Name must not contain number" readonly/></td>
                </tr>
                <tr>
                    <td>Outsider Username</td>
                    <td><input type='text' name='txt-outsiderusername' value="<?php echo htmlspecialchars($outsiderusername, ENT_QUOTES);  ?>" class='form-control' pattern=".{7,30}" title="Username must contain at least 7 and maximum 30 characters" readonly/></td>
                </tr>
                <tr>
                    <td>Outsider Password</td>
                    <td><input type='password' name='txt-outsiderpassword' value="<?php echo htmlspecialchars($outsiderpassword, ENT_QUOTES);  ?>" class='form-control' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}" title="Password must contain at least one number and one uppercase and lowercase letter, and at least 8 to 30 characters" required/></td>
                </tr>
                <tr>
                    <td>Outsider Gender</td>
                    <td><input type='text' name='txt-outsidergender' value="<?php echo htmlspecialchars($outsidergender, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Outsider Birthday</td>
                    <td><input type='date' name='txt-outsiderbirthday' min="1962-06-30" max="2003-06-30" value="<?php echo htmlspecialchars($outsiderbirthday, ENT_QUOTES);  ?>" class='form-control' title="Birthday must be in between 1962-06-30 and 2003-06-30" readonly/></td>
                </tr>
                <tr>
                    <td>Outsider Phone</td>
                    <td><input type='text' name='txt-outsiderphone' value="<?php echo htmlspecialchars($outsiderphone, ENT_QUOTES);  ?>" class='form-control' pattern="\d*" title="Phone number must not contain letter" readonly/></td>
                </tr>
                <tr>
                    <td>Outsider Address</td>
                    <td><input type='text' name='txt-outsideraddress' value="<?php echo htmlspecialchars($outsideraddress, ENT_QUOTES);  ?>" class='form-control' pattern=".{12,50}" title="Address must contain at least 12 and maximum 50 characters" readonly/></td>
                </tr>
                <tr>
                    <td>Outsider Mail</td>
                    <td><input type='email' name='txt-outsidermail' value="<?php echo htmlspecialchars($outsidermail, ENT_QUOTES);  ?>" class='form-control' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" readonly/></td>
                </tr>
                <tr>
                    <td>Outsider Status</td>
                    <td><input type='number' name='txt-outsiderstatus' min="0" max="1" value="<?php echo htmlspecialchars($outsiderstatus, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td>Payment Status</td>
                    <td><input type='number' name='txt-paymentstatus' min="0" max="1" value="<?php echo htmlspecialchars($paymentstatus, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='viewoutsiders.php' class='btn btn-danger'>Back to view outsiders</a>
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