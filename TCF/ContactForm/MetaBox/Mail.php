<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Contact Form Post type.
 */
class TCF_ContactForm_MetaBox_Mail {

  /**
	 * instance of this class
	 *
	 * @since 3.12
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

    /**
     * use for magic setters and getter
     * we can use this when we instantiate the class
     * it holds the variable from __set
     *
     * @see function __get, function __set
     * @access protected
     * @var array
     * */
    protected $vars = array();

    /**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

    /**
     * Constructor.
     */
    public function __construct() {
        if ( is_admin() ) {
            add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
            add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
        }

    }

    /**
     * Meta box initialization.
     */
    public function init_metabox() {
        add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
        add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );
    }

    /**
     * Adds the meta box.
     */
    public function add_metabox() {
        add_meta_box(
          'tcf-mail-meta-box',
          __( 'Mail Settings', 'textdomain' ),
          array( $this, 'render_metabox' ),
          TCF_POST_TYPE,
          'advanced',
          'default'
        );
    }

    /**
     * Renders the meta box.
     */
    public function render_metabox( $post ) {
        // Add nonce for security and authentication.
        wp_nonce_field( 'tcf_mail_settings_nonce_action', 'tcf_mail_settings_nonce' );

        $data = [];
        $data['to'] = TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_to([
          'post_id' => $post->ID,
          'action' => 'r',
          'single' => 1,
        ]);

				$data['from'] = get_bloginfo('name') . '<'.get_bloginfo('admin_email').'>';
        $db_from = TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_from([
          'post_id' => $post->ID,
          'action' => 'r',
          'single' => 1,
        ]);
				if($db_from){
					$data['from'] = $db_from;
				}

        $data['subject'] = TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_subject([
          'post_id' => $post->ID,
          'action' => 'r',
          'single' => 1,
        ]);
        $data['additional_headers'] = TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_additional_headers([
          'post_id' => $post->ID,
          'action' => 'r',
          'single' => 1,
        ]);
        $data['message_body'] = TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_message_body([
          'post_id' => $post->ID,
          'action' => 'r',
          'single' => 1,
        ]);

				$data['form_inputs'] = TCF_ContactForm_MetaBox_PostMeta::get_instance()->form_input([
					'post_id' => $post->ID,
					'action' => 'r',
					'single' => 1,
				]);
        TCF_View::get_instance()->admin_partials('metabox/mail.php', $data);
    }

    /**
     * Handles saving the meta box.
     *
     * @param int     $post_id Post ID.
     * @param WP_Post $post    Post object.
     * @return null
     */
    public function save_metabox( $post_id, $post ) {
        // Add nonce for security and authentication.
        $nonce_name   = isset( $_POST['tcf_mail_settings_nonce'] ) ? $_POST['tcf_mail_settings_nonce'] : '';
        $nonce_action = 'tcf_mail_settings_nonce_action';

        // Check if nonce is valid.
        if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) ) {
            return;
        }

        // Check if user has permissions to save data.
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        // Check if not an autosave.
        if ( wp_is_post_autosave( $post_id ) ) {
            return;
        }

        // Check if not a revision.
        if ( wp_is_post_revision( $post_id ) ) {
            return;
        }

        $mail_to = '';
        if(isset($_POST['email-to'])){
          $mail_to = $_POST['email-to'];
          TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_to([
            'post_id' => $post_id,
            'action' => 'u',
            'value'  => $mail_to
          ]);
        }

        $mail_from = '';
        if(isset($_POST['from'])){
          $mail_from = $_POST['from'];
          TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_from([
            'post_id' => $post_id,
            'action' => 'u',
            'value'  => $mail_from
          ]);
        }

        $mail_subject = '';
        if(isset($_POST['subject'])){
          $mail_subject = $_POST['subject'];
          TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_subject([
            'post_id' => $post_id,
            'action' => 'u',
            'value'  => $mail_subject
          ]);
        }

        $mail_additional_headers = '';
        if(isset($_POST['additional-headers'])){
          $mail_additional_headers = $_POST['additional-headers'];
          TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_additional_headers([
            'post_id' => $post_id,
            'action' => 'u',
            'value'  => $mail_additional_headers
          ]);
        }

        $mail_message_body = '';
        if(isset($_POST['message-body'])){
          $mail_message_body = $_POST['message-body'];
          TCF_ContactForm_MetaBox_PostMeta::get_instance()->mail_message_body([
            'post_id' => $post_id,
            'action' => 'u',
            'value'  => $mail_message_body
          ]);
        }

        $mail_form_input = '';
        if(isset($_POST['inputForm'])){
          $mail_form_input = $_POST['inputForm'];
          TCF_ContactForm_MetaBox_PostMeta::get_instance()->form_input([
            'post_id' => $post_id,
            'action' => 'u',
            'value'  => htmlentities($mail_form_input)
          ]);
        }
    }


} // class TCF_ContactForm_MetaBox_Mail
