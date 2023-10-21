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
class Product implements SerializeableInterface
{
    #[ID]
    #[GeneratedValue]
    #[Column]
    private int $id;

    #[Column]
    private string $name;

    #[Column]
    private float $value;

    #[ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    #[JoinColumn(name: 'category_id', referencedColumnName: 'id')]
    private Category $category;

    private array $serializeable = [ 'id', 'name', 'value', 'category' ];

    use Getters, Setters, Issets, Serializeable;

    public function __construct( string $name, float $value, Category $category )
    {
        $this->name = $name;
        $this->setValue( $value );
        $this->category = $category;
    }

    public function setValue( float $value )
    {
        if ( $value <= 0 ) {
            throw new Exception( 
                'Um produto não pode possuir preço menor ou igual a 0' 
            );
        }

        $this->value = $value;
    }
}
