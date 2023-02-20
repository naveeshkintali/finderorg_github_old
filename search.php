<?php 
include("conn.php");
$year = date("\ Y");
$baseURL = 'https://finderorg.com/'; 
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo $baseURL;?>assets/images/favicon_finderorg.png" type="image/x-icon" />

    <style>
    <?php include 'assets/css/mystyle.css';
    ?>
    </style>

</head>

<body>

    <div class="header">
        <a href="<?php echo $baseURL;?>" class="logo">Finderorg</a>
        <div class="header-right">
            <a class="active" href="<?php echo $baseURL;?>">Home</a>
            <a href="<?php echo $baseURL;?>about-us/" rel="noopener noreferrer">About</a>
            <a href="<?php echo $baseURL;?>blog/" rel="noopener noreferrer">Blog</a>
            <a href="<?php echo $baseURL;?>contact-us/" rel="noopener noreferrer">Contact</a>
        </div>
    </div>

    <div class="row">
        <div class="leftcolumn">

            <?php

//Blog Post Start //

if (!isset($_GET['q'])){
	//do nothing

if($_GET['City'] == 'blog'){
  
	$title = str_replace("/"," ",str_replace("-"," ",$_GET['Category']));
	$sql = $sql = "SELECT * FROM finderorg_us_post Where title='$title'";
	$run = mysqli_query($conn,$sql);
	$foundnum = mysqli_num_rows($run);
	
	if ($foundnum>0){
	$getquery = mysqli_query($conn,$sql);	
	$postCleanURL = $baseURL. 'blog/' .$_GET['Category'];
	
	if(mysqli_num_rows($getquery) > 0){
		while($row = mysqli_fetch_array($run))
		{	
		$title = $row['title'];
		$category = $row['category'];
		$content = $row['content'];
		
		echo '<title>'.$title.' - Finderorg</title>';
		echo '<meta name="description" content="'.substr($content,0,139).'">';
		echo '<link rel="canonical" href="'.$postCleanURL.'">';
		
		echo 	'<div class="card">';
		echo	'<h2>' .$title. '</h2>';
		echo		'<p>' .$content. '</p>';
		echo	'</div>';
		}

		// Free result set
        mysqli_free_result($getquery);
	}
	}else{
		echo '<div class="card">';
		echo 'We are unable to find a services for search';
		echo '<title>Finderorg - Org Information Search System</title>';
		echo '</div>';
	}
	mysqli_close($conn);
	goto jumpExit;
}

if(isset($_GET['City']) && isset($_GET['Category'])){

	$city = trim(strtolower(str_replace("-"," ",$_GET['City'])));
	$category = trim(strtolower(str_replace("-"," ",$_GET['Category'])));
	
	$sql = "SELECT ID, Name, City, State, Category, Service,About FROM  finderorg_US Where Category='$category' GROUP By City, Category Limit 10";
	
	$run = mysqli_query($conn,$sql);

	$foundnum = mysqli_num_rows($run);
if ($foundnum==0){
	 echo '<div class="card">';
	echo 'We are unable to find a services for search';
	echo '<title>Finderorg - Org Information Search System</title>';
	echo '</div>';
}else{
	
	echo '<title>Best ' .str_replace("Services", '', ucwords($category)). ' Service Providers in ' .ucwords($city). ' 【'.$year.' 】 | Finderorg</title>';
	
	$getquery = mysqli_query($conn,$sql);

	if(mysqli_num_rows($getquery) > 0){

		$i = 1;	
		$min = 9.1;
		$max = 9.9;
		
		while($row = mysqli_fetch_array($getquery))
		{		
			
				$id = $row["ID"];
				$name = $row["Name"];
				//$address = $row["Address"];
				$city = $row["City"];
				$state = $row["State"];
				//$zip = $row["Zip"];
				//$phonenumber = $row["PhoneNumber"];
				//$website = $row["Website"];
				$category = $row["Category"];
				$service = $row["Service"];
				$about = $row["About"];
				//$workhours = $row["WorkHours"];
				if (empty($about)) {
					$about = '<strong>' .$name.'</strong> are experts in the field of <strong>'.$category.'</strong>. The <strong>' .$name.'</strong> provides a wide range of intangible services. When promoting their products and services, the service industry uses a variety of marketing tactics. But let us learn about the services provided by the <strong>' .$name.'</strong> first to gain a better sense of what they do. The service provider services are always available to answer queries from customers.';
				}
				
				// Name Clean URL
				$nameCleanURL = preg_replace('/[^\p{L}\p{N}\s]/u', '',  $name);
				$nameCleanURL = trim(str_replace("  "," ", strtolower(str_replace("="," ",str_replace("^"," ",str_replace("*"," ",str_replace("%"," ",str_replace("!"," ",str_replace("@"," ",str_replace("#"," ",str_replace("$"," ",str_replace("&"," ",str_replace("@"," ",str_replace("+"," ",str_replace("_"," ",str_replace("/"," ",str_replace("-", " ", $nameCleanURL)))))))))))))))));
				$nameCleanURL = str_replace(" ","-",$nameCleanURL);
				
				// Category Clean URL
				$categoryCleanURL = preg_replace('/[^\p{L}\p{N}\s]/u', '',  $category);
				$categoryCleanURL = trim(str_replace("  "," ", strtolower(str_replace("="," ",str_replace("^"," ",str_replace("*"," ",str_replace("%"," ",str_replace("!"," ",str_replace("@"," ",str_replace("#"," ",str_replace("$"," ",str_replace("&"," ",str_replace("@"," ",str_replace("+"," ",str_replace("_"," ",str_replace("/"," ",str_replace("-", " ", $categoryCleanURL)))))))))))))))));
				$categoryCleanURL = str_replace(" ","-",$categoryCleanURL);
				
				// City Clean URL
				$cityCleanURL = preg_replace('/[^\p{L}\p{N}\s]/u', '',  $city);
				$cityCleanURL = trim(str_replace("  "," ", strtolower(str_replace("="," ",str_replace("^"," ",str_replace("*"," ",str_replace("%"," ",str_replace("!"," ",str_replace("@"," ",str_replace("#"," ",str_replace("$"," ",str_replace("&"," ",str_replace("@"," ",str_replace("+"," ",str_replace("_"," ",str_replace("/"," ",str_replace("-", " ", $cityCleanURL)))))))))))))))));
				$cityCleanURL = str_replace(" ","-",$cityCleanURL);
				
				$CleanURL = $baseURL.$cityCleanURL. '/' .$categoryCleanURL. '/' .$nameCleanURL. '-' .$id;
	
				echo '<div class="card">';
				echo  '<a href="'.$CleanURL. '"><h2>' .$name. ' in the City of '.$city.' United States</h2></a>';
				//echo  '<div class="imgBox"><img style="width:100%; height:360px" src="" alt="' . $name.  '"></div>';
				echo '<p>' .substr($about,0,184). '<a href="'.$CleanURL. '">...<strong>Read more</strong></a></p>';
				echo '</div>';
		}
		// Free result set
			mysqli_free_result($getquery);	
	}	
		mysqli_close($conn);
	}
	}
jumpExit:
}
?>

            <?php
include("conn.php");

$i=0;

if(!isset($_GET['q'])){
}
else if (isset($_GET['q'])) {
		
$search = isset($_GET['q']) ? $_GET['q'] : '';
$search = trim($search);

$search = str_replace("-"," ",$search);
$search =  trim(strtolower($search));

$sql = "SELECT ID, Name, City, State, Category, Service FROM  finderorg_US Where Name like '%$search%' or Category like '%$search%'  or City like '%$search%' or State like '%$search%' or Address like '%$search%' GROUP By Name, City, Category Limit 10";
	
$run = mysqli_query($conn,$sql);

$foundnum = mysqli_num_rows($run);

if ($foundnum==0)
{
	echo "We are unable to find a product for $search";
	echo '<title>Finderorg - Org Information Search System</title>';
}	
	else{
		
		if (empty($search)) {
	            echo "We are unable to find a product for search";
			echo '<title>Finderorg - Org Information Search System</title>';
			goto jumpExit;
			
		}
			else{
				echo '<title>Best Service Providers For ' .ucwords($search). ' 【'.$year.' 】 | Finderorg</title>';
				echo '<meta content=The Finderorg search system will help users quickly find the best service provider in nearby areas in the United States. name=description>';
		}
	
	$sql = "SELECT ID, Name, City, State, Category, Service FROM finderorg_US Where Name like '%$search%' or Category like '%$search%'  or City like '%$search%' or State like '%$search%' or Address like '%$search%' Limit 10";
	
	$getquery = mysqli_query($conn,$sql);

	if(mysqli_num_rows($getquery) > 0){
	while($row = mysqli_fetch_array($getquery))
	{		
	$id = $row["ID"];
	$name = $row["Name"];
	//$address = $row["Address"];
	$city = $row["City"];
	$state = $row["State"];
	//$zip = $row["Zip"];
	//$phonenumber = $row["PhoneNumber"];
	//$website = $row["Website"];
	$category = $row["Category"];
	$service = $row["Service"];
	//$about = $row["About"];
	//$workhours = $row["WorkHours"];
	
	// Name Clean URL
	$nameCleanURL = preg_replace('/[^\p{L}\p{N}\s]/u', '',  $name);
	$nameCleanURL = trim(str_replace("  "," ", strtolower(str_replace("="," ",str_replace("^"," ",str_replace("*"," ",str_replace("%"," ",str_replace("!"," ",str_replace("@"," ",str_replace("#"," ",str_replace("$"," ",str_replace("&"," ",str_replace("@"," ",str_replace("+"," ",str_replace("_"," ",str_replace("/"," ",str_replace("-", " ", $nameCleanURL)))))))))))))))));
	$nameCleanURL = str_replace(" ","-",$nameCleanURL);
	
	// Category Clean URL
	$categoryCleanURL = preg_replace('/[^\p{L}\p{N}\s]/u', '',  $category);
	$categoryCleanURL = trim(str_replace("  "," ", strtolower(str_replace("="," ",str_replace("^"," ",str_replace("*"," ",str_replace("%"," ",str_replace("!"," ",str_replace("@"," ",str_replace("#"," ",str_replace("$"," ",str_replace("&"," ",str_replace("@"," ",str_replace("+"," ",str_replace("_"," ",str_replace("/"," ",str_replace("-", " ", $categoryCleanURL)))))))))))))))));
    $categoryCleanURL = str_replace(" ","-",$categoryCleanURL);
	
	// City Clean URL
	$cityCleanURL = preg_replace('/[^\p{L}\p{N}\s]/u', '',  $city);
	$cityCleanURL = trim(str_replace("  "," ", strtolower(str_replace("="," ",str_replace("^"," ",str_replace("*"," ",str_replace("%"," ",str_replace("!"," ",str_replace("@"," ",str_replace("#"," ",str_replace("$"," ",str_replace("&"," ",str_replace("@"," ",str_replace("+"," ",str_replace("_"," ",str_replace("/"," ",str_replace("-", " ", $cityCleanURL)))))))))))))))));
    $cityCleanURL = str_replace(" ","-",$cityCleanURL);
	
	// State Clean URL
	//$stateCleanURL = preg_replace('/[^\p{L}\p{N}\s]/u', '',  $state);
	//$stateCleanURL = trim(str_replace("  "," ", strtolower(str_replace("="," ",str_replace("^"," ",str_replace("*"," ",str_replace("%"," ",str_replace("!"," ",str_replace("@"," ",str_replace("#"," ",str_replace("$"," ",str_replace("&"," ",str_replace("@"," ",str_replace("+"," ",str_replace("_"," ",str_replace("/"," ",str_replace("-", " ", $stateCleanURL)))))))))))))))));
    //$stateCleanURL = str_replace($stateCleanURL);
	
	$CleanURL = $baseURL.$cityCleanURL. '/' .$categoryCleanURL. '/' .$nameCleanURL. '-' .$id;
	
		
				echo '<div class="card">';
				echo  '<a href="'.$CleanURL. '"><h2>' .$name. ' in the City of '.$city.' United States</h2></a>';
				//echo  '<div class="imgBox"><img style="width:100%; height:360px" src="" alt="' . $name.  '"></div>';
				echo '<p>' .$category. '<a href="'.$CleanURL. '">...<strong>Read more</strong></a></p>';
				echo '</div>';
				
        }
        // Free result set
        mysqli_free_result($getquery);
	}
	}
	mysqli_close($conn);
}
//jumpExit:
?>
            <!-- END SEARCH RESULT -->

        </div>

        <div class="rightcolumn">
            <div class="card">
            </div>

            <div class="card">
            </div>

        </div>
    </div>

    <div class="footer">
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                        <div class="copyright-text">
                            <p>Copyright &copy; 2022, All Right Reserved <a
                                    href="<?php echo $baseURL;?>">Finderorg.com</a></p>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                        <div class="footer-menu">
                            <a href="<?php echo $baseURL;?>about-us/" rel="noopener noreferrer">About |</a>
                            <a href="<?php echo $baseURL;?>privacy-policy/" rel="noopener noreferrer">Privacy |</a>
                            <a href="<?php echo $baseURL;?>disclaimer/" rel="noopener noreferrer">Disclaimer |</a>
                            <a href="<?php echo $baseURL;?>contact-us/" rel="noopener noreferrer">Contact Us</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>