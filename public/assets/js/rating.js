
    //CS = Class do star
    // N = numero da estrela que será fixada
    //DAD =  Classe pai das stars
   window.starCheckfix= function (formname){
        let N = $('span[name="ratefix-'+formname+'"]').attr('note')
        $('span[name="ratefix-'+formname+'"] .star'+N).attr('checked','checked')
        $('span[name="ratefix-'+formname+'"]').css('pointer-events', 'none')
    }
   