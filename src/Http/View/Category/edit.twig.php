{% extends 'main.twig.php' %}

{% block content %}

<div class="d-flex justify-content-between mb-3 align-items-center">
    <h3>Categorias</h3>
</div>

<form action="/categories/id/update" method="post">
  <div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input id="name" name="name" type="text" value="" class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Atualizar</button>
</form>

{% endblock %}
