<?php
  if (session_status() === PHP_SESSION_NONE) 
    session_start();
?>
<div class="divcentralizar">
  <h2> Configurações </h2>
</div>
<div>
  <h3>Carregue seu script SQL:</h3>
  <form method="POST" action="php/uploadSQLFile.php" enctype="multipart/form-data">
    <input type="file" id="inputSQL" name="sqlScript" accept=".sql">
    <button class="bttcarregarscript" type="submit"> Carregar Script </button>
  </form>
</div>
<div>
  <h3>Escolha as informações da Raiz:</h3>
  <form method="POST" action="php/consultAvaliableTables.php">
    <label for="banco">Escolha o banco:</label>
    <?php if(isset($_SESSION['nomesBancos'])): ?>
      <select name="banco" id="selectBanco">
        <?php
          // Imprimindo os nomes de todos os bancos da conexão
          $nomesBancos = $_SESSION['nomesBancos'];
          if(isset($_SESSION['bancoEscolhido']))
            $bancoEscolhido = $_SESSION['bancoEscolhido'];
          else $bancoEscolhido = $nomesBancos[0];
          foreach ($nomesBancos as $nomeBanco){
            if($nomeBanco == $bancoEscolhido)
              $inicioOption = "<option selected ";
            else $inicioOption = "<option ";
            echo $inicioOption . "value=" . $nomeBanco . ">" . $nomeBanco . "</option>";
          }
        ?>
      </select>
      <button class="bttcarregarscript" type="submit"> Carregar Banco </button>
    <?php else: ?>
      <select name="banco" id="selectBanco" disabled>
        <option value="">Carregue seu Script antes...</option>
      </select>
      <button class="bttcarregarscript" type="submit" disabled> Carregar Banco </button>
    <?php endif; ?>
  </form>
  <form method="POST" action="php/consultAvaliableAttributes.php">
    <label for="tabela">Escolha a entidade raiz:</label>
    <?php if(isset($_SESSION['nomesTabelas'])): ?>
      <select name="tabela" id="selectTabela">
        <?php
          // Imprimindo os nomes de todas as tabelas do banco
          $nomesTabelas = $_SESSION['nomesTabelas'];
          if(isset($_SESSION['entidadeRaiz']))
            $tabelaEscolhida = $_SESSION['entidadeRaiz'];
          else $tabelaEscolhida = $nomesTabelas[0];
          foreach ($nomesTabelas as $nomeTabela){
            if($nomeTabela == $tabelaEscolhida)
              $inicioOption = "<option selected ";
            else $inicioOption = "<option ";
            echo $inicioOption . "value=" . $nomeTabela . ">" . $nomeTabela . "</option>";
          }
        ?>
      </select>
      <button class="bttcarregarscript" type="submit"> Carregar Entidade</button>
    <?php else: ?>
      <select name="tabela" id="selectTabela" disabled>
        <option value="">Escolha o banco antes...</option>
      </select>
      <button class="bttcarregarscript" type="submit" disabled> Carregar Entidade </button>
    <?php endif; ?>
  </form>
  <form method="POST" action="php/consultAvaliableData.php">
    <label for="atributoRaiz">Escolha o atributo raiz:</label>
    <?php if(isset($_SESSION['atributosDisp'])): ?>
      <select name="atributoRaiz" id="selectAtributoRaiz">
        <?php
          // Imprimindo os nomes de todos os atributos da tabela
          $nomesAtributos = $_SESSION['atributosDisp'];
          if(isset($_SESSION['atributoRaiz']))
            $atributoEscolhido = $_SESSION['atributoRaiz'];
          else $atributoEscolhido = $nomesAtributos[0];
          foreach ($nomesAtributos as $nomeAtributo){
            if($nomeAtributo == $atributoEscolhido)
              $inicioOption = "<option selected ";
            else $inicioOption = "<option ";
            echo $inicioOption . "value=" . $nomeAtributo . ">" . $nomeAtributo . "</option>";
          }
        ?>
      </select>
      <button class="bttcarregarscript" type="submit"> Carregar Atributo </button>
    <?php else: ?>
      <select name="atributoRaiz" id="selectAtributoRaiz" disabled>
        <option value="">Escolha a Tabela antes...</option>
      </select>
      <button class="bttcarregarscript" type="submit" disabled> Carregar Atributo </button>
    <?php endif; ?>
  </form>
  <form method="POST" action="php/consultEntityRelations.php">
    <label for="registroRaiz">Escolha o registro raiz:</label>
    <?php if(isset($_SESSION['registrosDisponiveis'])): ?>
      <select name="registroRaiz" id="selectRegistroRaiz">
        <?php
          // Imprimindo os nomes de todos os registros do atributo
          $nomesRegistros = $_SESSION['registrosDisponiveis'];
          if(isset($_SESSION['registroRaiz']))
            $registroEscolhido = $_SESSION['registroRaiz'];
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
        <option value="">Escolha o Atributo antes...</option>
      </select>
      <button class="bttcarregarscript" type="submit" disabled> Carregar Registro </button>
    <?php endif; ?>
  </form>
</div>
<div>
  <h3>Escolha as informações a serem Relacionadas:</h3>
  <form method="POST" action="php/consultRelationsAttributes.php">
    <label for="tabelaRelacionada">Escolha uma entidade relacionada:</label>
    <?php if(isset($_SESSION['tabelasRelacionadas'])): ?>
      <select name="tabelaRelacionada" id="selectTabelasRelacionadas">
        <?php
          // Imprimindo os nomes de todos as tabelas que estão relacionadas
          $nomesTabelasRelacionadas = $_SESSION['tabelasRelacionadas'];
          if(isset($_SESSION['tabelaRelacionada']))
            $tabelaEscolhidaRelacionada = $_SESSION['tabelaRelacionada'];
          else $tabelaEscolhidaRelacionada = $nomesTabelasRelacionadas[0];
          foreach ($nomesTabelasRelacionadas as $nomeTabelaRelacionada){
            if($nomeTabelaRelacionada == $tabelaEscolhidaRelacionada)
              $inicioOption = "<option selected ";
            else $inicioOption = "<option ";
            echo $inicioOption . "value=" . $nomeTabelaRelacionada . ">" . $nomeTabelaRelacionada . "</option>";
          }
        ?>
      </select>
      <button class="bttcarregarscript" type="submit"> Carregar Entidade </button>
    <?php else: ?>
      <select name="tabelaRelacionada" id="selectTabelasRelacionadas" disabled>
        <option value="">Escolha o Registro Raiz antes...</option>
      </select>
      <button class="bttcarregarscript" type="submit" disabled> Carregar Entidade </button>
    <?php endif; ?>
  </form>
  <form method="POST" action="php/consultRelationsData.php">
    <label for="atributoRelacionado">Escolha um atributo relacionado:</label>
    <?php if(isset($_SESSION['atributosRelacionados'])): ?>
      <select name="atributoRelacionado" id="selectAtributosRelacionados">
        <?php
          // Imprimindo os nomes de todos os atributos que podem ser relacioandos
          $nomesAtributosRelacionados = $_SESSION['atributosRelacionados'];
          if(isset($_SESSION['atributoRelacionado']))
            $atributoEscolhidoRelacionado = $_SESSION['atributoRelacionado'];
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
      <select name="atributoRelacionado" id="selectAtributosRelacionados" disabled>
        <option value="">Escolha uma Entidade Relacionada antes...</option>
      </select>
      <button class="bttcarregarscript" type="submit" disabled> Carregar Atributo </button>
    <?php endif; ?>
  </form>
</div>
<div class="divcentralizar">
<?php
if(isset($_SESSION['atributoRelacionado'])): ?>
  <button id="bttcarregargrafo" onclick="carregarBancoNoGrafo()"> Atualizar Grafo </button>
<?php
else: ?>
  <button id="bttcarregargrafo" disabled> Atualizar Grafo </button>
<?php
endif; ?>
</div>