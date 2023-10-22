{% extends 'main.twig.php' %}

{% block content %}

<div class="row mb-3">
  <h3 class="col-md-6">Vendas</h3>

  <div class="col-md-6 text-right">
    <a href="/sales/create" class="btn btn-sm btn-success">Nova Venda</a>
  </div>
</div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th class="text-right">Valor</th>
      <th class="text-center">Opções</th>
    </tr>
  </thead>
  <tbody>

  {% for sale in sales %}    
    <tr>
      <td><b>#{{ "%04d" | format( sale.id ) }}</b></td>
      <td class="text-right">R$ {{ sale.totalSale | number_format( 2, ',', '.' ) }}</td>
      <td>
        <div class="d-flex justify-content-center">
          <a href="/sales/{{ sale.id }}" class="btn btn-sm btn-primary mr-2">
            Visualizar
          </a>
        </div>
      </td>
    </tr>
  {% else %}
    <tr>
      <td colspan="8" class="py-4"><p class="text-center">Nenhum registro encontrado!</p></td>
    </tr>
  {% endfor %}
  </tbody>
</table>

{% endblock %}
