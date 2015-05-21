<?php
/*
 * Plugin Name: User Generate Password
 * Plugin URI: http://www.solagirl.net/wordpress-user-generate-password.html
 * Description: Let user enter password instead of generated by WordPress when sign up.用户注册时可以输入密码。
 * Version: 1.0
 * Author: Sola
 * Author URI: http://www.solagirl.net
*/

/* 
 * All credit goes to http://thematosoup.com 
 *
 * Original code is from http://thematosoup.com/development/allow-users-set-password-wordpress-registration/
 */

/*
 * Add Password, Repeat Password and Are You Human fields to WordPress registration form  http://wp.me/p1Ehkq-gn
 */


add_action('init', 'ugp_textdomain');
function ugp_textdomain() {
	load_plugin_textdomain('ugp-domain', false, 'user-generate-password');
}
add_action( 'register_form', 'ugp_show_extra_register_fields' );
function ugp_show_extra_register_fields(){
	?>
	<p>
	<label for="password"><?php _e( 'Password', 'ugp-domain' );?><br/>
	<input id="password" class="input" type="password" tabindex="30" size="25" value="" name="password" />
	</label>
	</p>
	<p>
	<label for="repeat_password"><?php _e( 'Repeat password', 'ugp-domain' );?><br/>
	<input id="repeat_password" class="input" type="password" tabindex="40" size="25" value="" name="repeat_password" />
	</label>
	</p>
	<p>
	<label for="are_you_human" style="font-size:12px"><?php _e( 'Sorry, but we must check if you are human. What is the name of website you are registering for?' , 'ugp-domain' ); ?><br/>
	<input id="are_you_human" class="input" type="text" tabindex="40" size="25" value="" name="are_you_human" />
	</label>
	</p>
	<?php
}

/*
 * Check the form for errors
 */
add_action( 'register_post', 'ugp_check_extra_register_fields', 10, 3 );
function ugp_check_extra_register_fields($login, $email, $errors) {
	if ( $_POST['password'] !== $_POST['repeat_password'] ) {
		$errors->add( 'passwords_not_matched', __("<strong>ERROR</strong>: Passwords must match", 'ugp-domain' ) );
	}
	if ( strlen( $_POST['password'] ) < 8 ) {
		$errors->add( 'password_too_short', __("<strong>ERROR</strong>: Passwords must be at least eight characters long", 'ugp-domain' ) );
	}
	if ( $_POST['are_you_human'] !== get_bloginfo( 'name' ) ) {
		$errors->add( 'not_human', __("<strong>ERROR</strong>: Your name is Bot? James Bot? Check bellow the form, there's a Back to [sitename] link.", 'ugp-domain' ) );
	}
}

/*
 * Storing WordPress user-selected password into database on registration
 */

add_action( 'user_register', 'ugp_register_extra_fields', 100 );
function ugp_register_extra_fields( $user_id ){
	$userdata = array();
	
	$userdata['ID'] = $user_id;
	if ( $_POST['password'] !== '' ) {
		$userdata['user_pass'] = $_POST['password'];
	}
	$new_user_id = wp_update_user( $userdata );
}

/*
 * Editing WordPress registration confirmation message
 */

add_filter( 'gettext', 'ugp_edit_password_email_text',20, 3 );
function ugp_edit_password_email_text ( $translated_text, $untranslated_text, $domain ) {
	if(in_array($GLOBALS['pagenow'], array('wp-login.php'))){
		if ( $untranslated_text == 'A password will be e-mailed to you.' ) {
			$translated_text = __( 'If you leave password fields empty one will be generated for you. Password must be at least eight characters long.', 'ugp-domain' );
		}
		if( $untranslated_text == 'Registration complete. Please check your e-mail.' ) {
			$translated_text = __( 'Registration complete. Please sign in or check your e-mail.', 'ugp-domain' );
		}
	}
	return $translated_text;
}
?>