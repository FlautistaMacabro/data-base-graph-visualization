function addInitialNodes(nomeRaiz, listaRegistros) {
  cy.elements().remove();
  cy.add({
    group: 'nodes',
    data: { id: nomeRaiz, level: 3 },
    style: {
      'background-color': '#bc37d4',
      'shape': 'diamond',
      'border-width': 2,
      'border-style': 'solid',
      'border-color': '#ebcffa'
    }
  });

  listaRegistros.forEach(registro => {
    cy.add({
      group: 'nodes',
      data: { id: registro, level: 2 },
      style: {
        'background-color': 'rgba(215, 85, 255, 0.274)',
      }
    });
    cy.add({
      group: 'edges',
      data: { source: nomeRaiz, target: registro },
      style: {
        'line-color': 'floralwhite',
      }
    });
  });

  defineLayout();
}

function addNewAttribute(listaNovosRegistros, listaRegistrosSource, listaRegistrosTarget) {
  let quantRegistros = listaRegistrosSource.length;
  let quantNode = listaNovosRegistros.length;
  let i = 0;
  for (; i < quantNode; i++) {
    let registroSource = listaRegistrosSource[i];
    let registroTarget = listaRegistrosTarget[i];
    let registroNewNode = listaNovosRegistros[i];
    cy.add({
      group: 'nodes',
      data: { id: registroNewNode, level: 1 },
      style: {
        'shape': 'vee',
        'background-color': '#c96ffc',
      }
    });
    cy.add({
      group: 'edges',
      data: { source: registroSource, target: registroTarget },
      style: {
        'line-style': 'dashed',
        'line-color': 'floralwhite',
      }
    });
  }
  for (; i < quantRegistros; i++) {
    let registroSource = listaRegistrosSource[i];
    let registroTarget = listaRegistrosTarget[i];
    cy.add({
      group: 'edges',
      data: { source: registroSource, target: registroTarget },
      style: {
        'line-style': 'dashed',
        'line-color': 'floralwhite',
      }
    });
  }

  defineLayout();
}

function addSecondaryNodes(nomeRaiz, nomeRaizSecundario, listaRegistros) {
  cy.add({
    group: 'nodes',
    data: { id: nomeRaizSecundario, level: 3 },
    style: {
      'background-color': '#bc37d4',
      'shape': 'diamond',
      'border-width': 2,
      'border-style': 'solid',
      'border-color': '#ebcffa'
    }
  });

  listaRegistros.forEach(registro => {
    cy.add({
      group: 'nodes',
      data: { id: registro, level: 2 },
      style: {
        'background-color': 'rgba(215, 85, 255, 0.274)',
      }
    });
    cy.add({
      group: 'edges',
      data: { source: nomeRaizSecundario, target: registro },
      style: {
        'line-color': 'floralwhite',
      }
    });
  });

  // Relação de mesma tabela para as raizes
  cy.add({
    group: 'edges',
    data: { source: nomeRaiz, target: nomeRaizSecundario },
    style: {
      'line-style': 'dashed',
      'line-color': 'floralwhite',
    }
  });

  defineLayout();
}

function defineLayout() {
  let layout = cy.layout({
    name: 'concentric',
    concentric: function( node ){
      return node.data("level");
    },
    minNodeSpacing: 80,
    avoidOverlap: true
  });
  layout.run();
}