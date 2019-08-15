<?php
$testimony_position = get_post_meta($post->ID, WEEBY_TESTIMONY_VAR_PREFIX.'position', true);
$testimony_posted = get_post_meta($post->ID, WEEBY_TESTIMONY_VAR_PREFIX.'posted', true);

$social_facebook = get_post_meta($post->ID, WEEBY_TESTIMONY_VAR_PREFIX.'social_facebook', true);
$social_twitter = get_post_meta($post->ID, WEEBY_TESTIMONY_VAR_PREFIX.'social_twitter', true);
$social_linkedin = get_post_meta($post->ID, WEEBY_TESTIMONY_VAR_PREFIX.'social_linkedin', true);
$social_youtube = get_post_meta($post->ID, WEEBY_TESTIMONY_VAR_PREFIX.'social_youtube', true);
$social_google_plus = get_post_meta($post->ID, WEEBY_TESTIMONY_VAR_PREFIX.'social_google_plus', true);

$testimony_ratings = get_post_meta($post->ID, WEEBY_TESTIMONY_VAR_PREFIX.'ratings', true);
	
	$testimony_rating_0_checked = ($testimony_ratings==0)?'checked':'';
	$testimony_rating_1_checked = ($testimony_ratings==1)?'checked':'';
	$testimony_rating_2_checked = ($testimony_ratings==2)?'checked':'';
	$testimony_rating_3_checked = ($testimony_ratings==3)?'checked':'';
	$testimony_rating_4_checked = ($testimony_ratings==4)?'checked':'';
	$testimony_rating_5_checked = ($testimony_ratings==5)?'checked':'';
	

?>


<div class="author-person-wrap">
	<div class="weeby-info-detail-wrap">
		<div class="form-group weeby-group-label">
			<div>Client /  Person Detail</div>
		</div>
		<div class="form-group">
			<div>Position Name / Industry</div>
			<div>
				<input type="text" name="<?php echo WEEBY_TESTIMONY_VAR_PREFIX.'position'; ?>" value="<?php echo $testimony_position; ?>" required />
				<small>Position of the person or industry name of the client.</small>
			</div>
		</div>
		<div class="form-group">
			<div>Date Rate</div>
			<div>
				<input type="date" name="<?php echo WEEBY_TESTIMONY_VAR_PREFIX.'posted'; ?>" value="<?php echo $testimony_posted; ?>" />
				<small>Testimony date acquired.</small>
			</div>
		</div>
	</div>
	
	<div>
		<div class="form-group weeby-group-label">
			<div>Social Networks</div>
		</div>
		<div class="form-group social-sites-wrap">
			<div class="facebook"><input type="text" name="<?php echo WEEBY_TESTIMONY_VAR_PREFIX.'social_facebook'; ?>" value="<?php echo $social_facebook; ?>" /></div>
			<div class="twitter"><input type="text" name="<?php echo WEEBY_TESTIMONY_VAR_PREFIX.'social_twitter'; ?>" value="<?php echo $social_twitter; ?>" /></div>
			<div class="linkedin"><input type="text" name="<?php echo WEEBY_TESTIMONY_VAR_PREFIX.'social_linkedin'; ?>" value="<?php echo $social_linkedin; ?>" /></div>
			<div class="youtube"><input type="text" name="<?php echo WEEBY_TESTIMONY_VAR_PREFIX.'social_youtube'; ?>" value="<?php echo $social_youtube; ?>" /></div>
			<div class="google-plus"><input type="text" name="<?php echo WEEBY_TESTIMONY_VAR_PREFIX.'social_google_plus'; ?>" value="<?php echo $social_google_plus; ?>" /></div>
		</div>

		
	</div>
	
	<div class="weeby-star-rating-wrap">
		<div class="form-group weeby-group-label">
			<div>Star Ratings</div>
		</div>
		<div class="form-group">
			<ul class="weeby-rating-list">
				<li>
					<input type="radio" name="<?php echo WEEBY_TESTIMONY_VAR_PREFIX.'ratings'; ?>" value="0" <?php echo $testimony_rating_0_checked; ?>  />
					<div class="star-rating"><?php echo Weeby_Testimony_Utilities_class::show_star_ratings(0); ?></div>
				</li>
				<li>
					<input type="radio" name="<?php echo WEEBY_TESTIMONY_VAR_PREFIX.'ratings'; ?>" value="1" <?php echo $testimony_rating_1_checked; ?>  />
					<div class="star-rating"><?php echo Weeby_Testimony_Utilities_class::show_star_ratings(1); ?></div>
				</li>
				<li>
					<input type="radio" name="<?php echo WEEBY_TESTIMONY_VAR_PREFIX.'ratings'; ?>" value="2" <?php echo $testimony_rating_2_checked; ?>  />
					<div class="star-rating"><?php echo Weeby_Testimony_Utilities_class::show_star_ratings(2); ?></div>
				</li>
				<li>
					<input type="radio" name="<?php echo WEEBY_TESTIMONY_VAR_PREFIX.'ratings'; ?>" value="3" <?php echo $testimony_rating_3_checked; ?>  />
					<div class="star-rating"><?php echo Weeby_Testimony_Utilities_class::show_star_ratings(3); ?></div>
				</li>
				<li>
					<input type="radio" name="<?php echo WEEBY_TESTIMONY_VAR_PREFIX.'ratings'; ?>" value="4" <?php echo $testimony_rating_4_checked; ?>  />
					<div class="star-rating"><?php echo Weeby_Testimony_Utilities_class::show_star_ratings(4); ?></div>
				</li>
				<li>
					<input type="radio" name="<?php echo WEEBY_TESTIMONY_VAR_PREFIX.'ratings'; ?>" value="5" <?php echo $testimony_rating_5_checked; ?>  />
					<div class="star-rating"><?php echo Weeby_Testimony_Utilities_class::show_star_ratings(5); ?></div>
				</li>
			</ul>
		</div>
	</div>
	
</div>

