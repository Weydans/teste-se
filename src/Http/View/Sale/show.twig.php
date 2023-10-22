{% extends 'main.twig.php' %}

{% block content %}

<div id="alert_content"></div>

<div class="d-flex justify-content-between mb-3 align-items-center">
  <h3>Venda: #{{ "%04d" | format( sale.id ) }}</h3>
</div>

<table class="table table-sm">
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
    {% for item in sale.saleItems %}
        <tr>
          <td>{{ item.product.name }}</td>
          <td>{{ item.product.value | number_format( 2, ',', '.' ) }}</td>
          <td>{{ item.product.category.tax | number_format( 2, ',', '.' ) }}</td>
          <td>{{ item.quantity }}</td>
          <td>{{ item.getTotalTaxes() | number_format( 2, ',', '.' ) }}</td>
          <td>{{ item.getTotal() | number_format( 2, ',', '.' ) }}</td>
        </tr>
      {% endfor %} 
  </tbody>

  <tfoot>
    <tr>
      <th colspan="5" class="text-right">Total Impostos</th>
      <th colspan="2" class="text-right text-danger">
        R$ {{ sale.totalTaxes | number_format( 2, ',', '.' ) }}
      </th>
    </tr>

    <tr>
      <th colspan="5" class="text-right">Total Geral</th>
      <th colspan="2" class="text-right text-danger">
        R$ {{ sale.totalSale | number_format( 2, ',', '.' ) }}
      </th>
    </tr>
  </tfoot>
</table>

{% endblock %}
