<?php
/**
 * WP-Members User API Functions
 * 
 * This file is part of the WP-Members plugin by Chad Butler
 * You can find out more about this plugin at https://rocketgeek.com
 * Copyright (c) 2006-2018  Chad Butler
 * WP-Members(tm) is a trademark of butlerblog.com
 *
 * @package WP-Members
 * @subpackage WP-Members API Functions
 * @author Chad Butler 
 * @copyright 2006-2018
 */

/**
 * Checks if user has a particular role.
 *
 * Utility function to check if a given user has a specific role. Users can
 * have multiple roles assigned, so it checks the role array rather than using
 * the incorrect method of current_user_can( 'role_name' ). The function can
 * check the role of the current user (default) or a specific user (if $user_id
 * is passed).
 *
 * @since 3.1.1
 * @since 3.1.6 Include accepting an array of roles to check.
 * @since 3.1.9 Return false if user is not logged in.
 * @since 3.2.0 Change return false to not logged in AND no user id.
 *
 * @global object        $current_user Current user object.
 * @global object        $wpmem        WP_Members object.
 * @param  string|array  $role         Slug or array of slugs of the role being checked.
 * @param  int           $user_id      ID of the user being checked (optional).
 * @return boolean       $has_role     True if user has the role, otherwise false.
 */
function wpmem_user_has_role( $role, $user_id = false ) {
	if ( ! is_user_logged_in() && ! $user_id ) {
		return false;
	}
	global $current_user, $wpmem;
	$has_role = false;
	if ( $user_id ) {
		$user = get_userdata( $user_id );
	}
	if ( is_user_logged_in() && ! $user_id ) {
		$user = ( isset( $current_user ) ) ? $current_user : wp_get_current_user();
	}
	if ( is_array( $role ) ) {
		foreach ( $role as $r ) {
			if ( in_array( $r, $user->roles ) ) {
				return true;
			}
		}
	} else {
		return ( in_array( $role, $user->roles ) ) ? true : $has_role;
	}
}

/**
 * Checks if a user has a given meta value.
 *
 * @since 3.1.8
 *
 * @global object  $wpmem     WP_Members object.
 * @param  string  $meta      Meta key being checked.
 * @param  string  $value     Value the meta key should have (optional).
 * @param  int     $user_id   ID of the user being checked (optional).
 * @return boolean $has_meta  True if user has the meta value, otherwise false.
 */
function wpmem_user_has_meta( $meta, $value = false, $user_id = false ) {
	global $wpmem;
	$user_id = ( $user_id ) ? $user_id : get_current_user_id();
	$has_meta = false;
	$user_value = get_user_meta( $user_id, $meta, true );
	if ( $value ) {
		$has_meta = ( $user_value == $value ) ? true : $has_meta;
	} else {
		$has_meta = ( $value ) ? true : $has_meta;
	}
	return $has_meta;
}

/**
 * Checks if a user is activated.
 *
 * @since 3.1.7
 * @since 3.2.3 Now a wrapper for WP_Members_Users::is_user_activated().
 *
 * @global object $wpmem
 * @param  int    $user_id
 * @return bool
 */
function wpmem_is_user_activated( $user_id = false ) {
	global $wpmem;
	return $wpmem->user->is_user_activated( $user_id );
}

/**
 * Gets an array of the user's registration data.
 *
 * Returns an array keyed by meta keys of the user's registration data for
 * all fields in the WP-Members Fields.  Returns the current user unless
 * a user ID is specified.
 *
 * @since 3.2.0
 *
 * @global object  $wpmem
 * @param  integer $user_id
 * @return array   $user_fields
 */
function wpmem_user_data( $user_id = false ) {
	global $wpmem;
	return $wpmem->user_fields( $user_id );
}

/**
 * Updates a user's role.
 *
 * This is a wrapper for $wpmem->update_user_role(). It can add a role to a
 * user, change or remove the user's role. If no action is specified it will
 * change the role.
 *
 * @since 3.2.0
 *
 * @global object  $wpmem
 * @param  integer $user_id (required)
 * @param  string  $role    (required)
 * @param  string  $action  (optional add|remove|set default:set)
 */
function wpmem_update_user_role( $user_id, $role, $action = 'set' ) {
	global $wpmem;
	$wpmem->user->update_user_role( $user_id, $role, $action );
}

/**
 * A function for checking user access criteria.
 *
 * @since 3.2.0
 * @since 3.2.3 Reversed order of arguments.
 *
 * @param  mixed   $product 
 * @param  integer $user_id User ID (optional|default: false).
 * @return boolean $access  If user has access.
 */
function wpmem_user_has_access( $product, $user_id = false ) {
	global $wpmem; 
	return $wpmem->user->has_access( $product, $user_id );
}

/**
 * Sets product access for a user.
 *
 * @since 3.2.3
 *
 * @global object $wpmem
 * @param  string $product
 * @param  int    $user_id
 * @return bool   $result
 */
function wpmem_set_user_product( $product, $user_id = false ) {
	global $wpmem;
	return $wpmem->user->set_user_product( $product, $user_id );
}

/**
 * Removes product access for a user.
 *
 * @since 3.2.3
 *
 * @global object $wpmem
 * @param  string $product
 * @param  int    $user_id
 */
function wpmem_remove_user_product( $product, $user_id = false ) {
	global $wpmem;
	$wpmem->user->remove_user_product( $product, $user_id );
	return;
}

/**
 * Sets a user as logged in.
 *
 * @since 3.2.3
 *
 * @global object $wpmem
 * @param  int    $user_id
 */
function wpmem_set_as_logged_in( $user_id ) {
	global $wpmem;
	$wpmem->user->set_as_logged_in( $user_id );
}
// End of file.