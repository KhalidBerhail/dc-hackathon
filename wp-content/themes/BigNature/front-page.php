<?php get_header(); 




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

		<section id="hero-section" class="hero-section">
			<h1 class="hero-section__title container">
				<span class="title-particle-1 title-particle">Nous sommes</span>
				<span class="title-particle-2 title-particle can-expand">
					BIG ensemble
					<span class="title-particle-2-expand expand"></span>
				</span>
				
				<span class="title-particle-3 title-particle">une association qui mobilise</span>
				<span class="title-particle-4 title-particle">
					la <span class="scale-up">force</span> 
				</span>
				<span class="title-particle-4 title-particle">
				du <span class="scale-up">collectif</span><i class="fa-solid fa-heart"></i>
					<span class="title-particle-4-expand expand">

						<div class="expand-content">
							<p>
								<span class="text-green">ensemble</span>, nous sommes plus
								<span class="text-red">fort.</span>
							</p>

							<div class="expand-img">
								<img src="<?php echo get_template_directory_uri();?>/images/png/humans-standing.png" alt="">
							</div>
						</div>
						
					</span>
				</span>
				<span class="title-particle-5 title-particle">pour un</span>
				<span class="title-particle-6 title-particle"><span class="scale-up">impact</span> a grande échelle</span>
				<span class="title-particle-7 title-particle">sur la</span>
				<span class="title-particle-8 title-particle">
					 
					<span class="particle-earth">
						société
						<i class="fa-solid fa-earth-americas"></i>
					</span>
					<span class="particle-rainbow">et l'environnement <i class="fa-solid fa-rainbow"></i> .</span>
				</span>
			</h1>
		</section><!-- #hero-section -->

		<section id="data-section" class="data-section">
			<div class="data-section-header data-header">
				
					<?php 
						$data_title = get_field('titre_section_projet');
						if($data_title) :
					?>
						<h2 class="data-header__title">	
							<?php echo $data_title; ?>
						</h2>
					<?php
						endif;
					?>
				
				<span class="data-header__rec"></span>
			</div>

			<div class="data-section-content container">
				<?php 
					$data_logo = get_field('logo_section_projet');
					if($data_logo) :
				?>
						<div class="data-content__logo">
							<img src="<?php echo esc_url($data_logo['url']); ?>" >
						</div>
				<?php
					endif;
				?>

				<?php 
					$data_intro = get_field('contenu_intro_projet');
					if($data_intro) :
				?>
						<div class="data-content__intro">
							<?php echo $data_intro; ?>
						</div>
				<?php
					endif;
				?>
				<div class="data-content__stats"></div>
				
			</div>
			
			<?php 
				$data_image = get_field('image_section_projet');
				if($data_image) :
			?>
					<div class="data-section__tree">
						<img src="<?php echo $data_image['url'];?>" alt="">
					</div>
			<?php
				endif;
			?>
		</section>
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

		<!--<div class="horizontal-section engagement engagement-section">
			<div class="engagement-back__img">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="790.454" height="1040.366" viewBox="0 0 790.454 1040.366">
					<defs>
						<filter id="Icon_awesome-leaf" x="0" y="0" width="790.454" height="1040.366" filterUnits="userSpaceOnUse">
						<feOffset dy="1" input="SourceAlpha"/>
						<feGaussianBlur stdDeviation="1.5" result="blur"/>
						<feFlood flood-opacity="0.161"/>
						<feComposite operator="in" in2="blur"/>
						<feComposite in="SourceGraphic"/>
						</filter>
					</defs>
					<g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Icon_awesome-leaf)">
						<path id="Icon_awesome-leaf-2" data-name="Icon awesome-leaf" d="M933.013,13.567c-9.567-17.443-36.9-18.141-48.346-1.675-52.959,75.214-147.773,122.1-256.082,122.1H491.916c-181.085,0-328,120.008-328,267.924,0,9.768,1.367,19.117,2.563,28.606,108.993-63.772,266.332-117.914,489.443-117.914,15.033,0,27.334,10.047,27.334,22.327s-12.3,22.327-27.334,22.327C226.438,357.263,44.328,572.3,4.01,653.1c-11.275,22.746,2.05,48.7,29.9,58.05,28.017,9.489,59.792-1.535,71.409-24.141,2.563-5.024,35.7-66.842,122.831-126.427,55.351,61.26,160.585,119.729,298.791,107.728C795.148,652.4,983.922,455.921,983.922,215.347c0-70.051-18.45-142.614-50.909-201.78Z" transform="translate(717.32 3.5) rotate(86)" fill="#dadfab" opacity="0.336"/>
					</g>
				</svg>
			</div>
			<div class="horizontal-container container">
				<div class="engagement-intro">
					<h2 class="engagement-intro__title">
						nos engagements
					</h2>
					<p class="engagement-intro__text">
						découvrez nos engagements 2022 et nos ambitions pour les années à venir.
					</p>
				</div>
				<div class="horizontal-scroll 2022-scroll">
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
					<div class="horizontal-scroll__item"></div>
				</div>
			</div>
		</div>-->

		<div class="horizontal">
      		<div id="panels" class="container horizontal-container horizontal-section engagement engagement-section">

				<!--Emptydiv-->
				<div></div>
				<!--Horizontal section intro-->
				<div class="engagement-intro">
					<h2 class="engagement-intro__title">
						nos engagements
					</h2>
					<p class="engagement-intro__text">
						découvrez nos engagements 2022 et nos ambitions pour les années à venir.
					</p>
					<div class="engagement-back__img">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="790.454" height="1040.366" viewBox="0 0 790.454 1040.366">
							<defs>
							<filter id="Icon_awesome-leaf" x="0" y="0" width="790.454" height="1040.366" filterUnits="userSpaceOnUse">
							<feOffset dy="1" input="SourceAlpha"/>
							<feGaussianBlur stdDeviation="1.5" result="blur"/>
							<feFlood flood-opacity="0.161"/>
							<feComposite operator="in" in2="blur"/>
							<feComposite in="SourceGraphic"/>
							</filter>
							</defs>
							<g transform="matrix(1, 0, 0, 1, 0, 0)" filter="url(#Icon_awesome-leaf)">
							<path id="Icon_awesome-leaf-2" data-name="Icon awesome-leaf" d="M933.013,13.567c-9.567-17.443-36.9-18.141-48.346-1.675-52.959,75.214-147.773,122.1-256.082,122.1H491.916c-181.085,0-328,120.008-328,267.924,0,9.768,1.367,19.117,2.563,28.606,108.993-63.772,266.332-117.914,489.443-117.914,15.033,0,27.334,10.047,27.334,22.327s-12.3,22.327-27.334,22.327C226.438,357.263,44.328,572.3,4.01,653.1c-11.275,22.746,2.05,48.7,29.9,58.05,28.017,9.489,59.792-1.535,71.409-24.141,2.563-5.024,35.7-66.842,122.831-126.427,55.351,61.26,160.585,119.729,298.791,107.728C795.148,652.4,983.922,455.921,983.922,215.347c0-70.051-18.45-142.614-50.909-201.78Z" transform="translate(717.32 3.5) rotate(86)" fill="#dadfab" opacity="0.336"/>
							</g>
						</svg>
					</div>
					<span class="engagement-intro__date">2022</span>
				</div>
				<!--/Horizontal section intro-->

				<!--Horizontal section panels-->
				<div id="panels-container" class="horizontal-scroll 2022-scroll" style="width: 500%;">
				
					<?php 
						$engagements = get_field('engagements');
						if($engagements) : 
							$i=0;
							$eng_count = count($engagements)/2;
							while($i<$eng_count) :
								$i++;
								$img_key = 'image_engagement_'.$i;
								$img_url = $engagements[$img_key]['url'];
					?>
					
						<div id="panel-<?php echo $i;?>" class="horizontal-scroll__item">
							<img src="<?php echo esc_url($img_url)?>" alt="">
						</div>
					<?php
							endwhile;
						endif;
					?>

					
				</div>
				<!--/Horizontal section panels-->
      		</div>
		</div>

		<section class="agenda-section agenda">
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
				<a class="agenda-cta" href="">tous les événements <i class="fa-solid fa-turn-up"></i> </a>
			</div>
		</section>

		<!-- -------------- OUR TREES --------------  -->
		
		<section class="ourtrees-section ourtrees">
			<div class="ourtrees-forest">
				<div class="ourtrees-tree">
					<div class="ourtrees-title">
						<div class="ourtrees-highlight"> </div>
						<span class="ourtrees-text">nos arbres <br/>en france</span>
					</div>
				</div>
			</div>
			<div class="ourtrees-map">
				<img class="ourtrees-carte" src="<?php echo get_template_directory_uri();?>/images/png/carte.png" alt="foret"" alt="Carte de France">
				<div class="ourtrees-legend">
					<div class="ourtrees-legend-container">
						<img class="ourtrees-legend-leaf" src="<?php echo get_template_directory_uri();?>/images/png/white_leaf.png" alt="feuille blanche">
						<span class="ourtrees-legend-text">arbres plantés</span>
					</div>
					<div class="ourtrees-legend-container">
						<img class="ourtrees-legend-leaf" src="<?php echo get_template_directory_uri();?>/images/png/green_leaf.png" alt="feuille verte">
						<span class="ourtrees-legend-text">future plantation</span>
					</div>
				</div>
			</div>
		</section>

		<!-- -------------- JOIN US --------------  -->
		<section class="joinus-section joinus">
			<div class="joinus-box">
				<div class="joinus-box-one">
						<img class="site-footer-illustration mobile-ble" src="<?php echo get_template_directory_uri();?>/images/png/ble.png" alt="blé">
						<img class="site-footer-illustration mobile-ble" src="<?php echo get_template_directory_uri();?>/images/png/ble.png" alt="blé">
						<img class="site-footer-illustration" src="<?php echo get_template_directory_uri();?>/images/png/ble.png" alt="blé">
						<img class="site-footer-illustration mobile-ble" src="<?php echo get_template_directory_uri();?>/images/png/ble.png" alt="blé">
					</div>
				</div>
				
				<div class="joinus-box-two">
					<img class="site-footer-illustration mobile-ble" src="<?php echo get_template_directory_uri();?>/images/png/ble.png" alt="blé">
					<div>
						<div class="joinus-highlight"> </div>
						<div class="joinus-text">rejoignez-nous !</div>
					</div>
					<img class="site-footer-illustration mobile-ble" src="<?php echo get_template_directory_uri();?>/images/png/ble.png" alt="blé">
				</div>

				<div class="joinus-box-three">
					<button class="joinus-button">
						devenir membre
					</button>
				</div>
			</div>
		</section>

	</div><!-- #content -->
</div><!-- #primary -->
    
<?php get_footer();
