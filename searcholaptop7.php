<?php
  $host="us-cdbr-iron-east-05.cleardb.net";
  $user="be790e4eb7458b";
  $password="78c739da";
  $db="heroku_0a876b33f00670d";
  
  $conn = mysqli_connect($host,$user,$password,$db);

  session_start();

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
   
  if(isset($_POST['btn-search'])){   
    $searchedlaptopname=$_POST['txt-searchedlaptopname'];
    if($searchedlaptopname == "Dell G3 3590 Core i5-9300H (N5I5518W)"){
      header("location: searcholaptop1.php");
    } elseif($searchedlaptopname == "Dell Vostro 3401 Core i3-1005G1 70233744"){
      header("location: searcholaptop2.php");
    } elseif($searchedlaptopname == "Asus Vivobook A512FA-EJ099T Blue"){
      header("location: searcholaptop3.php");
    } elseif($searchedlaptopname == "Asus Vivobook A415EP-EB118T Core i7-1165G7"){
      header("location: searcholaptop4.php");
    } elseif($searchedlaptopname == "HP 14s-dq1100TU Core I3-1005G1 (193U0PA - Silver)"){
      header("location: searcholaptop5.php");
    } elseif($searchedlaptopname == "HP 15s-fq1106TU Core I3-1005G1 (193Q2PA - Silver)"){
      header("location: searcholaptop6.php");
    } elseif($searchedlaptopname == "MSI Modern 14 B11MO-010VN Core i7-1165G7"){
      header("location: searcholaptop7.php");
    } elseif($searchedlaptopname == "MSI Modern 14 B11M-073VN Core i7-1165G7"){
      header("location: searcholaptop8.php");
    } elseif($searchedlaptopname == "Acer Aspire 3 AS A315-54-34U1 Core i3-10110U"){
      header("location: searcholaptop9.php");
    } elseif($searchedlaptopname == "Acer Aspire 5 A514-52-54L3 Core i5-8265U"){
      header("location: searcholaptop10.php");
    } elseif($searchedlaptopname == ""){
      header("location: viewolaptop.php");
    } else{
      echo '<script>alert("The searched laptop name is not existed in the library database. Please modify the information in the search field again for searching laptop")</script>';
    }
  }

  if(isset($_POST['btn-refresh'])){
    header("location: viewolaptop.php");
  }
  
  if(isset($_POST['btn-borrow'])){
    $_SESSION['borrowed_laptopname'] = "MSI Modern 14 B11MO-010VN Core i7-1165G7";
    header("location: borrowolaptop.php");
  }

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Laptop Searching Page For Outsiders</title>
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

    input[type=text] {
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

    /* Create four equal columns that floats next to each other */
    .column {
    float: left;
    width: 25%;
    padding: 10px;
    }

    /* Clear floats after the columns */
    .row:after {
    content: "";
    display: table;
    clear: both;
    }

    .buttonHolder{ 
      text-align: center; 
    }

    input[type=submit] {
      border: none;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      margin: 4px 2px;
      cursor: pointer;
      font-size: 17px;
    }

    label {
    padding: 12px 12px 12px 0;
    display: inline-block;
    font-weight: bold;
    }

    @media screen and (max-width: 992px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      .sidebar a {float: left;}
      div.content {margin-left: 0;}

      .column  {
            width: 50%;
        }
    }

    @media screen and (max-width: 500px) {
      .sidebar a {
        text-align: center;
        float: none;
      }

      .column  {
            width: 100%;
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
  <a href="home5.php">Home</a>
  <a href="viewobook1.php">View Books</a>
  <a class="active" href="viewolaptop.php">View Laptops</a>
  <a href="borrowobook.php">Borrow Books</a>
  <a href="borrowolaptop.php">Borrow Laptops</a>
  <a href="borroworoom.php">Rent Study Room</a>
  <a href="printodocument.php">Print Documents</a>
  <a href="viewobookborrowingrecords.php">View Book Borrowing Records</a>
  <a href="viewolaptopborrowingrecords.php">View Laptop Borrowing Records</a>
  <a href="vieworoomborrowingrecords.php">View Room Borrowing Records</a>
  <a href="viewobookprintingrecords.php">View Book Printing Records</a>
  <a href="updateoutsiderinfo.php">Update Info</a>
  <a href="librarychat.php"> Online Chat</a>
  <a href="about5.php">About Us</a>
  <a href="index.php">Log Out</a>
</div>

<div class="content">
  <img src="img/logo.PNG" alt="Library Logo" style="width:45%">
  <h2>The laptop-viewing page for outsiders</h2>
  <h3>The information about the current laptops on this website</h3>

  <form action="searcholaptop7.php" method="POST" autocomplete="off">
    <label for="txt-searchedlaptopname">Searched Laptop Name</label>
    <div class="autocomplete" style="width:350px;">
    <input type="text" placeholder="Enter searched laptop name here" id="txt-searchedlaptopname" name="txt-searchedlaptopname" pattern=".{1,100}" title="Laptop name must contain at least 1 and maximum 100 characters" data-clear-btn="true" data-mini="true">
    </div>
    <input type="submit" style="background-color: DodgerBlue;" value="Search Laptop" name="btn-search">
    <input type="submit" style="background-color: #FF0000;" value="Refresh" name="btn-refresh">
  </form>
  
  <h4></h4>

  <div class="row">
    <div class="column" style="background-color:#aaa;">
    <img src="img/laptop7.png" alt="Laptop 7 Image" style="display: block; margin-left: auto; margin-right: auto; width:100%;height:300px;">
    <p>Laptop Name: MSI Modern 14 B11MO-010VN Core i7-1165G7</p>
    <p>OS: Windows 10 Home</p>
    <p>Laptop Status: Available</p>
    <form action="searcholaptop7.php" method="POST">
    <div class="buttonHolder">
    <input type="submit" style="background-color: #4CAF50;" value="Borrow Laptop" name="btn-borrow">
    </div>
    </form>
    </div>
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
var laptops = ["Dell G3 3590 Core i5-9300H (N5I5518W)", "Dell Vostro 3401 Core i3-1005G1 70233744", "Asus Vivobook A512FA-EJ099T Blue", "Asus Vivobook A415EP-EB118T Core i7-1165G7", "HP 14s-dq1100TU Core I3-1005G1 (193U0PA - Silver)", "HP 15s-fq1106TU Core I3-1005G1 (193Q2PA - Silver)", "MSI Modern 14 B11MO-010VN Core i7-1165G7", "MSI Modern 14 B11M-073VN Core i7-1165G7", "Acer Aspire 3 AS A315-54-34U1 Core i3-10110U", "Acer Aspire 5 A514-52-54L3 Core i5-8265U"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("txt-searchedlaptopname"), laptops);
</script>

</body>
</html>