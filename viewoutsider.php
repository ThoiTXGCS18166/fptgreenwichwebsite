<!DOCTYPE HTML>
<html>
<head>
    <title>The Specific Outsider Viewing Page For Staff</title>
 
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
 
</head>
<body>
 
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>View Specific Outsider Information</h1>
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
            $query = "SELECT OutsiderID, StaffID, OutsiderName, OutsiderUsername, OutsiderGender, OutsiderDoB, OutsiderPhone, OutsiderAddress, OutsiderMail, OutsiderStatus, PaymentStatus FROM outsiders WHERE OutsiderID = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
        
            // this is the first question mark
            $stmt->bindParam(1, $id);
        
            // execute our query
            $stmt->execute();
        
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // values to fill up our form
            $outsiderid = $row['OutsiderID'];
            $staffid = $row['StaffID'];
            $outsidername = $row['OutsiderName'];
            $outsiderusername = $row['OutsiderUsername'];
            $outsidergender = $row['OutsiderGender'];
            $outsiderbirthday = $row['OutsiderDoB'];
            $outsiderphone = $row['OutsiderPhone'];
            $outsideraddress = $row['OutsiderAddress'];
            $outsidermail = $row['OutsiderMail'];
            $outsiderstatus = $row['OutsiderStatus'];
            $paymentstatus = $row['PaymentStatus'];

            if($outsiderstatus == 1) {
                $status = 'Available';
            } else {
                $status = 'Disabled';
            }

            if($paymentstatus == 1) {
                $payment = 'Paid';
            } else {
                $payment = 'Unpaid';
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
                <td>Outsider ID</td>
                <td><?php echo htmlspecialchars($outsiderid, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Staff ID</td>
                <td><?php echo htmlspecialchars($staffid, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Outsider Name</td>
                <td><?php echo htmlspecialchars($outsidername, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Outsider Username</td>
                <td><?php echo htmlspecialchars($outsiderusername, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Outsider Gender</td>
                <td><?php echo htmlspecialchars($outsidergender, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Outsider Birthday</td>
                <td><?php echo htmlspecialchars($outsiderbirthday, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Outsider Phone</td>
                <td><?php echo htmlspecialchars($outsiderphone, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Outsider Address</td>
                <td><?php echo htmlspecialchars($outsideraddress, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Outsider Mail</td>
                <td><?php echo htmlspecialchars($outsidermail, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Outsider Status</td>
                <td><?php echo htmlspecialchars($status, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Payment Status</td>
                <td><?php echo htmlspecialchars($payment, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='viewoutsiders.php' class='btn btn-danger'>Back to view outsiders</a>
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