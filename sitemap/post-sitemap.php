<?php 
include("conn.php");
header('Content-type: application/xml');
$domain = 'http://localhost/finderorg/';
$LastModi = date('c',time());
$sitemap = 'post-sitemap';

$sql = "SELECT title FROM finderorg_us_post";

$run = mysqli_query($conn,$sql);
$foundnum = mysqli_num_rows($run);
$getquery = mysqli_query($conn,$sql);

	if(mysqli_num_rows($getquery) > 0){

		header("Content-type: application/xml");
		//header("Content-Type: text/php;");
		//header("Content-Type: text/xml;");
		echo '<?xml version="1.0" encoding="UTF-8"?>' .PHP_EOL;
		echo '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' .PHP_EOL;
			
		while($row = mysqli_fetch_array($getquery))
		{		
			// title Clean URL
			$titleCleanURL = 'blog/'. trim(strtolower(str_replace(" ","-",$row["title"])));

			echo '<url>' .PHP_EOL;
			echo '<loc>' . $domain . $titleCleanURL . '</loc>'  .PHP_EOL;
			echo '<lastmod>' .$LastModi. '</lastmod>'  .PHP_EOL;
			//echo '<changefreq>weekly</changefreq>' .PHP_EOL;
			//echo  '<priority>0.5</priority>' .PHP_EOL;
			echo '</url>'  .PHP_EOL;
		}
			echo '</urlset>'.PHP_EOL;
			mysqli_free_result($getquery);
			
				// destroy more than one variable
        unset($foundnum,$run,$sql,$row,$titleCleanURL,$LastModi);
        
	}
	mysqli_close($conn);
?>