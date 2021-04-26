<!DOCTYPE HTML>
<html>
<head>
    <title>The Book Printing Records Viewing Page For Student</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
    <!-- custom css -->
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>
 
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>View Student Book Printing Records</h1>
        </div>
     
        <?php
        // include database connection
        include 'config/database.php';

        session_start();
        
        $action = isset($_GET['action']) ? $_GET['action'] : "";
        
        // select all data
        $query = "SELECT printings.PrintingID, books.BookName, printings.PrinterName, printings.PrintingDate, printings.PrintingFee, printings.PrintingStatus, printings.PaymentStatus FROM printings INNER JOIN books ON printings.BookID=books.BookID WHERE printings.PrinterName = '" .$_SESSION['login_studentusername']."' ORDER BY printings.PrintingID ASC";
        $stmt = $con->prepare($query);
        $stmt->execute();
        
        // this is how to get number of rows returned
        $num = $stmt->rowCount();
        
        // link to create record form
        echo "<a href='printsdocument.php' class='btn btn-primary m-b-1em'>Print New Book</a>";

        echo "<br>";
        
        // link to return to staff main page
        echo "<a href='home3.php' class='btn btn-primary m-b-1em'>Return To Homepage</a>";
        
        //check if more than 0 record found
        if($num>0){
        
            echo "<table class='table table-hover table-responsive table-bordered'>";//start table
 
            //creating our table heading
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Book Name</th>";
                echo "<th>Printer Name</th>";
                echo "<th>Printing Date</th>";
                echo "<th>Fee</th>";
                echo "<th>Printing Status</th>";
                echo "<th>Payment Status</th>";
                echo "<th>Action</th>";
            echo "</tr>";
            
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['firstname'] to
                // just $firstname only
                extract($row);

                if($PrintingStatus == 1) {
                    $Status = 'Printed';
                } else {
                    $Status = 'Not Printed';
                }

                if($PaymentStatus == 1) {
                    $Payment = 'Paid';
                } else {
                    $Payment = 'Unpaid';
                }
                
                // creating new table row per record
                echo "<tr>";
                    echo "<td>{$PrintingID}</td>";
                    echo "<td>{$BookName}</td>";
                    echo "<td>{$PrinterName}</td>";
                    echo "<td>{$PrintingDate}</td>";
                    echo "<td>{$PrintingFee}</td>";
                    echo "<td>{$Status}</td>";
                    echo "<td>{$Payment}</td>";
                    echo "<td>";
                        // read one record 
                        echo "<a href='viewsbookprintingrecord.php?id={$PrintingID}' class='btn btn-info m-r-1em'>Read</a>";
                                    
                        // we will use this links on next part of this post
                        echo "<a href='cancelsbookprintingrecord.php?id={$PrintingID}'  class='btn btn-danger'>Cancel</a>";
                    echo "</td>";
                echo "</tr>";
            }
        
        // end table
        echo "</table>";
            
        }
        
        // if no records found
        else{
            echo "<div class='alert alert-danger'>No records found.</div>";
        }
        ?>
         
    </div> <!-- end .container -->
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>