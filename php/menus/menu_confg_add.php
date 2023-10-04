<?php
  if (session_status() === PHP_SESSION_NONE) 
    session_start();
?>
<div class="divcentralizar">
  <h2> Configurações adicionais </h2>
</div>
<div>
  <h3>Insira um novo registro raiz de mesma tabela e atributo:</h3>
  <form method="POST" action="php/consultNewNode.php">
    <label for="registroRaiz">Escolha outro registro raiz:</label>
    <?php if(isset($_SESSION['registrosDisponiveisRestantes'])): ?>
      <select name="registroRaizSecundario" id="selectRegistroRaiz">
        <?php
          // Imprimindo os nomes de todos os registros do atributo
          $nomesRegistros = $_SESSION['registrosDisponiveisRestantes'];
          if(isset($_SESSION['registroRaizSecundario']))
            $registroEscolhido = $_SESSION['registroRaizSecundario'];
          else $registroEscolhido = $nomesRegistros[0];
          foreach ($nomesRegistros as $nomeRegistro){
            if($nomeRegistro == $registroEscolhido)
              $inicioOption = "<option selected ";
            else $inicioOption = "<option ";
            echo $inicioOption . "value=" . $nomeRegistro . ">" . $nomeRegistro . "</option>";
          }
        ?>
      </select>
      <button class="bttcarregarscript" type="submit"> Carregar Registro </button>
    <?php else: ?>
      <select name="registroRaiz" id="selectRegistroRaiz" disabled>
        <option value="">Defina as configurações principais antes...</option>
      </select>
      <button class="bttcarregarscript" type="submit" disabled> Carregar Registro </button>
    <?php endif; ?>
  </form>
  <h3>Insira um outro atributo relacionado para a raiz escolhida:</h3>
  <form method="POST" action="php/consultNewData.php">
    <label for="atributoRelacionado">Escolha um atributo relacionado:</label>
    <?php if(isset($_SESSION['atributosRelacionadosRestantes'])): ?>
      <select name="atributoRelacionadoNovo" id="selectAtributosRelacionados">
        <?php
          // Imprimindo os nomes de todos os atributos que podem ser relacioandos
          $nomesAtributosRelacionados = $_SESSION['atributosRelacionadosRestantes'];
          if(isset($_SESSION['atributoRelacionadoNovo']))
            $atributoEscolhidoRelacionado = $_SESSION['atributoRelacionadoNovo'];
          else $atributoEscolhidoRelacionado = $nomesAtributosRelacionados[0];
          foreach ($nomesAtributosRelacionados as $nomeAtributoRelacionado){
            if($nomeAtributoRelacionado == $atributoEscolhidoRelacionado)
              $inicioOption = "<option selected ";
            else $inicioOption = "<option ";
            echo $inicioOption . "value=" . $nomeAtributoRelacionado . ">" . $nomeAtributoRelacionado . "</option>";
          }
        ?>
      </select>
      <button class="bttcarregarscript" type="submit"> Carregar Atributo </button>
    <?php else: ?>
      <select name="atributoRelacionadoNovo" id="selectAtributosRelacionados" disabled>
        <option value="">Defina as configurações principais antes...</option>
      </select>
      <button class="bttcarregarscript" type="submit" disabled> Carregar Atributo </button>
    <?php endif; ?>
  </form>
</div>