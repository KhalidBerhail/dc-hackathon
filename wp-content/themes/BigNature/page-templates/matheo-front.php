<?php 
/*
    Template Name: Matheo-Front
*/

get_header(); 


//Construction of Api call URL
$pro1 = get_field('1er_produit_alimentaire');
$pro2 = get_field('2e_produit_alimentaire');
$pro3 = get_field('3e_produit_alimentaire');
$list_prods= array($pro1 ,$pro2,$pro3);
$metric = get_field('metric_a_afficher');

$pre_url = "https://data.ademe.fr/data-fair/api/v1/datasets/agribalyse-synthese/metric_agg?metric=avg&field=".urlencode($metric);

?>

<div id="primary" class="content-area">
	<div id="content" class="site-content">

		<div id="hero-section" class="hero-section container">
			<h1 class="hero-section__title">
				<span class="title-particle-1 title-particle">Nous sommes</span>
				<span class="title-particle-2 title-particle">BIG ensemble</span>
				<span class="title-particle-3 title-particle">une association qui mobilise</span>
				<span class="title-particle-4 title-particle">la force du collectif</span>
				<span class="title-particle-5 title-particle">pour un</span>
				<span class="title-particle-6 title-particle">impact a grande échelle</span>
				<span class="title-particle-7 title-particle">sur la</span>
				<span class="title-particle-8 title-particle">société et l'environnement</span>
			</h1>
		</div><!-- #hero-section -->

		<!--<div class="data-section">
			<?php
				foreach($list_prods as $prod):
					$product = $prod['label'];
					$url_fetch = $pre_url."&q=".urlencode($product)."&q_mode=simple";
					$ch = curl_init();
					
					try {
						curl_setopt($ch, CURLOPT_URL, $url_fetch);
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
							<h3 class="data-element__title"><?php echo $product?></h3>
							<p class="data-element__metric">
								<strong><?php echo $metric.":";?></strong>
								<?php echo $obj->metric;?>
							</p>
						</div>
			<?php
					
					else:
						echo "problem with retrieving data";
					endif;
				endforeach;
			?>
		</div>-->
		<!-- #data-section -->

		<div class="agenda-section agenda">
			<div class="agenda-container container">
			<h2 class="agenda-title">Agenda</h2>
			<div class="agenda-list">
				<div class="agenda-event">
					<div class="agenda-event__date">
						<p>09</p>
						<p>DEC</p>
					</div>
					<div class="agenda-event__details">
						<h3>salons & événements</h3>
						<p>Bilan zéro déchets et sensibilisation</p>
						<span>Paris</span>
					</div>
				</div>

				<div class="agenda-event">
					<div class="agenda-event__date">
						<p>25</p>
						<p>NOV</p>
					</div>
					<div class="agenda-event__details">
						<h3>chantier participatif</h3>
						<p>Bilan zéro déchets et sensibilisation</p>
						<span>Paris</span>
					</div>
				</div>

				<div class="agenda-event">
					<div class="agenda-event__date">
						<p>10</p>
						<p>FEV</p>
					</div>
					<div class="agenda-event__details">
						<h3>chantier participatif</h3>
						<p>Bilan zéro déchets et sensibilisation</p>
						<span>Paris</span>
					</div>
				</div>
				</div>
				<a class="agenda-cta" href="">tous les événements</a>
			</div>
		</div>

	</div><!-- #content -->
</div><!-- #primary -->
    
<?php get_footer();