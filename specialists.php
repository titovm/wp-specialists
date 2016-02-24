<?php
/**
 * Plugin Name: Специалисты
 * Plugin URI: #
 * Version: 1.0
 * Author: Bio C
 * Author URI: http://www.bio-c.ru
 * Description: Система отображения и фильтрации специалистов
 * License: GPL2
 * Text Domain: specialists
 * Domain Path: /languages
 */

 class Specialists {

    /**
     * Constructor. Called when plugin is initialised
     */
    function __construct() {
    	add_action( 'init', array( $this, 'register_specialist_post_type'));
    	add_shortcode( 'show-all-specialists', array( $this, 'show_all_specialists_shortcode' ));
    	add_action( 'wp_enqueue_scripts', array( $this, 'specialists_scripts_and_styles'));
    }

    function register_specialist_post_type() {

		register_post_type( 'specialist',

			array( 'labels' => array(
					'name' => __( 'Специалисты', 'specialists' ), /* This is the Title of the Group */
					'singular_name' => __( 'Специалист', 'specialists' ), /* This is the individual type */
					'all_items' => __( 'Все специалисты', 'specialists' ), /* the all items menu item */
					'add_new' => __( 'Добавить', 'specialists' ), /* The add new menu item */
					'add_new_item' => __( 'Добавить специалиста', 'specialists' ), /* Add New Display Title */
					'edit' => __( 'Редактировать', 'specialists' ), /* Edit Dialog */
					'edit_item' => __( 'Редактировать специалиста', 'specialists' ), /* Edit Display Title */
					'new_item' => __( 'Новый специалист', 'specialists' ), /* New Display Title */
					'view_item' => __( 'Посмотреть специалиста', 'specialists' ), /* View Display Title */
					'search_items' => __( 'Искать специалиста', 'specialists' ), /* Search Custom Type Title */
					'not_found' =>  __( 'Специалиста не найдено.', 'specialists' ), /* This displays if there are no entries yet */
					'not_found_in_trash' => __( 'Nothing found in Trash', 'specialists' ), /* This displays if there is nothing in the trash */
					'parent_item_colon' => ''
				), /* end of arrays */
				'description' => __( 'Это специалисты', 'specialists' ), /* Custom Type Description */
				'public' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				'show_ui' => true,
				'query_var' => true,
				'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
				'menu_icon' => 'dashicons-id', /* the icon for the custom post type menu */
				'rewrite'	=> array( 'slug' => 'specialist', 'with_front' => true ), /* you can specify its url slug */
				'has_archive' => 'specialists', /* you can rename the slug here */
				'capability_type' => 'post',
				'hierarchical' => false,
				/* the next one is important, it tells what's enabled in the post editor */
				'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'sticky')
			) /* end of options */
		); /* end of register post type */

		/* this adds your post categories to your custom post type */
		register_taxonomy_for_object_type( 'category', 'speciality' );
		/* this adds your post tags to your custom post type */

		register_taxonomy( 'speciality',
			array('specialist'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
			array('hierarchical' => true,     /* if this is true, it acts like categories */
				'labels' => array(
					'name' => __( 'Специализации', 'specialists' ), /* name of the custom taxonomy */
					'singular_name' => __( 'Специализация', 'specialists' ), /* single taxonomy name */
					'search_items' =>  __( 'Искать специализации', 'specialists' ), /* search title for taxomony */
					'all_items' => __( 'Все специализации', 'specialists' ), /* all title for taxonomies */
					'parent_item' => __( 'Родительская специализация', 'specialists' ), /* parent title for taxonomy */
					'parent_item_colon' => __( 'Родительская специализация:', 'specialists' ), /* parent taxonomy title */
					'edit_item' => __( 'Редактировать специализацию', 'specialists' ), /* edit custom taxonomy title */
					'update_item' => __( 'Обновить специализацию', 'specialists' ), /* update title for taxonomy */
					'add_new_item' => __( 'Добавить специализацию', 'specialists' ), /* add new title for taxonomy */
					'new_item_name' => __( 'Название новой специализации', 'specialists' ) /* name title for taxonomy */
				),
				'show_admin_column' => true,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'speciality' ),
			)
		);

		include_once('specialists-metabox.php');

	}

	function show_all_specialists_shortcode() {
	    $args = array(
	    	'post_type' => 'specialist',
	    	'nopaging' => true,
	    	// 'posts_per_page' => -1
	    	);
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();?>
		<article id="specialist-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">
			<h3 class="h4"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
		<?php
			$postid = get_the_ID();
		    // Print photo
			$out = '';
      $out .= '<div class="specialist-photo">';
			if ( has_post_thumbnail() ) {
				$out .= get_the_post_thumbnail($postid, 'thumbnail');
			} else {
				$out .= '<img src="'.plugins_url('/img/specialist.gif', __FILE__).'" alt="Нет фото">';
			}
      $out .= '</div>';
      echo $out;

			// Print escerpt
			$out = '';
			$my_excerpt = get_the_excerpt();
			if ( $my_excerpt != '' ) {
				$out .= '<div class="specialist-about">';
				$out .= $my_excerpt;
				$out .= '</div>';
				echo $out;
			}

			echo '<a href="'.get_the_permalink().'" class="read-more">Подробная информация</a>';
			echo '</article>';
		endwhile;
	}

	function specialists_scripts_and_styles() {
		wp_register_style( 'specialists', plugins_url('/specialists.css', __FILE__), array(), '', 'all' );
		wp_enqueue_style('specialists');
	}

}

$Specialists = new Specialists;

?>
