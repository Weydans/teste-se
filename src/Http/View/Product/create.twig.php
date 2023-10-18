{% extends 'main.twig.php' %}

{% block content %}

<div class="d-flex justify-content-between mb-3 align-items-center">
    <h3>Produtos</h3>
</div>

<form action="/products/store" method="post">
  <div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input id="name" name="name" type="text" value="" class="form-control">
  </div>

  <div class="mb-3">
    <label for="value" class="form-label">Valor</label>
    <input id="value" name="value" type="number" step="0.01" value="" class="form-control">
  </div>
  
  <div class="mb-3">
    <label for="category_id" class="form-label">Categoria</label>
      <select id="category_id" name="category_id" class="form-control">
        <option value=""> --SELECIONE-- </option>
      </select>
  </div>

  <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

{% endblock %}
