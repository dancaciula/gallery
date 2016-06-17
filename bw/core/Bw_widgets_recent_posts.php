<?php

/**
 * Extend Recent Posts Widget 
 *
 * Adds different formatting to the default WordPress Recent Posts Widget
 */
 
class Bw_widgets_recent_posts extends WP_Widget_Recent_Posts {
 
	function widget($args, $instance) {
	
		extract( $args );
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', BW_THEME) : $instance['title'], $instance, $this->id_base);
		
		if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
			$number = 10;
		}
		
		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if( $r->have_posts() ) :
			
			echo $before_widget;
			
			if( $title ) echo $before_title . $title . $after_title; ?>
			<ul class="bw-sidebar-posts">
				<?php while( $r->have_posts() ) : $r->the_post(); ?>				
				<li>
					
					<?php if( has_post_thumbnail() ): ?>
					<div class="thumb">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail( 'thumbnail' ); ?>
						</a>
					</div>
					<?php endif; ?>
					
					<div class="cont <?php if( !has_post_thumbnail() ) { echo ' no-thumb'; } ?>">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_title(); ?>
						</a>
						<p><?php echo Bw::truncate( get_the_excerpt(), 6 ); ?></p>
					</div>
					
				</li>
				<?php endwhile; ?>
			</ul>
			 
			<?php
			echo $after_widget;
		
		wp_reset_postdata();
		
		endif;
	}
}

?>