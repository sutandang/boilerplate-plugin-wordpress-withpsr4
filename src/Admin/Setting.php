<?php
namespace Boombar\Admin;

class Setting {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_assets') );
		add_action( 'wp_enqueue_scripts', array($this, 'public_enqueue_assets') );
		add_action( 'admin_menu', array($this, 'add_settings_page') );
		add_filter( 'tj_boombar_field', array($this, 'settings_fields') );
	}

	public function admin_enqueue_assets() 
	{
	    wp_enqueue_style('tonjoo-codemirror-css',TJ_BOOMBAR_BASE_URL ."src/Admin/assets/codemirror/codemirror.css",array(),$this->version);        
	    wp_enqueue_style('tonjoo-monokai-css',TJ_BOOMBAR_BASE_URL ."src/Admin/assets/codemirror/theme/monokai.css",array(),$this->version);        
	    wp_enqueue_script('tonjoo-codemirror-js',TJ_BOOMBAR_BASE_URL ."src/Admin/assets/codemirror/codemirror.js",array(),$this->version);
	    wp_enqueue_script('tonjoo-codemirror-xml-js',TJ_BOOMBAR_BASE_URL ."src/Admin/assets/codemirror/mode/xml/xml.js",array(),$this->version);
	    wp_enqueue_script('tonjoo-codemirror-javascript-js',TJ_BOOMBAR_BASE_URL ."src/Admin/assets/codemirror/mode/javascript/javascript.js",array(),$this->version);
	    wp_enqueue_script('tonjoo-codemirror-css-js',TJ_BOOMBAR_BASE_URL ."src/Admin/assets/codemirror/mode/css/css.js",array(),$this->version);
	    wp_enqueue_script('tonjoo-codemirror-htmlmixed-js',TJ_BOOMBAR_BASE_URL ."src/Admin/assets/codemirror/mode/htmlmixed/htmlmixed.js",array(),$this->version);
		wp_enqueue_style( 'wp-color-picker' );

	}

	public function public_enqueue_assets() 
	{
	    wp_enqueue_style('tonjoo-boombar-css',TJ_BOOMBAR_BASE_URL ."src/Frontend/assets/boombar.css",array(),$this->version);        

	}
	public function add_settings_page(){
		$page = add_options_page( __('Tonjoo Boombar', 'tonjoo-boombar'), __('Tonjoo Boombar', 'tonjoo-boombar'), 'manage_options', 'tonjoo_boombar_page', array($this, 'display_settings_page') );
		add_action('load-' . $page, array( $this, 'save_settings'  ));
	}

	public function display_settings_page(){
		$data_boombar = get_option('tonjoo_boombar_value');
		include TJ_BOOMBAR_BASE_DIR. 'view/Admin.php';
	}

	/**
	 * Save the Page Builder settings.
	 */
	public function save_settings(){

		if( !current_user_can('manage_options') ) return;
		if( !wp_verify_nonce( filter_input(INPUT_POST, '_wpnonce') , 'panels-settings') ) return;

		$values = array();
			
		$values = array(
						'tj_boombar_html' => htmlspecialchars($_POST['tonjoo_boombar_value']['tj_boombar_html']),
						'tj_cange_color' => htmlspecialchars($_POST['tonjoo_boombar_value']['tj_cange_color']),
						'tj_cange_font_color' => htmlspecialchars($_POST['tonjoo_boombar_value']['tj_cange_font_color']),
						'is_active' => htmlspecialchars($_POST['tonjoo_boombar_value']['is_active']),
					);
		if(get_option('tonjoo_boombar_value'))
		{
			update_option( 'tonjoo_boombar_value', $values );			
		}else{
			add_option( 'tonjoo_boombar_value', $values );						
		}
		
		$this->settings = wp_parse_args( $values, $this->settings );
		$this->settings_saved = true;
	}
}
