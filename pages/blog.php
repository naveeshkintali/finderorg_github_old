<?php
include("conn.php");
$baseURL = "https://finderorg.com/";
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog - Finderorg</title>
    <meta name="description"
        content="finderorg.com is an organizations information search system. Based on customer reviews, the search engine will help users quickly find the best service provider">
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

$i = 0;
$k=1;
$tempPageURL = 'blog/?page=';
$blogPageURL = 'https://finderorg.com/blog/';

$sql = "SELECT id FROM finderorg_us_post";
$run = mysqli_query($conn,$sql);
$foundnum = mysqli_num_rows($run);
$getquery = mysqli_query($conn,$sql);

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if($actual_link==$blogPageURL){
	$start = 0;
	$Limit = 10;
}else{
	for($i=0;$i<=$foundnum;$i+=10) {
		$checkPageLink = $baseURL.$tempPageURL.$k;

		if($actual_link==$checkPageLink){
			$start = $i;
			$Limit = $start+10;
			goto jumpExit;
		}else{
			$start = $i;
			$Limit = $start+10;
		}
		$k=$k+1;
	}
jumpExit:
}


$sql  = "SELECT * FROM finderorg_us_post ORDER BY id DESC LIMIT $start, $Limit";
$run = mysqli_query($conn,$sql);
$foundnum = mysqli_num_rows($run);
$getquery = mysqli_query($conn,$sql);

	if(mysqli_num_rows($getquery) > 0){
		while($row = mysqli_fetch_array($getquery))
		{		
			$title = $row["title"];
			$category = $row["category"];
			$content = $row["content"];
			
			$titleCleanURL = preg_replace('/[^\p{L}\p{N}\s]/u', '',  $title);
			$titleCleanURL = trim(str_replace("  "," ", strtolower(str_replace("="," ",str_replace("^"," ",str_replace("*"," ",str_replace("%"," ",str_replace("!"," ",str_replace("@"," ",str_replace("#"," ",str_replace("$"," ",str_replace("&"," ",str_replace("@"," ",str_replace("+"," ",str_replace("_"," ",str_replace("/"," ",str_replace("-", " ", $titleCleanURL)))))))))))))))));
			$titleCleanURL = str_replace(" ","-",$titleCleanURL);
			
			$postCleanURL = $titleCleanURL;
			$date = date("M d, Y", strtotime($row['date']));
        
		echo	'<div class="card">';
		echo	'<h2><a href="'.$baseURL.'blog/'.$postCleanURL.'">' .$title. '</a></h2>';
		echo	'<p>' .$date. ', ' .$category.'</p>';
		echo 	'<p>' .substr($content,0,184). '<a href="'.$baseURL.'blog/'.$postCleanURL.'">...<strong>Read more</strong></a></p>';
		echo 	'</div>';
		}
		mysqli_free_result($getquery);
	}
	mysqli_close($conn);
?>

            <br />
            <div class="pagination">
                <?php
//if($foundnum==0){
	if(isset($_GET['page'])) {
		$page=$_GET['page'];
	}else {
		$page=1;
	}
		echo '<a href="' . $baseURL . 'blog/">&laquo;</a>'; 
	for($p=$page; $p<=$page+10;$p++) {
		echo '<a style="text-decoration: none; color:inherit;" href="' . $baseURL . 'blog/?page=' . $p . '">' . $p . '</a> '; 
	} 
						
	//End Page Change //
	if ($p != ''){	
		echo '<a href="' . $baseURL . 'blog/?page=' . $p . '">&raquo;</a>';	
	}else{
		echo '<a font-size:1vw; href="' . $baseURL . 'blog/?page=' . $page . '">&raquo;</a>';
	}
//}
?>

            </div>
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
                            <a href="<?php echo $baseURL;?>/contact-us/" rel="noopener noreferrer">Contact Us</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>