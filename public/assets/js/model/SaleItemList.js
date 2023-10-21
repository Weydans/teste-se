class SaleItemList 
{
  constructor( itemsOnSale ) 
  {
    this._itemsOnSale = itemsOnSale;
    this._items       = []; 
  }

  get items() 
  {
    return [].concat( this._items );
  }

  add( product ) 
  {
    this._items.forEach( ( item ) => {
      if ( item.id == product.id ) {
        throw new Error( 'Não é permitido adicionar o mesmo item mais de uma vez' );
      }
    } );

    this._items.push( product );
  }

  remove( id ) 
  {
    this._items = this._items.filter( ( item ) => {
      if ( item.id != id ) {
        return item;
      }
    } );
  }

  calculateTotalTaxes() 
  {
    return this._items.reduce( ( total, item ) => total += item.getTotalTaxes(), 0 );
  }

  calculateTotal() 
  {
    return this._items.reduce( ( total, item ) => total += item.getTotal(), 0 );
  }

  isEmpty() {
    return this._items.length <= 0 ? true : false;
  }

  reset() {
    this._items = [];
  }
}
