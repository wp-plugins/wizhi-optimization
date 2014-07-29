<?php
/**
 * display pagination
 *
 * @Author: kriesi
 * @Link  : http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
 *
 * @uses  get_pagenum_link
 *
 * @since mx 1.0
 */

if ( ! function_exists( 'wizhi_pagination' ) ):

	function wizhi_pagination( $pages = '', $range = 5 ) {
		$showitems = ( $range * 2 ) + 1;

		global $paged;
		if ( empty( $paged ) ) {
			$paged = 1;
		}

		if ( $pages == '' ) {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if ( ! $pages ) {
				$pages = 1;
			}
		}

		if ( 1 != $pages ) {
			echo "<ul class=\"pure-paginator\"><li><span class='pure-button'>页 " . $paged . " / " . $pages . "</span></li>";
			if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
				echo "<li><a class='pure-button prev' href='" . get_pagenum_link( 1 ) . "'>首页</a></li>";
			}
			if ( $paged > 1 && $showitems < $pages ) {
				echo "<li><a class='pure-button next' href='" . get_pagenum_link( $paged - 1 ) . "'> < </a></li>";
			}

			for ( $i = 1; $i <= $pages; $i ++ ) {
				if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
					echo ( $paged == $i ) ? "<li><span class='pure-button pure-button-active'>" . $i . "</span></li>" : "<li><a class='pure-button' href='" . get_pagenum_link( $i ) . "' class=\"inactive\">" . $i . "</a></li>";
				}
			}

			if ( $paged < $pages ) {
				echo "<li><a class='pure-button next' href=\"" . get_pagenum_link( $paged + 1 ) . "\">></a></li>";
			}
			if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
				echo "<a class='pure-button' href='" . get_pagenum_link( $pages ) . "'>尾页</a>";
			}
			echo "</ul>\n";
		}
	}
endif;

?>