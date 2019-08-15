<div class="weeby-tstmnl item">
	<div class="item-info-wrap">
		
		<div class="col-info">
			<div class="testimonial-box">
				<span class="quote-open">&ldquo; </span>
					<?php echo $testimony_message; ?>
				<span class="quote-close">	&rdquo;</span>
			</div>
			<div class="rating-date-wrap">
				<div class="star-rating">
					<?php
					$range_rate = range(1, 5);
					foreach($range_rate as $rate){
						$colored = ($testimony_ratings<$rate)?'-o':'';
					?>
					<span class="star-value"><i class="fa fa-star<?php echo $colored; ?>"></i></span>
					<?php } ?>
				</div>
				<div class="testimonial-date"> <?php echo $testimony_posted; ?></div>
			</div>
			
		</div>
		
		<div class="col-info">
			
			<div class="profile-info">
				<div class="profile-name"> <?php echo $testimony_name; ?></div>
				<div class="profile-position"> <?php echo $testimony_position; ?></div>
				
				<div class="profile-social"><?php echo $socal_netword_sites_url; ?></div>
			</div>
			
			<div class="profile-avatar-wrap">
				<img src="<?php echo $testimony_image; ?>" alt="<?php echo $testimony_name; ?>" />
			</div>
		</div>
		
	</div>
</div>