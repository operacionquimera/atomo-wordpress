<?php

// to include in functions.php
function the_breadcrumb($sep = ' / ') {

	if ( is_front_page() ) {
		return false;
	}

	// Start the breadcrumb with a link to your homepage
	echo '<div class="breadcrumbs">';
	echo '<a href="' . get_option( 'home' ) . '"></a>';
	echo $sep;

	// Check if the current page is a category, an archive or a single page. If so show the category or archive name.
	if (is_category() || is_single() ) {
		the_category(' / ');
	} elseif ( is_archive() || is_single() ) {
		if ( is_day() ) {
			printf( __( '%s', 'atomo' ), get_the_date() );
		} elseif ( is_month() ) {
			printf( __( '%s', 'atomo' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'atomo' ) ) );
		} elseif ( is_year() ) {
			printf( __( '%s', 'atomo' ), get_the_date( _x( 'Y', 'yearly archives date format', 'atomo' ) ) );
		} else {
			_e( 'Blog Archives', 'atomo' );
		}
	}

	// If the current page is a single post, show its title with the separator
	if ( is_single() ) {
		echo $sep;
		the_title();
	}

	// If the current page is a static page, show its title.
	if ( is_page() ) {
		echo the_title();
	}

	// if you have a static page assigned to be you posts list page. It will find the title of the static page and display it. i.e Home >> Blog
	if ( is_home() ) {
		global $post;
		$page_for_posts_id = get_option( 'page_for_posts' );
		if ( $page_for_posts_id ) {
			$post = get_page( $page_for_posts_id );
			setup_postdata($post);
			the_title();
			rewind_posts();
		}
	}

	echo '</div>';
}