{% extends 'main.twig.php' %}

{% block content %}

<div class="d-flex justify-content-between mb-3 align-items-center">
  <h3>Vendas</h3>
</div>

<form action="/sales/store" method="post">
  <table class="table">
    <thead>
      <tr>
        <td>Produto</td>
        <td>Valor</td>
        <td>Quantidade</td>
        <td>Imposto</td>
        <td colspan="2">Total</td>
      </tr>
    </thead>
  
    <tbody>
      <tr>
        <td>
          <select id="category_id" name="category_id" class="form-control">
            <option value=""> --SELECIONE-- </option>
          </select>
        </td>
        
        <td>
          <input id="name" name="name" type="text" value="" class="form-control">
        </td>
        
        <td>
          <input id="value" name="value" type="number" step="0.01" value="" class="form-control" readonly>
        </td>
        
        <td>
          <input id="value" name="value" type="number" step="0.01" value="" class="form-control" readonly>
        </td>
        
        <td>
          <input id="value" name="value" type="number" step="0.01" value="" class="form-control" readonly>
        </td>
      
        <td>
          <button class="btn btn-success"> + </button>
        </td>
      </tr>
    </tbody>
  </table>
  
  <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

{% endblock %}
