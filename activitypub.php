<?php
/**
 * Plugin Name: ActivityPub
 * Plugin URI: https://github.com/pfefferle/wordpress-activitypub/
 * Description: The ActivityPub protocol is a decentralized social networking protocol based upon the ActivityStreams 2.0 data format.
 * Version: 4.1.1
 * Author: Matthias Pfefferle & Automattic
 * Author URI: https://automattic.com/
 * License: MIT
 * License URI: http://opensource.org/licenses/MIT
 * Requires PHP: 7.0
 * Text Domain: activitypub
 * Domain Path: /languages
 *
 * @package Activitypub
 */

namespace Activitypub;

use WP_CLI;

require_once __DIR__ . '/includes/compat.php';
require_once __DIR__ . '/includes/functions.php';

\define( 'ACTIVITYPUB_PLUGIN_VERSION', '4.1.1' );

/**
 * Initialize the plugin constants.
 */
\defined( 'ACTIVITYPUB_REST_NAMESPACE' ) || \define( 'ACTIVITYPUB_REST_NAMESPACE', 'activitypub/1.0' );
\defined( 'ACTIVITYPUB_EXCERPT_LENGTH' ) || \define( 'ACTIVITYPUB_EXCERPT_LENGTH', 400 );
\defined( 'ACTIVITYPUB_NOTE_LENGTH' ) || \define( 'ACTIVITYPUB_NOTE_LENGTH', 400 );
\defined( 'ACTIVITYPUB_SHOW_PLUGIN_RECOMMENDATIONS' ) || \define( 'ACTIVITYPUB_SHOW_PLUGIN_RECOMMENDATIONS', true );
\defined( 'ACTIVITYPUB_MAX_IMAGE_ATTACHMENTS' ) || \define( 'ACTIVITYPUB_MAX_IMAGE_ATTACHMENTS', 3 );
\defined( 'ACTIVITYPUB_HASHTAGS_REGEXP' ) || \define( 'ACTIVITYPUB_HASHTAGS_REGEXP', '(?:(?<=\s)|(?<=<p>)|(?<=<br>)|^)#([A-Za-z0-9_]+)(?:(?=\s|[[:punct:]]|$))' );
\defined( 'ACTIVITYPUB_USERNAME_REGEXP' ) || \define( 'ACTIVITYPUB_USERNAME_REGEXP', '(?:([A-Za-z0-9\._-]+)@((?:[A-Za-z0-9_-]+\.)+[A-Za-z]+))' );
\defined( 'ACTIVITYPUB_URL_REGEXP' ) || \define( 'ACTIVITYPUB_URL_REGEXP', '(https?:|www\.)\S+[\w\/]' );
\defined( 'ACTIVITYPUB_CUSTOM_POST_CONTENT' ) || \define( 'ACTIVITYPUB_CUSTOM_POST_CONTENT', "[ap_title type=\"html\"]\n\n[ap_content]\n\n[ap_hashtags]" );
\defined( 'ACTIVITYPUB_AUTHORIZED_FETCH' ) || \define( 'ACTIVITYPUB_AUTHORIZED_FETCH', false );
\defined( 'ACTIVITYPUB_DISABLE_REWRITES' ) || \define( 'ACTIVITYPUB_DISABLE_REWRITES', false );
\defined( 'ACTIVITYPUB_DISABLE_INCOMING_INTERACTIONS' ) || \define( 'ACTIVITYPUB_DISABLE_INCOMING_INTERACTIONS', false );
// Disable reactions like `Like` and `Announce` by default.
\defined( 'ACTIVITYPUB_DISABLE_REACTIONS' ) || \define( 'ACTIVITYPUB_DISABLE_REACTIONS', true );
\defined( 'ACTIVITYPUB_DISABLE_OUTGOING_INTERACTIONS' ) || \define( 'ACTIVITYPUB_DISABLE_OUTGOING_INTERACTIONS', false );
\defined( 'ACTIVITYPUB_SHARED_INBOX_FEATURE' ) || \define( 'ACTIVITYPUB_SHARED_INBOX_FEATURE', false );
\defined( 'ACTIVITYPUB_SEND_VARY_HEADER' ) || \define( 'ACTIVITYPUB_SEND_VARY_HEADER', false );
\defined( 'ACTIVITYPUB_DEFAULT_OBJECT_TYPE' ) || \define( 'ACTIVITYPUB_DEFAULT_OBJECT_TYPE', 'wordpress-post-format' );

/*
 * Mastodon HTML sanitizer.
 *
 * @see https://docs.joinmastodon.org/spec/activitypub/#sanitization
 */
\define(
	'ACTIVITYPUB_MASTODON_HTML_SANITIZER',
	array(
		'p'          => array(),
		'span'       => array( 'class' ),
		'br'         => array(),
		'a'          => array( 'href', 'rel', 'class' ),
		'del'        => array(),
		'pre'        => array(),
		'code'       => array(),
		'em'         => array(),
		'strong'     => array(),
		'b'          => array(),
		'i'          => array(),
		'u'          => array(),
		'ul'         => array(),
		'ol'         => array( 'start', 'reversed' ),
		'li'         => array( 'value' ),
		'blockquote' => array(),
		'h1'         => array(),
		'h2'         => array(),
		'h3'         => array(),
		'h4'         => array(),
	)
);

// Define Actor-Modes for the plugin.
\define( 'ACTIVITYPUB_ACTOR_MODE', 'actor' );
\define( 'ACTIVITYPUB_BLOG_MODE', 'blog' );
\define( 'ACTIVITYPUB_ACTOR_AND_BLOG_MODE', 'actor_blog' );

// Post visibility constants.
\define( 'ACTIVITYPUB_CONTENT_VISIBILITY_PUBLIC', '' );
\define( 'ACTIVITYPUB_CONTENT_VISIBILITY_QUIET_PUBLIC', 'quiet_public' );
\define( 'ACTIVITYPUB_CONTENT_VISIBILITY_LOCAL', 'local' );

// Plugin related constants.
\define( 'ACTIVITYPUB_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
\define( 'ACTIVITYPUB_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
\define( 'ACTIVITYPUB_PLUGIN_FILE', ACTIVITYPUB_PLUGIN_DIR . basename( __FILE__ ) );
\define( 'ACTIVITYPUB_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Initialize REST routes.
 */
function rest_init() {
	Rest\Actors::init();
	Rest\Outbox::init();
	Rest\Inbox::init();
	Rest\Followers::init();
	Rest\Following::init();
	Rest\Webfinger::init();
	Rest\Comment::init();
	Rest\Server::init();
	Rest\Collection::init();
	Rest\Interaction::init();

	// Load NodeInfo endpoints only if blog is public.
	if ( is_blog_public() ) {
		Rest\NodeInfo::init();
	}
}
\add_action( 'rest_api_init', __NAMESPACE__ . '\rest_init' );

/**
 * Initialize plugin.
 */
function plugin_init() {
	\add_action( 'init', array( __NAMESPACE__ . '\Migration', 'init' ) );
	\add_action( 'init', array( __NAMESPACE__ . '\Activitypub', 'init' ) );
	\add_action( 'init', array( __NAMESPACE__ . '\Activity_Dispatcher', 'init' ) );
	\add_action( 'init', array( __NAMESPACE__ . '\Handler', 'init' ) );
	\add_action( 'init', array( __NAMESPACE__ . '\Admin', 'init' ) );
	\add_action( 'init', array( __NAMESPACE__ . '\Hashtag', 'init' ) );
	\add_action( 'init', array( __NAMESPACE__ . '\Mention', 'init' ) );
	\add_action( 'init', array( __NAMESPACE__ . '\Health_Check', 'init' ) );
	\add_action( 'init', array( __NAMESPACE__ . '\Scheduler', 'init' ) );
	\add_action( 'init', array( __NAMESPACE__ . '\Comment', 'init' ) );
	\add_action( 'init', array( __NAMESPACE__ . '\Link', 'init' ) );

	if ( site_supports_blocks() ) {
		\add_action( 'init', array( __NAMESPACE__ . '\Blocks', 'init' ) );
	}

	$debug_file = __DIR__ . '/includes/debug.php';
	if ( \WP_DEBUG && file_exists( $debug_file ) && is_readable( $debug_file ) ) {
		require_once $debug_file;
		Debug::init();
	}
}
\add_action( 'plugins_loaded', __NAMESPACE__ . '\plugin_init' );


/**
 * Class Autoloader.
 */
\spl_autoload_register(
	function ( $full_class ) {
		$base_dir = __DIR__ . '/includes/';
		$base     = 'Activitypub\\';

		if ( strncmp( $full_class, $base, strlen( $base ) ) === 0 ) {
			$maybe_uppercase = str_replace( $base, '', $full_class );
			$class           = strtolower( $maybe_uppercase );
			// All classes should be capitalized. If this is instead looking for a lowercase method, we ignore that.
			if ( $maybe_uppercase === $class ) {
				return;
			}

			if ( false !== strpos( $class, '\\' ) ) {
				$parts    = explode( '\\', $class );
				$class    = array_pop( $parts );
				$sub_dir  = strtr( implode( '/', $parts ), '_', '-' );
				$base_dir = $base_dir . $sub_dir . '/';
			}

			$filename = 'class-' . strtr( $class, '_', '-' );
			$file     = $base_dir . $filename . '.php';

			if ( file_exists( $file ) && is_readable( $file ) ) {
				require_once $file;
			} else {
				// translators: %s is the class name.
				$message = sprintf( esc_html__( 'Required class not found or not readable: %s', 'activitypub' ), esc_html( $full_class ) );
				Debug::write_log( $message );
				\wp_die( $message ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
);

/**
 * Add plugin settings link.
 *
 * @param array $actions The current actions.
 */
function plugin_settings_link( $actions ) {
	$settings_link   = array();
	$settings_link[] = \sprintf(
		'<a href="%1s">%2s</a>',
		\menu_page_url( 'activitypub', false ),
		\__( 'Settings', 'activitypub' )
	);

	return \array_merge( $settings_link, $actions );
}
\add_filter( 'plugin_action_links_' . ACTIVITYPUB_PLUGIN_BASENAME, __NAMESPACE__ . '\plugin_settings_link' );

\register_activation_hook(
	__FILE__,
	array(
		__NAMESPACE__ . '\Activitypub',
		'activate',
	)
);

\register_deactivation_hook(
	__FILE__,
	array(
		__NAMESPACE__ . '\Activitypub',
		'deactivate',
	)
);

\register_uninstall_hook(
	__FILE__,
	array(
		__NAMESPACE__ . '\Activitypub',
		'uninstall',
	)
);

// Load integrations.
require_once __DIR__ . '/integration/load.php';

/**
 * `get_plugin_data` wrapper.
 *
 * @deprecated 4.2.0 Use `get_plugin_data` instead.
 *
 * @param array $default_headers Optional. The default plugin headers. Default empty array.
 * @return array The plugin metadata array.
 */
function get_plugin_meta( $default_headers = array() ) {
	_deprecated_function( __FUNCTION__, '4.2.0', 'get_plugin_data' );

	if ( ! $default_headers ) {
		$default_headers = array(
			'Name'        => 'Plugin Name',
			'PluginURI'   => 'Plugin URI',
			'Version'     => 'Version',
			'Description' => 'Description',
			'Author'      => 'Author',
			'AuthorURI'   => 'Author URI',
			'TextDomain'  => 'Text Domain',
			'DomainPath'  => 'Domain Path',
			'Network'     => 'Network',
			'RequiresWP'  => 'Requires at least',
			'RequiresPHP' => 'Requires PHP',
			'UpdateURI'   => 'Update URI',
		);
	}

	return \get_file_data( __FILE__, $default_headers, 'plugin' );
}

/**
 * Plugin Version Number used for caching.
 *
 * @deprecated 4.2.0 Use constant ACTIVITYPUB_PLUGIN_VERSION directly.
 */
function get_plugin_version() {
	_deprecated_function( __FUNCTION__, '4.2.0', 'ACTIVITYPUB_PLUGIN_VERSION' );

	return ACTIVITYPUB_PLUGIN_VERSION;
}

// Check for CLI env, to add the CLI commands.
if ( defined( 'WP_CLI' ) && WP_CLI ) {
	WP_CLI::add_command(
		'activitypub',
		'\Activitypub\Cli',
		array(
			'shortdesc' => 'ActivityPub related commands to manage plugin functionality and the federation of posts and comments.',
		)
	);
}
