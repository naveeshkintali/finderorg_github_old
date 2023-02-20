<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finderorg - Org Information Search System</title>
    <meta name="description"
        content="finderorg.com is an organizations information search system. Based on customer reviews, the search engine will help users quickly find the best service provider">

    <link rel="canonical" href="https://finderorg.com/" />
    <link rel="alternate" hreflang="en-us" href="https://finderorg.com" />
    <link rel="shortcut icon" href="assets/images/favicon_finderorg.png" type="image/x-icon" />

    <style>
    <?php include 'assets/css/mystyle.css';
    ?>
    </style>

</head>

<body>
    <div class="header">
        <a href="" class="logo">Finderorg</a>
        <div class="header-right">
            <a class="active" href="">Home</a>
            <a href="about-us/" rel="noopener noreferrer">About</a>
            <a href="blog/" rel="noopener noreferrer">Blog</a>
            <a href="contact-us/" rel="noopener noreferrer">Contact</a>
        </div>
    </div>

    <div class="row">
        <div class="leftcolumn">
            <?php require_once('category.php'); ?>
        </div>

        <div class="rightcolumn">
            <div class="card">
                <div class="search-bar">
                    <form action="" class="frmSearch" name="form1" method="get" style="margin:auto;max-width:720px">
                        <input type="text" value="" placeholder="Search" name="q" area-lable="Search"></input>
                        <!-- <button type="submit" value="Submit" name=""><i class="fa fa-search"></i></button>  -->
                    </form>
                </div>
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
                            <p>Copyright &copy; 2022, All Right Reserved <a href="">Finderorg.com</a></p>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                        <div class="footer-menu">
                            <a href="about-us/" rel="noopener noreferrer">About |</a>
                            <a href="privacy-policy/" rel="noopener noreferrer">Privacy |</a>
                            <a href="disclaimer/" rel="noopener noreferrer">Disclaimer |</a>
                            <a href="/contact-us/" rel="noopener noreferrer">Contact Us</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>