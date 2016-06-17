<?php

/**
 * Extend Recent Comments Widget 
 *
 * Adds different formatting to the default WordPress Recent Comments Widget
 */
 
class Bw_widgets_recent_comments extends WP_Widget_Recent_Comments {
	
	function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = wp_cache_get('widget_recent_comments', 'widget');

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

 		extract($args, EXTR_SKIP);
 		$output = '';

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Comments' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
 			$number = 5;

		$comments = get_comments( apply_filters( 'widget_comments_args', array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish' ) ) );
		$output .= $before_widget;
		if ( $title )
			$output .= $before_title . $title . $after_title;

		$output .= '<ul id="recentcomments" class="bw-sidebar-posts">';
		if ( $comments ) {
			// Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
			$post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
			_prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

			foreach ( (array) $comments as $comment) {
				$output .= '<li class="recentcomments">';
				$output .= '<div class="thumb">';
				$output .= '<a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' . get_avatar($comment->user_id , 110) . '</a>';
				$output .= '</div>';
				$output .= '<div class="cont">';
				$output .= '<a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">';
				$output .= get_comment_author_link();
				$output .= '</a>';
				$output .= '<p>' . Bw::truncate( $comment->comment_content, 7 ) . '</p>';
				$output .= '</div>';
				$output .= '</li>';
			}
 		}
		$output .= '</ul>';
		$output .= $after_widget;

		echo $output;
		$cache[$args['widget_id']] = $output;
		wp_cache_set('widget_recent_comments', $cache, 'widget');
	}
	
}

?>