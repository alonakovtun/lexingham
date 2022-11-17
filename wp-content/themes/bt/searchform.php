<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s" class="assistive-text visually-hidden"><?php _e( 'חפשו באתר', 'bt' ); ?></label>
	<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'חפשו באתר', 'bt' ); ?>" />
	<!--input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'bt' ); ?>" /-->
	<button type="submit" class="submit" name="submit" id="searchsubmit">
		<i class="fas fa-search"></i>
	</button>
</form>