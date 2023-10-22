<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

use App\Domain\Model\Category;
use App\Domain\Service\CategoryCreateService;
use App\Domain\Repository\CategoryRepository;

#[CoversClass(CategoryCreateService::class)]
#[UsesClass(Category::class)]
#[UsesClass(CategoryRepository::class)]
class CategoryCreateServiceTest extends TestCase
{
    public function test_execute_should_call_categoryRepository_save_method_and_return_new_category_on_success() 
    {
        $categoryDto       = new \stdClass();
        $categoryDto->name = 'Valid Name';
        $categoryDto->tax  = 12.5;
        
        $categoryRepository = $this->createMock( CategoryRepository::class );
        $categoryRepository->expects( $this->once() )->method( 'create' );
        
        $category = CategoryCreateService::execute( 
            $categoryDto, 
            $categoryRepository 
        );
        
        self::assertNotNull( $category );
    }
}
