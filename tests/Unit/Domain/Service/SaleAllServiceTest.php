<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Service\SaleAllService;
use App\Domain\Repository\SaleRepository;

#[CoversClass(SaleAllService::class)]
class SaleAllServiceTest extends TestCase
{
    public function test_execute_should_call_sale_repository_all_method() 
    {
        $saleRepository = $this->createMock( SaleRepository::class );
        $saleRepository->expects( $this->once() )->method( 'all' );
        
        SaleAllService::execute( $saleRepository );
    }
}
