{% extends 'main.twig.php' %}

{% block content %}

<div class="row mb-3">
  <h3 class="col-md-6">Produtos</h3>

  <div class="col-md-6 text-right">
    <a href="/products/create" class="btn btn-sm btn-success">Novo Produto</a>
  </div>
</div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Nome</th>
      <th>Valor</th>
      <th>Categoria</th>
      <th>Imposto</th>
      <th class="text-center">Opções</th>
    </tr>
  </thead>
  <tbody>

  {% for product in products %}    
    <tr>
      <td>{{ product.id }}</td>
      <td>{{ product.name }}</td>
      <td>R$ {{ product.value | number_format( 2, ',', '.' ) }}</td>
      <td>{{ product.category.name }}</td>
      <td>{{ product.category.tax | number_format( 2, ',', '.' ) }}%</td>
      <td>
        <div class="d-flex justify-content-center">
          <a href="/products/{{ product.id }}/edit" class="btn btn-sm btn-success mr-2">
            Editar
          </a>
      
          <form action="/products/{{ product.id }}/delete" method="POST">
            <button type="submit" class="btn btn-sm btn-danger">
                Remover
            </button>
          </form>
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
