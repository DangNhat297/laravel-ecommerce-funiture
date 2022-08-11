$(document).ready(function(){
    setTimeout(function(){
        $('.pre-loading').fadeOut(900)
        $('html, body').css({
            overflow: 'auto',
            height: 'auto'
        })
    }, 900)
})