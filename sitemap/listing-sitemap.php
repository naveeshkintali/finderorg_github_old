<?php
include("conn.php");
$domain = 'http://localhost/finderorg/';
$LastModi = date('c',time());
$sitemap = 'listing-sitemap';
$k=1;
//$j=1;

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//$actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	
$sql = "SELECT ID FROM finderorg_US";
$run = mysqli_query($conn,$sql);
$foundnum = mysqli_num_rows($run);
$getquery = mysqli_query($conn,$sql);

if(mysqli_num_rows($getquery) > 0){
	for($i=0;$i<=$foundnum;$i+=1) {
		//$j=$j+1;
		$checkSitemapLink = $domain . $sitemap. '-' .$k.'.xml';
		if($actual_link==$checkSitemapLink){
			$start = $i;
			$Limit = $start+30000;
			goto jumpExit;
		}
			$k=$k+1;
	}
}
//echo $start;
//echo '<br></br>';
//echo $Limit;
//die();

jumpExit:
    
    // destroy more than one variable
        unset($foundnum,$run,$sql,$i,$k);
        

$sql = "SELECT ID, Name, City, Category FROM finderorg_US Limit $start, $Limit";
$run = mysqli_query($conn,$sql);
$foundnum = mysqli_num_rows($run);
$getquery = mysqli_query($conn,$sql);

	if(mysqli_num_rows($getquery) > 0){

		//header("Content-type: application/xml");
		//header("Content-Type: text/php;");
		header("Content-Type: text/xml;");
		echo '<?xml version="1.0" encoding="UTF-8"?>' .PHP_EOL;
		echo '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' .PHP_EOL;
			
		//echo '<url>' .PHP_EOL;
		//echo '<loc>' . $domain . '</loc>'  .PHP_EOL;
		//echo '<lastmod>' .$LastModi. '</lastmod>'  .PHP_EOL;
		//echo '</url>'  .PHP_EOL;
		//echo '</urlset>'.PHP_EOL;
		
		while($row = mysqli_fetch_array($getquery))
		{		
	
			$id = $row["ID"];
			// City Clean URL
			$cityCleanURL = preg_replace('/[^\p{L}\p{N}\s]/u', '',  $row["City"]);
			$cityCleanURL = trim(str_replace("  "," ", strtolower(str_replace("="," ",str_replace("^"," ",str_replace("*"," ",str_replace("%"," ",str_replace("!"," ",str_replace("@"," ",str_replace("#"," ",str_replace("$"," ",str_replace("&"," ",str_replace("@"," ",str_replace("+"," ",str_replace("_"," ",str_replace("/"," ",str_replace("-", " ", $cityCleanURL)))))))))))))))));
			$cityCleanURL = str_replace(" ","-",$cityCleanURL);
			
			// Category Clean URL
			$categoryCleanURL = preg_replace('/[^\p{L}\p{N}\s]/u', '',  $row["Category"]);
			$categoryCleanURL = trim(str_replace("  "," ", strtolower(str_replace("="," ",str_replace("^"," ",str_replace("*"," ",str_replace("%"," ",str_replace("!"," ",str_replace("@"," ",str_replace("#"," ",str_replace("$"," ",str_replace("&"," ",str_replace("@"," ",str_replace("+"," ",str_replace("_"," ",str_replace("/"," ",str_replace("-", " ", $categoryCleanURL)))))))))))))))));
			$categoryCleanURL = str_replace(" ","-",$categoryCleanURL);
			
			$nameCleanURL = preg_replace('/[^\p{L}\p{N}\s]/u', '',  $row["Name"]);
			$nameCleanURL = trim(str_replace("  "," ", strtolower(str_replace("="," ",str_replace("^"," ",str_replace("*"," ",str_replace("%"," ",str_replace("!"," ",str_replace("@"," ",str_replace("#"," ",str_replace("$"," ",str_replace("&"," ",str_replace("@"," ",str_replace("+"," ",str_replace("_"," ",str_replace("/"," ",str_replace("-", " ", $nameCleanURL)))))))))))))))));
			$nameCleanURL = str_replace(" ","-",$nameCleanURL);
			
			$CleanURL = $cityCleanURL. '/' .$categoryCleanURL. '/' .$nameCleanURL.'-'.$id;
			
			echo '<url>' .PHP_EOL;
			echo '<loc>' . $domain . $CleanURL . '</loc>'  .PHP_EOL;
			//echo '<lastmod>' .$LastModi. '</lastmod>'  .PHP_EOL;
			//echo '<changefreq>weekly</changefreq>' .PHP_EOL;
			//echo  '<priority>0.5</priority>' .PHP_EOL;
			echo '</url>'  .PHP_EOL;
		}
			echo '</urlset>'.PHP_EOL;
			mysqli_free_result($getquery);
			
			// destroy more than one variable
        unset($foundnum,$run,$sql,$start,$Limit,$row,$id,$cityCleanUR,$categoryCleanURL,$nameCleanURL,$CleanURL);
	}
	  mysqli_close($conn);
?>