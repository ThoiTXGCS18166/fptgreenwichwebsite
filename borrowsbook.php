<?php
  $host="us-cdbr-iron-east-05.cleardb.net";
  $user="be790e4eb7458b";
  $password="78c739da";
  $db="heroku_0a876b33f00670d";
  
  $conn = mysqli_connect($host,$user,$password,$db);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  session_start();

  date_default_timezone_set("Asia/Ho_Chi_Minh");
  $currentdate = date("Y-m-d");
  
  if(isset($_POST['btn-borrow'])){   
    $staffid=1;
    $borrowername=$_POST['txt-studentusername'];
    $bookname=$_POST['txt-bookname'];
    $borrowertype="Student";
    $startdate=$_POST['txt-startdate'];
    $borrowday="14 days";
    $recordfee="0 USD";
    $borrowingstatus=0;
    $returnstatus=0;
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $submitdate=date('Y-m-d H:i:s');
    $enddate = date('Y-m-d', strtotime($startdate. ' + 13 days'));
    $borrowpriority="1";
    $bookingstatus=1;
    $extendtime=0;
    $borrowermail = $_SESSION['login_mail'];

    $sql="SELECT * FROM books WHERE BookName='".$bookname."'";
    
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){
      while ($row = mysqli_fetch_assoc($result)) {
        $bookid = $row["BookID"];
        $bookstatus = $row["BookStatus"];
      }

      if($bookstatus==0) {
        echo '<script>alert("The chosen book is currently unavailable for borrowing. Please choose a different book to borrow.")</script>';
      } else {
        $sql="SELECT * FROM bookrecords WHERE BookID='".$bookid."' AND BookingStatus = '1'";
    
        $result=mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)==2){
          echo '<script>alert("The current chosen book has enough borrowers for reservation. Please choose a different book to borrow.")</script>';
        } elseif(mysqli_num_rows($result)==1) {
          while ($row = mysqli_fetch_assoc($result)) {
            $startdate1 = $row["StartDate"];
            $enddate1 = $row["EndDate"];
            $startdate2 = date('Y-m-d', strtotime($startdate1. ' - 14 days'));
          }
    
          $datetime1 = new DateTime($startdate);
          $datetime2 = new DateTime($startdate1);
          $datetime3 = new DateTime($enddate1);
          $datetime4 = new DateTime($startdate2);
    
          if($datetime1 == $datetime2 || $datetime1 == $datetime3) {
            echo '<script>alert("The current book can not be booked at the chosen time. Please return and choose a different time to borrow the book")</script>';
          } elseif($datetime1 > $datetime2 && $datetime1 < $datetime3) {
            echo '<script>alert("The current book can not be booked at the chosen time. Please return and choose a different time to borrow the book")</script>';
          } elseif($datetime1 > $datetime4 && $datetime1 < $datetime2) {
            echo '<script>alert("The current book can not be booked at the chosen time. Please return and choose a different time to borrow the book")</script>';
          } else {
            $sql="INSERT INTO bookrecords (BookID, StaffID, BorrowerName, BorrowerType, StartDate, EndDate, BorrowDay, RecordFee, BorrowingStatus, ReturnStatus, SubmitDate, BorrowPriority, BookingStatus, ExtendTime, BorrowerMail)
            VALUES ('$bookid', '$staffid', '$borrowername', '$borrowertype', '$startdate', '$enddate', '$borrowday', '$recordfee', '$borrowingstatus', '$returnstatus', '$submitdate', '$borrowpriority','$bookingstatus','$extendtime', '$borrowermail')";   
                
            if ($conn->query($sql) === TRUE) {
              echo '<script>alert("Request for borrowing book submitted successfully. Please often check your book borrowing record or email notification to come to the library on the right day to receive the needed book.")</script>';
            } else {
              echo '<script>alert("The input information is incorrect. Please modify the information into the form again for borrowing book")</script>';
            }
          }
        } else {
          $sql="INSERT INTO bookrecords (BookID, StaffID, BorrowerName, BorrowerType, StartDate, EndDate, BorrowDay, RecordFee, BorrowingStatus, ReturnStatus, SubmitDate, BorrowPriority, BookingStatus, ExtendTime, BorrowerMail)
          VALUES ('$bookid', '$staffid', '$borrowername', '$borrowertype', '$startdate', '$enddate', '$borrowday', '$recordfee', '$borrowingstatus', '$returnstatus', '$submitdate', '$borrowpriority','$bookingstatus','$extendtime', '$borrowermail')";   
              
          if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Request for borrowing book submitted successfully. Please often check your book borrowing record or email notification to come to the library on the right day to receive the needed book.")</script>';
          } else {
            echo '<script>alert("The input information is incorrect. Please modify the information into the form again for borrowing book")</script>';
          }
        }
      }
    } else {
      echo '<script>alert("The borrowed book name is not existed in the library database. Please modify the information into the form again for borrowing book")</script>';
    }
  }
  
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Book Borrowing Page For Student</title>
    <style>
    * {
      box-sizing:border-box;
    }

    body {
      margin: 0;
      font-family: "Lato", sans-serif;
    }

    .sidebar {
      margin: 0;
      padding: 0;
      width: 290px;
      background-color: #f1f1f1;
      position: fixed;
      height: 100%;
      overflow: auto;
    }

    .sidebar a {
      display: block;
      color: black;
      padding: 16px;
      text-decoration: none;
    }
    
    .sidebar a.active {
      background-color: #4CAF50;
      color: white;
    }

    .sidebar a:hover:not(.active) {
      background-color: #555;
      color: white;
    }

    div.content {
      margin-left: 300px;
      padding: 1px 16px;
      height: 1000px;
    }

    .autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    /*position the autocomplete items to be the same width as the container:*/
    top: 100%;
    left: 0;
    right: 0;
    }

    .autocomplete-items div {
      padding: 10px;
      cursor: pointer;
      background-color: #fff; 
      border-bottom: 1px solid #d4d4d4; 
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
      background-color: #e9e9e9; 
    }

    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
      background-color: DodgerBlue !important; 
      color: #ffffff; 
    }

    input[type=text], input[type=date] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
    }

    /*the container must be positioned relative:*/
    .autocomplete {
      position: relative;
      display: inline-block;
    }

    label {
    padding: 12px 12px 12px 0;
    display: inline-block;
    }

    input[type=submit] {
      border: none;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      margin: 4px 2px;
      cursor: pointer;
      font-size: 17px;
      width: 12em;
      height: 3em;
    }

    input[type=submit]:hover {
    background-color: #45a049;
    }

    .container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    }

    .col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
    }

    .col-75 {
    float: left;
    width: 75%;
    margin-top: 6px;
    }

    /* Clear floats after the columns */
    .row:after {
    content: "";
    display: table;
    clear: both;
    }

    .buttonHolder{ 
      text-align: right;
      margin: 4px 2px;
      padding-top: 5px; 
    }

    @media screen and (max-width: 992px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      .sidebar a {float: left;}
      div.content {margin-left: 0;}
    }

    @media screen and (max-width: 500px) {
      .sidebar a {
        text-align: center;
        float: none;
      }

      .col-25, .col-75, input[type=submit] {
        width: 100%;
        margin-top: 0;
      }

      .buttonHolder{ 
        text-align: center;
      }
    }

    h2{
        text-align: center;
    }

    h3{
        text-align: center;
    }

    img {
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    </style>
</head>
<body>

<div class="sidebar">
  <a href="home3.php">Home</a>
  <a href="viewsbook1.php">View Books</a>
  <a href="viewslaptop.php">View Laptops</a>
  <a class="active" href="borrowsbook.php">Borrow Books</a>
  <a href="borrowslaptop.php">Borrow Laptops</a>
  <a href="borrowsroom.php">Rent Study Room</a>
  <a href="printsdocument.php">Print Documents</a>
  <a href="viewsbookborrowingrecords.php">View Book Borrowing Records</a>
  <a href="viewslaptopborrowingrecords.php">View Laptop Borrowing Records</a>
  <a href="viewsroomborrowingrecords.php">View Room Borrowing Records</a>
  <a href="viewsbookprintingrecords.php">View Book Printing Records</a>
  <a href="updatestudentinfo.php">Update Info</a>
  <a href="librarychat.php"> Online Chat</a>
  <a href="about3.php">About Us</a>
  <a href="index.php">Log Out</a>
</div>

<div class="content">
  <img src="img/logo.PNG" alt="Library Logo" style="width:45%">
  <h2>The book borrowing page for student</h2>
  <h3>The book borrowing form for student</h3>

  <div class="container">
    <form action="borrowsbook.php" method="POST">
    <div class="row">
        <div class="col-25">
        <label for="txt-studentusername">Student Username</label>
        </div>
        <div class="col-75">
        <input type="text" id="txt-studentusername" name="txt-studentusername" value="<?php echo $_SESSION['login_studentusername'];?>" readonly data-mini="true">
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-bookname">Borrowed Book</label>
        </div>
        <div class="col-75">
        <div class="autocomplete" style="width:100%;">
        <input type="text" placeholder="Enter book name here" id="txt-bookname" name="txt-bookname" value="<?php echo $_SESSION['borrowed_bookname'];?>" pattern=".{1,150}" title="Book name must contain at least 1 and maximum 150 characters" data-clear-btn="true" data-mini="true" required>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="txt-startdate">Start Date</label>
        </div>
        <div class="col-75">
        <input type="date" id="txt-startdate" name="txt-startdate" min="<?php echo $currentdate;?>" data-clear-btn="true" data-mini="true" required>
        </div>
    </div>
    <div class="row">
      <div class="buttonHolder">
      <input type="submit" value="Borrow Book" name="btn-borrow" style="background-color: #4CAF50;">
      </div>
    </div>
    </form>
    </div>
</div>

<script>
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var books = ["How to win friends and influence people", "Think and Grow Rich", "Start with Why", "The 7 Habits of Highly Effective People", "HTML & CSS: Design and Build Web Sites", "Learning Web Design", "The Soul of a New Machine", "Learning PHP, MySQL, JavaScript, CSS and HTML5", "Guns, Germs, and Steel", "A People History of the United States", "The History of the Ancient World", "Devil in the White City", "Salt, Fat, Acid, Heat", "On Food and Cooking", "Kitchen Confidential", "Mastering the Art of French Cooking", "Becoming", "Into the Wild", "Steve Jobs", "Unbroken"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("txt-bookname"), books);
</script>

</body>
</html>