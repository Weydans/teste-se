<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Service\CategoryAllService;
use App\Domain\Repository\CategoryRepository;

#[CoversClass(CategoryAllService::class)]
class CategoryAllServiceTest extends TestCase
{
    public function test_execute_should_call_category_repository_all_method() 
    {
        $categoryRepository = $this->createMock( CategoryRepository::class );
        $categoryRepository->expects( $this->once() )->method( 'all' );
        
        CategoryAllService::execute( $categoryRepository );
    }
}
