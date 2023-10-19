{% extends 'main.twig.php' %}

{% block content %}

<div class="row mb-3">
  <h3 class="col-md-6">Categorias</h3>

  <div class="col-md-6 text-right">
    <a href="/categories/create" class="btn btn-sm btn-success">Nova Categoria</a>
  </div>
</div>

<table class="table table-sm">
  <thead>
    <tr>
      <th>Id</th>
      <th>Nome</th>
      <th>Opções</th>
    </tr>
  </thead>
  <tbody>

  {% for process in processes %}    
    <tr>
      <td>{{ process.id }}</td>

      <td>{{ process.person.name }}</td>
      
      <td>
        <div class="d-flex justify-content-start">
          <a href="/products/id/edit" class="btn btn-sm btn-success mr-2">
            Editar
          </a>
      
          <form action="/categories/id/delete" method="POST">
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
  <tfoot>
      <tr>
          <th>Id</th>
          <th>Nome</th>
          <th>Opções</th>
      </tr>
  </tfoot>
</table>

{% endblock %}
