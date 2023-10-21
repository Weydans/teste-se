<?php

namespace App\Http\Controller;

use Lib\Flash;
use Lib\Controller;
use App\Domain\Service\SaleAllService;
use App\Domain\Service\SaleFindService;
use App\Domain\Service\SaleCreateService;
use App\Domain\Repository\SaleRepository;
use App\Domain\Service\ProductAllService;
use App\Domain\Repository\ProductRepository;

class SaleController extends Controller 
{    
    public function index()
    {
        try {
            $sales = SaleAllService::execute( new SaleRepository() );

            return $this->responseView( 'Sale/datagrid', [ 
                'successMessage' => Flash::get('successMessage'),
                'errorMessage'   => Flash::get('errorMessage'),
                'sales'          => $sales,
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

    public function show()
    {
        try {
            $sale = SaleFindService::execute( 
                $this->request->id, 
                new SaleRepository() 
            );

            return $this->responseView( 'Sale/show', [ 
                'successMessage' => Flash::get('successMessage'),
                'errorMessage'   => Flash::get('errorMessage'),
                'sale'           => $sale,
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
            $data     = [];

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
        try {
            if ( empty( $this->request ) ) {
                return $this->responseJson( 
                    '400', 
                    'Não é possível registrar uma venda sem itens' 
                );
            }

            $sale = SaleCreateService::execute(
                $this->request, 
                new SaleRepository(),
                new ProductRepository()
            );

            $this->data = $sale->toJson();

            foreach ( $sale->saleItems as $item ) {
                $this->data[] = $item->toJson(); 
            }

            return $this->responseJson( '201', 'Venda registrada com sucesso' );

		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

            return $this->responseJson( '400', $message );
		} 
    }
}
