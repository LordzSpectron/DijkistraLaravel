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

<h1 style="text-align: center;">Todos os dados</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Aresta</td>
            <td>Vértice</td>
            <td>Ações</td>
        </tr>
    </thead>
    <tbody>
    @foreach($arvers as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->arestas }}</td>
            <td>{{ $value->vertices }}</td>

            <td>
                <form method="POST" action="{{ URL::to('arvers/' . $value->id) }}">

                <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" class="btn btn-danger">Excluir</button>
                @csrf
                </form>
                <br>
                <a class="btn btn-small btn-success" href="{{ URL::to('arvers/' . $value->id) }}">Mostrar</a>

            </td>

        </tr>
    @endforeach
    </tbody>
</table>

</div>
</body>
</html>