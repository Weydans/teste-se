{% extends 'main.twig.php' %}

{% block content %}

<div id="alert_content"></div>

<div class="d-flex justify-content-between mb-3 align-items-center">
  <h3>Vendas</h3>
</div>

<form id="form_sale" action="/sales/store" method="post">
  <div class="row mb-4">
    <div class="form-group col-md-6">
      <label>Produto</label>
      <select id="select_product" name="select_product" class="form-control form-control-sm">
      </select>
    </div>

    <div class="form-group col-md-5">
      <label>Quantidade</label>
      <input id="input_quantity" name="value" type="number" step="1.0" min="1" value="" class="form-control form-control-sm" />
    </div>

    <div class="form-group col-md-1 pt-4">
      <button id="btn_add" type="button" class="btn btn-sm btn-block btn-success mt-2"> + </button>
    </div>
  </div>
</form>

<table id="data_container" class="table table-sm"></table>

<button id="btn_send_sale" type="submit" class="btn btn-primary">Registrar Venda</button>

<script src="/assets/js/model/SaleItem.js"></script>
<script src="/assets/js/model/SaleItemList.js"></script>
<script src="/assets/js/view/SaleListView.js"></script>
<script src="/assets/js/service/HTTPClient.js"></script>
<script src="/assets/js/controller/SaleController.js"></script>
<script>
const products = [
  {
    id: 1,
    name: 'LG K10',
    price: 1000.0,
    category: {
      name: "Telefornia",
      tax: 10,
    }
  },  
  {
    id: 2,
    name: 'Batedeira',
    price: 200.5,
    category: {
      name: "Eletro",
      tax: 12,
    }
  },  
  {
    id: 3,
    name: 'Cadeira',
    price: 250.90,
    category: {
      name: "Moveis",
      tax: 31.7,
    }
  },  
];

let saleController = new SaleController( products );
</script>

{% endblock %}
