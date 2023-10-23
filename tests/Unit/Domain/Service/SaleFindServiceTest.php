<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Model\Sale;
use App\Domain\Service\SaleFindService;
use App\Domain\Repository\SaleRepository;

#[CoversClass(SaleFindService::class)]
class SaleFindServiceTest extends TestCase
{
    public function test_execute_should_call_sale_repository_find_method() 
    {
        $sale = $this->createMock( Sale::class );

        $saleRepository = $this->createMock( SaleRepository::class );
        $saleRepository->method( 'find' )->willReturn( $sale );
        $saleRepository->expects( $this->once() )->method( 'find' );
        
        SaleFindService::execute( 1, $saleRepository );
    }
}
