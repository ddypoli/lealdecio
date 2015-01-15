$(document).ready(function(){
    $('.remove').click(function(){
        $('.confirm_button').attr('data-foto-id', $(this).parent().attr('id'));
        $('.confirm_dialog').show();
        $('.confirm_button').focus();
        
    });
    
    $('.confirm_button').click(function(){
        var imagem_id = $('.confirm_button').attr('data-foto-id').replace('img-', '');
        
        $.ajax({
            url: '/codeigniter/admin/terreno/delete_image',
            type: 'POST',
            data: {id: imagem_id}
        }).done(function(html){
            $('body').append(html);
        });
        
        $('#img-' + imagem_id).remove();
        $('.confirm_dialog').hide();
    });
    
    $('.cancel_button').click(function(){
        $('.confirm_dialog').hide();
    });
        
});