<?php

namespace App\Http\Controller;

use Lib\Controller;
use Lib\Flash;

class ProductController extends Controller 
{
    public function index()
    {
        try {
            return $this->responseView( 'Product/datagrid', [ 
                'successMessage' => Flash::get('successMessage'),
                'errorMessage'   => Flash::get('errorMessage'),
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
			return $this->responseView( 'Product/create', [
				'successMessage' => Flash::get('successMessage'),
				'errorMessage'   => Flash::get('errorMessage'),
				'old'            => Flash::get('oldValue'),
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

    }

    public function edit()
    {
        try {
            return $this->responseView( 'Product/edit', [
                'successMessage' => Flash::get('successMessage'),
                'errorMessage'   => Flash::get('errorMessage'),
                'old'            => Flash::get('oldValue'),
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

    }

    public function delete()
    {

    }
}
