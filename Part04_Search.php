<!-- 
    Student Name: Seeram Likitha
    Project Name: Project 3
    Due Date: 20 Nov 2016
-->

<?php
$owner = "Likitha Seeram";
/*Form to display the Search on Navigation bar*/
function getForm() {
  return "<form class='nav navbar-form navbar-right' method='post'>
        <div class='form-group'>
          <input type='text' class='form-control' placeholder='Search Paintings' name='title'>
        </div>
        <button type='submit' class='btn btn-primary' name='submit'>Search</button>
       </form>";
  }

/*This function is used to highlight search content*/
function get_highlighted_data($content, $word) {
  $replace = '<span class="coloring">' . $word . '</span>';
  $content = str_replace($word, $replace, $content);
  return $content;
  }
/*To navigate  to search Page upon clicking search button on navigation bar*/
if(isset($_POST['submit'])) {
  $name = $_POST['title'];
  if($name) {
    header('Location: Part04_Search.php?title='.$name);
  }
  else {
    header('Location: Part04_Search.php');
  }
}

//Oprning a DataBase connection
$db = new mysqli('localhost','root','','art');
  if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 
?>

<!DOCTYPE HTML>

<html>
<head>
	<title>CSE5335 - Assignment3</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">

	<link rel="stylesheet" type="text/css" href="art.css">

<!-- This script is used to 'show' or 'hide' a textbox depending upon radio button selection -->
	<script>
	$(document).ready(function() {
		$("input[type='radio']").change(function() {
			if ($(this).val()=='option1') {
				$('#search1').attr('style','display:block');
				$('#search2').attr('style','display:none');
			}
			else if ($(this).val()=='option2') {
				$('#search2').attr('style','display:block');
				$('#search1').attr('style','display:none');	
			}
			else {
				$('#search1').attr('style','display:none');
				$('#search2').attr('style','display:none');
			}
		});
	});
	</script>

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
     <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Project 3</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="default.php">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="about.php">About Us</a></li>
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown">Pages <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><?php echo "<a href='Part01_ArtistDataList.php'>Artists Data List (Part 1)</a>"; ?></li>
            <li><?php echo "<a href='Part02_SingleArtist.php?id=19'>Single Artist (Part 2)</a>"; ?></li>
            <li><?php echo "<a href='Part03_SingleWork.php?id=394'>Single Work (Part 3)</a>"; ?></li>
            <li class="active"><?php echo "<a href='Part04_Search.php'>Search (Part 4)</a>"; ?></li>
          </ul>
        </li>
       </ul>  

       <?php echo getForm(); ?>

       <div class="nav navbar-form navbar-right">
 	   	<span class="text-muted name"><?php echo $owner; ?></span>
 	   </div>
    </div>
   </div> 
</nav>

<?php 
  /*1) Case for a plain search form*/
  if(!isset($_GET['title']) && !isset($_GET['description']) && !isset($_GET['display'])) {
  echo "<div class='container welcome'>
  <h2>Search Results</h2>
  <hr>

  <form method='GET'>
  <div class='table-bordered gap search-box'>
  <div class='radio left-gap'>
      <label>
      <input type='radio' name='filter' id='titleFilter' value='option1'>
      Filter by Title
      </label>
  </div>
  <div class='left-gap right-gap'>
    <input type='text' class='form-control' id='search1' name='title' style='display: none;''>
  </div>
  <div class='radio left-gap'>
      <label>
      <input type='radio' name='filter' id='descriptionFilter' value='option2'>
      Filter by Description
      </label>
  </div>
  <div class='left-gap right-gap'>
    <input type='text' class='form-control' id='search2' name='description' style='display: none;'>
  </div>
  <div class='radio left-gap'>
      <label>
      <input type='radio' name='filter' id='noFilter' value='option3'>
      No Filter (Show all art works)
      </label>
  </div>
  <div class='left-gap below-gap'>
    <input type='submit' name='filterButton' class='btn btn-primary' id='filter' value='Filter'>
  </div>
  </div>
  </form>

</div>";
  }

  /*2) Case when searching using title*/
  elseif (isset($_GET['title']) && !isset($_GET['description']) && !isset($_GET['display'])) {
    echo "<div class='container welcome'>
  <h2>Search Results</h2>
  <hr>

  <form method='GET'>
  <div class='table-bordered gap search-box'>
  <div class='radio left-gap'>
      <label>
      <input type='radio' name='filter' id='titleFilter' value='option1' checked>
      Filter by Title
      </label>
  </div>
  <div class='left-gap right-gap'>
    <input type='text' class='form-control' id='search1' name='title' style='display: block;'";
  echo "value='".$_GET['title']."'>
  </div>
  <div class='radio left-gap'>
      <label>
      <input type='radio' name='filter' id='descriptionFilter' value='option2'>
      Filter by Description
      </label>
  </div>
  <div class='left-gap right-gap'>
    <input type='text' class='form-control' id='search2' name='description' style='display: none;'>
  </div>
  <div class='radio left-gap'>
      <label>
      <input type='radio' name='filter' id='noFilter' value='option3'>
      No Filter (Show all art works)
      </label>
  </div>
  <div class='left-gap below-gap'>
    <input type='submit' name='filterButton' class='btn btn-primary' id='filter' value='Filter'>
  </div>
  </div>
  </form>

  </div>";

  $sql1 = "SELECT * FROM ARTWORKS WHERE TITLE LIKE '%".$_GET['title']."%' ORDER BY ArtistID";
  try {
    $result1 = $db->query($sql1);
  }
  catch(Exception $e) {
    echo "Message:" .$e->getMessage();
  }
  while ($works1 = mysqli_fetch_array($result1)) {
  echo "<div class='container gap'>
  <div class='row'>
    <div class='col-xs-2'>
      <a href='Part03_SingleWork.php?id=".$works1['ArtWorkID']."'><img src='images/art/works/square-medium/".$works1['ImageFileName'].".jpg' alt='ARTWORK' height='170px' width='170px' class='thumbnail' id='imageresource'></a>
    </div>
    <div class='col-xs-8'>
      <a href='Part03_SingleWork.php?id=".$works1['ArtWorkID']."'><p>".utf8_encode($works1['Title'])."</p></a>
      <p>";
      $data = utf8_encode($works1['Description']);
      echo $data;
      echo "</p>
    </div>
  </div>
  </div>";
  }

  $result1->close();
}

  /*3) Case when searching using description*/
  elseif (!isset($_GET['title']) && isset($_GET['description']) && !isset($_GET['display'])) {
    echo "<div class='container welcome'>
  <h2>Search Results</h2>
  <hr>

  <form method='GET'>
  <div class='table-bordered gap search-box'>
  <div class='radio left-gap'>
      <label>
      <input type='radio' name='filter' id='titleFilter' value='option1'>
      Filter by Title
      </label>
  </div>
  <div class='left-gap right-gap'>
    <input type='text' class='form-control' id='search1' name='title' style='display: none;'>
  </div>
  <div class='radio left-gap'>
      <label>
      <input type='radio' name='filter' id='descriptionFilter' value='option2' checked>
      Filter by Description
      </label>
  </div>
  <div class='left-gap right-gap'>
    <input type='text' class='form-control' id='search2' name='description' style='display: block;' value='".$_GET['description']."'>
  </div>
  <div class='radio left-gap'>
      <label>
      <input type='radio' name='filter' id='noFilter' value='option3'>
      No Filter (Show all art works)
      </label>
  </div>
  <div class='left-gap below-gap'>
    <input type='submit' name='filterButton' class='btn btn-primary' id='filter' value='Filter'>
  </div>
  </div>
  </form>

</div>";

  $sql2 = "SELECT * FROM ARTWORKS WHERE DESCRIPTION LIKE '%".$_GET['description']."%' ORDER BY ArtistID";
  try {
    $result2 = $db->query($sql2);
  }
  catch(Exception $e) {
    echo "Message:" .$e->getMessage();
  }
  while ($works2 = mysqli_fetch_array($result2)) {
  echo "<div class='container gap'>
  <div class='row'>
    <div class='col-xs-2'>
      <a href='Part03_SingleWork.php?id=".$works2['ArtWorkID']."'><img src='images/art/works/square-medium/".$works2['ImageFileName'].".jpg' alt='ARTWORK' height='170px' width='170px' class='thumbnail' id='imageresource'></a>
    </div>
    <div class='col-xs-8'>
      <a href='Part03_SingleWork.php?id=".$works2['ArtWorkID']."'><p>".$works2['Title']."</p></a>
      <p>";
      echo get_highlighted_data(utf8_encode($works2['Description']),$_GET['description']); 
      echo "</p>
    </div>
  </div>
  </div>";
  }

  $result2->close();
  }

  /*4) Case to display all artworks (No Filter Selected)*/
  else if (!isset($_GET['title']) && !isset($_GET['description']) && isset($_GET['display'])){
    echo "<div class='container welcome'>
  <h2>Search Results</h2>
  <hr>

  <form method='GET'>
  <div class='table-bordered gap search-box'>
  <div class='radio left-gap'>
      <label>
      <input type='radio' name='filter' id='titleFilter' value='option1'>
      Filter by Title
      </label>
  </div>
  <div class='left-gap right-gap'>
    <input type='text' class='form-control' id='search1' name='title' style='display: none;'>
  </div>
  <div class='radio left-gap'>
      <label>
      <input type='radio' name='filter' id='descriptionFilter' value='option2' checked>
      Filter by Description
      </label>
  </div>
  <div class='left-gap right-gap'>
    <input type='text' class='form-control' id='search2' name='description' style='display: none;'>
  </div>
  <div class='radio left-gap'>
      <label>
      <input type='radio' name='filter' id='noFilter' value='option3' checked>
      No Filter (Show all art works)
      </label>
  </div>
  <div class='left-gap below-gap'>
    <input type='submit' name='filterButton' class='btn btn-primary' id='filter' value='Filter'>
  </div>
  </div>
  </form>

</div>";

  $sql3 = "SELECT * FROM ARTWORKS";
  try {
    $result3 = $db->query($sql3);
  }
  catch(Exception $e) {
    echo "Message:" .$e->getMessage();
  }
  while ($works3 = mysqli_fetch_array($result3)) {
  echo "<div class='container gap'>
  <div class='row'>
    <div class='col-xs-2'>
      <a href='Part03_SingleWork.php?id=".$works3['ArtWorkID']."'><img src='images/art/works/square-medium/".$works3['ImageFileName'].".jpg' alt='ARTWORK' height='170px' width='170px' class='thumbnail' id='imageresource'></a>
    </div>
    <div class='col-xs-8'>
      <a href='Part03_SingleWork.php?id=".$works3['ArtWorkID']."'><p>".$works3['Title']."</p></a>
      <p>".utf8_encode($works3['Description'])."</p>
    </div>
  </div>
  </div>";
  }

  $result3->close();
  }
?>

<!-- Redirecting the search page depending upon search selection criteria -->
<?php
if(isset($_GET['filterButton'])) {
  $selection = $_GET['filter'];
  $title = $_GET['title'];
  $description = $_GET['description'];
  if($selection == "option1" || $selection == "option2" || $selection == "option3") {
    if($selection == "option1" && $title != "")
    {
      header('Location: Part04_Search.php?title='.$title);
      exit;
    }
    elseif ($selection == "option2" && $description != "") {
      header('Location: Part04_Search.php?description='.$description);
      exit;
    }
    else {
      header('Location: Part04_Search.php?display=all');
      exit;
    }
  }
  else { 
    header('Location: Part04_Search.php');
    exit;
    }
}
?>

<?php 
  $db->close();
?>
</body>
</html>