<?php
    // echo PATH_URL;
?>
<div class="uk-container h-100vh">
    <div class="uk-grid-small uk-height-1-1" uk-grid>
        <div class="uk-width-1-1 uk-flex uk-flex-center uk-flex-middle">
            <div class="uk-width-1-3@m uk-flex uk-flex-center uk-padding bg-cinza-escuro border-radius-20">
                <div id="form-login">
                    <div class="uk-margin uk-text-center">
                        <h2 class="uk-margin-remove uk-padding-remove uk-text-bold texto-branco">Login</h2>
                        <p class="uk-margin-remove uk-padding-remove texto-branco">Gerenciador de Clientes</p>
                    </div>

                    <div class="uk-margin">
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: user"></span>
                            <input class="uk-input" placeholder="Login" type="text" id="nome" required>
                        </div>
                    </div>

                    <div class="uk-margin">
                        <div class="uk-inline">
                            <span class="uk-form-icon" uk-icon="icon: lock"></span>
                            <input class="uk-input" placeholder="Senha" type="password" id="senha" required>
                        </div>
                    </div>

                    <div class="uk-margin uk-text-center">
                        <button class="uk-button btn-laranja" id="btn-entrar">Entrar</button><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
