<?php
/**
 * Author URI: https://github.com/kmeze
 * Plugin Name: AcademizeWP
 * Text Domain: ACWP
 * Author: Krešimir Meze
 * Description: Publish courses and training events on WordPress websites.
 * PluginUri: https://github.com/kmeze/AcademizeWP
 * Version: 1.0.0
/*WPPluginInfo PluginHeaderTag ACWP*/

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Action Hooks
 */
add_action( 'init', 'ACWP_register_acwp_course_post_type', 10, 0);
add_action( 'init', 'ACWP_register_acwp_event_post_type', 10, 0);
add_action( 'init', 'ACWP_register_acwp_eventtype_for_acwp_event', 10, 0);
add_action( 'init', 'ACWP_register_acwp_eventtype_taxonomy', 9, 0);
add_action( 'init', 'ACWP_register_acwp_subject_for_acwp_course', 10, 0);
add_action( 'init', 'ACWP_register_acwp_subject_taxonomy', 9, 0);
add_action( 'init', 'ACWP_RegisterSubjectListBlock', 10, 0);
/*WPPluginInfo ActionHooks ACWP*/

/**
 * Filter Hooks
 */
/*WPPluginInfo FilterHooks ACWP*/

/**
 * Callbacks
 */
function ACWP_flush_courses_rewrite_rules( /*CallbackInfo CallbackArg ACWP.flush_courses_rewrite_rules*/ ) {
    
    ACWP_register_acwp_course_post_type();
    flush_rewrite_rules();

}
function ACWP_flush_events_rewrite_rules( /*CallbackInfo CallbackArg ACWP.flush_events_rewrite_rules*/ ) {
    
    ACWP_register_acwp_event_post_type();
    flush_rewrite_rules();

}
function ACWP_flush_eventtypes_rewrite_rules( /*CallbackInfo CallbackArg ACWP.flush_eventtypes_rewrite_rules*/ ) {
    
    ACWP_register_acwp_eventtype_taxonomy();
    flush_rewrite_rules();

}
function ACWP_flush_subjects_rewrite_rules( /*CallbackInfo CallbackArg ACWP.flush_subjects_rewrite_rules*/ ) {
    
    ACWP_register_acwp_subject_taxonomy();
    flush_rewrite_rules();

}
function ACWP_register_acwp_course_post_type( /*CallbackInfo CallbackArg ACWP.register_acwp_course_post_type*/ ) {
    
    register_post_type('acwp_course',
        array(
            'labels'      => array(
                'name'          => __( 'Courses', 'ACWP' ),
                'singular_name' => __( 'Course', 'ACWP' ),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array( 'slug' => 'courses' ),
        )
    );
}
function ACWP_register_acwp_event_post_type( /*CallbackInfo CallbackArg ACWP.register_acwp_event_post_type*/ ) {
    
    register_post_type('acwp_event',
        array(
            'labels'      => array(
                'name'          => __( 'Events', 'ACWP' ),
                'singular_name' => __( 'Event', 'ACWP' ),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array( 'slug' => 'events' ),
        )
    );
}
function ACWP_register_acwp_eventtype_for_acwp_event( /*CallbackInfo CallbackArg ACWP.register_acwp_eventtype_for_acwp_event*/ ) {
    register_taxonomy_for_object_type( 'acwp_eventtype', 'acwp_event' );
}
function ACWP_register_acwp_eventtype_taxonomy( /*CallbackInfo CallbackArg ACWP.register_acwp_eventtype_taxonomy*/ ) {
    
    register_taxonomy( 'acwp_eventtype', null,
        array(
        		'labels'            => array(
                     'name'              => __( 'EventTypes', 'ACWP' ),
                     'singular_name'     => __( 'EventType', 'ACWP' ),
                ),
                'public'      => true,
                'has_archive' => true,
                'rewrite'     => array( 'slug' => 'eventtypes' ),
        	 )
        );
}
function ACWP_register_acwp_subject_for_acwp_course( /*CallbackInfo CallbackArg ACWP.register_acwp_subject_for_acwp_course*/ ) {
    register_taxonomy_for_object_type( 'acwp_subject', 'acwp_course' );
}
function ACWP_register_acwp_subject_taxonomy( /*CallbackInfo CallbackArg ACWP.register_acwp_subject_taxonomy*/ ) {
    
    register_taxonomy( 'acwp_subject', null,
        array(
        		'labels'            => array(
                     'name'              => __( 'Subjects', 'ACWP' ),
                     'singular_name'     => __( 'Subject', 'ACWP' ),
                ),
                'public'      => true,
                'has_archive' => true,
                'rewrite'     => array( 'slug' => 'subjects' ),
        	 )
        );
}
function ACWP_RegisterSubjectListBlock( /*CallbackInfo CallbackArg ACWP.RegisterSubjectListBlock*/ ) {
    
        $script = "((blocks, blockEditor, element) => {
            const el = element.createElement;
            const useBlockProps = blockEditor.useBlockProps;
            blocks.registerBlockType('acwp/subjects', {
                edit: (props) => {
                    var blockProps = useBlockProps();
                    return el( 'div', blockProps, 'Subjects list' )
                },
                save: () => null
            });
        })(window.wp.blocks, window.wp.blockEditor, window.wp.element);";

        wp_register_script( 'acwp-subjects', '' );
        wp_add_inline_script( 'acwp-subjects', $script );

        register_block_type( 'acwp/subjects', array(
            '$schema'         => 'https://schemas.wp.org/trunk/block.json',
            'api_version'     => '2',
            'title'           => 'Subjects List',
            'category'        => 'widgets',
            'description'     => 'Display a list of all subjects',
            'textdomain'      => 'acwp',
            'icon'            => 'screenoptions',
            'editor_script'   => 'acwp-subjects',
            'render_callback' => function ( $attributes ) {
                $subjects = get_terms( array( 'taxonomy' => 'acwp_subject', ) );
                $class    = 'nav';
                $class    .= $attributes['className'] ? ' ' . $attributes['className'] : '';

                ob_start();
                if ( $subjects ) : ?>
                    <ul class="<?php esc_attr_e( $class ); ?>">
                        <?php foreach ( $subjects as $subject ) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo esc_url( get_term_link( $subject ) ); ?>">
                                    <?php esc_html_e( $subject->name ); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif;

                return ob_get_clean();
            },
        ) );
    
}
/*WPPluginInfo Callbacks ACWP*/
function ACWP_uninstall() {
    /*WPPluginInfo UninstallHook ACWP*/
}

/**
 * DataStructure classes
 */
class ACWP_User {
    /*DataStructureInfo ClassProperty ACWP.User*/

    public function __construct() {
        /*DataStructureInfo ClassConstructor ACWP.User*/
    }

    public static function parse( object $object ):?ACWP_User {
        if (! isset( $object ) ) return null;
        
        $dataStructure = new ACWP_User();
        /*DataStructureInfo ClassParseProperty ACWP.User*/

        return $dataStructure;
    }

    /*DataStructureInfo ClassMethod ACWP.User*/
}
/*WPPluginInfo DataStructureClasses ACWP*/

/**
 * Code concept
 */
/*WPPluginInfo CodeTag ACWP*/

register_activation_hook( __FILE__, function () {
    /*WPPluginInfo ActivationBeforeDbDeltaHook ACWP*/
    /*WPPluginInfo ActivationDbDeltaHook ACWP*/
    /*WPPluginInfo ActivationAfterDbDeltaHook ACWP*/
    ACWP_flush_courses_rewrite_rules ();

    ACWP_flush_events_rewrite_rules ();

    ACWP_flush_eventtypes_rewrite_rules ();

    ACWP_flush_subjects_rewrite_rules ();

    /*WPPluginInfo ActivationHook ACWP*/
} );
register_deactivation_hook( __FILE__, function () {
    /*WPPluginInfo DeactivationHook ACWP*/
} );
register_uninstall_hook( __FILE__, 'ACWP_uninstall' ); // NOTE: register_uninstall_hook callback cannot be anonymous function
