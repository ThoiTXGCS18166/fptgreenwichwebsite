<!DOCTYPE HTML>
<html>
<head>
    <title>The Room Borrowing Record Updating Page For Staff</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update Room Borrowing Record Information</h1>
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
            $query = "SELECT RoomRecordID, RoomID, StaffID, BorrowerName, BorrowerType, StartDate, BorrowHour, EndDate, RecordFee, BorrowingStatus, ReturnStatus, BorrowPriority, BookingStatus, BorrowerMail FROM roomrecords WHERE RoomRecordID = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
            
            // this is the first question mark
            $stmt->bindParam(1, $id);
            
            // execute our query
            $stmt->execute();
            
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // values to fill up our form
            $roomid = $row['RoomID'];
            $staffid = $row['StaffID'];
            $borrowername = $row['BorrowerName'];
            $borrowertype = $row['BorrowerType'];
            $startdate = $row['StartDate'];
            $borrowhour = $row['BorrowHour'];
            $enddate = $row['EndDate'];
            $recordfee = $row['RecordFee'];
            $borrowingstatus = $row['BorrowingStatus'];
            $returnstatus = $row['ReturnStatus'];
            $borrowpriority = $row['BorrowPriority'];
            $bookingstatus = $row['BookingStatus'];
            $borrowermail = $row['BorrowerMail'];
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
                $query = "UPDATE roomrecords 
                            SET RoomID=:roomid, StaffID=:staffid, BorrowerName=:borrowername, BorrowerType=:borrowertype, StartDate=:startdate, BorrowHour=:borrowhour, EndDate=:enddate, RecordFee=:recordfee, BorrowingStatus=:borrowingstatus, ReturnStatus=:returnstatus, BorrowPriority=:borrowpriority, BookingStatus=:bookingstatus, BorrowerMail=:borrowermail
                            WHERE RoomRecordID = :id";
        
                // prepare query for excecution
                $stmt = $con->prepare($query);
        
                // posted values
                $roomid=htmlspecialchars(strip_tags($_POST['txt-roomid']));
                $staffid=htmlspecialchars(strip_tags($_POST['txt-staffid']));
                $borrowername=htmlspecialchars(strip_tags($_POST['txt-borrowername']));
                $borrowertype=htmlspecialchars(strip_tags($_POST['txt-borrowertype']));
                $startdate=htmlspecialchars(strip_tags($_POST['txt-startdate']));
                $borrowhour=htmlspecialchars(strip_tags($_POST['txt-borrowhour']));
                $enddate=htmlspecialchars(strip_tags($_POST['txt-enddate']));
                $recordfee=htmlspecialchars(strip_tags($_POST['txt-recordfee']));
                $borrowingstatus=htmlspecialchars(strip_tags($_POST['txt-borrowingstatus']));
                $returnstatus=htmlspecialchars(strip_tags($_POST['txt-returnstatus']));
                $borrowpriority=htmlspecialchars(strip_tags($_POST['txt-borrowpriority']));
                $bookingstatus=htmlspecialchars(strip_tags($_POST['txt-bookingstatus']));
                $borrowermail=htmlspecialchars(strip_tags($_POST['txt-borrowermail']));
        
                // bind the parameters
                $stmt->bindParam(':roomid', $roomid);
                $stmt->bindParam(':staffid', $staffid);
                $stmt->bindParam(':borrowername', $borrowername);
                $stmt->bindParam(':borrowertype', $borrowertype);
                $stmt->bindParam(':startdate', $startdate);
                $stmt->bindParam(':borrowhour', $borrowhour);
                $stmt->bindParam(':enddate', $enddate);
                $stmt->bindParam(':recordfee', $recordfee);
                $stmt->bindParam(':borrowingstatus', $borrowingstatus);
                $stmt->bindParam(':returnstatus', $returnstatus);
                $stmt->bindParam(':borrowpriority', $borrowpriority);
                $stmt->bindParam(':bookingstatus', $bookingstatus);
                $stmt->bindParam(':borrowermail', $borrowermail);
                $stmt->bindParam(':id', $id);
                
                // Execute the query
                if($stmt->execute()){
                    echo "<div class='alert alert-success'>Record was updated.</div>";
                }else{
                    echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
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
                    <td>Room ID</td>
                    <td><input type='number' name='txt-roomid' min="1" max="30" value="<?php echo htmlspecialchars($roomid, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Staff ID</td>
                    <td><input type='number' name='txt-staffid' min="1" max="10" value="<?php echo htmlspecialchars($staffid, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Borrower Name</td>
                    <td><input type='text' name='txt-borrowername' value="<?php echo htmlspecialchars($borrowername, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Borrower Type</td>
                    <td><input type='text' name='txt-borrowertype' value="<?php echo htmlspecialchars($borrowertype, ENT_QUOTES);  ?>" class='form-control' pattern="[^0-9]*" title="Borrower type must not contain number" readonly/></td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td><input type='text' name='txt-startdate' value="<?php echo htmlspecialchars($startdate, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td>Borrow Hours</td>
                    <td><input type='text' name='txt-borrowhour' value="<?php echo htmlspecialchars($borrowhour, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td><input type='text' name='txt-enddate' value="<?php echo htmlspecialchars($enddate, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Record Fee</td>
                    <td><input type='text' name='txt-recordfee' value="<?php echo htmlspecialchars($recordfee, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td>Borrowing Status</td>
                    <td><input type='number' name='txt-borrowingstatus' min="0" max="1" value="<?php echo htmlspecialchars($borrowingstatus, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td>Return Status</td>
                    <td><input type='number' name='txt-returnstatus' min="0" max="1" value="<?php echo htmlspecialchars($returnstatus, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td>Room Borrowing Priority</td>
                    <td><input type='number' name='txt-borrowpriority' min="0" value="<?php echo htmlspecialchars($borrowpriority, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td>Booking Status</td>
                    <td><input type='number' name='txt-bookingstatus' min="0" max="1" value="<?php echo htmlspecialchars($bookingstatus, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td>Borrower Mail</td>
                    <td><input type='text' name='txt-borrowermail' value="<?php echo htmlspecialchars($borrowermail, ENT_QUOTES);  ?>" class='form-control' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" required/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='viewroomrecords.php' class='btn btn-danger'>Back to view room borrowing records</a>
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