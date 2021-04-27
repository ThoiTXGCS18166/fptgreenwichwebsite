<?php
  $host="localhost";
  $user="root";
  $password="";
  $db="library";
  
  $conn = mysqli_connect($host,$user,$password,$db);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  session_start();

  $sql="SELECT * FROM books WHERE BookName = 'Unbroken' limit 1";

  $result=mysqli_query($conn,$sql);
                
  if(mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
      $book20author = $row["AuthorName"];
      $book20length = $row["BookLength"];
      $book20image = $row["BookImage"];
      $status20 = $row["BookStatus"];
    }

    if($status20 == 0) {
      $book20status = 'Unavailable';
    } else {
      $book20status = 'Available';
    }
  }
   
  if(isset($_POST['btn-search'])){   
    $searchedname=$_POST['txt-searchedname'];
    if($searchedname == "How to win friends and influence people" || $searchedname == "Dale Carnegie"){
      header("location: searchtbook1.php");
    } elseif($searchedname == "Think and Grow Rich" || $searchedname == "Napoleon Hill"){
      header("location: searchtbook2.php");
    } elseif($searchedname == "Start with Why" || $searchedname == "Simon Sinek"){
      header("location: searchtbook3.php");
    } elseif($searchedname == "The 7 Habits of Highly Effective People" || $searchedname == "Stephen Covey"){
      header("location: searchtbook4.php");
    } elseif($searchedname == "HTML & CSS: Design and Build Web Sites" || $searchedname == "Jon Duckett"){
      header("location: searchtbook5.php");
    } elseif($searchedname == "Learning Web Design" || $searchedname == "Jennifer Robbins"){
      header("location: searchtbook6.php");
    } elseif($searchedname == "The Soul of a New Machine" || $searchedname == "Tracy Kidder"){
      header("location: searchtbook7.php");
    } elseif($searchedname == "Learning PHP, MySQL, JavaScript, CSS and HTML5" || $searchedname == "Robin Nixon"){
      header("location: searchtbook8.php");
    } elseif($searchedname == "Guns, Germs, and Steel" || $searchedname == "Jared Diamond"){
      header("location: searchtbook9.php");
    } elseif($searchedname == "A People History of the United States" || $searchedname == "Howard Zinn"){
      header("location: searchtbook10.php");
    } elseif($searchedname == "The History of the Ancient World" || $searchedname == "Susan Wise Bauer"){
      header("location: searchtbook11.php");
    } elseif($searchedname == "Devil in the White City" || $searchedname == "Erik Larson"){
      header("location: searchtbook12.php");
    } elseif($searchedname == "Salt, Fat, Acid, Heat" || $searchedname == "Samin Nosrat"){
      header("location: searchtbook13.php");
    } elseif($searchedname == "On Food and Cooking" || $searchedname == "Harold McGee"){
      header("location: searchtbook14.php");
    } elseif($searchedname == "Kitchen Confidential" || $searchedname == "Anthony Bourdain"){
      header("location: searchtbook15.php");
    } elseif($searchedname == "Mastering the Art of French Cooking" || $searchedname == "Julia Child"){
      header("location: searchtbook16.php");
    } elseif($searchedname == "Becoming" || $searchedname == "Michelle Obama"){
      header("location: searchtbook17.php");
    } elseif($searchedname == "Into the Wild" || $searchedname == "Jon Krakauer"){
      header("location: searchtbook18.php");
    } elseif($searchedname == "Steve Jobs" || $searchedname == "Walter Isaacson"){
      header("location: searchtbook19.php");
    } elseif($searchedname == "Unbroken" || $searchedname == "Laura Hillenbrand"){
      header("location: searchtbook20.php");
    } elseif($searchedname == ""){
      header("location: viewtbook1.php");
    } else{
      echo '<script>alert("The searched book/author name is not existed in the library database. Please modify the information in the search field again for searching book")</script>';
    }
  }

  if(isset($_POST['btn-refresh'])){
    header("location: viewtbook1.php");
  }

  if(isset($_POST['btn-borrow'])){
    $_SESSION['borrowed_bookname'] = "Unbroken";
    header("location: borrowtbook.php");
  }

  if(isset($_POST['btn-print'])){
    $_SESSION['printed_bookname'] = "Unbroken";
    header("location: printtdocument.php");
  }

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Book Searching Page For Teachers</title>
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
  <a href="home4.php">Home</a>
  <a class="active" href="viewtbook1.php">View Books</a>
  <a href="viewtlaptop.php">View Laptops</a>
  <a href="borrowtbook.php">Borrow Books</a>
  <a href="borrowtlaptop.php">Borrow Laptops</a>
  <a href="borrowtroom.php">Rent Study Room</a>
  <a href="printtdocument.php">Print Documents</a>
  <a href="viewtbookborrowingrecords.php">View Book Borrowing Records</a>
  <a href="viewtlaptopborrowingrecords.php">View Laptop Borrowing Records</a>
  <a href="viewtroomborrowingrecords.php">View Room Borrowing Records</a>
  <a href="viewtbookprintingrecords.php">View Book Printing Records</a>
  <a href="updateteacherinfo.php">Update Info</a>
  <a href="librarychat.php"> Online Chat</a>
  <a href="about4.php">About Us</a>
  <a href="index.php">Log Out</a>
</div>

<div class="content">
  <img src="img/logo.PNG" alt="Library Logo" style="width:45%">
  <h2>The book-searching page for teachers</h2>
  <h3>The information about the searched book on this website</h3>

  <form action="searchtbook20.php" method="POST" autocomplete="off">
    <label for="txt-searchedname">Searched Book/Author Name</label>
    <div class="autocomplete" style="width:350px;">
    <input type="text" placeholder="Enter searched book/author name here" id="txt-searchedname" name="txt-searchedname" pattern=".{1,150}" title="Book/Author name must contain at least 1 and maximum 150 characters" data-clear-btn="true" data-mini="true">
    </div>
    <input type="submit" style="background-color: DodgerBlue;" value="Search Book" name="btn-search">
    <input type="submit" style="background-color: #FF0000;" value="Refresh" name="btn-refresh">
  </form>

  <h4>Book Category : Biographies</h4>

  <div class="row">
    <div class="column" style="background-color:#ddd;">
    <?php echo $book20image ? "<img src='img/{$book20image}' style='display: block; margin-left: auto; margin-right: auto; width:100%; height:400px;' />" : "No image found.";  ?>
    <p>Book Author: <?php echo $book20author;?></p>
    <p>Book Pages: <?php echo $book20length;?> pages</p>
    <p>Book Status: <?php echo $book20status;?></p>
    <p style="text-align: center;"><a href="viewtbook20detail.php">View Book Details</a></p>
    <form action="searchtbook20.php" method="POST">
    <div class="buttonHolder">
    <input type="submit" style="background-color: #4CAF50;" value="Borrow Book" name="btn-borrow">
    <input type="submit" style="background-color: #555555;" value="Print Book" name="btn-print">
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
var books = ["How to win friends and influence people", "Think and Grow Rich", "Start with Why", "The 7 Habits of Highly Effective People", "HTML & CSS: Design and Build Web Sites", "Learning Web Design", "The Soul of a New Machine", "Learning PHP, MySQL, JavaScript, CSS and HTML5", "Guns, Germs, and Steel", "A People History of the United States", "The History of the Ancient World", "Devil in the White City", "Salt, Fat, Acid, Heat", "On Food and Cooking", "Kitchen Confidential", "Mastering the Art of French Cooking", "Becoming", "Into the Wild", "Steve Jobs", "Unbroken", "Dale Carnegie", "Napoleon Hill", "Simon Sinek", "Stephen Covey", "Jon Duckett", "Jennifer Robbins", "Tracy Kidder", "Robin Nixon", "Jared Diamond", "Howard Zinn", "Susan Wise Bauer", "Erik Larson", "Samin Nosrat", "Harold McGee", "Anthony Bourdain", "Julia Child", "Michelle Obama", "Jon Krakauer", "Walter Isaacson", "Laura Hillenbrand"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("txt-searchedname"), books);
</script>

</body>
</html>