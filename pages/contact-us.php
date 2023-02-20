<?php $baseURL = 'http://localhost/finderorg/'; ?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Finderorg - Org Information Search System</title>
<meta name="description" content="finderorg.com is an organizations information search system. Based on customer reviews, the search engine will help users quickly find the best service provider">
<link rel="shortcut icon" href="<?php echo $baseURL;?>assets/images/favicon_finderorg.png" type="image/x-icon" />

<style><?php include 'assets/css/mystyle.css'; ?></style>

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
	
	<div class="card">
	<h2>GET IN TOUCH</h2>
	<p>info@finderorg.com</p>
	<h4>BUSINESS HOURS</h4>
	<p>Monday – Friday 8:30am to 5pm</p>
	<p>Saturday – 8:30am to 2pm</p>
	<p>Sunday – Closed</p>
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
                            <p>Copyright &copy; 2022, All Right Reserved <a href="<?php echo $baseURL;?>">Finderorg.com</a></p>
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