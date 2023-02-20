<?php 
include("/home2/bestrev2/public_html/finderorg/conn.php");
header('Content-type: application/xml');

$domain = 'http://localhost/finderorg/';
$LastModi = date('c',time());
$listingSitemap = 'listing-sitemap';
$pageSitemap = 'page-sitemap';
$postSitemap = 'post-sitemap';

$k=1;

$sql = "SELECT ID FROM finderorg_US";
$run = mysqli_query($conn,$sql);
$foundnum = mysqli_num_rows($run);
$getquery = mysqli_query($conn,$sql);


if(mysqli_num_rows($getquery) > 0){
	echo '<?xml version="1.0" encoding="UTF-8"?>';
	echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	
		echo '<sitemap>';
		echo '<loc>' .$domain.$pageSitemap .'.xml</loc>';
		//echo '<lastmod>' . $LastModi . '</lastmod>';
		echo '</sitemap>';
		
		echo '<sitemap>';
		echo '<loc>' .$domain.$postSitemap .'.xml</loc>';
		//echo '<lastmod>' . $LastModi . '</lastmod>';
		echo '</sitemap>';
		
	for($i=0;$i<=$foundnum;$i+=30000) {
		echo '<sitemap>';
		echo '<loc>' .$domain.$listingSitemap . '-' .$k.'.xml</loc>';
		echo '<lastmod>' . $LastModi . '</lastmod>';
	    //echo '<changefreq>weekly</changefreq>';
		//echo  '<priority>0.5</priority>';
		echo '</sitemap>';
		$k=$k+1;
	}	
	echo '</sitemapindex>';
		mysqli_free_result($getquery);
		// destroy more than one variable
        unset($foundnum,$run,$sql,$row,$i,$k,$listingSitemap,$pageSitemap,$postSitemap);
}
	mysqli_close($conn);
?>