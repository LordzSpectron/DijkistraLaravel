<style>
.vis-panel.vis-background.vis-vertical{
    height: 600px !important;
}
</style>
<!DOCTYPE html>
<html>
<head>
    <title>dijkistra</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/vis-network@9.0.4/styles/vis-network.css">
    <script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
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


<h1>ID {{ $arvers->id }}</h1>

    <div class="jumbotron text-center">
    <strong>Arestas:</strong> {{ $arvers->arestas }}<br>
    <strong>Vértices:</strong> {{ $arvers->vertices }}
    <h2>Dijkistra Network Graph</h2>
        <div id="mynetwork" style="margin:10%;"></div>
        
        <script type="text/javascript">
            (function(){
                function getRandomInt(min, max) {
                    min = Math.ceil(min);
                    max = Math.floor(max);
                    return Math.floor(Math.random() * (max - min + 1)) + min;
                }
                function randomIntBetweenInclusive(a, b) {
                    return Math.floor(Math.random() * (b - a + 1) + a)
                }
                var g = new jsgraphs.WeightedDiGraph( {{ $arvers->arestas }} );
                var arestas = {{ $arvers->arestas }};
                var vertices = {{ $arvers->vertices }};

                for(v=0; v < {{ $arvers->arestas }}; v++){
                    g.addEdge(new jsgraphs.Edge(v, getRandomInt(0, vertices), v));
                    g.addEdge(new jsgraphs.Edge(v, getRandomInt(v, vertices), v));
                    g.addEdge(new jsgraphs.Edge(v, getRandomInt(0, vertices), v));
                }

                var dijkstra = new jsgraphs.Dijkstra(g, 0);

                
                
                var g_nodes = [];
                var g_edges = [];
                for(var v=0; v < {{ $arvers->arestas }}; ++v){
                    g.node(v).label = 'Aresta ' + v; // assigned 'Node {v}' as label for node v
                    g_nodes.push({
                       id: v,
                       label: g.node(v).label
                    });
                }

                if(v){
                    var v = getRandomInt(1, arestas);
                    if(dijkstra.hasPathTo(v)){
                        var path = dijkstra.pathTo(v);
                        console.log("=============================================")
                        console.log('Iniciando do 0 para ' + v);
                        document.write("<h4> Iniciando do 0 para " + v + " <\/h4>");
                        for(var i = 0; i < path.length; ++i) {
                            var e = path[i];
                            console.log("De: " + e.from() + ' Para => ' + e.to() + ' Pela vértice: ' + e.weight);
                            document.write("<h5> De: " + e.from() + ' Para => ' + e.to() + ' Pela vértice: ' + e.weight + "<\/h5>");
                            g_edges.push({
                                from: e.from(),
                                to: e.to(),
                                length: e.weight,
                                label: '' + e.weight,
                                arrows:'to',
                                color: '#00ff00'
                            });
                        }
                        console.log('Trajeto Finalizado, chegamos ao ' + v);
                        document.write("<h4> Trajeto Finalizado, chegamos ao " + v + " <\/h4>");
                        console.log('Distância : '  + dijkstra.distanceTo(v));
                        document.write("<h4>Distância : "  + dijkstra.distanceTo(v) + "<\/h4>");
                        console.log('Trajeto Finalizado, chegamos ao ' + v);
                        console.log("=============================================")
                    }
                }

                for(var v=0; v < g.V; ++v) {    
                    var adj_v = g.adj(v);
                    for(var i = 0; i < adj_v.length; ++i) {
                        var e = adj_v[i];
                        var w = e.other(v);
                        g_edges.push({
                            from: v,
                            to: w,
                            length: e.weight,
                            label: '' + e.weight,
                            arrows:'to'
                        });
                    };
                }

                console.log(g.V); // display 6, which is the number of vertices in g
                console.log(g.adj(0)); // display [5, 1, 2], which is the adjacent list to vertex 0
                
                var nodes = new vis.DataSet(g_nodes);

                // create an array with edges
                var edges = new vis.DataSet(g_edges);

                // create a network
                var container = document.getElementById('mynetwork');
                var data = {
                    nodes: nodes,
                    edges: edges
                };
                var options = {
                    autoResize: true,

                };
                var network = new vis.Network(container, data, options);
            })();
        </script>
    </div>

</div>
</body>
</html>