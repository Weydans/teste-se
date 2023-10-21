<?php

namespace App\Http\Controller;

use App\Domain\Repository\ProductRepository;
use App\Domain\Service\ProductAllService;
use Lib\Controller;
use Lib\Flash;

class SaleController extends Controller 
{
    public function index()
    {
        try {
            return $this->responseView( 'Sale/datagrid', [ 
                'successMessage' => Flash::get('successMessage'),
                'errorMessage'   => Flash::get('errorMessage'),
            ]);

        } catch ( \Exception $e ) {
            $message = $_ENV['APP_DEBUG'] 
                ? $e->getMessage() 
                : 'Houve um erro entre em contato com o suporte';

            return $this->responseView( 'Sale/datagrid', [ 
                'message' => $message 
            ]);
        } 
    }

    public function create()
    {
        try {
            $products = ProductAllService::execute( new ProductRepository() );

            $data = [];

            foreach ( $products as $product ) {
                $data[] = $product->toJson();
            }

			return $this->responseView( 'Sale/create', [
				'successMessage' => Flash::get('successMessage'),
				'errorMessage'   => Flash::get('errorMessage'),
				'old'            => Flash::get('oldValue'),
				'products'       => json_encode( $data ),
			]);

		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

			return $this->responseView( 'Sale/create', [ 
				'errorMessage' => $message 
			]);
        }    
    }

    public function store()
    {
        // return $this->responseJson( 201, 'Venda registrada com sucesso' );
        return $this->responseJson( 400, 'Erro ao registrar venda' );
    }
}
