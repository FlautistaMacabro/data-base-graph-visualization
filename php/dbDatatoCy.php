<script>
  function carregarBancoNoGrafo() {
    //alert(dataBaseSelected);
    let valorAtributoRaiz = <?php echo json_encode($_SESSION['registroRaiz']); ?>.toUpperCase();
    let registrosRelationDisp = <?php echo json_encode($_SESSION['registrosRelacionados']); ?>.map(str => {
      return (str.toString()).toUpperCase();
    });;
    addInitialNodes(valorAtributoRaiz, registrosRelationDisp);
    <?php
    if(isset($_SESSION['registrosSecundariosRelacionados'])): ?>
      let valorAtributoRaizSecundario = <?php echo json_encode($_SESSION['registroRaizSecundario']); ?>.toUpperCase();
      let registrosSecundariosRelationDisp = <?php echo json_encode($_SESSION['registrosSecundariosRelacionados']); ?>.map(str => {
        return (str.toString()).toUpperCase();
      });;
      addSecondaryNodes(valorAtributoRaiz, valorAtributoRaizSecundario, registrosSecundariosRelationDisp);
      //registrosRelationDisp = registrosRelationDisp.concat(registrosSecundariosRelationDisp);
      //registrosRelationDisp = registrosRelationDisp.sort();
    <?php endif;
    if(isset($_SESSION['registrosNovoAtributoRelacionadoSource'])): ?>
      let registrosSource = <?php echo json_encode($_SESSION['registrosNovoAtributoRelacionadoSource']); ?>.map(str => {
        return (str.toString()).toUpperCase();
      });;
      let registrosTarget = <?php echo json_encode($_SESSION['registrosNovoAtributoRelacionadoTarget']); ?>.map(str => {
        return (str.toString()).toUpperCase();
      });;
      let novosRegistros = [...new Set(registrosTarget)];
      addNewAttribute(novosRegistros, registrosSource, registrosTarget);
    <?php endif; ?>
    //addNewAttribute(registrosRelationDisp, registrosNewNodes, registrosNewEdges);*/
  }
</script>