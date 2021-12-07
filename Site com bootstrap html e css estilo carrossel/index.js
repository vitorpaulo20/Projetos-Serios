function sel1Vl1(){
    alert("Teste de função !!! ");
}
function changeFunc($i) {
    if ($i == '1'){
        window.open('https://olhardigital.com.br/','_blank');
    }else if($i == '2'){
        window.open('https://g1.globo.com/','_blank');
    }else if($i == '3'){
        window.open('https://news.google.com/topstories?hl=pt-BR&gl=BR&ceid=BR:pt-419','_blank');
    }
}

//Login funções 


function validaEmail(){
let pauloEmail ='vitorpaulo17@hotmail.com';
let pauloSenha ='Pantheon19';

if(document.form.emailIn.value == pauloEmail && document.form.senhaIn.value == pauloSenha ){

    window.open('../Bootstrap/index.html','_blank');

}else{

alert("Não é o papai");

}

}


function verificarSenhas(){
    if (document.form.senhaIn.value == document.form.senhaIn.value)
    {alert ("As duas senhas conferem")
    }
     
    else{
    alert ("As duas senhas não conferem")
    }   
}