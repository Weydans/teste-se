{% extends 'main.twig.php' %}

{% block content %}

<div class="row mb-3">
  <h3 class="col-md-6">Vendas</h3>

  <div class="col-md-6 text-right">
    <a href="/sales/create" class="btn btn-sm btn-success">Nova Venda</a>
  </div>
</div>

<table class="table table-sm">
  <thead>
    <tr>
      <th>Id</th>
      <th>Valor</th>
      <th>Opções</th>
    </tr>
  </thead>
  <tbody>

  {% for sale in sales %}    
    <tr>
      <td>{{ sale.id }}</td>
      <td>{{ sale.totalSale }}</td>
      <td>
        <div class="d-flex justify-content-start">
          <a href="/sales/{{ sale.id }}" class="btn btn-sm btn-success mr-2">
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
