window.onload = function(){
    trocarBackground();
    setInterval(trocarBackground, 3600);
    
    // De 1 a 4
    var backgroundAtualIndex = 1;
    
    var body = $('body');        
    
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
    
    function resetarStyle(){
        var apagar = $('#novo-vendedor');
        apagar.removeClass('f1');
        apagar.removeClass('f2');
        apagar.removeClass('f3');
        apagar.removeClass('f4');
        apagar.removeClass('f5');
        
        $('.font1').removeClass('active');
        $('.font2').removeClass('active');
        $('.font3').removeClass('active');
        $('.font4').removeClass('active');
        $('.font5').removeClass('active');
        
        return apagar;
    }
    
    
    $('.font1').click(function(){
        resetarStyle().addClass('f1');
        $('.font1').addClass('active');
    });
    
    $('.font2').click(function(){
        resetarStyle().addClass('f2');
        $('.font2').addClass('active');
    });
    
    $('.font3').click(function(){
        resetarStyle().addClass('f3');
        $('.font3').addClass('active');
    });
    
    $('.font4').click(function(){
        resetarStyle().addClass('f4');
        $('.font4').addClass('active');
    });
    
    $('.font5').click(function(){
        resetarStyle().addClass('f5');
        $('.font5').addClass('active');
    });
    
    $('.detalhes').click(function(){
        $('.mostrar').dialog({
            minWidth: 920,
            draggable: false,
        });
        return false;
    });
    
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
    
    $('.jcarousel').jcarousel({
        wrap: 'both'
    });
    
    $('.jcarousel-navigation-prev').jcarouselControl({
        target: '-=1'
    });
    
    $('.jcarousel-navigation-next').jcarouselControl({
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