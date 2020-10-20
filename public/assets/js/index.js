$(document).ready(function() {
 
$('form[name="nomemed"]').submit(function(e){
    var form = $(this)
    e.preventDefault()
    data = $(this).serializeArray()
    loadSubmit(data)
})
$('form[name="activeprinc"]').submit(function(e){
    e.preventDefault()
    data = $(this).serializeArray()
    loadSubmit(data)
})

function loadSubmit(data){
    $('.btnsearch').attr('disabled', true)

        if(data[1].name === "med_nm"){
            $('#btnnomemed').hide()
            $('.loadnomemed').show()
        }else{
            $('#btnactiveprinc').hide()
            $('.loadactiveprinc').show()
        }
        setTimeout(function(){
            $('.btnsearch').attr('disabled', false)
            submitSearch(data)
            //$('#formsearch input').attr('disabled', false);
            // if(data[1].name === "med_nm"){
            //     $('#btnnomemed').show()
            //     $('.loadnomemed').hide()

            // }else{
            //     $('#btnactiveprinc').show()
            //     $('.loadactiveprinc').hide()
            // }
       },500)
      
     
}
function submitSearch(D){
    console.log(D)
    $.ajax({
        url: '/search',
        type:'POST',
        data: D,
        dataType: 'JSON',
        success: function (response) {
            const error = true;
            if(response.validator === false){
                $('.validateM').html('<span id="message" style="color:red">Pesquisa inválida</span>')
                $('#btnnomemed').show()
                $('.loadnomemed').hide()
            }
            if(response.search_med === 'not_found'){
                $('#btnnomemed').show()
                $('.loadnomemed').hide()
            
                $('.validateM').html('<span class="ml-4 mt-2" id="message"style="color:red">Nenhum Medicamento foi encontrado</span>')
                setTimeout(function(){
                    $('.validateM').children().fadeOut(500).remove()
                },3000)

             
             }
             if(response.search_activeP === 'not_found'){
                $('#btnactiveprinc').show()
                $('.loadactiveprinc').hide() 

                $('.validateA').html('<span class="ml-4 mt-2" id="message"style="color:red">Nenhum principio ativo foi encontrado</span>')
                setTimeout(function(){
                    $('.validateA').children().fadeOut(500).remove()
                },3000)
             
             }
            if (response.redirect) {
                window.location.href = response.redirect;
            }
        }
    })
}
$('#dataTables').DataTable({
    //"order":[[1,'asc']],
    // "searching": false,
    // "paginate": false,
    "language": {
        
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
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
    
})
var isMobile = false; //initiate as false
    // device detection
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) { 
    isMobile = true;
        if(isMobile == true){
            // $('#dataTables').addClass('nowrap')
        }   
    }
})