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
      <th>Data</th>
      <th>Valor</th>
      <th>Opções</th>
    </tr>
  </thead>
  <tbody>

  {% for process in processes %}    
    <tr>
      <td>{{ process.id }}</td>

      <td>{{ process.created_at|date('Y-m-d H:i:s') }}</td>
      
      <td>{{ process.person.name }}</td>
      
      <td>
        <div class="d-flex justify-content-start">
          <a href="/sales/id/edit" class="btn btn-sm btn-success mr-2">
            Editar
          </a>
      
          <form action="/sales/id/delete" method="POST">
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
      <th>Data</th>
      <th>Valor</th>
      <th>Opções</th>
    </tr>
  </tfoot>
</table>

{% endblock %}
