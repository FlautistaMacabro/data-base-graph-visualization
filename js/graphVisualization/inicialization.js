// var cytoscape = require('cytoscape');
// import panzoom from "../../node_modules/cytoscape-panzoom/cytoscape-panzoom.js";

// panzoom( cytoscape ); // register extension

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

// var defaults = {
//   zoomFactor: 0.05, // zoom factor per zoom tick
//   zoomDelay: 45, // how many ms between zoom ticks
//   minZoom: 0.1, // min zoom level
//   maxZoom: 10, // max zoom level
//   fitPadding: 50, // padding when fitting
//   panSpeed: 10, // how many ms in between pan ticks
//   panDistance: 10, // max pan distance per tick
//   panDragAreaSize: 75, // the length of the pan drag box in which the vector for panning is calculated (bigger = finer control of pan speed and direction)
//   panMinPercentSpeed: 0.25, // the slowest speed we can pan by (as a percent of panSpeed)
//   panInactiveArea: 8, // radius of inactive area in pan drag box
//   panIndicatorMinOpacity: 0.5, // min opacity of pan indicator (the draggable nib); scales from this to 1.0
//   zoomOnly: false, // a minimal version of the ui only with zooming (useful on systems with bad mousewheel resolution)
//   fitSelector: undefined, // selector of elements to fit
//   animateOnFit: function(){ // whether to animate on fit
//     return false;
//   },
//   fitAnimationDuration: 1000, // duration of animation on fit

//   // icon class names
//   sliderHandleIcon: 'fa fa-minus',
//   zoomInIcon: 'fa fa-plus',
//   zoomOutIcon: 'fa fa-minus',
//   resetIcon: 'fa fa-expand'
// };

// panzoom( cytoscape );
// // add the panzoom control
// cy.panzoom( defaults );