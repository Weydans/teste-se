class SaleController 
{
  constructor( itemsOnSale ) 
  {
    window.addEventListener( 'load', () => {
      const table         = document.getElementById( 'data_container' );
      this._alertContent  = document.getElementById( 'alert_content' );
      this._selectProduct = document.getElementById( 'select_product' );
      this._inputQuantity = document.getElementById( 'input_quantity' );
      this._btnAdd        = document.getElementById( 'btn_add' );
      this._btnSendSale   = document.getElementById( 'btn_send_sale' );
      this._saleItemList  = new SaleItemList( itemsOnSale );
      this._saleItemview  = new SaleListView( table ); 

      this.fillSelect( itemsOnSale );
      this.addItem( itemsOnSale );
      this.sendSale();
    });
  }

  fillSelect( itemsOnSale ) 
  {
    let options = itemsOnSale
                    .map( item => `<option value="${item.id}">${item.name}</option>` )
                    .join('');

    this._selectProduct.innerHTML = `
      <option value=""> --SELECIONE-- </option>
      ${options}
    `;
  }

  addItem( itemsOnSale ) 
  {
    this._btnAdd.addEventListener( 'click', () => {
      this._alertContent.innerHTML = ``;

      let productId = this._selectProduct.value;
      let quantity  = this._inputQuantity.value;

      if (   isNaN( productId )
          || productId <= 0
          || isNaN( quantity )
          || quantity <= 0 
      ) {
        this._alertContent.innerHTML = `
          <div class="alert alert-danger">
            Todos os campos são obrigatórios e aquantidade deve ser maior que 0
          </div>
        `;
        
        return;
      }

      let product = itemsOnSale.find( item => item.id == productId );

      try {
        this._saleItemList.add( new SaleItem( product, quantity ) );

      } catch ( e ) {
        this._alertContent.innerHTML = `
          <div class="alert alert-danger">${e.message}</div>
        `;
        
        console.error( e );
      }

      this._saleItemview.render( this._saleItemList );
      this.clearForm();
    } ); 
  }

  removeItem( event ) 
  {
    let id = event.target.value;
    this._saleItemList.remove( id  );
    this._saleItemview.render( this._saleItemList );
  }

  clearForm() 
  {
    this._selectProduct.value = '';
    this._inputQuantity.value = '';
  }

  sendSale() {
    this._btnSendSale.addEventListener( 'click', async ( event ) => { 
      event.preventDefault();

      if ( this._saleItemList.isEmpty() ) {
        this._alertContent.innerHTML = `
          <div class="alert alert-danger">
            Não é possível registrar uma venda sem itens
          </div>
        `;

        return;
      }

      const requestBody = this._saleItemList.items.map( item => {
        return { id: item.id, quantity: item.quantity };
      } );
      
      const httpClient = new HTTPClient( '/api' );
      const response = await httpClient.post( '/sales/store', requestBody );

      if ( response.message && response.httpCode == 201 ) {
        this._alertContent.innerHTML = `
          <div class="alert alert-success">${ response.message }</div>
        `;
        
        this._saleItemList.reset();
        this._saleItemview.render( this._saleItemList );

      } else if ( response.message && response.httpCode >= 400 ) {
        this._alertContent.innerHTML = `
          <div class="alert alert-danger">${ response.message }</div>
        `;
      }
    });
  }
}
