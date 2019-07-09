<?php
defined( 'ABSPATH' ) or die;

/**
 * Plugin Name: GDG Contato
 * Description: Formulário de contato criado durante o workshop sobre WordPress do GDG Lauro.
 * Version: 1.0
 * Author: Flávio Escobar
 * Author URI: http://flavioescobar.com.br/
 * Plugin URI: http://flavioescobar.com.br/
 */

define( 'GDG_PLUGIN_URL', WP_PLUGIN_URL . "/" . dirname( plugin_basename( __FILE__ ) ) );
define( 'GDG_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

// Manipulando requisições AJAX.
add_action( 'wp_ajax_nopriv_ajaxcall', 'ajaxcall' );
add_action( 'wp_ajax_ajaxcall', 'ajaxcall' );

function ajaxcall() {
	$parameters = get_post_var( 'parameters' );
	$controller = get_post_var( 'controller' );
	$operation  = get_post_var( 'operation' );

	load_controller( 'Controller' );
	$gdg_controller = new \Gdg\Controller();

	if ( null !== $controller && null !== $operation && null !== $parameters ) {
		$controller .= 'Controller';
		$controller_class = '\Gdg\\' . $controller;
		load_controller( $controller );

		new $controller_class( $operation, $parameters );
	}

	$gdg_controller->print_errors( 'Requisição inválida.' );
}

function load_controller( $controller ) {
	$controller_file = GDG_PLUGIN_PATH . 'controller/class-' . from_camel_case( $controller ) . '.php';

	if ( ! file_exists( $controller_file ) ) {
		$error = ( true === WP_DEBUG ) ? 'Controller não encontrado: ' . $controller : 'Requisição inválida.';
		$controller_file = GDG_PLUGIN_PATH . 'controller/class-controller.php';
		$ca_controller   = new \Gdg\Controller();
		$ca_controller->print_errors( $error );
	}

	require_once( $controller_file );
}

// Copied from StackOverflow. Please don't blame me!
function from_camel_case( $input ) {
	preg_match_all( '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches );
	$ret = $matches[0];
	foreach( $ret as &$match ) {
		$match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
	}
	return implode( '-', $ret );
}

function get_array_var( $var, $array ) {
	return array_key_exists( $var, $array ) ? $array[$var] : null;
}

function get_post_var( $var ) {
	return get_array_var( $var, $_POST );
}

// Usando shortcodes para inserção do formulário de contato no conteúdo do site.
function gdg_form_contato_shortcode() {
	?>
	<form id="enviar_mensagem_form" data-cac="Contato">
	    <div>
	        <input type="text" placeholder="Nome" id="contato_nome" style="width: 30%;">
	        <input type="email" placeholder="Email" id="contato_email" style="width: 30%;">
	        <input type="text" placeholder="Assunto" id="contato_assunto" style="width: 30%;">
	    </div>
	    <br>
	    <div>
	        <textarea placeholder="Mensagem" rows="5" id="contato_mensagem" style="width: 92%;"></textarea>
	    </div>
	    <br>
	    <button type="submit" class="btn btn--default action" id="enviar_mensagem">Enviar →</button>
	    <div id="fallback" class="fallback"></div>	
	</form>
	<?php
}
add_shortcode( 'gdg_contato', 'gdg_form_contato_shortcode' );

// Adiciona os arquivos JS.
function gdg_scripts() {
	wp_enqueue_script( 'jquery-js', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), false, true );
	wp_enqueue_script( 'gdg-contato-js', GDG_PLUGIN_URL . '/js/gdg-contato.js', array( 'jquery-js' ), false, true );
	wp_localize_script( 'gdg-contato-js', 'gdg', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' )
	) );
}
add_action( 'wp_enqueue_scripts', 'gdg_scripts' );


// Adiciona menu do plugin
function gdg_options_page() {
	add_menu_page(
		'GDG Contato',
		'GDG Contato',
		'manage_options',
		'gdg-contato',
		'gdg_options_page_html'
	);
}
add_action( 'admin_menu', 'gdg_options_page' );

// Constrói a página de configurações do plugin.
function gdg_options_page_html() {
	// Verifica permissões do usuário
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// Mensagem que será exibida quando o usuário salvar as configurações.
	if ( isset( $_GET['settings-updated'] ) ) {
		add_settings_error( 'gdg_messages', 'gdg_message', __( 'Configurações Salvas', 'gdg' ), 'updated' );
	}

	// Função que de fato mostra as mensagens registradas acima.
	settings_errors( 'gdg_messages' );
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
			// Imprime os campos de formulário do plugin. Deve ser executada dentro de uma tag <form>.
			settings_fields( 'gdg' );
			// Imprime as seções de configurações do plugin.
			do_settings_sections( 'gdg' );
			// Apenas imprime um botão de Submit.
			submit_button( 'Salvar Configurações' );
			?>
		</form>
	</div>
	<?php
}

// Registra as seções e campos de configuração do plugin.
function gdg_settings_init() {
	// Define o escopo das configurações - grupo 'gdg', opção salva no banco 'gdg_options'.
	register_setting( 'gdg', 'gdg_options' );

	// Adiciona uma seção na página de config.
	add_settings_section(
		'gdg_section', // Nome da seção.
		__( 'Configurações', 'gdg' ), // Título.
		'gdg_section_cb', // A função que de fato imprime a section
		'gdg' // Página na qual será exibida (no caso, a página do nosso plugin)
	);

	// Adiciona um campo de formulário na página de config.
	add_settings_field(
		'emails_contato',
		__( 'Emails de contato', 'gdg' ),
		'gdg_field_emails_contato_cb', // A função de callback é a que de fato imprime o campo na página.
		'gdg',
		'gdg_section', // Aqui vinculamos este campo a uma seção.
		[ // Estes parâmetros serão passados para a função de callback 'gdg_field_emails_contato_cb'
			'label_for' => 'emails_contato',
			'class' => 'gdg_row',
			'gdg_custom_data' => 'custom', // Apenas um exemplo de dados customizados, caso necessário.
		]
	);
}
add_action( 'admin_init', 'gdg_settings_init' );

// Função que de fato imprime nossa seção de config.
function gdg_section_cb( $args ) {
	?>
	<p id="<?php echo esc_attr( $args['id'] ); ?>">
		<?php esc_html_e( 'Configurações gerais do plugin.', 'gdg' ); ?>
	</p>
	<?php
}

// Função que de fato imprime nosso campo de formulário na página de config.
function gdg_field_emails_contato_cb( $args ) {
	$options = get_option( 'gdg_options' );
	?>
	<input id="<?php echo esc_attr( $args['label_for'] ); ?>" type="text" placeholder="joao@email.com,maria@email.com"
	       data-custom="<?php echo esc_attr( $args['gdg_custom_data'] ); ?>" style="width: 100%;"
	       name="gdg_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
	       value="<?php echo esc_attr( $options['emails_contato'] ); ?>" />
	<p class="description">
		<?php
		esc_html_e(
			'Informe um ou mais emails para receber as mensagens de contato do site. Caso escolha mais de um email, use
			vírgulas para separá-los.',
			'gdg'
		);
		?>
	</p>
	<?php
}
