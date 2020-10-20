const _med = document.querySelector(".medsingle");
window.med = _med.getAttribute("content");

$(document).ready(function() {
    starCheckfix('G')
    starCheckfix('SE')
    starCheckfix('E')
    
       $('form[name="comment"]').submit(function(e){
        var form = $(this)
        $('#btnsave').toggle()
        $('#loadsave').toggle()

           e.preventDefault()
           grecaptcha.ready(function() {
                let grecaptchaKeyMeta = document.querySelector("meta[name='grecaptcha-key']");
                let grecaptchaKey = grecaptchaKeyMeta.getAttribute("content");
                let grecaptchaAction = form.attr('data-grecaptcha-action');
        
                
                grecaptcha.execute(grecaptchaKey, {action: grecaptchaAction})
                .then((token) => {
                    let recap = document.querySelector('#med_nm_recap')
                    recap.value = token
                })
            })
            setTimeout(function(){
            var data_array = $('form[name="comment"]').map(function () {
                return $(this).serializeArray()
                })
                data_array.push({name: "med", value: med})
                console.log(data_array)
                $.ajax({
                    url: '../storecomment',
                    type:'POST',
                    data: data_array,
                    dataType: 'json',
                    success: function (response) {
                        console.log(response.validator_fail)
                        $('#btnsave').toggle()
                        $('#loadsave').toggle()
                        if(response.save){
                            $('.modal-content').css('display','none')
                            $('.preload-comment').attr('id','preloader').css({'display':'block', 'background':'transparent'})
                            $('#preloader').unbind()
                            $('#preloader').delay(1000).fadeOut('slow', function() {
                                $(this).stop()
                                $('.preload-comment').removeAttr('id').css({'display':'none'})
                                $('#av-btn').hide()
                                $('#avcheck').show()
                                $('#modalcomment').modal('hide')
                                $('.modal-content').css('display','block')
                                $('form[name="comment"]').get(0).reset()
                            })
                        }else if(response.double_vote){
                            $('.errorMsg').html('<div class="col-12 mx-2"><span>'+response.double_vote+'</span></div>')
                            setTimeout(function(){
                                $('.errorMsg').children().fadeOut(700).remove()
                            },3000)
                        }else if(response.validator_fail){
                            $('.errorMsg').html('<div class="col-12"><span>'+response.validator_fail+'</span></div>')
                            setTimeout(function(){
                                $('.errorMsg').children().fadeOut(700).remove()
                            },3000)
                        }
                            
                      
                    },
                    error: function (err) {
                        console.log(err)
                        if (err.status == 500) { // when status code is 422, it's a validation issue
                        $('.errorMsg').html('<div class="col-12"><span>'+response.validator_fail+'</span></div>')
                        setTimeout(function(){
                            $('.errorMsg').children().fadeOut(700).remove()
                        },3000)
                        }
                    }
                })
            },800)
          
   })

    $('#dataTables').DataTable({
        "searching": false,
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "Nenhuma linha selecionada",
                    "1": "Selecionado 1 linha"
                }
            },
            "buttons": {
                "copy": "Copiar para a área de transferência",
                "copyTitle": "Cópia bem sucedida",
                "copySuccess": {
                    "1": "Uma linha copiada com sucesso",
                    "_": "%d linhas copiadas com sucesso"
                }
            }
        }
        
    });
    $('#avalienow').click(function(e){
        e.preventDefault()
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#table").offset().top
        }, 400);
        $("#av-btn").effect("shake",{times:2},1000)
    })

    var isMobile = false; //initiate as false
    // device detection
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) { 
        isMobile = true;
    }
    console.log(isMobile)

    if(isMobile == false){
        $('.Msocialmedia').hide()
     }else{
        $('.Msocialmedia').show()

         
     }   
     
    $('#share').click(function(e){
        e.preventDefault()
         $([document.documentElement, document.body]).animate({
            scrollTop: $('.Dsocialmedia').offset().top
        }, 500);
        
    })

});