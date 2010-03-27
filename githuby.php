<?php
/*
Plugin Name: GitHuby - All in one github plugin.
Plugin URI: http://github url
Description: This does lots of things, just not yet.
Author: Patrick Forringer
Version: 0.1
Author URI: http://patrick.forringer.com
*/

define( GitHuby_DEBUG, true );

define( GitHuby_VER, 0.1);

/* Set constant path to the GitHuby plugin directory. */
define( GitHuby_DIR, plugin_dir_path( __FILE__ ) );

/* Set constant path to the GitHuby plugin URL. */
define( GitHuby_URL, plugin_dir_url( __FILE__ ) );

include GitHuby_DIR.'lib/phpGitHubApi.php';

class githuby_plugin
{

	function __construct()
	{

		// get plugin options for connecting.
		$options = array(
			'login'       => get_option('github_user') ,
			'token'       => get_option('github_token'),
			'debug'       => GitHuby_DEBUG
		);

		$this->gh = new phpGitHubApi( $options );

		// plugin init
		$this->init();
	}

	private function init()
	{

		if (is_admin()) {
			// Create menus and options
			add_action('admin_menu', array( &$this, 'ghby_create_menu'));
			// instalation and adeactivation hooks
			register_activation_hook( __FILE__, array( &$this, 'install') );
			register_deactivation_hook( __FILE__, array( &$this, 'uninstall') );
		}

	}

	// --------------------------------------------------------
	// Install and Uninstall routines
	//

	private function install()
	{

	}

	private function uninstall()
	{

	}

	// --------------------------------------------------------
	// Admin Menus
	//

	function ghby_create_menu()
	{
		//create new top-level menu
		add_menu_page( 'Githuby Settinzzz', 'Githuby', 'administrator', __FILE__, array( &$this, 'ghby_settings_page' ), plugins_url('/img/github.png', __FILE__) );

		//call register settings function
		add_action( 'admin_init', array( &$this, 'register_settings' ) );
	}

	function register_settings()
	{
		//register our settings
		register_setting( 'ghby-settings-group', 'github_user' );
		register_setting( 'ghby-settings-group', 'github_token' );
		//register_setting( 'ghby-settings-group', 'option_etc' );
	}

	function ghby_settings_page()
	{
?>
		<div class="wrap">
		<h2>Githuby Options</h2>

		<form method="post" action="options.php">
		    <?php settings_fields( 'ghby-settings-group' ); ?>
		    <table class="form-table">
		        <tr valign="top">
		        <th scope="row"><?php _e('Github Username') ?></th>
		        <td><input type="text" name="github_user" value="<?php echo get_option('github_user'); ?>" /></td>
		        </tr>

		        <tr valign="top">
		        <th scope="row"><?php _e('Github Token') ?></th>
		        <td><input type="text" name="github_token" value="<?php echo get_option('github_token'); ?>" /></td>
		        </tr>
		    </table>

		    <p class="submit">
		    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		    </p>

		</form>
		</div><?php
	}

	// --------------------------------------------------------
	//
	//

	function test()
	{

	}

}

// Start all the crazyness!
new githuby_plugin();