<?php
/**
 * big-brother functions and definitions
 *
 * @package big-brother
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'big_brother_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function big_brother_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on big-brother, use a find and replace
	 * to change 'big-brother' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'big-brother', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'big-brother' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'big_brother_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // big_brother_setup
add_action( 'after_setup_theme', 'big_brother_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function big_brother_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'big-brother' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'big_brother_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function big_brother_scripts() {
	wp_enqueue_style( 'big-brother-style', get_stylesheet_uri() );

	wp_enqueue_script( 'big-brother-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'big-brother-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'big-brother-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'big_brother_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/*
* Breadcrumbs via: http://colorburned.com/adding-custom-breadcrumbs-into-your-wordpress-theme/
* Needs work. Won't grab all levels. Only top and current.
*/
function the_breadcrumbs() {
 
        global $post;
 
        if (!is_home()) {
 
            echo "<a class='breadcrumbs-root' href='";
            echo get_option('home');
            echo "'>";
            echo get_bloginfo($name);
            echo "</a>";
 
            if (is_category() || is_single()) {
 
                echo " > ";
                $cats = get_the_category( $post->ID );
 
                foreach ( $cats as $cat ){
                    echo $cat->cat_name;
                    echo " > ";
                }
                if (is_single()) {
                    the_title();
                }
            } elseif (is_page()) {
 
                if($post->post_parent){
                    $anc = get_post_ancestors( $post->ID );
                    $anc_link = get_page_link( $post->post_parent );
 
                    foreach ( $anc as $ancestor ) {
                        $output = "<span class='breadcrumbs-ancestor'><a href=".$anc_link.">".get_the_title($ancestor)."</a></span>";
                    }
 
                    echo $output;
                    echo "<span class='breadcrumbs-current'>";
                    echo the_title();
                    echo "</span>";
 
                } else {
                    echo "<span class='breadcrumbs-current'>";
                    echo the_title();
                    echo "</span>";
                }
            }
        }
    elseif (is_tag()) {single_tag_title();}
    elseif (is_day()) {echo"Archive: "; the_time('F jS, Y'); echo'</li>';}
    elseif (is_month()) {echo"Archive: "; the_time('F, Y'); echo'</li>';}
    elseif (is_year()) {echo"Archive: "; the_time('Y'); echo'</li>';}
    elseif (is_author()) {echo"Author's archive: "; echo'</li>';}
    elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "Blogarchive: "; echo'';}
    elseif (is_search()) {echo"Search results: "; }
}
