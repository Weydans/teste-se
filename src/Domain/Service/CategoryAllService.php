<?php

namespace App\Domain\Service;

use App\Domain\Repository\CategoryRepository;

class CategoryAllService
{
    public static function execute( CategoryRepository $repository ) : array 
    {
        return $repository->all();
    }
}
