<?php

namespace App\Domain\Service;

use App\Domain\Repository\CategoryRepository;
use App\Domain\Exception\InvalidDeleteException;

class CategoryDeleteService
{
    public static function execute(
        int $id,  
        CategoryRepository $repository 
    ) : bool
    {
        $category = $repository->find( $id );

        if ( count( $category->products ) ) {
            throw new InvalidDeleteException( 
                'Não é permitido remover categorias que possuem produtos registrados' 
            );
        }

        return $repository->delete( $id );
    }
}
