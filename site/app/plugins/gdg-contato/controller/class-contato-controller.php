<?php
namespace Gdg;

defined( 'ABSPATH' ) or die;

class ContatoController extends Controller {
	private $validator;

	public function __construct( $operation = null, $parameters = null ) {
		parent::__construct( $operation, $parameters );
	}

	public function enviar_mensagem( $parameters ) {
		$email    = get_array_var( 'contato_email', $parameters );
		$nome     = get_array_var( 'contato_nome', $parameters );
		$assunto  = get_array_var( 'contato_assunto', $parameters );
		$mensagem = get_array_var( 'contato_mensagem', $parameters );

		date_default_timezone_set( 'America/Bahia' );

		$siteName = get_bloginfo( 'name' );
		$to       = get_option( 'gdg_options' )['emails_contato'];
		$subject  = 'Contato do site - ' . date('d/m/Y H:i');
		$message  = '<p>Você recebeu a mensagem abaixo pelo formulário de contato do site ' . $siteName . ':</p>
			<h2>' . $assunto . '</h2>
			<h3>' . $nome . ' - ' . $email . '</h3>
			<p>' . $mensagem .'</p>';
		$headers = array(
			'Content-Type: text/html; charset=UTF-8',
			'From: ' . $siteName
		);

		$email_sent = wp_mail( $to, $subject, $message, $headers );

		if ( !$email_sent ) {
			$this->print_warning(
				'Desculpe, o envio falhou. Por favor, tente mais tarde ou <a href="mailto:' . $to .
				'">envie-nos um email diretamente</a>.'
			);
		}

		$this->print_success( 'Obrigado pelo mensagem! Entraremos em contato em breve.' );
	}
}
