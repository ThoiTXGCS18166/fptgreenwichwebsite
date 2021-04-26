<!DOCTYPE HTML>
<html>
<head>
    <title>The Laptop Updating Page For Administrator</title>
     
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
         
</head>
<body>
 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update Laptop Information</h1>
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
            $query = "SELECT LaptopID, AdminID, LaptopName, CPU, RAM, HardDrive, Screen, ScreenCard, Port, OperatingSystem, LaptopStatus, Size FROM laptops WHERE LaptopID = ? LIMIT 0,1";
            $stmt = $con->prepare( $query );
            
            // this is the first question mark
            $stmt->bindParam(1, $id);
            
            // execute our query
            $stmt->execute();
            
            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // values to fill up our form
            $adminid = $row['AdminID'];
            $laptopname = $row['LaptopName'];
            $cpu = $row['CPU'];
            $ram = $row['RAM'];
            $harddrive = $row['HardDrive'];
            $screen = $row['Screen'];
            $screencard = $row['ScreenCard'];
            $port = $row['Port'];
            $operatingsystem = $row['OperatingSystem'];
            $laptopstatus = $row['LaptopStatus'];
            $size = $row['Size'];
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
                $query = "UPDATE laptops 
                            SET AdminID=:adminid, LaptopName=:laptopname, CPU=:cpu, RAM=:ram, HardDrive=:harddrive, Screen=:screen, ScreenCard=:screencard, Port=:port, OperatingSystem=:operatingsystem, LaptopStatus=:laptopstatus, Size=:size
                            WHERE LaptopID = :id";
        
                // prepare query for excecution
                $stmt = $con->prepare($query);
        
                // posted values
                $adminid=htmlspecialchars(strip_tags($_POST['txt-adminid']));
                $laptopname=htmlspecialchars(strip_tags($_POST['txt-laptopname']));
                $cpu=htmlspecialchars(strip_tags($_POST['txt-cpu']));
                $ram=htmlspecialchars(strip_tags($_POST['txt-ram']));
                $harddrive=htmlspecialchars(strip_tags($_POST['txt-harddrive']));
                $screen=htmlspecialchars(strip_tags($_POST['txt-screen']));
                $screencard=htmlspecialchars(strip_tags($_POST['txt-screencard']));
                $port=htmlspecialchars(strip_tags($_POST['txt-port']));
                $operatingsystem=htmlspecialchars(strip_tags($_POST['txt-operatingsystem']));
                $laptopstatus=htmlspecialchars(strip_tags($_POST['txt-laptopstatus']));
                $size=htmlspecialchars(strip_tags($_POST['txt-size']));
        
                // bind the parameters
                $stmt->bindParam(':adminid', $adminid);
                $stmt->bindParam(':laptopname', $laptopname);
                $stmt->bindParam(':cpu', $cpu);
                $stmt->bindParam(':ram', $ram);
                $stmt->bindParam(':harddrive', $harddrive);
                $stmt->bindParam(':screen', $screen);
                $stmt->bindParam(':screencard', $screencard);
                $stmt->bindParam(':port', $port);
                $stmt->bindParam(':operatingsystem', $operatingsystem);
                $stmt->bindParam(':laptopstatus', $laptopstatus);
                $stmt->bindParam(':size', $size);
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
                    <td>Admin ID</td>
                    <td><input type='number' name='txt-adminid' min="1" max="10" value="<?php echo htmlspecialchars($adminid, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Laptop Name</td>
                    <td><input type='text' name='txt-laptopname' value="<?php echo htmlspecialchars($laptopname, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>CPU</td>
                    <td><input type='text' name='txt-cpu' value="<?php echo htmlspecialchars($cpu, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>RAM</td>
                    <td><input type='text' name='txt-ram' value="<?php echo htmlspecialchars($ram, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Hard Drive</td>
                    <td><input type='text' name='txt-harddrive' value="<?php echo htmlspecialchars($harddrive, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Screen</td>
                    <td><input type='text' name='txt-screen' value="<?php echo htmlspecialchars($screen, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Screen Card</td>
                    <td><input type='text' name='txt-screencard' value="<?php echo htmlspecialchars($screencard, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Port</td>
                    <td><input type='text' name='txt-port' value="<?php echo htmlspecialchars($port, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Operating System</td>
                    <td><input type='text' name='txt-operatingsystem' value="<?php echo htmlspecialchars($operatingsystem, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Size</td>
                    <td><input type='text' name='txt-size' value="<?php echo htmlspecialchars($size, ENT_QUOTES);  ?>" class='form-control' readonly/></td>
                </tr>
                <tr>
                    <td>Laptop Status</td>
                    <td><input type='number' name='txt-laptopstatus' min="0" max="1" value="<?php echo htmlspecialchars($laptopstatus, ENT_QUOTES);  ?>" class='form-control' required/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='viewlaptops.php' class='btn btn-danger'>Back to view laptops</a>
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