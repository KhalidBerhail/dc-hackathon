<?php get_header(); 




//Construction of Api call URL
$pro1 = get_field('1er_produit_alimentaire');
$pro2 = get_field('2e_produit_alimentaire');
$pro3 = get_field('3e_produit_alimentaire');
$list_prods= array($pro1 ,$pro2,$pro3);
$metric = get_field('metric_a_afficher');

$pre_url = "https://data.ademe.fr/data-fair/api/v1/datasets/agribalyse-synthese/metric_agg?metric=avg&field=".urlencode($metric);
//"&q=".urlencode($prod_alim1['label'])."&q_mode=simple";


echo $url1;





?>

<div id="primary" class="content-area">
	<div id="content" class="site-content">

	<div class="data-section">
		<?php
			foreach($list_prods as $prod):
				$product = $prod['label'];
				$url_fetch = $pre_url."&q=".urlencode($product)."&q_mode=simple";
				$ch = curl_init();
				
				try {
					curl_setopt($ch, CURLOPT_URL, $url_fetch);
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

				if($http_code == intval(200)) :
					//decoding json response
					$obj = json_decode($response);
			
		?>
					<div class="data-element">
						<!--element-title-->
						<h3 class="data-element__title"><?php echo $prod['label'];?></h3>
						<p class="data-element__metric"><?php echo $obj->metric;?></p>
					</div>
		<?php
				
				else:
					echo $http_code;
				endif;
			endforeach;
		?>
	</div><!-- .data-section -->

		
	</div><!-- #content -->
</div><!-- #primary -->
    
<?php get_footer();
