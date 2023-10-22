{% extends 'main.twig.php' %}

{% block content %}

<div id="alert_content"></div>

<div class="d-flex justify-content-between mb-3 align-items-center">
  <h3>Venda: #{{ "%04d" | format( sale.id ) }}</h3>
</div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th style="width: 30%">Produto</th>
      <th class="text-right">Valor (R$)</th>
      <th class="text-right">Imposto (%)</th>
      <th class="text-center">Quantidade</th>
      <th class="text-right">Imposto (R$)</th>
      <th class="text-right">Total (R$)</th>
    </tr>
  </thead>

  <tbody id="tbody_sale">
    {% for item in sale.saleItems %}
        <tr>
          <td>{{ item.product.name }}</td>
          <td class="text-right">{{ item.product.value | number_format( 2, ',', '.' ) }}</td>
          <td class="text-right">{{ item.product.category.tax | number_format( 2, ',', '.' ) }}</td>
          <td class="text-center">{{ item.quantity }}</td>
          <td class="text-right">{{ item.getTotalTaxes() | number_format( 2, ',', '.' ) }}</td>
          <td class="text-right">{{ item.getTotal() | number_format( 2, ',', '.' ) }}</td>
        </tr>
      {% endfor %} 
  </tbody>

  <tfoot>
    <tr>
      <th colspan="5" class="text-right">Total Impostos</th>
      <th class="text-right text-danger">
        R$ {{ sale.totalTaxes | number_format( 2, ',', '.' ) }}
      </th>
    </tr>

    <tr>
      <th colspan="5" class="text-right">Total Geral</th>
      <th class="text-right text-danger">
        R$ {{ sale.totalSale | number_format( 2, ',', '.' ) }}
      </th>
    </tr>
  </tfoot>
</table>

{% endblock %}
