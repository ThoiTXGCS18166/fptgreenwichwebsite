<!DOCTYPE HTML>
<html>
<head>
    <title>The Room Borrowing Record Extending Page For Outsider</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Extend Room Borrowing Record</h1>
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
            $query = "SELECT RoomRecordID, RoomID, BorrowerName, BorrowerType, StartDate, EndDate, RecordFee, BorrowingStatus, ReturnStatus, SubmitDate, BookingStatus, BorrowerMail FROM roomrecords WHERE RoomRecordID = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
            
            // this is the first question mark
            $stmt->bindParam(1, $id);
            
            // execute our query
            $stmt->execute();
            
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // values to fill up our form
            $roomid = $row['RoomID'];
            $borrowername = $row['BorrowerName'];
            $borrowertype = $row['BorrowerType'];
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $startdate = $row['StartDate'];
            $enddate = $row['EndDate'];
            if(empty($enddate)){
                $enddate = $row['EndDate'];
            }else {
                $enddate = date('Y-m-d H:i:s', strtotime($enddate)+10800);
            }
            $recordfee = $row['RecordFee'];
            $borrowingstatus = $row['BorrowingStatus'];
            $returnstatus = $row['ReturnStatus'];
            $submitdate = $row['SubmitDate'];
            $bookingstatus = $row['BookingStatus'];

            $borrowermail = $row['BorrowerMail'];

            $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $startdate);
            $endtime = $datetime->format('Y-m-d 23:59:59');

            $datetime1 = new DateTime($enddate);
            $datetime2 = new DateTime($endtime);

            if($borrowingstatus == 1) {
                $borrow = 'Borrowed';
            } else {
                $borrow = 'Not Borrowed';
            }

            if($returnstatus == 1) {
                $return = 'Returned';
            } else {
                $return = 'Not Returned';
            }

            if($bookingstatus == 1) {
                $book = 'Booked';
            } else {
                $book = 'Disabled';
            }
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
                
                if($datetime1 < $datetime2) {
                    if($borrowingstatus == 1 && $bookingstatus == 0) {
                        // write update query
                        // in this case, it seemed like we have so many fields to pass and 
                        // it is better to label them and not use question marks
                        $query = "UPDATE roomrecords 
                        SET RoomID=:roomid, BorrowerName=:borrowername, BorrowerType=:borrowertype, StartDate=:startdate, EndDate=:enddate, RecordFee=:recordfee, BorrowingStatus=:borrowingstatus, ReturnStatus=:returnstatus, SubmitDate=:submitdate, BookingStatus=:bookingstatus, BorrowerMail=:borrowermail 
                        WHERE RoomRecordID = :id";
    
                        // prepare query for excecution
                        $stmt = $con->prepare($query);
    
                        // posted values
                        $roomid=htmlspecialchars(strip_tags($_POST['txt-roomid']));
                        $borrowername=htmlspecialchars(strip_tags($_POST['txt-borrowername']));
                        $borrowertype=htmlspecialchars(strip_tags($_POST['txt-borrowertype']));
                        $startdate=htmlspecialchars(strip_tags($_POST['txt-startdate']));
                        $enddate=htmlspecialchars(strip_tags($_POST['txt-enddate']));
                        $recordfee=htmlspecialchars(strip_tags($_POST['txt-recordfee']));
                        $borrow=htmlspecialchars(strip_tags($_POST['txt-borrowingstatus']));
                        $return=htmlspecialchars(strip_tags($_POST['txt-returnstatus']));
                        $submitdate=htmlspecialchars(strip_tags($_POST['txt-submitdate']));
                        $book=htmlspecialchars(strip_tags($_POST['txt-bookingstatus']));
                        $borrowermail=htmlspecialchars(strip_tags($_POST['txt-borrowermail']));

                        if($borrow == 'Borrowed') {
                            $borrowingstatus = 1;
                        } else {
                            $borrowingstatus = 0;
                        }
            
                        if($return == 'Returned') {
                            $returnstatus = 1;
                        } else {
                            $returnstatus = 0;
                        }
            
                        if($book == 'Booked') {
                            $bookingstatus = 1;
                        } else {
                            $bookingstatus = 0;
                        }
    
                        // bind the parameters
                        $stmt->bindParam(':roomid', $roomid);
                        $stmt->bindParam(':borrowername', $borrowername);
                        $stmt->bindParam(':borrowertype', $borrowertype);
                        $stmt->bindParam(':startdate', $startdate);
                        $stmt->bindParam(':enddate', $enddate);
                        $stmt->bindParam(':recordfee', $recordfee);
                        $stmt->bindParam(':borrowingstatus', $borrowingstatus);
                        $stmt->bindParam(':returnstatus', $returnstatus);
                        $stmt->bindParam(':submitdate', $submitdate);
                        $stmt->bindParam(':bookingstatus', $bookingstatus);
                        $stmt->bindParam(':borrowermail', $borrowermail);
                        $stmt->bindParam(':id', $id);
                        
                        // Execute the query
                        if($stmt->execute()){
                            echo "<div class='alert alert-success'>Record was updated.</div>";
                        }else{
                            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                        }
                    } else {
                        echo '<script>alert("This room borrowing record can not be extended")</script>';
                    }
                } else {
                    echo '<script>alert("This room borrowing record can not be extended anymore")</script>';
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
                    <td><input type='text' name='txt-roomid' value="<?php echo htmlspecialchars($roomid, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Borrower Name</td>
                    <td><input type='text' name='txt-borrowername' value="<?php echo htmlspecialchars($borrowername, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Borrower Type</td>
                    <td><input type='text' name='txt-borrowertype' value="<?php echo htmlspecialchars($borrowertype, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td><input type='text' name='txt-startdate' value="<?php echo htmlspecialchars($startdate, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td><input type='text' name='txt-enddate' value="<?php echo htmlspecialchars($enddate, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Record Fee</td>
                    <td><input type='text' name='txt-recordfee' value="<?php echo htmlspecialchars($recordfee, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Borrowing Status</td>
                    <td><input type='text' name='txt-borrowingstatus' value="<?php echo htmlspecialchars($borrow, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Return Status</td>
                    <td><input type='text' name='txt-returnstatus' value="<?php echo htmlspecialchars($return, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Request Submit Date</td>
                    <td><input type='text' name='txt-submitdate' value="<?php echo htmlspecialchars($submitdate, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Booking Status</td>
                    <td><input type='text' name='txt-bookingstatus' value="<?php echo htmlspecialchars($book, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td>Borrower Mail</td>
                    <td><input type='text' name='txt-borrowermail' value="<?php echo htmlspecialchars($borrowermail, ENT_QUOTES);  ?>" readonly class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='vieworoomborrowingrecords.php' class='btn btn-danger'>Back to view room borrowing records</a>
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