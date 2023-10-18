{% extends 'main.twig.php' %}

{% block content %}

<div class="row mb-3">
  <h3 class="col-md-6">Produtos</h3>

  <div class="col-md-6 text-right">
    <a href="/products/create" class="btn btn-sm btn-success">Novo Produto</a>
  </div>
</div>

<table class="table table-sm">
  <thead>
    <tr>
      <th>Id</th>
      <th>Nome</th>
      <th>Categoria</th>
      <th>Valor</th>
      <th>Opções</th>
    </tr>
  </thead>
  <tbody>

  {% for process in processes %}    
    <tr>
      <td>{{ process.id }}</td>

      <td>
      {% for actionLabel, actionValue in actions %}
        {{ process.type == actionValue ? actionLabel : '' }}
      {% endfor %}
      </td>

      <td>{{ process.person.name }}</td>
      
      <td>{{ process.unit.name }}</td>

      <td>
      {% for statusLabel, statusValue in statusList %}
        {{ process.status == statusValue ? statusLabel : '' }}
      {% endfor %}
      </td>

      <td>{{ process.created_at|date('Y-m-d H:i:s') }}</td>
      
      <td>{{ process.updated_at|date('Y-m-d H:i:s') }}</td>
      
      <td>
        <div class="d-flex justify-content-start">
          <a href="/{{ process.id }}" class="btn btn-sm btn-success mr-2">
            Editar
          </a>
      
          <form action="/delete/{{ process.id }}" method="POST">
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
          <th>Categoria</th>
          <th>Valor</th>
          <th>Opções</th>
      </tr>
  </tfoot>
</table>

{% endblock %}
