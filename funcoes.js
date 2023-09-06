$(function () {

    //botao login
    $("#btnLogar").click(function () {
        var login = $("#txtLogin").val();
        var senha = $("#txtSenha").val();
        var loja = $("#cbLoja").val();

        if(login == ''|| senha == ''){
           $.notify("Informe o login e a senha corretamente...", "warn");
           return;
        }

        $.post("xp_portal.php",{
            op:3,
            login:login,
            senha:senha
           },function(ret){
            
            if (ret != ''){
                 var usuario = ret

                window.location.href = "/portal_gc_lar_novo/index.php?usuario=" + usuario + '?loja=' + loja;  

                $("#msgBemVindo").text(usuario + loja);
                                           
            }else{
                $.notify("Login ou senha invalida!");
            }           
        });
        
    });

    //divPedidos
    $("#divPedidos").dialog({
        autoOpen: false,
        width: 600,
        height: 500,
        buttons: {									
		    "Salvar": function() {

               id = $("#txtID").val();
               pedido = $("#txtPedido").val();
               marketplace =  $("#cbMarketplace").val();
               link_etiqueta = $("#txtlinkEtiqueta").val();
               id_loja = $("#cbloja2").val();
                              
               $.post("xp_portal.php",{
                op:2,
                id:id,
                pedido:pedido,
                marketplace:marketplace,
                link_etiqueta:link_etiqueta,
                id_loja:id_loja
               },function(ret){
                
                $("#divOrcamentos").load("xp_portal.php",{op:1,id:id},function(ret){							
                    $("#tabOrcamentos").gridSorter({headers: { 6: {sorter:false} }});
                });

                $.notify(ret, "success");

                $("#divPedidos").dialog("close");

               });
            },
            
            "Sair": function() {
                $("#divPedidos").dialog("close");
            }
        },       
    });

    //botao cadastrar pedido
    $("#btnCadastrar").click(function () {

        $("#txtID").val('');
        $("#txtPedido").val('');
        $("#cbMarketplace").val('');
        $("#txtlinkEtiqueta").val('');
        $("#divPedidos").dialog("open");
    });

    //btn para filtrar os pedidos
    $("#btnPesquisar").click(function () {

        var dataI = $("#dataI").val();
        var dataF = $("#dataF").val();
        var loja = $("#cbLoja").val();
        var status = $("#cbStatus").val();

        if(dataI == '' || dataF == ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Selecione uma data valida para fazer a pesquisa!',
              })
              return;
        }

        $(".box-search").show();
        
        $("#divOrcamentos").load("xp_portal.php",{op:1,dataI:dataI,dataF:dataF,loja:loja,status:status},function(ret){							
            $("#tabOrcamentos").gridSorter({headers: { 6: {sorter:false} }});
            
        });	
        
    });

    //nav que chama o cadastro de pedidos
    $("#navCadPeidos").click(function () {
        $("#divPedidos").dialog("open");     
    });

    //botao para editar um pedido
    $(document).on("click", "#linkEditar", function(){
        
        var conteudo = '';

        $(this).closest('tr').find('td').each(function () {
			conteudo += $(this).text() + ';';
		});

        var dados = conteudo.split(';');
		
        var id = dados[0];
        var pedido = dados[1];
        var marketplace = dados[2];
        var link_etiqueta = dados[4];

        $("#txtID").val(id);
        $("#txtPedido").val(pedido);
        $("#cbMarketplace").val(marketplace);
        $("#txtlinkEtiqueta").val(link_etiqueta);

        $("#divPedidos").dialog("open");
 
    });

    //Input pesquisa, cada letra digitada ele procura na grid 
    jQuery('#searchData').on('change', function(event){

        var textoProcurado = $("#searchData").val();
        
        $("#divOrcamentos").load("xp_portal.php",{op:1,textoProcurado:textoProcurado},function(ret){							
            $("#tabOrcamentos").gridSorter({headers: { 6: {sorter:false} }});
        });	

    });

    $(document).on("click", "#linkFinalizar", function(){
        
        var conteudo = '';

        $(this).closest('tr').find('td').each(function () {
			conteudo += $(this).text() + ';';
		});

        var dados = conteudo.split(';');
		
        var pedido = dados[1];

        //sweetalert -> para colocar animacao na hora de exibir o alerta
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: 'Têm certeza que deseja finalizar o pedido: ',
            text: pedido,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {

                $.post("xp_portal.php",{
                op:4,
                pedido:pedido
                },function(ret){
                
                $("#divOrcamentos").load("xp_portal.php",{op:1},function(ret){							
                    $("#tabOrcamentos").gridSorter({headers: { 6: {sorter:false} }});
                });

                $("#divPedidos").dialog("close");

                alert(ret)

               });

                
              swalWithBootstrapButtons.fire(
                'Sucesso!',
                'Pedido ' + pedido + ' Finalizado!',
                'success'
              )
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'Cancelado!',
                'Seu pedido não foi finalizado!',
                'error'
              )
            }
          })
    })
    //fim do sweetalert 


}); //fim
   
