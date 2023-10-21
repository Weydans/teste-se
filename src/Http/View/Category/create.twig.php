{% extends 'main.twig.php' %}

{% block content %}

<div class="d-flex justify-content-between mb-3 align-items-center">
    <h3>Categorias</h3>
</div>

<form action="/categories/store" method="post">
  <div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input id="name" name="name" type="text" value="{{ old.name }}" class="form-control">
  </div>

  <div class="mb-3">
    <label for="tax" class="form-label">Imposto (%)</label>
    <input id="tax" name="tax" type="number" value="{{ old.tax }}" class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

{% endblock %}
