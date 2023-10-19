<?php

namespace App\Http\Controller;

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
			return $this->responseView( 'Sale/create', [
				'successMessage' => Flash::get('successMessage'),
				'errorMessage'   => Flash::get('errorMessage'),
				'old'            => Flash::get('oldValue'),
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

    }
}
