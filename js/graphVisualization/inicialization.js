var cy = cytoscape({

  container: document.getElementById('cy'), // container to render in

  style: [ // the stylesheet for the graph
    {
      selector: 'node',
      style: {
        'background-color': '#666',
        'label': 'data(id)'
      }
    },

    {
      selector: 'edge',
      style: {
        'width': 3,
        'line-color': '#ccc',
        'target-arrow-color': '#ccc',
        'target-arrow-shape': 'none',
      }
    }
  ],

  layout: {
    name: 'concentric',
    concentric: function( node ){
      return node.data("level");
    },
    minNodeSpacing: 80,
  }

});