let canvas = document.getElementById("snake");
let context = canvas.getContext("2d");
let box = 32;
let snake = [];
snake[0] = {
    x: 8 * box,
    y: 8 * box
}
let direction = "right";


// criando o background 

function criarBG() {
    context.fillStyle = "lightgreen";
    context.fillRect(0, 0, 16 * box, 16 * box);
}

// Criando a cobrinha 

function criarCobrinha() {
    for (i = 0; i < snake.length; i++) {
        context.fillStyle = "green";
        context.fillRect(snake[i].x, snake[i].y, box, box);
    }

}


// Para não virar a cobrinha no lado contrario da direção e evento passar 
//teclas do teclado para essa função. 
document.addEventListener('keydown', update);
function update(event){
if(event.keyCode == 37 && direction != "right") direction = "left";
if(event.keyCode == 38 && direction != "down") direction = "up";
if(event.keyCode == 39 && direction != "left") direction = "right";
if(event.keyCode == 40 && direction != "up") direction = "down";
}




function iniciarJogo(){

//Cria Margens impedindo a cobrinha de seguir infinitamente direto e quando ela atravessa a tela fazendo com que ela volte para posição do outro lado da tela. 

if(snake[0].x > 15 * box && direction == "right") snake[0].x = 0;
if(snake[0].x < 0  && direction == "left") snake[0].x = 16 * box;
if(snake[0].y > 15 * box  && direction == "down") snake[0].y = 0;
if(snake[0].y < 0  && direction == "up") snake[0].y = 16 * box;

for(i=1;i<snake.length;i++){

if(snake[0].x == snake[i].x && snake[0].y == snake[i].y){
clearInterval(jogo);
alert('Game over (* _ *)');
}
}
//Chama o background e a cobrinha funções
    criarBG();
    criarCobrinha();
    drawnFood();

//Posiciona a cobrinha no plano estanciando sua posição como x=0 e y=0 plano cartesiano    
let snakeX = snake[0].x;
let snakeY = snake[0].y;

if(direction == "right") snakeX += box;
if(direction == "left") snakeX -= box;
if(direction == "up") snakeY -= box;
if(direction == "down") snakeY += box;

if(snakeX != food.x || snakeY != food.y){
    snake.pop();   
}
else{
  food.x = Math.floor(Math.random() * 15 + 1) * box;
  food.y = Math.floor(Math.random() * 15 +1) * box;
}



//Remove o ultimo elemento do array
let newHead = {
x: snakeX,
y: snakeY
}
snake.unshift(newHead);

}

let food={
x: Math.floor(Math.random() * 15 + 1) * box,
y: Math.floor(Math.random() * 15 +1) * box

}

function drawnFood(){
context.fillStyle = "red";
context.fillRect(food.x, food.y, box, box);

}



// função de tempod de jogo com inicar jogo para o jogo não travar
let jogo = setInterval(iniciarJogo , 100);


