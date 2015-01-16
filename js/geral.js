window.onload = function(){
    //trocarBackground();
    //setInterval(trocarBackground, 3600);
    
    // De 1 a 4
    //var backgroundAtualIndex = 1;
    
    //var body = $('body');        
    /*
    function trocarBackground(){
        var url = "url('images/background-*_2.jpg')";
        
        if(backgroundAtualIndex < 4){
            backgroundAtualIndex++;
        }else{
            backgroundAtualIndex = 1;
        }
        
        url = url.replace("\*", backgroundAtualIndex);
        
        $('#home').animate({opacity: 0.9}, 1200, function(){
            $('#home').css("background-image", url);
            $('#home').animate({opacity: 1});
        });

    }
    */
    
    $('.submit').click(function(){
        $.ajax({
            type: 'POST',
            url: 'mail.php',
            async: true,
            success: function (data) {
                alert(data);
            }
        });
        return false;
    });
    
    $('.slider').jcarousel({
        wrap: 'both',
        vertical: true
    });
    
    $('.imagens-prev').jcarouselControl({
        target: '-=1'
    });
    
    $('.imagens-next').jcarouselControl({
        target: '+=1'
    });
    
    $('.mensagem').jcarousel({
        wrap: 'both'
    });
   
    $('.msg-prev').jcarouselControl({
        target: '-=1'
    });
    
    $('.msg-next').jcarouselControl({
        target: '+=1'
    });
};