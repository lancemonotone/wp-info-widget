<?php
/**
 * @package MeerkatInfoWidget
 * @uses Advanced Custom Fields plugin
 */

add_action('widgets_init', create_function('', 'return register_widget("MeerkatInfoWidget");'));

class MeerkatInfoWidget extends WP_Widget {
	
	var $defaults = array(
        'title' => '',
        'id'    => '',
        'orientation'   => 'horizontal',
        'collapse' => '0'
    );
    
    var $widgetname = 'MeerkatInfoWidget';
    var $namespace  = 'meerkat_info_widget';
	var $classname  = 'meerkat-info-widget';
	var $version    = "1.0.0";
	    
	function __construct(){
		$description      = 'Display list of things. Compact, attractive, noticeable. Click thing to reveal more info (top thing is active by default).';
        $label            =  WMS_WIDGET_PREFIX . 'Meerkat Info Widget';
        $widget_ops  = array('classname' => $this->classname. ' cf', 'description' => __($description) );
        $control_ops = array('width' => WMS_WIDGET_WIDTH, 'height' => WMS_WIDGET_HEIGHT);
		
		parent::__construct( 
			$this->namespace, 
			_($label),
			$widget_ops,
			$control_ops
		);
		$this->add_hooks();
		MeerkatInfoWidgetHelper::setup();
	}
	
	/**
     * Add in various hooks
     * 
     * Place all add_action, add_filter, add_shortcode hook-ins here
     */
	function add_hooks(){
		// Register front-end js and styles for this plugin
		add_action( 'wp_enqueue_scripts', array( &$this, 'wp_register_scripts' ), 1 );
		add_action( 'wp_enqueue_scripts', array( &$this, 'wp_register_styles' ), 1 );

        // Register admin js and styles for this plugin
        add_action( 'admin_head', array( &$this, 'wp_register_scripts' ), 1 );
        add_action( 'admin_head', array( &$this, 'wp_register_styles' ), 1 );

        // Add Shortcode for widget
		add_shortcode('wms_info_widget', array(&$this, 'meerkat_info_shortcode'));
	}
	
	/** VIDEOWALL
     * Register scripts used by this plugin for enqueuing elsewhere
     * 
     * @uses wp_register_script()
     */
    function wp_register_scripts() {
        // load fancybox for youtube
        global $js;
        $js['fancybox-media']['load'] = true;
                
        $name = $this->classname.'-widget';
        if(!is_admin()){
	        wp_enqueue_script( $name, MEERKATINFO_URLPATH . '/js/widget.min.js', array( 'jquery' ), $this->version, true );
        }else{
            global $pagenow;
            if ($pagenow == "widgets.php") {
                wp_enqueue_script( $name.'-admin', MEERKATINFO_URLPATH . '/js/admin.js', array( 'jquery' ), $this->version, true );
                wp_localize_script( $name.'-admin', 'videowallAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));  
            }
        }
    }
    
    /**
     * Register styles used by this plugin for enqueuing elsewhere
     * 
     * @uses wp_register_style()
     */
    function wp_register_styles() {
        // Admin Stylesheet
        $name = $this->classname.'-widget';
        if(!is_admin()){
	        wp_enqueue_style( $name, MEERKATINFO_URLPATH . '/css/widget.css', array(), $this->version, 'screen' );
	    }else{
        	wp_enqueue_style( $name.'-admin', MEERKATINFO_URLPATH . '/css/admin.css', array(), $this->version, 'screen' );
        }
    }
	
    
    /**
     * Widget Display
     *
     * @param Array $args Settings
     * @param Array $instance Widget Instance
     */
	function widget( $args, $instance ) {
		extract( $args );
	    
	    echo $before_widget;
	    
	    //Set up some default widget settings.
    	$defaults = $this->defaults;
    	$instance = wp_parse_args( (array) $instance, $defaults ); 
	    extract($instance);
	    
	    echo $before_title . $instance['title'] . $after_title;
		
		require(MEERKATINFO_DIRNAME.'/views/view-widget.php');
	
	    echo $after_widget;
	}
	
	/**
	 * Widgets page form submission logic
	 *
	 * @param Array $new_instance
	 * @param Array $old_instance
	 * @return unknown
	 */
	function update( $new_instance, $old_instance ) {
	    
	    foreach( $new_instance as $key => $val ) {
	        $data[$key] = Meerkat_Info::_sanitize( $val );
	    }

	    return $data;
	}

	/**
	 * Widgets page form controls
	 *
	 * @param Array $instance
	 */
	function form( $instance ) {
	
    	//Set up some default widget settings.
    	$defaults = $this->defaults;
    	
    	$instance = wp_parse_args( (array) $instance, $defaults ); 
    	
    	require('views/view-form.php');
	}
    
	/**
	 * Widget shortcode
	 *
	 * @param Array $atts
	 * @return String Widget HTML
	 */
	function meerkat_info_shortcode($atts) {
	    static $widget_i = 0;
	    global $wp_widget_factory;
	    
	    $defaults = shortcode_atts($this->defaults, $atts);
	    
	    $instance = wp_parse_args( (array) $instance, $defaults ); 
	    
	    if (!is_a($wp_widget_factory->widgets[$this->widgetname], $this->widgetname)){
	        $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
	        
	        if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')){
	            return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct"),'<strong>'.$class.'</strong>').'</p>';
	        } else {
	            $class = $wp_class;
	        }
	    }
	    
	    ob_start();
	    
	    the_widget($this->widgetname, $instance, array(
	    	'widget_id'     => $this->classname.'-'.$widget_i,
	        'before_widget' => '<div id="'.$this->namespace.'-'.$widget_i++.'" class="widget '.$this->classname.' cf">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="title">',
			'after_title'   => '</h2>'
	    ));
	    
	    return ob_get_clean();
	    
	}
	
}

?>
