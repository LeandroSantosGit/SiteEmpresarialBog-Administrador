$(document).ready(function () {
    // Expandir ou ocultar menu
    $('.sidebar-toggle').on('click', function () {
        $('.sidebar').toggleClass('toggled');
    });
    
    // Carregar pagina com submenu aberto
    var active = $('.sidebar .active');
    if (active.length && active.parent('.collapse').length) {
        var parent = active.parent('.collapse');
        
        parent.prev('a').attr('aria-expanded', true);
        parent.addClass('show');
    }
});

function previewImage() {
    var img = document.querySelector('input[name=imageNew]').files[0];
    var preview = document.querySelector('#previewImgUser');
    
    var reader = new FileReader();
    reader.onloadend = function() {
        preview.src = reader.result;
    };
    
    if (img) {
        return reader.readAsDataURL(img);
    }
    return preview.src = "";
}

// Modal de confirmação para deletar usuário
$(document).ready(function() {
    $('a[data-confirm]').click(function(ev) {
        var href = $(this).attr('href');
        if (!$('#confirm-delete').length) {
            $('body').append(`
                <div class='modal fade'
                     id='confirm-delete'
                     tabindex='-1'
                     role='dialog'
                     aria-labelledby='apagaritemLabel'
                     aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header bg-primary text-white'>
                                Excluir
                                <button type='button'
                                        class='close'
                                        data-dismiss='modal'
                                        aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                Tem certeza que deseja apagar ?
                            </div>
                            <div class='modal-footer'>
                                <button type='button'
                                        class='btn btn-outline-success'
                                        data-dismiss='modal'>
                                    Cancelar
                                </button>
                                    <a id='dataConfirmOk'
                                       type='button'
                                       class='btn btn-outline-danger'>
                                        Apagar
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>`);
        }
        
        $('#dataConfirmOk').attr('href', href);
        $('#confirm-delete').modal({show: true});
        return false;
    });
});

$('#passar_mouse').mouseover(function(){
  $('#mostrar').css('display', 'block');
});

$('#passar_mouse').mouseout(function(){
  $('#mostrar').css('display', 'none');
});

$(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});