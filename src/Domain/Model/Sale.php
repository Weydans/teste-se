<?php

namespace App\Domain\Model;

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
use Doctrine\Common\Collections\ArrayCollection;

#[Entity]
class Sale implements SerializeableInterface
{
    #[ID]
    #[GeneratedValue]
    #[Column]
    private int $id;

    #[Column]
    private float $totalTaxes;

    #[Column]
    private float $totalSale;

    #[OneToMany( 
        targetEntity: SaleItem::class, 	
        mappedBy: 'sale', 
        cascade: ['persist', 'remove'] 
    )]
    private Collection $saleItems;
    
    private array $serializeable = [ 'id', 'totalTaxes', 'totalSale', 'saleItems' ];

    use Getters, Setters, Issets, Serializeable;

    public function __construct()
    {
        $this->saleItems  = new ArrayCollection();
        $this->totalTaxes = 0.0;
        $this->totalSale  = 0.0;
    }

    public function addItem( SaleItem $saleItem ) 
    {
        $this->saleItems->add( $saleItem );
        $saleItem->sale = $this;

        $this->totalTaxes += $saleItem->getTotalTaxes();
        $this->totalSale  += $saleItem->getTotal();
    }
}
