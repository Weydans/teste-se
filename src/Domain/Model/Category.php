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
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\Common\Collections\Collection;

#[Entity]
class Category implements SerializeableInterface
{
    #[ID]
    #[GeneratedValue]
    #[Column]
    private int $id;

    #[Column]
    private string $name;

    #[Column]
    private float $tax;

    #[OneToMany( 
        targetEntity: Product::class, 	
        mappedBy: 'category', 
        cascade: ['persist', 'remove'] 
    )]
    private Collection $products;
    
    private array $serializeable = [ 'id', 'name', 'tax' ];

    use Getters, Setters, Issets, Serializeable;

    public function __construct( string $name, float $tax )
    {
        $this->name = $name;
        $this->setTax( $tax );
    }

    public function setTax( float $tax )
    {
        if ( $tax < 0 ) {
            throw new Exception( 'Uma categoria não pode possuir imposto menor que 0' );
        }

        $this->tax = $tax;
    }
}
