class SaleItem 
{
  constructor( product, quantity ) 
  {
    this._product  = product;
    this._quantity = quantity; 
  }

  get id() 
  {
    return this._product.id;
  }

  get name() 
  {
    return this._product.name;
  }

  get price() 
  {
    return this._product.price;
  }

  get quantity() 
  {
    return this._quantity;
  }

  get tax() 
  {
    return this._product.category.tax;
  }

  getTotalTaxes() 
  {
    return ( this.tax * this._product.price * this._quantity ) / 100;
  }

  getTotal() 
  {
    return ( this._product.price * this._quantity ) + this.getTotalTaxes();
  }
}
