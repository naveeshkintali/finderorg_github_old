<?php $baseURL = "https://finderorg.com/";?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - Finderorg</title>
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
            <div class="card">
                <h2>About Finderorg.com</h2>
                <p>There are millions of people in the world. Each person has their hobbies and interests. They like to
                    pick up a profession of their choice and ability. Sometimes, it becomes vital to find a professional
                    in a particular field of activity or an organization, according to its reviews. finderorg.com is an
                    organization's information search system. Based on customer reviews, the search engine will help
                    users quickly find the best service provider in nearby areas. The tool is definitely time-saving and
                    helpful for users to discover the best service. Now the users don't have to worry about it. Isn't it
                    great!</p>
                <h3>Read on to know some of the features of the system.</h3>
                <p>There are millions of organizations and essential services.</p>
                <ul>
                    <li>More than 3000 cities which we covered in the country.</li>
                    <li>All organizations are divided into 3 thousand sectors for easy search.</li>
                </ul>
                <p>Some of the popular organizations in the country are USA Medical and Healthcare, USA Home service,
                    Automotive, and other USA Services.
                <p>
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
                            <a href="<?php echo $baseURL;?>contact-us/" rel="noopener noreferrer">Contact Us</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>