/**
 * Verifica se há campos em branco em um form. 
 */
const verificarCamposEmBranco = function(){
    let estado = true;

    $(this).find('input[required], textarea[required], select[required]').each(function(){
        const $campo = $(this);

        if($campo.val().length == 0){
            estado = false;
            $campo.addClass('uk-form-danger');
        }
        else{
            $campo.removeClass('uk-form-danger');
        }
    });
    return estado;
};
// -----------------------
const formatarDataParaSql = data => {
    // Formata data de dd/mm/YYYY para YYYY-mm-dd
    const parteData = data.split('/');
    return `${parteData[2]}-${parteData[1]}-${parteData[0]}`;
}
