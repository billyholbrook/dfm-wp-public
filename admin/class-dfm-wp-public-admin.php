<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.digitalfirstmedia.com
 * @since      1.0.0
 *
 * @package    DFM_WP_Public
 * @subpackage DFM_WP_Public/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    DFM_WP_Public
 * @subpackage DFM_WP_Public/admin
 * @author     DFM
 */
class DFM_WP_Public_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
        add_action( 'admin_menu', array( $this, 'add_dashboard_menu_items') );
    }

    /**
	 * Adds the pages to the dashboard menu.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
    public function add_dashboard_menu_items() {
        add_dashboard_page('Sports Content', 'Sports Content', 'read', 'dfm-sports-content', array($this, 'sports_content'));
        add_dashboard_page('Animals Content', 'Animals Content', 'read', 'dfm-animals-content', array($this, 'animals_content'));
        add_dashboard_page('Business Content', 'Business Content', 'read', 'dfm-business-content', array($this, 'business_content'));
        add_dashboard_page('Entertainment Content', 'Entertainment Content', 'read', 'dfm-entertainment-content', array($this, 'entertainment_content'));
        add_dashboard_page('World and News Content', 'World and News Content', 'read', 'dfm-world-and-news-content', array($this, 'world_and_news_content'));
    }

    /**
	 * Retrieves and displays link to post by category name.
	 *
	 * @since 1.0.0
	 * @access private
	 * @return void
	 */
    private function get_posts_by_category_name($category_name, $num_posts) {
        ?>
        <ul>
        <?php
        $category_slug = str_replace(' ', '-', $category_name);
        $args = array(
            'category_name'  => $category_slug,
            'posts_per_page' => $num_posts,
            'orderby'        => 'publish_date',
            'order'          => 'DESC'
        );
        $query = new WP_Query( $args );

        if($query->have_posts()) {
            while($query->have_posts()) { 
                $query->the_post();
        ?>
            <li><a href='<?php the_permalink(get_the_id()); ?>'><?php the_title(); ?></a></li>
        <?php
            }
        }
        else {
            echo '<li>There are no ' . $category_name . ' posts. Check back later</li>';
        }
        ?>
        </ul>
        <?php
    }
    /**
	 * Content for the sports dashboard page.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
    public function sports_content() {
        $this->get_posts_by_category_name('Sports', 25);
    }

    /**
	 * Content for the animals dashboard page.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
    public function animals_content() {
        $this->get_posts_by_category_name('Animals', 10);
    }

    /**
	 * Content for the business dashboard page.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
    public function business_content() {
        $this->get_posts_by_category_name('Business', 12);
    }

    /**
	 * Content for the entertainment dashboard page.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
    public function entertainment_content() {
        $this->get_posts_by_category_name('Entertainment', 50);
    }

    /**
	 * Content for the world and news dashboard page.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return void
	 */
    public function world_and_news_content() {
        $this->get_posts_by_category_name('World and News', 100);
    }
}