$(document).ready(function () { 
    // Máscaras
    let $cpf = $("#modal-editar").find("#cpf");
    $cpf.mask('000.000.000-00', {reverse: true});

    let $rg = $("#modal-editar").find("#rg");
    $rg.mask('00.000.000-0', {reverse: true});

    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
      },
      spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
          }
      };
      
      $("#modal-editar").find('#telefone').mask(SPMaskBehavior, spOptions);
});
// ---------------------
$("#table").on("click", "#editar", function(){

    const $btn                        = $(this);
    const id                            = $btn.data('id');
    const $modal                    = $("#modal-editar");
    const $tr                           = $btn.parents('tr');
    const nome            = $tr.find('#nome').text();
    const cpf            = $tr.find('#cpf').text();
    const rg            = $tr.find('#rg').text();
    const dataNasc            = formatarDataParaSql($tr.find('#dataNasc').text());
    const telefone            = $tr.find('#telefone').text();
    $modal.find('#enderecos').html("")
    $($tr.find('ul')).each(function() {
        let dataEndereco    = $(this).data('endereco');
        // 
         $modal.find('#enderecos').append(`<input type="text" data-endereco="${dataEndereco}" class="uk-input uk-width-5-6" value="${$.trim($( this ).text())}"><a id="excluirEndereco"  data-endereco="${dataEndereco}"><span uk-icon="trash"></span></a>`);
    });

    // console.log(enderecos)
    $modal.find('#nome').val(nome);
    $modal.find('#cpf').val(cpf);
    $modal.find('#rg').val(rg);
    $modal.find('#dataNasc').val(dataNasc);
    $modal.find('#telefone').val(telefone);
    $modal.find('#id').val(id);

    UIkit.modal($modal).show();
})

// ---------------
$("#modal-editar").on("click", "#cancelar", function () {
    location.reload()
})

// ------------------
$("#modal-editar").on("click", "#excluirEndereco", function () {
    // alert('ok')
    const $btn           = $(this);
    const id               = $btn.data('endereco');
    // alert(id)
        $.ajax({
            url: 'excluirEndereco',
            type: 'POST',
            dataType: 'JSON',
            data: { id },
            beforeSend: () => $btn.text('Aguarde...').attr('disabled', 'disabled'),
            success: resultado => {
                if (resultado.status == 'sucesso') {
                    setTimeout(() => {
                        location.reload()
                    }, 2000);
                    UIkit.notification(resultado.mensagem, { pos: "top-center", status: "success" });
                }
                else {
                    UIkit.notification(resultado.mensagem, { pos: "top-center", status: "danger" });
                }
            },
            error: () => UIkit.notification("Oops, ocorreu algum erro interno. Tente novamente mais tarde.", { pos: "top-center", status: "danger" }),
            complete: () => $btn.text(atualTxt).removeAttr('disabled')
        })
})

// ---------------
$("#btn-editar").on("click", function () {

    const $btn = $(this);
    const $modal  = $('#modal-editar');
    const nome = $modal.find('#nome').val();
    const cpf = $modal.find('#cpf').val();
    const rg = $modal.find('#rg').val();
    const dataNasc = $modal.find('#dataNasc').val();
    const telefone = $modal.find('#telefone').val();
    const id = $modal.find('#id').val();
    const enderecosEdita = []
    $('#enderecos').find('input').each(function() {
        let dataEndereco    = $(this).data('endereco');
        enderecosEdita.push(dataEndereco +' - '+$(this).val())
    });
    const endereco = $('#todo-list').find('li')
    const enderecos = []
    $(endereco).each(function() {
        enderecos.push($(this).text())
    });
    // console.log(enderecosEdita +'-'+enderecos)
    const atualTxt = $btn.text();

        $.ajax({
            url: 'editarCliente',
            type: 'POST',
            dataType: 'JSON',
            data: { id, nome, cpf, rg, dataNasc, telefone, enderecosEdita, enderecos},
            beforeSend: () => $btn.text('Aguarde...').attr('disabled', 'disabled'),
            success: resultado => {
                if (resultado.status == 'sucesso') {
                    setTimeout(() => {
                        location.reload()
                    }, 2000);
                    UIkit.notification(resultado.mensagem, { pos: "top-center", status: "success" });
                }
                else {
                    UIkit.notification(resultado.mensagem, { pos: "top-center", status: "danger" });
                }
            },
            error: () => UIkit.notification("Oops, ocorreu algum erro interno. Tente novamente mais tarde.", { pos: "top-center", status: "danger" }),
            complete: () => $btn.text(atualTxt).removeAttr('disabled')
        })
})
// -----------------
$("#table").on("click", "#excluir", function(){
    const $btn              = $(this);
    const id                  = $btn.data('id');
    const $tr                = $btn.parents('tr');
    const nome            = $tr.find('#nome').text();

    const atualTxt = $btn.text();

    UIkit.modal.confirm(`Deseja realmente excluir o cliente <b>${nome}</b>?`).then(function() {
        $.ajax({
            url: 'excluirCliente',
            type: 'POST',
            dataType: 'JSON',
            data: { id },
            beforeSend: () => $btn.text('Aguarde...').attr('disabled', 'disabled'),
            success: resultado => {
                if (resultado.status == 'sucesso') {
                    setTimeout(() => {
                        location.reload()
                    }, 2000);
                    UIkit.notification(resultado.mensagem, { pos: "top-center", status: "success" });
                }
                else {
                    UIkit.notification(resultado.mensagem, { pos: "top-center", status: "danger" });
                }
            },
            error: () => UIkit.notification("Oops, ocorreu algum erro interno. Tente novamente mais tarde.", { pos: "top-center", status: "danger" }),
            complete: () => $btn.text(atualTxt).removeAttr('disabled')
        })
    })
})
// ---------------------------------
function addTodoItem() {
    var todoItem = $("#new-todo-item").val();
    $("#todo-list").append("<li> " + 
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
  
  });