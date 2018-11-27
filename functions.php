<?php

/**
 * Theme basics.
 */

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function _test_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

	}
	add_action( 'after_setup_theme', '_test_setup' );



	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function _test_content_width() {
		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( '_test_content_width', 1200 );
	}
	add_action( 'after_setup_theme', '_test_content_width', 0 );



	/**
	 * Enqueue scripts and styles.
	 */
	function _test_scripts() {
		wp_enqueue_style( '_test-style', get_stylesheet_uri() );
	}
	add_action( 'wp_enqueue_scripts', '_test_scripts' );



/**
 * WebMan Amplifier plugin.
 */

	/**
	 * Testing metabox WYSIWYG editor.
	 */
	if ( function_exists( 'wma_meta_option' ) ) {

		// Admin only.
		if ( function_exists( 'wma_add_meta_box' ) ) {

			function _test_wma_metabox( $fields = array() ) {

				// Tab: WYSIWYG test

					$fields[] = array(
						'type'  => 'section-open',
						'id'    => 'wysiwyg-test',
						'title' => 'WYSIWYG test',
					);

					$desc  = 'This text should display on top of post content in a blue box. ';
					$desc .= 'We are testing for <a href="https://github.com/WordPress/gutenberg/issues/7176">Gutenberg compatibility here</a>. ';

					$fields[] = array(
						'type'        => 'textarea',
						'id'          => 'wysiwyg',
						'label'       => 'WYSIWYG test <br><br><small>' . $desc . '</small>',
						'description' => $desc,
						'editor'      => true,
					);

					$fields[] = array(
						'type' => 'section-close',
					);

				return $fields;
			}

			wma_add_meta_box( array(
				'fields' => '_test_wma_metabox',
				'id'     => '_test-metabox',
				'pages'  => array( 'post', 'page' ),
				'title'  => 'Test metabox',
			) );

		}

		/**
		 * Displaying field content on front end.
		 */
		function _test_wma_display_wysiwyg( $entry_content ) {
			if ( function_exists( 'wma_meta_option' ) ) {
				$entry_content = '<div class="test-content wysiwyg">' . wma_meta_option( 'wysiwyg' ) . '</div>' . $entry_content;
			}

			return $entry_content;
		}
		add_filter( 'the_content', '_test_wma_display_wysiwyg' );

	} else {

		/**
		 * Prompt to install the plugin.
		 */
		function _test_wma_prompt( $entry_content ) {
			return '<div class="alert">Install and activate <a href="https://wordpress.org/plugins/webman-amplifier/">WebMan Amplifier</a> plugin first</div>';
		}
		add_filter( 'the_content', '_test_wma_prompt' );

	}
