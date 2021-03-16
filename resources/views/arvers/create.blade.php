
<!DOCTYPE html>
<html>
<head>
    <title>dijkistra</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>

<ul class="nav justify-content-center" style="margin-top: 1%;">
  <li class="nav-item">
    <a class="nav-link active" href="{{ URL::to('arvers') }}">Ver todas as Arestas e Vértices</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ URL::to('arvers/create') }}">Criar uma Aresta ou Vértice</a>
  </li>
</ul>
<div class="container" style="margin-top: 5%;">


<h1>Adicionar uma arver</h1>

<!-- if there are creation errors, they will show here -->

<form method="POST" action="{{ URL::to('arvers') }}">

    <div class="form-group">
        <label for="arestas">Arestas</label>
        <input type="text" class="form-control" name="arestas" id="arestas" placeholder="Arestas">
    </div>
    <div class="form-group">
        <label for="vertices">Vertices</label>
        <input type="text" class="form-control" name="vertices" id="vertices" placeholder="Vertices">
    </div>

    <button type="submit" class="btn btn-primary">Adicionar</button>
    @csrf
    </form>

</div>
</body>
</html>