<?php
include("conn.php");
$baseURL ="https://finderorg.com/";

$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$year = date("\ Y");
if (strpos($url,'blog') !== false) {
	
		echo '<div class="card">';
			echo "Page not found";
			echo '<title>Not found - Finderorg</title>';
		echo '</div>';
    goto jumpExit;
}elseif(isset($_GET['City']) && isset($_GET['Category'])){
	echo '<div class="card">';
			echo "Page not found";
			echo '<title>Not found - Finderorg</title>';
		echo '</div>';
    goto jumpExit;
	
}
	
	if(isset($_GET['q'])){
		
		$search = isset($_GET['q']) ? $_GET['q'] : '';
		$search = trim($search);
		
		$sql = "SELECT City, Category, Service FROM finderorg_US Where Category like '%$search%' or Service like '%$search%' or City like '%$search%' or State like '%$search%' GROUP By City, Category Limit 10";
	}else{
		$sql = "SELECT About, City, Category, Service FROM finderorg_US GROUP By Category Limit 10";
	}
	
	$getquery = mysqli_query($conn,$sql);
	$foundnum = mysqli_num_rows($getquery);
	if ($foundnum==0){
		echo '<div class="card">';
			echo "We are unable to find a services for $search";
			echo '<title>Finderorg - Org Information Search System</title>';
		echo '</div>';
	}else{
	
	if(mysqli_num_rows($getquery) > 0){
	while($row = mysqli_fetch_array($getquery))
	{
	
	$city = trim($row["City"]);
	$category = trim($row["Category"]);
	
	$categoryCleanURL = preg_replace('/[^\p{L}\p{N}\s]/u', '',  $category);
	$categoryCleanURL = trim(str_replace("  "," ", strtolower(str_replace("="," ",str_replace("^"," ",str_replace("*"," ",str_replace("%"," ",str_replace("!"," ",str_replace("@"," ",str_replace("#"," ",str_replace("$"," ",str_replace("&"," ",str_replace("@"," ",str_replace("+"," ",str_replace("_"," ",str_replace("/"," ",str_replace("-", " ", $categoryCleanURL)))))))))))))))));
	$categoryCleanURL = str_replace(" ","-",$categoryCleanURL);
		
	// City Clean URL
	$cityCleanURL = preg_replace('/[^\p{L}\p{N}\s]/u', '',  $city);
	$cityCleanURL = trim(str_replace("  "," ", strtolower(str_replace("="," ",str_replace("^"," ",str_replace("*"," ",str_replace("%"," ",str_replace("!"," ",str_replace("@"," ",str_replace("#"," ",str_replace("$"," ",str_replace("&"," ",str_replace("@"," ",str_replace("+"," ",str_replace("_"," ",str_replace("/"," ",str_replace("-", " ", $cityCleanURL)))))))))))))))));
	$cityCleanURL = str_replace(" ","-",$cityCleanURL);
		
	$CleanURL = $baseURL.$cityCleanURL.'/'.$categoryCleanURL;
	
	echo '<div class="card">';
    echo  '<a href="'. $CleanURL. '" target="_blank"><h2>Best ' .str_replace("Services", '', $category). ' Services in '.$city.'【'.$year.' 】</h2></a>';
    //echo  '<h5>Title description, Sep 2, 2017</h5>';
    //echo  '<div class="imgBox"><img style="width:100%; height:360px" src="" alt="' . $CleanURL.  '"></div>';
	echo '<p>' .$category. '<a href="'.$CleanURL. '" target="_blank">...<strong>Read more</strong></a></p>';
	echo '</div>';
    }
        // Free result set
        mysqli_free_result($getquery);
		mysqli_close($conn);
	}
	}
jumpExit:
?>