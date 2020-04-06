<?php
// echo '<pre>';
// print_r($param['listaClientes']);
// print_r($param['listaEnderecos']);
// echo '</pre>';
?>
<div class="uk-grid-small" uk-grid>
    <h1 class="uk-heading-small texto-laranja uk-margin-medium-top uk-margin-left">Listar Clientes</h1>
        <div class="uk-width-1-1@m uk-flex uk-flex-center uk-padding" id="table">
            <table class="uk-table tabela-separada" >
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="uk-text-center">CPF</th>
                        <th class="uk-text-center">RG</th>
                        <th class="uk-text-center">Data Nascimento</th>
                        <th class="uk-text-center">Telefone</th>
                        <th class="uk-text-center">Endereços</th>
                        <th class="uk-text-center">Editar</th>
                        <th class="uk-text-center">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($param['listaClientes'] as $cliente){ ?>
                    <tr>
                        <td id="nome"><?= $cliente['nome'] ?></td>
                        <td id="cpf" class="uk-text-center"><?= $cliente['cpf'] ?></td>
                        <td id="rg" class="uk-text-center"><?= $cliente['rg'] ?></td>
                        <td id="dataNasc" class="uk-text-center"><?= date("d/m/Y", strtotime($cliente['dataNasc'])) ?></td>
                        <td id="telefone" class="uk-text-center"><?= $cliente['telefone'] ?></td>
                        <td id="endereco" class="uk-text-center">
                        <?php foreach($param['listaEnderecos'] as $endereco){
                                    if($cliente['id'] == $endereco['idCliente']){  ?>
                                <ul data-endereco="<?= $endereco['id'] ?>">
                                <?= $endereco['endereco'] ?>
                                </ul>
                            <?php  } 
                             } ?>
                        </td>
                        <td class="uk-text-center"><a class="texto-laranja" id="editar" data-id="<?= $cliente['id'] ?>" uk-icon="cog"></a></td>
                        <td class="uk-text-center"><a class="texto-laranja" uk-icon="trash" data-id="<?= $cliente['id'] ?>" id="excluir"></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>     
</div>

<!-- Modal de editar cliente -->
<div id="modal-editar" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header bg-cinza-escuro">
            <h2 class="uk-modal-title texto-laranja">Editar Cliente</h2>
        </div>
        <div class="uk-modal-body">
        <div class="uk-grid-match uk-grid-small" id="form-adicionar" uk-grid>
            <input type="hidden" id="id">
            <div class="uk-width-1-1@m">
                <label>
                    Nome:
                    <input type="text" id="nome" class="uk-input" placeholder="Digite o nome completo" maxlength="50" required>             
                </label>    
            </div> 
            <div class="uk-width-1-2@m">
                <label>
                    CPF:
                    <input type="text" id="cpf" class="uk-input" placeholder="Digite o CPF" required>             
                </label>    
            </div>
            <div class="uk-width-1-2@m">
                <label>
                    RG:
                    <input type="text" id="rg" class="uk-input" placeholder="Digite o RG" required>             
                </label>    
            </div>
            <div class="uk-width-1-2@m">
                <label>
                    Data de Nascimento:
                    <input type="date" id="dataNasc" class="uk-input" required>             
                </label>    
            </div>
            <div class="uk-width-1-2@m">
                <label>
                    Telefone:
                    <input type="text" id="telefone" class="uk-input" placeholder="Digite o telefone" maxlength="150" required>             
                </label>    
            </div>
            <div class="uk-width-1-1@m">
            <label>
                Endereço:
                <div id="enderecos"><!-- JS --></div>
            </label>    
                <form id="form-add-todo" class="form-add-todo">
                    <!-- <label for="todo">Endereços:</label> -->
                    <input type="text" id="new-todo-item" class="new-todo-item uk-input" name="todo" maxlength="150" placeholder="Adicione um novo endereço">
                    <input type="submit" id="add-todo-item" class="add-todo-item uk-button btn-azul" value="Adicionar Endereço">
                </form>
            </div> 
            <form id="form-todo-list">
                <ul id="todo-list" class="todo-list ">
                </ul>
            </form>
        </div>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button btn-branco uk-modal-close" id="cancelar" type="button">Cancelar</button>
            <button class="uk-button btn-laranja" id="btn-editar" type="button">Editar</button>
        </div>
    </div>
</div>
