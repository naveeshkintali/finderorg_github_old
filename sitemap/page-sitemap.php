<?php 
include("conn.php");
header('Content-type: application/xml');

$basename = basename($_SERVER['PHP_SELF']);
$mainDomain = 'http://localhost/finderorg/';
$LastModi = date('c',time());
$about_us = 'about-us/';
$blog = 'blog/';
$privacy_policy = 'privacy-policy/';
$disclaimer = 'disclaimer/';
$contact_us = 'contact-us/';

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

echo '<sitemap>';
echo '<loc>' .$mainDomain . $about_us . '</loc>';
echo '<lastmod>' . $LastModi . '</lastmod>';
echo '</sitemap>';

echo '<sitemap>';
echo '<loc>' .$mainDomain . $blog . '</loc>';
echo '<lastmod>' . $LastModi . '</lastmod>';
echo '</sitemap>';

echo '<sitemap>';
echo '<loc>' .$mainDomain . $privacy_policy . '</loc>';
echo '<lastmod>' . $LastModi . '</lastmod>';
echo '</sitemap>';

echo '<sitemap>';
echo '<loc>' .$mainDomain . $disclaimer . '</loc>';
echo '<lastmod>' . $LastModi . '</lastmod>';
echo '</sitemap>';

echo '<sitemap>';
echo '<loc>' .$mainDomain . $contact_us . '</loc>';
echo '<lastmod>' . $LastModi . '</lastmod>';
echo '</sitemap>';

echo '</sitemapindex>';
?>