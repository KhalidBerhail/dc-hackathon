	</div><!-- #main -->
	
	<footer id="site-footer" class="site-footer-section site-footer">

		<div class="site-footer__content">
		
			<div class="site-footer-wrapper">
				<div class="site-footer-wrapped-one">
					<img class="site-footer-illustration" src="<?php echo get_template_directory_uri();?>/images/png/vache.png" alt="vache">
				</div>
				<div class="site-footer-wrapped-two">
					<img class="site-footer-illustration" src="<?php echo get_template_directory_uri();?>/images/png/vache.png" alt="vache">
				</div>
				<div class="site-footer-wrapped-three">
					<img class="site-footer-illustration" src="<?php echo get_template_directory_uri();?>/images/png/vache.png" alt="vache">
				</div>
				<div class="site-footer-wrapped-four">
					<img class="site-footer-illustration" src="<?php echo get_template_directory_uri();?>/images/png/vache.png" alt="vache">
				</div>
				<div class="site-footer-wrapped-five">
					<img class="site-footer-logo" src="<?php echo get_template_directory_uri();?>/images/png/Logo_BigEnsemble_Blanc.png" alt="Logo BigEnsemble">
				</div>
				<div class="site-footer-wrapped-six">
					<img class="site-footer-illustration" src="<?php echo get_template_directory_uri();?>/images/png/vache.png" alt="vache">
				</div>
				<div class="site-footer-wrapped-seven">
					<img class="site-footer-illustration" src="<?php echo get_template_directory_uri();?>/images/png/vache.png" alt="vache">
				</div>
				<div class="site-footer-wrapped-eight">
					<?php 
						$socials = get_field('reseaux_socieaux');
						if($socials) :
							$inc=0;
							$soc_count = count($socials)/2;
							while($inc<$soc_count) :
								$inc++;
								$rs_val_key = 'reseau_'.$inc ;
								$rs_url_key = 'lien_reseau_'.$inc;
								$rs_val = $socials[$rs_val_key];
								$rs_url = $socials[$rs_url_key];
					?>

								<a class="site-footer__link" href="<?php echo $rs_url?>" target="_blank">
									<i class="fa-brands fa-<?php echo $rs_val; ?>"></i>
								</a>
					<?php
							endwhile;
						endif;
					?>
				</div>
				<div class="site-footer-wrapped-nine">
					<img class="site-footer-illustration" src="<?php echo get_template_directory_uri();?>/images/png/vache.png" alt="vache">
				</div>
			</div>
			
		</div>

		<?php wp_footer(); ?>

	</footer>
    
</body>
</html>