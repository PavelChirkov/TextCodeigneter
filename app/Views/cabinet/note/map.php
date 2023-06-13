<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Vis Network | Basic usage</title>

    <script
      type="text/javascript"
      src="/js/vis.js"
    ></script>

    <style type="text/css">
      #mynetwork {
        width: 600px;
        height: 400px;
        border: 1px solid lightgray;
      }
    </style>
  </head>
  <body>
    <p>Create a simple network with some nodes and edges.</p>

    <div id="mynetwork"></div>

    <script type="text/javascript">
      // create an array with nodes
      var nodes = new vis.DataSet([
        { id: 1, label: "Node 1" },
        { id: 2, label: "Node 2" },
        { id: 3, label: "Node 3" },
        { id: 4, label: "Node 4" },
        { id: 5, label: "Node 5" },
        { id: 6, label: "Node 6" },
      ]);

      // create an array with edges
      var edges = new vis.DataSet([
        { from: 1, to: 3 },
        { from: 1, to: 2 },
        { from: 2, to: 4 },
        { from: 2, to: 5 },
        { from: 3, to: 3 },
        { from: 6, to: 1 },
      ]);

      // create a network
      var container = document.getElementById("mynetwork");
      var data = {
        nodes: nodes,
        edges: edges,
      };
      var options = {};
      var network = new vis.Network(container, data, options);
    </script>
  </body>
</html>