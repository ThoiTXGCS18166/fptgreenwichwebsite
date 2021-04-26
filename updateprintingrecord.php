<!DOCTYPE HTML>
<html>
<head>
    <title>The Book Printing Record Updating Page For Staff</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update Book Printing Record Information</h1>
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
            $query = "SELECT PrintingID, BookID, StaffID, PrinterName, PrinterType, PrintingDate, PrintingFee, PrintingStatus, PrintPriority, BookingStatus, PaymentStatus, PrinterMail FROM printings WHERE PrintingID = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
            
            // this is the first question mark
            $stmt->bindParam(1, $id);
            
            // execute our query
            $stmt->execute();
            
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // values to fill up our form
            $bookid = $row['BookID'];
            $staffid = $row['StaffID'];
            $printername = $row['PrinterName'];
            $printertype = $row['PrinterType'];
            $printingdate = $row['PrintingDate'];
            $printingfee = $row['PrintingFee'];
            $printingstatus = $row['PrintingStatus'];
            $printpriority = $row['PrintPriority'];
            $bookingstatus = $row['BookingStatus'];
            $paymentstatus = $row['PaymentStatus'];
            $printermail = $row['PrinterMail'];
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
                $query = "UPDATE printings 
                            SET BookID=:bookid, StaffID=:staffid, PrinterName=:printername, PrinterType=:printertype, PrintingDate=:printingdate, PrintingFee=:printingfee, PrintingStatus=:printingstatus, PrintPriority=:printpriority, BookingStatus=:bookingstatus, PaymentStatus=:paymentstatus, PrinterMail=:printermail
                            WHERE PrintingID = :id";
        
                // prepare query for excecution
                $stmt = $con->prepare($query);
        
                // posted values
                $bookid=htmlspecialchars(strip_tags($_POST['txt-bookid']));
                $staffid=htmlspecialchars(strip_tags($_POST['txt-staffid']));
                $printername=htmlspecialchars(strip_tags($_POST['txt-printername']));
                $printertype=htmlspecialchars(strip_tags($_POST['txt-printertype']));
                $printingdate=htmlspecialchars(strip_tags($_POST['txt-printingdate']));
                $printingfee=htmlspecialchars(strip_tags($_POST['txt-printingfee']));
                $printingstatus=htmlspecialchars(strip_tags($_POST['txt-printingstatus']));
                $printpriority=htmlspecialchars(strip_tags($_POST['txt-printpriority']));
                $bookingstatus=htmlspecialchars(strip_tags($_POST['txt-bookingstatus']));
                $paymentstatus=htmlspecialchars(strip_tags($_POST['txt-paymentstatus']));
                $printermail=htmlspecialchars(strip_tags($_POST['txt-printermail']));
        
                // bind the parameters
                $stmt->bindParam(':bookid', $bookid);
                $stmt->bindParam(':staffid', $staffid);
                $stmt->bindParam(':printername', $printername);
                $stmt->bindParam(':printertype', $printertype);
                $stmt->bindParam(':printingdate', $printingdate);
                $stmt->bindParam(':printingfee', $printingfee);
                $stmt->bindParam(':printingstatus', $printingstatus);
                $stmt->bindParam(':printpriority', $printpriority);
                $stmt->bindParam(':bookingstatus', $bookingstatus);
                $stmt->bindParam(':paymentstatus', $paymentstatus);
                $stmt->bindParam(':printermail', $printermail);
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
                    <td>Book ID</td>
                    <td><input type='number' name='txt-bookid' min="1" max="20" value="<?php echo htmlspecialchars($bookid, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Staff ID</td>
                    <td><input type='number' name='txt-staffid' min="1" max="10" value="<?php echo htmlspecialchars($staffid, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Printer Name</td>
                    <td><input type='text' name='txt-printername' value="<?php echo htmlspecialchars($printername, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Printer Type</td>
                    <td><input type='text' name='txt-printertype' value="<?php echo htmlspecialchars($printertype, ENT_QUOTES);  ?>" class='form-control' pattern="[^0-9]*" title="Printer type must not contain number" readonly/></td>
                </tr>
                <tr>
                    <td>Printing Date</td>
                    <td><input type='date' name='txt-printingdate' value="<?php echo htmlspecialchars($printingdate, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Printing Fee</td>
                    <td><input type='text' name='txt-printingfee' value="<?php echo htmlspecialchars($printingfee, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Printing Status</td>
                    <td><input type='number' name='txt-printingstatus' min="0" max="1" value="<?php echo htmlspecialchars($printingstatus, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td>Book Printing Priority</td>
                    <td><input type='number' name='txt-printpriority' min="0" value="<?php echo htmlspecialchars($printpriority, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td>Booking Status</td>
                    <td><input type='number' name='txt-bookingstatus' min="0" max="1" value="<?php echo htmlspecialchars($bookingstatus, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td>Payment Status</td>
                    <td><input type='number' name='txt-paymentstatus' min="0" max="1" value="<?php echo htmlspecialchars($paymentstatus, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td>Printer Mail</td>
                    <td><input type='text' name='txt-printermail' value="<?php echo htmlspecialchars($printermail, ENT_QUOTES);  ?>" class='form-control' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email must be resembled to characters@characters.domain" required/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='viewprintingrecords.php' class='btn btn-danger'>Back to view book printing records</a>
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