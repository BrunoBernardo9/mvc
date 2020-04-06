// --------------- Funções
const validarLogin = (nome, senha) => {
    return $.ajax({
        url: 'validarLogin',
        type: 'post',
        dataType: 'json',
        data: {nome, senha}
    });
}   
// --------------- Eventos
$("#btn-entrar").on("click", async function(){
    const $btn       = $(this);
    const $formLogin = $("#form-login");

    const estadoForm = verificarCamposEmBranco.call($formLogin);

    if(estadoForm){
        const nome     = $formLogin.find('#nome').val();
        const senha    = $formLogin.find('#senha').val();
        const textoBtn = $btn.text();

        try {
            $btn.text('Aguarde...');

            const resultado = await validarLogin(nome, senha);

            $btn.text(textoBtn);

            if(resultado.status == 'sucesso'){
                UIkit.notification('Login realizado com sucesso, aguarde...', {status: 'success', pos: 'top-center'});
                window.location = 'listar'
            }
            else{
                UIkit.notification(resultado.mensagem, {status: 'warning', pos: 'top-center'});
            }
        } catch (e){
            $btn.text(textoBtn);
            UIkit.notification('Oops, ocorreu algum erro. Tente novamente mais tarde.', {status: 'warning', pos: 'top-center'})
        }   
    }
    else{
        UIkit.notification('Oops, preencha todos os campos.', {status: 'warning', pos: 'top-center'});
    }
})
// ------------------