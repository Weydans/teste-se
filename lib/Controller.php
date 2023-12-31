<?php

namespace Lib;

use \stdclass;
use Lib\Request;

abstract class Controller
{
	protected $request;
	protected $data;
	private $response;

	public function __construct( Request $request, Response $response )
	{
		$this->request = ( object ) array_merge( 
			( array ) $request->get,
			( array ) $request->post,
			( array ) json_decode( $request->input ),
		);

		$this->response = $response;
		$this->data		= new stdclass();
	}

	public function getResponse( int $httpCode, string $message ) : Response 
	{
		$this->setResponse( $httpCode, $message );
		
		return $this->response;
	}

	public function responseJson( int $httpCode, string $message ) : void 
	{
        header( 'Content-Type: application/json' );
        header( 'Accept: application/json' );
		header( "{$_SERVER['SERVER_PROTOCOL']} {$httpCode}");
		
		$this->setResponse( $httpCode, $message );

		echo $this->response->toJson();	
	}

	private function setResponse( int $httpCode, string $message ) : void 
	{
		$this->response->httpCode = $httpCode;
		$this->response->message  = $message;
		$this->response->data	  = $this->data;
	}

	public function responseView( string $view, array $data = [] ) : void 
	{
		$templatesPath = __DIR__ . '/../src/Http/View';

		$twig = new \Twig\Environment(
			new \Twig\Loader\FilesystemLoader( $templatesPath )
		);

		$viewWithExtension = $view . '.twig.php';

		echo $twig->render( $viewWithExtension, $data );
	}
}

