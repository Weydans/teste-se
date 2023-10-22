{% extends 'main.twig.php' %}

{% block content %}

<div class="row mb-3">
  <h3 class="col-md-6">Categorias</h3>

  <div class="col-md-6 text-right">
    <a href="/categories/create" class="btn btn-sm btn-success">Nova Categoria</a>
  </div>
</div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Nome</th>
      <th class="text-right">Imposto</th>
      <th class="text-center">Opções</th>
    </tr>
  </thead>
  <tbody>

  {% for category in categories %}    
    <tr>
      <td>{{ category.id }}</td>
      <td>{{ category.name }}</td>
      <td class="text-right">{{ category.tax }}%</td>
      
      <td>
        <div class="d-flex justify-content-center">
          <a href="/categories/{{ category.id }}/edit" class="btn btn-sm btn-success mr-2">
            Editar
          </a>
      
          <form action="/categories/{{ category.id }}/delete" method="POST">
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
