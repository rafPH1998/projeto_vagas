//FAZENDO A REQUISICAO PARA PEGAR REGISTROS DOS USUARIOS EM TEMPO REAL
$(function(){
    $('#pesquisa').keyup(function() {
        var pesquisa = $('input').val();

        if(pesquisa != '') {

            $.ajax({
				url:'search.php',
				method:'POST',
				dataType:'json',
				data: {palavra: pesquisa},
				success: function(data) {
                    $('#tbody').html('');
					$.each(data, function (a, obj) {
                        
                        //TRATANDO A DATA PARA JOGAR NO FRONT
                        var date = new Date(obj.data);
                        var dia = String(date.getDate());
                        var mes = String(date. getMonth() + 1). padStart(2, '0');
                        var ano = date.getFullYear();
                        var dataAtual = dia + '/' + mes + '/' + ano;

                        var item = obj.status;
                        if(item == 1) {
                            item = 'Ativa';
                        } else {
                            item = 'Inativa';
                        }
                    
                        //MONTANDO A TABELA QUE VEM DO BACK
                        $("#tbody").append('<tr><td>'+ obj.id +'</td><td>'+ obj.titulo+'</td><td>'+ item +'</td><td>'+ dataAtual +'</td><td>'+ obj.cidade +'</td>Editar<td></td></tr>')
                    })
				}
			})
            .fail(function(){
            	$('#table').html('').append('<div class="message">Nenhuma vaga encontrada.</div>');
            });

        } else {
			window.location.href = window.location.href;
		}
    });
});

function ver_descricao(id) {
    $.ajax({
        url:'ver_descricao.php',
        type: 'POST',
        data: {id:id},
        beforeSend:function() {   
            $('#modal').fadeTo("slow", 1).modal('show');    
            $('#modal').modal('show');
        },
        success:function(html) {
			
            $('#modal').find('.modal-body').html(html);
            $('#modal').find('.modal-body').find('form').on('submit', salvar);

            $('#modal').find('show');
        }
    });
}


function editar(id) {
    $.ajax({
        url:'edit_vagas.php',
        type: 'POST',
        data: {id:id},
        beforeSend:function() {   
            $('#modal').fadeTo("slow", 1).modal('show');    
            $('#modal').modal('show');
        },
        success:function(html) {
			
            $('#modal').find('.modal-body').html(html);
            $('#modal').find('.modal-body').find('form').on('submit', salvar);

            $('#modal').find('show');
        }
    });
}

function salvar(e) {
    e.preventDefault();
    var titulo = $(this).find('input[name=titulo]').val();
    var cidade = $(this).find('input[name=cidade]').val();
    var descricao = $(this).find('textarea[name=descricao]').val();

    var id = $(this).find('input[name=id]').val();

    $.ajax({
        url:'edit_action.php',
        type:'POST',
        data: {
            titulo:titulo,  
            cidade:cidade, 
            descricao:descricao, 
            id:id
        },
        success:function() {
            window.location.href = window.location.href;
        }
    });
}

// FUNCAO PARA O USUARIO VER A SENHA AO CLICAR NO CHECKBOX NO ARQUIVO DE CADASTRAR, LA POSSUI O INPUT DE SENHA E CONFIRMAR A SENHA
function togglePassword1() {
    let inputPassword = document.getElementById('password');
    let passwordConfirmation = document.getElementById('password_confirmation');
    if (inputPassword.type == 'password' && passwordConfirmation.type == 'password') {
        inputPassword.type = 'text';
        passwordConfirmation.type = 'text';
    } else {
        inputPassword.type = 'password';
        passwordConfirmation.type = 'password';
    }
}

//NESSA, APENAS UMA FUNCAO PARA UM UNICO INPUT DA SENHA
function togglePassword2() {
    let inputPassword = document.getElementById('password');
    if (inputPassword.type == 'password') {
        inputPassword.type = 'text';
        passwordConfirmation.type = 'text';
    } else {
        inputPassword.type = 'password';
        passwordConfirmation.type = 'password';
    }
}

function excluir(id) {
    $('#exampleModal').modal('show');
}

function cadastrar(loggedId) {
    $.ajax({
        url:'inscricao_vaga.php',
        type: 'POST',
        data: {id:loggedId},
        beforeSend:function() {   
            $('#modal2').fadeTo("slow", 0.9).modal('show');    
            $('#modal2').modal('show');
        },
        success:function(html) {
            $('#modal2').find('.modal-body2').html(html);
            $('#modal2').find('.modal-body2').find('form').on('submit', function(e){
                e.preventDefault();
                var name = $(this).find('input[name=name]').val();
                var cpf = $(this).find('input[name=cpf]').val();
                var endereco = $(this).find('input[name=endereco]').val();
                var tel_1 = $(this).find('input[name=tel_1]').val();
                var tel_2 = $(this).find('input[name=tel_2]').val();
                var tel_recado = $(this).find('input[name=tel_recado]').val();
                var rua = $(this).find('input[name=rua]').val();
                var cidade = $(this).find('input[name=cidade]').val();
                var estado = $(this).find('input[name=estado]').val();
                var cargo = $(this).find('input[name=cargo]').val();

                $.ajax({
                    url:'inscricao_a_vaga_action.php',
                    type:'POST',
                    data: {
                        name:name, 
                        cpf:cpf, 
                        endereco:endereco, 
                        tel_1:tel_1, 
                        tel_2:tel_2, 
                        tel_recado:tel_recado,
                        rua:rua,
                        cidade:cidade,
                        estado:estado,
                        cargo:cargo
                    },
                    success:function() {
                        document.querySelector('#area-alert').style.display = 'block';
                    }
                });
            });

            $('#modal2').fadeTo("slow", 0.9).modal('show');
        }
       
    });

}

function menuToggle() {
   var menuArea = document.querySelector(".area-menu");
   //var logout = document.querySelector('.area-logout');

   if(menuArea.style.width == '250px') {
       menuArea.style.width = '0px';
   } else {
       menuArea.style.width = '250px';
   }
}









