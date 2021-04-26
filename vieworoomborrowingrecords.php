<!DOCTYPE HTML>
<html>
<head>
    <title>The Room Borrowing Records Viewing Page For Outsider</title>
     
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
            <h1>View Outsider Room Borrowing Records</h1>
        </div>
     
        <?php
        // include database connection
        include 'config/database.php';

        session_start();
        
        $action = isset($_GET['action']) ? $_GET['action'] : "";
        
        // select all data
        $query = "SELECT roomrecords.RoomRecordID, rooms.RoomLocation, roomrecords.BorrowerName, roomrecords.StartDate, roomrecords.EndDate, roomrecords.BorrowingStatus FROM roomrecords INNER JOIN rooms ON roomrecords.RoomID=rooms.RoomID WHERE roomrecords.BorrowerName = '" .$_SESSION['login_outsiderusername']."' ORDER BY roomrecords.RoomRecordID ASC";
        $stmt = $con->prepare($query);
        $stmt->execute();
        
        // this is how to get number of rows returned
        $num = $stmt->rowCount();
        
        // link to create record form
        echo "<a href='borroworoom.php' class='btn btn-primary m-b-1em'>Borrow New Room</a>";

        echo "<br>";
        
        // link to return to staff main page
        echo "<a href='home5.php' class='btn btn-primary m-b-1em'>Return To Homepage</a>";
        
        //check if more than 0 record found
        if($num>0){
        
            echo "<table class='table table-hover table-responsive table-bordered'>";//start table
 
            //creating our table heading
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Room Location</th>";
                echo "<th>Borrower Name</th>";
                echo "<th>Start Date</th>";
                echo "<th>End Date</th>";
                echo "<th>Borrowing Status</th>";
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

                if($BorrowingStatus == 1) {
                    $Status = 'Borrowed';
                } else {
                    $Status = 'Not Borrowed';
                }
                
                // creating new table row per record
                echo "<tr>";
                    echo "<td>{$RoomRecordID}</td>";
                    echo "<td>{$RoomLocation}</td>";
                    echo "<td>{$BorrowerName}</td>";
                    echo "<td>{$StartDate}</td>";
                    echo "<td>{$EndDate}</td>";
                    echo "<td>{$Status}</td>";
                    echo "<td>";
                        // read one record 
                        echo "<a href='vieworoomborrowingrecord.php?id={$RoomRecordID}' class='btn btn-info m-r-1em'>Read</a>";
                        
                        // we will use this links on next part of this post
                        echo "<a href='extendoroomborrowingrecord.php?id={$RoomRecordID}' class='btn btn-primary m-r-1em'>Extend</a>";
            
                        // we will use this links on next part of this post
                        echo "<a href='canceloroomborrowingrecord.php?id={$RoomRecordID}'  class='btn btn-danger'>Cancel</a>";
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