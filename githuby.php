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

include( GitHuby_DIR.'lib/phpGitHubApi.php' );

class githuby{
	
	function __construct( $gh_options ){
		$this->gh = new phpGitHubApiRequest( $gh_options );
		$this->gh-api = new phpGitHubApi();
	}
	
	function test(){
	
	}
	
}

$options = array(
  'url'         => 'http://github.com/api/v2/:format/:path',
  'format'      => 'json',
  'user_agent'  => 'php-github-api (http://github.com/ornicar/php-github-api)',
  'http_port'   => 80,
  'timeout'     => 20,
  'login'       => null,
  'token'       => null,
  'debug'       => GitHuby_DEBUG
);
  
new githuby( $options );
