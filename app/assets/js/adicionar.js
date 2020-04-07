$(document).ready(function () { 
    // Máscaras
    let $cpf = $("#cpf");
    $cpf.mask('000.000.000-00', {reverse: true});

    let $rg = $("#rg");
    $rg.mask('00.000.000-0', {reverse: true});

    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
      },
      spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
          }
      };
      
      $('#telefone').mask(SPMaskBehavior, spOptions);
});
// ---------------------
$("#btn-adicionar").on("click", function () {
    const $formCadastro = $("#form-adicionar");
    const resultadoForm = verificarCamposEmBranco.call($formCadastro);

    if(resultadoForm){
        const nome = $('#nome').val();
        const cpf = $('#cpf').val();
        const rg = $('#rg').val();
        const dataNasc = $('#dataNasc').val();
        const telefone = $('#telefone').val();
        const endereco = $('#todo-list').find('li')
        const enderecos = []
        $(endereco).each(function() {
            enderecos.push($( this ).text())
        });
        
        //console.log(endereco)
        $.ajax({
            url: 'adicionarCliente',
            type: 'POST',
            dataType: 'JSON',
            data: { nome, cpf, rg, dataNasc, telefone, enderecos },
            // beforeSend: () => $btn.text('Aguarde...').attr('disabled', 'disabled'),
            success: resultado => {
                if (resultado.status == 'sucesso') {
                    setTimeout(() => {
                        UIkit.notification(resultado.mensagem, { pos: "top-center", status: "success" });
                        location.reload();
                    }, 2000);
                    
                }
                else {
                    UIkit.notification(resultado.mensagem, { pos: "top-center", status: "danger" });
                }
            },
            error: () => UIkit.notification("Oops, ocorreu algum erro interno. Tente novamente mais tarde.", { pos: "top-center", status: "danger" }),
        })
    } else {
        UIkit.notification("Preencha os campos requeridos.", { pos: "top-center", status: "warning" })
    }
})
// -----------------------------------------------------
function addTodoItem() {
    var todoItem = $("#new-todo-item").val();
    $("#todo-list").append("<li name='endercos'> " + 
                           todoItem +
                           " <span uk-icon='close' class='todo-item-delete'>"+
                           "</span></li>");
    
   $("#new-todo-item").val("");
  }
  
  function deleteTodoItem(e, item) {
    e.preventDefault();
    $(item).parent().fadeOut('slow', function() { 
      $(item).parent().remove();
    });
  }
  
                             
  function completeTodoItem() {  
    $(this).parent().toggleClass("strike");
  }
  
  $(function() {
   
     $("#add-todo-item").on('click', function(e){
       e.preventDefault();
       if($("#new-todo-item").val().length > 0){
        addTodoItem()
       }
     });
    
    $("#todo-list").on('click', '.todo-item-delete', function(e){
      var item = this; 
      deleteTodoItem(e, item)
    })
    
    $(document).on('click', ".todo-item-done", completeTodoItem)
})
  
// -----------------------

