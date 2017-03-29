<!-- 
    Student Name: Seeram Likitha
    Project Name: Project 3
    Due Date: 20 Nov 2016
-->

<?php
$owner = "Likitha Seeram";

function getForm() {
	return "<form class='nav navbar-form navbar-right' method='post'>
        <div class='form-group'>
          <input type='text' class='form-control' placeholder='Search Paintings' name='title'>
        </div>
        <button type='submit' class='btn btn-primary' name='submit'>Search</button>
       </form>";
	}
if(isset($_POST['submit'])) {
	$name = $_POST['title'];
	if($name) {
		header('Location: Part04_Search.php?title='.$name);
	}
	else {
		header('Location: Part04_Search.php');
	}
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
        <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="about.php">About Us</a></li>
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown">Pages <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><?php echo "<a href='Part01_ArtistDataList.php'>Artists Data List (Part 1)</a>"; ?></li>
            <li><?php echo "<a href='Part02_SingleArtist.php?id=19'>Single Artist (Part 2)</a>"; ?></li>
            <li><?php echo "<a href='Part03_SingleWork.php?id=394'>Single Work (Part 3)</a>"; ?></li>
            <li><?php echo "<a href='Part04_Search.php'>Search (Part 4)</a>"; ?></li>
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

<!-- This div displays the website information -->
<div class="welcome jumbotron">
	<div class="inside">
	<h1>Welcome to Assignment #3</h1>
	<h4>This is the third assignment for <?php echo "<strong>" . $owner . "</strong>"; ?> in the course CSE5335-002</h4>
	</div>
</div>

<!-- This div contains the links to other pages -->
<div class="container">
<div class="row">
	<div class="col-md-2 clearfix visible-*-block">
	<span class="glyphicon glyphicon-info-sign input-lg" aria-hidden="true">AboutUs<br></span>
	<p class="input-sm">What is this all about and other stuff</p><br>
	<button type="button" class="btn btn-default" onclick="javascript:window.location.href='about.php';">
		<span class="glyphicon glyphicon-link" aria-hidden="true">VisitPage</span>
	</button>
	</div>
	<div class="col-md-2 clearfix visible-*-block">
	<span class="glyphicon glyphicon-list input-lg"" aria-hidden="true">ArtistList</span><br>
	<p class="input-sm">Displays a list of artist names as links</p><br>
	<button type="button" class="btn btn-default" onclick="javascript:window.location.href='Part01_ArtistDataList.php';">
		<span class="glyphicon glyphicon-link" aria-hidden="true">VisitPage</span>
	</button>
	</div>
	<div class="col-md-2 clearfix visible-*-block">
	<span class="glyphicon glyphicon-user input-lg"" aria-hidden="true">SingleArtist</span><br>
	<p class="input-sm">Displays information for a single artist</p><br>
	<button type="button" class="btn btn-default" onclick="javascript:window.location.href='Part02_SingleArtist.php?id=19';">
		<span class="glyphicon glyphicon-link" aria-hidden="true">VisitPage</span>
	</button>
	</div>
	<div class="col-md-2 clearfix visible-*-block">
	<span class="glyphicon glyphicon-picture input-lg"" aria-hidden="true">SingleWork</span><br>
	<p class="input-sm">Displays information for a single work</p><br>
	<button type="button" class="btn btn-default" onclick="javascript:window.location.href='Part03_SingleWork.php?id=394';">
		<span class="glyphicon glyphicon-link" aria-hidden="true">VisitPage</span>
	</button>
	</div>
	<div class="col-md-2 clearfix visible-*-block">
	<span class="glyphicon glyphicon-search input-lg"" aria-hidden="true">Search</span><br>
	<p class="input-sm">Perform search on ArtWorks tables</p><br>
	<button type="button" class="btn btn-default" onclick="javascript:window.location.href='Part04_Search.php';">
		<span class="glyphicon glyphicon-link" aria-hidden="true">VisitPage</span>
	</button>
	</div>
</div>
</div>
</body>
</html>