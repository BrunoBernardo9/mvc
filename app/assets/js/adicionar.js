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
$("#resposta").on("click", "#editar", function(){
    const $btn                        = $(this);
    const id                            = $btn.data('id');
    const $modal                    = $("#modal-editar");
    const $tr                           = $btn.parents('tr');
    const equipamento            = $tr.find('#equipamento').text();
    const codigo                     = $tr.find('#codigo').html();
    const status                      = $tr.find('#status').html();
    const setor                       = $tr.find('#setor').html();
    const local                        = $tr.find('#local').html();
    const capacidade               = $tr.find('#capacidade').html();
    const resolucao                 = $tr.find('#resolucao').html();
    const fornecedor               = $tr.find('#fornecedor').html();
    const marca                      = $tr.find('#marca').html();
    const ultima                      = formatarDataParaSql($tr.find('#ultima').html());
    const dataProximaSql         = $tr.find('#proximaSql').html();
    const statusEquipamento   = $tr.find('#statusEquipamento').html();
    const frequencia                = $tr.find('#frequencia').html();

    $modal.find('#equipamento').val(equipamento);
    $modal.find('#codigo').val(codigo);
    $modal.find('#status').val(status);
    $modal.find('#setor').val(setor);
    $modal.find('#local').val(local);
    $modal.find('#capacidade').val(capacidade);
    $modal.find('#resolucao').val(resolucao);
    $modal.find('#fornecedor').val(fornecedor);
    $modal.find('#marca').val(marca);
    $modal.find('#frequencia').val(frequencia);
    $modal.find('#ultima').val(ultima);
    $modal.find('#proxima').val(dataProximaSql);
    $modal.find('#statusEquipamento').val(statusEquipamento);
    $modal.find('#id').val(id);

    UIkit.modal($modal).show();
})

// ---------------
$("#btn-editar").on("click", function () {
    const $btn = $(this);
    const $modal  = $('#modal-editar');
    const equipamento = $modal.find('#equipamento').val();
    const codigo = $modal.find('#codigo').val();
    const status = $modal.find('#status').val();
    const setor = $modal.find('#setor').val();
    const local = $modal.find('#local').val();
    const capacidade = $modal.find('#capacidade').val();
    const resolucao = $modal.find('#resolucao').val();
    const frequencia = $modal.find('#frequencia').val();
    const ultima = $modal.find('#ultima').val();
    const proxima = $modal.find('#proxima').val();
    const statusEquipamento = $modal.find('#statusEquipamento').val();
    const id = $modal.find('#id').val();
    const fornecedor = $modal.find('#fornecedor').val();
    const marca = $modal.find('#marca').val();

    const atualTxt = $btn.text();

    // alert(`${fornecedor} - ${marca}`);

        $.ajax({
            url: '/api/equipamentos/editar',
            type: 'POST',
            dataType: 'JSON',
            data: { id, equipamento, codigo, status, setor, local, capacidade, resolucao, fornecedor, marca, frequencia, ultima, proxima, statusEquipamento },
            beforeSend: () => $btn.text('Aguarde...').attr('disabled', 'disabled'),
            success: resultado => {
                if (resultado.status == 'sucesso') {
                    setTimeout(() => {
                        $("#btn-pesquisar").click();
                        UIkit.modal($modal).hide();
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

// -----------------------------
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

