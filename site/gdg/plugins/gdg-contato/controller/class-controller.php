<?php
namespace Gdg;

defined( 'ABSPATH' ) or die;

class Controller {
	public function __construct( $operation = null, $parameters = null ) {
		if ( null !== $operation && null !== $parameters ) {
			if ( ! method_exists( $this, $operation ) ) {
				$this->print_errors( 'Requisição inválida.' );
			}

			$this->$operation( $parameters );
		}
	}

	public function print_message( $status, $data, $fallback_target = 'fallback' ) {
		die( json_encode( compact( 'status', 'data', 'fallback_target' ) ) );
	}

	public function print_errors( $data, $fallback_target = 'fallback' ) {
		$this->print_message( 'error', $data, $fallback_target );
	}

	public function print_warning( $data, $fallback_target = 'fallback') {
		$this->print_message( 'warning', $data, $fallback_target );
	}

	public function print_success( $data, $fallback_target = 'fallback' ) {
		$this->print_message( 'success', $data, $fallback_target );
	}

	public function return_data( $data, $fallback_target = 'fallback' ) {
		$this->print_message( 'data', $data, $fallback_target );
	}

	public function extrair_dados_objetos( $lista_objetos, $dados ) {
		$extraidos = array();

		foreach ( $lista_objetos as $objeto ) {
			$extraido = new \stdClass();

			foreach ( $dados as $dado ) {
				$extraido->{$dado} = $objeto->{$dado};
			}

			$extraidos[] = $extraido;
		}

		return $extraidos;
	}
}
