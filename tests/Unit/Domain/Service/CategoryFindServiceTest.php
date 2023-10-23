<?php

namespace Tests\Unit\Domain\Service;

use App\Domain\Model\Category;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Service\CategoryFindService;
use App\Domain\Repository\CategoryRepository;

#[CoversClass(CategoryFindService::class)]
class CategoryFindServiceTest extends TestCase
{
    public function test_execute_should_call_category_repository_find_method() 
    {
        $category = $this->createMock( Category::class );

        $categoryRepository = $this->createMock( CategoryRepository::class );
        $categoryRepository->method( 'find' )->willReturn( $category );
        $categoryRepository->expects( $this->once() )->method( 'find' );
        
        CategoryFindService::execute( 1, $categoryRepository );
    }
}
