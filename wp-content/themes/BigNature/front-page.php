<?php get_header(); 

$ch = curl_init();
try {
	curl_setopt($ch, CURLOPT_URL, "https://data.ademe.fr/data-fair/api/v1/datasets/agribalyse-synthese/lines?page=1&after=1&size=12&select=%2A&highlight=Nom_du_Produit_en_Fran%C3%A7ais&q_mode=simple");
	// curl_setopt($ch, CURLOPT_URL, "https://www.balldontlie.io/api/v1/games");
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);   
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);         
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	
	$response = curl_exec($ch);
	
} catch (\Throwable $th) {
	throw $th;
} finally {
	if (curl_errno($ch)) {
		echo curl_error($ch);
		die();
	}
	
}
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
?>

<div id="primary" class="content-area">
	<div id="content" class="site-content">

	<div class="data-section">
		<?php
			//Checking if api call return code is Succesfull
			if($http_code == intval(200)) :
				//decoding json response
				$obj = json_decode($response);
				//looping through response
				foreach($obj->results as $match) :
		?>
					<div class="data-element">
						<!--element-title-->
						<h3 class="data-element__title"><?php echo $match->LCI_Name?></h3>
					</div>
		<?php
				endforeach;
			endif;
		?>
	</div><!-- .data-section -->

		
	</div><!-- #content -->
</div><!-- #primary -->
    
<?php get_footer();
