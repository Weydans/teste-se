<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" 
          crossorigin="anonymous">

    <title>Soft Expert</title>
  </head>
  <body>
      <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand">Soft<b>Expert</b></a>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="/products">Produtos</a></li>
            <li class="nav-item"><a class="nav-link" href="/categories">Categorias</a></li>
            <li class="nav-item"><a class="nav-link" href="/taxes">Impostos</a></li>
            <li class="nav-item"><a class="nav-link" href="/sales">Venda</a></li>
          </ul>
        </div>
      </nav>
    
    <div id="content" class="container my-5 pb-5">
      {% if errorMessage %}
        <div class="alert alert-danger">{{ errorMessage }}</div>
      {% endif %}

      {% if successMessage %}
        <div class="alert alert-success">{{ successMessage }}</div>
      {% endif %}

      {% block content %}{% endblock %}
    </div> 
    
    <footer class="p-3 bg-dark text-white text-center">
      <span>Desenvolvido por Weydans Barros</span>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" 
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
            crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" 
            crossorigin="anonymous">
    </script>
  </body>
</html>
