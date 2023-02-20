<?php
include("conn.php");
$baseURL = 'https://finderorg.com/';
$year = date("\ Y");
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
if(isset($_GET['City']) && isset($_GET['Category']) && isset($_GET['Name']) && isset($_GET['ID'])){
	
	$id = $_GET['ID'];
	$checkID = $_GET['ID'];
	
	$sql = "SELECT ID, Name, Address, City, State, Category, Service, PhoneNumber, About, WorkHours, Website, Closed FROM finderorg_US Where ID='$id'";
	$run = mysqli_query($conn,$sql);
	$foundnum = mysqli_num_rows($run);
	$getquery = mysqli_query($conn,$sql);
if ($foundnum>0){
	if(mysqli_num_rows($getquery) > 0){
		while($row = mysqli_fetch_array($run))
		{	
			$id = $row["ID"];
			$name = $row["Name"];
			$address = $row["Address"];
			$city = $row["City"];
			$state = $row["State"];
			//$zip = $row["Zip"];
			$phonenumber = $row["PhoneNumber"];
			$website = $row["Website"];
			$category = $row["Category"];
			$service = $row["Service"];
			$about = $row["About"];
			$workhours = $row["WorkHours"];
		}
	}
	
	$sql_related_product = "SELECT ID, Name, City, Category FROM finderorg_US Where Category = '$category' Limit 11";
	$getquery_related_product = mysqli_query($conn,$sql_related_product);
	$run_related_product = mysqli_query($conn,$sql_related_product);
	//$foundnum_related_product = mysqli_num_rows($run);

//if($foundnum_related_product>0){
	if(mysqli_num_rows($getquery_related_product) > 0){
		
		while($row_related_product = mysqli_fetch_array($run_related_product))
		{	
			$related_product_id = $row_related_product['ID'];
			$related_product_city = trim(strtolower(str_replace("-"," ",$row_related_product['City'])));
			$related_product_category = trim(strtolower(str_replace("-"," ",$row_related_product['Category'])));
			$related_product_name = trim(strtolower(str_replace("-"," ",$row_related_product['Name'])));

			// Name Clean URL
			$nameCleanURL = preg_replace('/[^\p{L}\p{N}\s]/u', '',  $related_product_name);
			$nameCleanURL = trim(str_replace("  "," ", strtolower(str_replace("="," ",str_replace("^"," ",str_replace("*"," ",str_replace("%"," ",str_replace("!"," ",str_replace("@"," ",str_replace("#"," ",str_replace("$"," ",str_replace("&"," ",str_replace("@"," ",str_replace("+"," ",str_replace("_"," ",str_replace("/"," ",str_replace("-", " ", $nameCleanURL)))))))))))))))));
			$nameCleanURL = str_replace(" ","-",$nameCleanURL);
			
			// Category Clean URL
			$categoryCleanURL = preg_replace('/[^\p{L}\p{N}\s]/u', '',  $related_product_category);
			$categoryCleanURL = trim(str_replace("  "," ", strtolower(str_replace("="," ",str_replace("^"," ",str_replace("*"," ",str_replace("%"," ",str_replace("!"," ",str_replace("@"," ",str_replace("#"," ",str_replace("$"," ",str_replace("&"," ",str_replace("@"," ",str_replace("+"," ",str_replace("_"," ",str_replace("/"," ",str_replace("-", " ", $categoryCleanURL)))))))))))))))));
			$categoryCleanURL = str_replace(" ","-",$categoryCleanURL);
			
			// City Clean URL
			$cityCleanURL = preg_replace('/[^\p{L}\p{N}\s]/u', '',  $related_product_city);
			$cityCleanURL = trim(str_replace("  "," ", strtolower(str_replace("="," ",str_replace("^"," ",str_replace("*"," ",str_replace("%"," ",str_replace("!"," ",str_replace("@"," ",str_replace("#"," ",str_replace("$"," ",str_replace("&"," ",str_replace("@"," ",str_replace("+"," ",str_replace("_"," ",str_replace("/"," ",str_replace("-", " ", $cityCleanURL)))))))))))))))));
			$cityCleanURL = str_replace(" ","-",$cityCleanURL);
			$CleanURL = $baseURL.$cityCleanURL. '/' .$categoryCleanURL. '/' .$nameCleanURL. '-' .$related_product_id;
			$CleanURL_Category = $baseURL.$cityCleanURL. '/' .$categoryCleanURL;
			
			$list_of_related_service_provider[] =  '<a href="' .$CleanURL. '">' .ucwords($related_product_name). ' in '.$related_product_city.  '</a></li>';
			$list_of_related_service_provider_Category[] =  '<a href="' .$CleanURL_Category. '">Best ' .ucwords($related_product_category). ' Service Provider in ' .$related_product_city. '</a></li>';	
		}
			mysqli_free_result($getquery_related_product);
	}
}
}
?>

            <!-- START SEARCH RESULT  -->
            <?php
			
if(isset($_GET['City']) && isset($_GET['Category']) && isset($_GET['Name']) && isset($_GET['ID'])){
	$id = $_GET['ID'];

	$city = trim(strtolower(str_replace("-"," ",$_GET['City'])));
	$category = trim(strtolower(str_replace("-"," ",$_GET['Category'])));
	$name = trim(strtolower(str_replace("-"," ",$_GET['Name'])));
	
	$sql = "SELECT ID, Name, Address, City, State, Category, Service, PhoneNumber, About, WorkHours, Closed FROM finderorg_US Where ID='$id'";
	$run = mysqli_query($conn,$sql);
	$foundnum = mysqli_num_rows($run);
	
if ($foundnum==0){
		echo '<div class="card">';
		echo "We are unable to find a services for search";
		echo '<title>Finderorg - Org Information Search System</title>';
		echo '</div>';
}else{
	if (empty($id)) {
		echo '<title>Finderorg - Org Information Search System</title>';
			goto jumpExit;
	}else{
		echo '<title>' .ucwords($name). ' in ' .ucwords($city). ' | Finderorg</title>';
		echo '<meta content=' .$name. ' is providing the services for the '.$category.  ' in the city of '.$city. ', United States. name=description>';
	}

	$min = 9.1;
	$max = 9.9;

		if(mysqli_num_rows($getquery) > 0){
			while($row = mysqli_fetch_array($getquery))
			{
				$id = $row["ID"];
				$name = $row["Name"];
				$address = $row["Address"];
				$city = $row["City"];
				$state = $row["State"];
				//$zip = $row["Zip"];
				$phonenumber = $row["PhoneNumber"];
				$website = $row["Website"];
				$closed = $row["Closed"];
				$category = $row["Category"];
				$service = $row["Service"];
				$about = $row["About"];
				$workhours = $row["WorkHours"];
				
				
				$title_dynamic_Point_1 = 'Best Service Provider for ' .$category. ' in the city of ' .$city. ', United States';
				
				$heading_content_dynamic_Point_2 = 'We found the <strong>' .$name. '</strong> Service Provider for <strong>' .$category. '</strong> in the city of <strong>' .$city. ', United States</strong>. 
				The <strong>finderorg.com</strong> search system strives to identify your regions most acceptable service provider and gives customers accurate and pertinent information. If you believe your search phrases match the category you are looking for, and the service provider is close by, you can learn more about them and obtain information. The name of the service provider, information about the business, its category, location, hours of operation, and contact information are all listed here.
				<br></br>Additionally, our search engine gives suppliers a <strong>[Score out of 10]</strong> rating based on user interest and search phrases.
				The complete information on the <strong>' .$name. '</strong> can be found in the section below:';
				
				$table_of_contents = '<ul>
										<li>Introduction of '.$name.'</li>
										<li>What Types of Services Provided by '.$name.'</li>
										<li>Rating Score of '.$name.'</li>
										<li>Contact Details of '.$name.'</li>
										<li>Other Service Providers in the category of '.$category.'</li>
										<li>List of Other Service Providers in nearby your areas</li>
										<li>Frequently Asked Questions</li>
									</ul>';
									
				$about_comapnay_dynamic_Point_3 = '<strong>' .$name. '</strong> has been representing the highest standard of excellence for many years now in <strong>' . $city . ', United States</strong>. It focuses on the processes of <strong>' .$category. ', ' .$service. '</strong>. Moreover, it contributed to developing their reputation in the industry as being able to deliver high-quality work promptly. It offers the best <strong>' .$category. '</strong> experience as their goal is to reach customers where they are rather than waiting for them to approach them.';
				
				$types_of_services_dynamic_Point_4 = '<strong>' .$name.'</strong> are experts in the field of <strong>'.$category.'</strong>. The <strong>' .$name.'</strong> provides a wide range of intangible services. When promoting their products and services, the service industry uses a variety of marketing tactics. But let us learn about the services provided by the <strong>' .$name.'</strong> first to gain a better sense of what they do. The service provider services are always available to answer queries from customers.';
				
				$score_dynamic_Point_5  = 'A rating score is a performance management system that indicates a service providers level of performance or accomplishment. According to our methodology, <strong>'.$name. '</strong> gets a <strong>(' . mt_rand ($min*10, $max*10) / 10 .' out of 10)</strong> rating. <br></br><strong>Note:</strong> How do we come up with a rating score? <br></br>We created a backend algorithm in our search engine to determine the rating score based on the level of user involvement, interest, and search phrases entered into the site. If you come across the same service provider again, your rating score may fluctuate from time to time.';
				
				$other_service_provider_category_dynamic_Point_6 = 'There are several service providers in this category that offer services that are comparable to one another. Below is a list of the highly recommended service providers available in the same category in this city located in the United States.<br></br><strong>You can also visit the listing page by clicking on the list if you want to check with others.</strong>';
				
				$list_of_service_provider_nearby_areas_dynamic_Point_7 = 'If you want to know about the best service providers in nearby your areas in the city of <strong>' . $city .', United States </strong> , you can check out the following list below. ';
				
				$conclusion = 'We hope that the website provided you with the updated and correct information. Please leave feedback regarding our search system and how quickly you got the required information.  Please inform us if you possess any ideas or recommendations that could help us enhance the performance of our search system. Please do not hesitate to contact us at our email address: info@finderorg.com.<br></br>
				We value your comments. As a result, it would be beneficial if you could provide comments about the service provider or discuss your experience working with them. Please submit your remarks to our email ID: info@finderorg.com.<br></br>
				The information present in this article is for general information purposes only. We recommend the customers have complete knowledge before proceeding.';
				
				
				$FAQs = '<h4><strong>How Do I Find the Best Service Provider?</strong></h4>
				<p>You can find the best service provider online, directory website, on social media platforms, etc	</p>
				
				<h4><strong>How Do I Choose the Right Service Provider?</strong></h4>
				<p>You can choose a service provider that knows your business best, meets your requirements, develop realistic expectations, and is capable and cost-effective.</p>
				
				<h4><strong>Do Service Provider Systems Provide All Categories of Information?</strong></h4>
				<p>Yes.</p>
				
				<h4 class="list-group-item-heading"><strong>Does this Article Provide a Top 10 List of Service Providers in Our Areas?</strong></h4>
				<p>Yes.</p>
				
				<h4><strong>How to Choose the Right Service Provider on the Website?</strong></h4>
				<p>The best way to choose the right service provider on the website is by checking their reviews and ratings.</p>
				
				<h4><strong>Do I Need to Register First to Find Service Providers on the Website?</strong></h4>
				<p>No.</p>
				
				<h4><strong>Can We Directly Contact You on the Website for Any Service-related Inquiries?</strong></h4>
				<p>Yes, you can directly email us for any service-related inquiries.</p>';
				
				
				$disclaimer =  '<Strong>Disclaimer:</strong> The data comes from multiple service providers. Hence, it does not guarantee that the information is the most recent available data. The data provided may be inaccurate, contain errors, and is taken by assumptions. Therefore, if you find any issues with it, then please feel free to email us at: <strong>info@finderorg.com</strong>.';
				
				$people_also_search_for = $category .' providers, ' .$category. ' providers near me, service provider, ' .$category. ' providers in my area, best '.$category.' in my area, '.$category. ' companies, '.$category. ' company, best service providers in the city of ' .$city. ', best service providers in ' .$city. ', best service providers for ' .$category;
		
				echo	'<div class="card">';
				echo	  '<h2>' . $title_dynamic_Point_1 . '</h2>';
				//echo	  '<h5>Title description, Dec 7, 2017</h5>';
				//echo	  '<div class="listingimage" style="height:200px;"></div>';
				//echo       '<br />';
				echo	  '<p>' . $heading_content_dynamic_Point_2 .'</p>';
				echo 		'<h2>Table of Contents</h2>';
				echo 			'<p>' .$table_of_contents. '</p>';
				echo         '<h2>Introduction of ' .$name. '</h2>';
				if (empty($about)) {
					echo				'<p>' .$about_comapnay_dynamic_Point_3.'</p>';
				}else{
					echo				'<p>' .$about.'</p>';
				}
				
				echo					'<h2>What Types of Services Provided by ' .$name. '</h2>';
				echo					'<p>' .$types_of_services_dynamic_Point_4. '</p>';
				
				echo					'<h2>Rating Score of ' .$name. '</h2>';
				echo					'<p>' . $score_dynamic_Point_5 . '</p>';
				
				echo					'<h2>Contact Details of ' .$name. '</h2>';

				if (!empty($name)) {
				echo					'<p>Company Name: ' .$name. '</p>';
				}
				if (!empty($address)) {
				echo					'<p>Address: ' .$address. '</p>';
				}
				if (!empty($phonenumber)) {
				echo					'<p>Phone: ' .$phonenumber. '</p>';
				}
				if (!empty($website)) {
				echo					'<p>Website: ' .$website. '</p>';
				}
				if (!empty($workhours)) {
				echo					'<p>Work Hours: ' .$workhours. '</p>';
				}
				if (!empty($closed)) {
				echo					'<p>Closed: ' .$closed. '</p>';
				}
				echo					'<h2>Other Service Providers in the Category of ' .$category. '</h2>';
				echo					'<p> ' .$other_service_provider_category_dynamic_Point_6. '</p>';
				
				echo '<ul>';
				foreach($list_of_related_service_provider_Category as $y => $val_cat) {
					if (!$y==0) {
						$list_of_related_service_provider_Category = '<li>' .$val_cat. '</li>';
						echo str_replace("Services", '', ucwords($list_of_related_service_provider_Category));
					}
				}
				echo '</ul>';
				
				echo					'<h2>List of Other Service Providers in Nearby Your Areas</h2>';
				echo					'<p> ' .$list_of_service_provider_nearby_areas_dynamic_Point_7. '</p>';
				
				echo '<ul>';
				foreach($list_of_related_service_provider as $x => $val) {
					if (!$x==0) {
						$list_of_related_service_provider = '<li>' .$val. '</li>';
						echo ucwords($list_of_related_service_provider);
					}
				}
				echo '</ul>';
				
				echo	'<h2>Conclusion</h2>';
				echo		'<p>' .$conclusion. '</p>';
				
				echo	'<h2>Frequently Asked Questions</h2>';
				echo		$FAQs;
				
				echo	'<p><strong>People Also Search For:</strong> ' .strtolower($people_also_search_for). '</p>';
				
				echo	'<p>' . $disclaimer .'</p>';
				echo  '</div>';
			
			}
			// Free result set
			mysqli_free_result($getquery);
		}
	}
	mysqli_close($conn);
}

jumpExit:

?>

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