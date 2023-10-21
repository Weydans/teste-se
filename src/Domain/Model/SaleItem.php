<?php

namespace App\Domain\Model;

use \Exception;
use Lib\Issets;
use Lib\Getters;
use Lib\Setters;
use Lib\Serializeable;
use Lib\SerializeableInterface;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\GeneratedValue;

#[Entity]
class SaleItem implements SerializeableInterface
{
    #[ID]
    #[GeneratedValue]
    #[Column]
    private int $id;

    #[Column]
    private int $quantity;

    #[ManyToOne(targetEntity: Product::class)]
    #[JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private Product $product;

    #[ManyToOne(targetEntity: Sale::class)]
    #[JoinColumn(name: 'sale_id', referencedColumnName: 'id')]
    private Sale $sale;

    private array $serializeable = [ 'id', 'quantity', 'product', 'sale' ];

    use Getters, Setters, Issets, Serializeable;

    public function __construct( 
        int $quantity, 
        Product $product, 
    )
    {
        $this->setQuantity( $quantity );

        $this->product = $product;
    }

    public function setQuantity( int $quantity )
    {
        if ( $quantity <= 0 ) {
            throw new Exception( 
                'Um item de venda não pode ter sua quantidade inferior a 1' 
            );
        }

        $this->quantity = $quantity;
    }

    public function setSale( Sale $sale ) 
    {
        $this->sale = $sale;
    }

    public function getTotalTaxes() : float
    {
        return $this->product->value * $this->product->category->tax / 100 * $this->quantity;
    }

    public function getTotal() : float
    {
        return ( $this->product->value * $this->quantity ) + $this->getTotalTaxes();
    }
}
