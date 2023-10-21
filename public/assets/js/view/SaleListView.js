class SaleListView 
{
  constructor( container ) 
  {
    this._container = container;
  }

  render( list ) 
  {
    this._container.innerHTML = `
      <thead>
        <tr>
          <th style="width: 30%">Produto</th>
          <th>Valor (R$)</th>
          <th>Imposto (%)</th>
          <th>Quantidade</th>
          <th>Imposto (R$)</th>
          <th colspan="2">Total (R$)</th>
        </tr>
      </thead>

      <tbody id="tbody_sale">
        ${ list.items.map( item => `
            <tr>
              <td>${ item.name }</td>
              <td>${ `${ item.value.toFixed( 2 ) }`.replace('.', ',') }</td>
              <td>${ item.tax }</td>
              <td>${ item.quantity }</td>
              <td>
                ${ `${ item.getTotalTaxes().toFixed( 2 ) }`.replace('.', ',') }
              </td>
              <td>
                ${ `${ item.getTotal().toFixed( 2 ) }`.replace('.', ',') }
              </td>
              <td class="text-right">
                <button value="${item.id}" 
                  onclick="saleController.removeItem( event )" 
                  type="button" 
                  class="btn btn-sm btn-block btn-danger"
                > 
                  X 
                </button>
              </td>
            </tr>
          `).join('') 
        }
      </tbody>

      <tfoot>
        <tr>
          <th colspan="5" class="text-right">Total Impostos</th>
          <th colspan="2" class="text-right text-danger">
            R$ ${ `${ list.calculateTotalTaxes().toFixed( 2 ) }`. replace( '.', ',' ) }
          </th>
        </tr>

        <tr>
          <th colspan="5" class="text-right">Total Geral</th>
          <th colspan="2" class="text-right text-danger">
            R$ ${ `${ list.calculateTotal().toFixed( 2 ) }`.replace( '.', ',' ) }
          </th>
        </tr>
      </tfoot>
    `;
  }
}
