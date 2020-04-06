 <div class="uk-container uk-container-small">
    <h1 class="uk-heading-small texto-laranja">Adicionar Cliente</h1>
        <div class="uk-grid-match uk-grid-small" id="form-adicionar" uk-grid>
            <div class="uk-width-1-1@m">
                <label>
                    Nome:
                    <input type="text" id="nome" class="uk-input" placeholder="Digite o nome completo" maxlength="50" required>             
                </label>    
            </div> 
            <div class="uk-width-1-2@m">
                <label>
                    CPF:
                    <input type="text" id="cpf" name="cpf" class="uk-input" placeholder="Digite o CPF" required>             
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
                    <input type="date" id="dataNasc" class="uk-input" maxlength="150" required>             
                </label>    
            </div>
            <div class="uk-width-1-2@m">
                <label>
                    Telefone:
                    <input type="text" id="telefone" class="uk-input" placeholder="Digite o telefone" maxlength="20" required>             
                </label>    
            </div>
            <div class="uk-width-1-1@m">
                <form id="form-add-todo" class="form-add-todo">
                    <label for="todo">Endereços:</label>
                    <input type="text" id="new-todo-item" class="new-todo-item uk-input" name="todo"  maxlength="150" placeholder="Digite o endereço">
                    <input type="submit" id="add-todo-item" class="add-todo-item uk-button btn-azul" value="Adicionar Endereço">
                </form>
            </div>
            
            <form id="form-todo-list">
                <ul id="todo-list" class="todo-list ">
                </ul>
            </form>
        </div>
        <div class="uk-flex uk-flex-right uk-margin-top">
        <button class="uk-button btn-laranja" id="btn-adicionar" type="button">Adicionar</button>
        <div>
    </div>
</div>