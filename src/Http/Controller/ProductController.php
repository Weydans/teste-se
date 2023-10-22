<?php

namespace App\Http\Controller;

use App\Domain\Exception\InvalidDeleteException;
use Lib\Flash;
use Lib\Controller;
use App\Domain\Service\ProductAllService;
use App\Domain\Service\CategoryAllService;
use App\Domain\Service\ProductFindService;
use App\Domain\Service\ProductCreateService;
use App\Domain\Service\ProductUpdateService;
use App\Domain\Service\ProductDeleteService;
use App\Domain\Repository\ProductRepository;
use App\Domain\Repository\CategoryRepository;
use App\Domain\Exception\RegisterNotFoundException;
use App\Domain\Repository\SaleItemRepository;

class ProductController extends Controller 
{
    public function index()
    {
        try {
            $products = ProductAllService::execute( new ProductRepository() );

            return $this->responseView( 'Product/datagrid', [ 
                'successMessage' => Flash::get('successMessage'),
                'errorMessage'   => Flash::get('errorMessage'),
                'products'       => $products,
            ]);

        } catch ( \Exception $e ) {
            $message = $_ENV['APP_DEBUG'] 
                ? $e->getMessage() 
                : 'Houve um erro entre em contato com o suporte';

            return $this->responseView( 'Product/datagrid', [ 
                'message' => $message 
            ]);
        } 
    }

    public function create()
    {
        try {
            $categories = CategoryAllService::execute( new CategoryRepository() );

			return $this->responseView( 'Product/create', [
				'successMessage' => Flash::get('successMessage'),
				'errorMessage'   => Flash::get('errorMessage'),
				'old'            => Flash::get('oldValue'),
                'categories'     => $categories,
			]);

		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

			return $this->responseView( 'Product/create', [ 
				'errorMessage' => $message 
			]);
        }    
    }

    public function store()
    {
        try {
            if (   empty( $this->request->name ) 
                || empty( $this->request->value )
                || empty( $this->request->category_id ) 
            ) {
                Flash::set('oldValue', $this->request);
                Flash::set(
                    'errorMessage', 
                    'Todos os campos são de preenchimento obrigatório'
                );

                return header("location: /products/create");
            }

            ProductCreateService::execute(
                $this->request, 
                new ProductRepository(),
                new CategoryRepository()
            );

            Flash::set( 'successMessage', 'Registro cadastrado com sucesso');

            return header("location: /products");
		
		} catch ( \Exception $e ) {
            Flash::set('oldValue', $this->request);

			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

			Flash::set( 'errorMessage', $message );

			return header("location: /products/create");
		} 
    }

    public function edit()
    {
        try {
            $categories = CategoryAllService::execute( new CategoryRepository() );
            $product    = ProductFindService::execute( 
                $this->request->id,
                new ProductRepository() 
            );

            return $this->responseView( 'Product/edit', [
                'successMessage' => Flash::get('successMessage'),
                'errorMessage'   => Flash::get('errorMessage'),
                'old'            => Flash::get('oldValue'),
                'categories'     => $categories,
                'product'        => $product,
            ]);

        } catch ( \Exception $e ) {
            $message = $_ENV['APP_DEBUG'] 
                ? $e->getMessage() 
                : 'Houve um erro entre em contato com o suporte';

            return $this->responseView( 'Product/edit', [ 
                'errorMessage' => $message 
            ]);
        } 
    }

    public function update()
    {
        try {
            if (   empty( $this->request->name ) 
                || empty( $this->request->value )
                || empty( $this->request->category_id ) 
            ) {
                Flash::set('oldValue', $this->request);
                Flash::set(
                    'errorMessage', 
                    'Todos os campos são de preenchimento obrigatório'
                );

                return header("location: /products/{$this->request->id}/edit");
            }

            ProductUpdateService::execute(
                $this->request, 
                new ProductRepository(),
                new CategoryRepository()
            );

            Flash::set( 'successMessage', 'Registro cadastrado com sucesso');

            return header("location: /products");
		
		} catch ( \Exception $e ) {
            Flash::set('oldValue', $this->request);

			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

			Flash::set( 'errorMessage', $message );

            return header("location: /products/{$this->request->id}/edit");
		} 
    }

    public function delete()
    {
		try {
			ProductDeleteService::execute(
				$this->request->id, 
				new ProductRepository(), 
                new SaleItemRepository()
			);

			Flash::set( 'successMessage', 'Registro removido com sucesso' );

			return header("location: /products");
		
		} catch ( RegisterNotFoundException $e ) {
			Flash::set( 'errorMessage', 'Registro não encontrado' );

			return header("location: /products");

		} catch ( InvalidDeleteException $e ) {
			Flash::set( 'errorMessage', $e->getMessage() );

			return header("location: /products");
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

			Flash::set( 'errorMessage', $message );

			return header("location: /products");
		} 
    }
}
