<?php

namespace App\Http\Controller;

use App\Domain\Exception\InvalidDeleteException;
use Lib\Flash;
use Lib\Controller;
use App\Domain\Service\CategoryAllService;
use App\Domain\Service\CategoryFindService;
use App\Domain\Repository\CategoryRepository;
use App\Domain\Service\CategoryCreateService;
use App\Domain\Service\CategoryDeleteService;
use App\Domain\Service\CategoryUpdateService;
use App\Domain\Exception\RegisterNotFoundException;

class CategoryController extends Controller 
{
    public function index()
    {
        try {
            return $this->responseView( 'Category/datagrid', [ 
                'successMessage' => Flash::get('successMessage'),
                'errorMessage'   => Flash::get('errorMessage'),
                'categories'     => CategoryAllService::execute( new CategoryRepository ),
            ]);

        } catch ( \Exception $e ) {
            $message = $_ENV['APP_DEBUG'] 
                ? $e->getMessage() 
                : 'Houve um erro entre em contato com o suporte';

            return $this->responseView( 'Category/datagrid', [ 
                'message' => $message 
            ]);
        } 
    }

    public function create()
    {
        try {
			return $this->responseView( 'Category/create', [
				'successMessage' => Flash::get('successMessage'),
				'errorMessage'   => Flash::get('errorMessage'),
				'old'            => Flash::get('oldValue'),
			]);

		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

			return $this->responseView( 'Category/create', [ 
				'errorMessage' => $message 
			]);
        }    
    }

    public function store()
    {
        try {
            if ( empty( $this->request->name ) || empty( $this->request->tax ) ) {
                Flash::set('oldValue', $this->request);

                Flash::set(
                    'errorMessage', 
                    'Todos os campos são de preenchimento obrigatório'
                );

                return header("location: /categories/create");
            }

            CategoryCreateService::execute(
                $this->request, 
                new CategoryRepository(),
            );

            Flash::set( 'successMessage', 'Registro cadastrado com sucesso');

            return header("location: /categories");
		
		} catch ( \Exception $e ) {
            Flash::set('oldValue', $this->request);

			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

			Flash::set( 'errorMessage', $message );

			return header("location: /categories/create");
		} 
    }

    public function edit()
    {
        try {
            $category = CategoryFindService::execute( 
                $this->request->id, 
                new CategoryRepository() 
            );

            return $this->responseView( 'Category/edit', [
                'successMessage' => Flash::get('successMessage'),
                'errorMessage'   => Flash::get('errorMessage'),
                'old'            => Flash::get('oldValue'),
                'category'       => $category, 
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
            if ( empty( $this->request->name ) || empty( $this->request->tax ) ) {
                Flash::set('oldValue', $this->request);

                Flash::set(
                    'errorMessage', 
                    'Todos os campos são de preenchimento obrigatório'
                );

                return header("location: /categories/{$this->request->id}/edit");
            }

            CategoryUpdateService::execute(
                $this->request, 
                new CategoryRepository(),
            );

            Flash::set( 'successMessage', 'Registro cadastrado com sucesso');

            return header("location: /categories");
		
		} catch ( \Exception $e ) {
            Flash::set('oldValue', $this->request);

			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

			Flash::set( 'errorMessage', $message );

            return header("location: /categories/{$this->request->id}/edit");
		} 
    }

    public function delete()
    {
		try {
			CategoryDeleteService::execute(
				$this->request->id, 
				new CategoryRepository() 
			);

			Flash::set( 'successMessage', 'Registro removido com sucesso' );

			return header("location: /categories");
		
		} catch ( RegisterNotFoundException $e ) {
			Flash::set( 'errorMessage', 'Registro não encontrado' );

			return header("location: /categories");
		} catch ( InvalidDeleteException $e ) {
			Flash::set( 'errorMessage', $e->getMessage() );

			return header("location: /categories");
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

			Flash::set( 'errorMessage', $message );

			return header("location: /categories");
		} 
    }
}
