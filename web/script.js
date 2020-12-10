// Variabler - Images/Tiles

let player = 1
spiller = new Image(); 
spiller.src= 'img/strongguy2.png';


let wall = 0

kasse = new Image(); 
kasse.src= 'img/box.png';

let road = 2;
sand = new Image(); 
sand.src= 'img/sand.png';


let trap = 3
bot1 = new Image(); 
bot1.src= 'img/gunman2.png';

let trap2 = 5
bot2 = new Image(); 
bot2.src= 'img/survivor-meleeattack_knife_5.png';


let trap3 = 6
bot3 = new Image(); 
bot3.src= 'img/survivor-meleeattack_knife_11.png';

let trap4 = 7
bot4 = new Image(); 
bot4.src= 'img/survivor-meleeattack_knife_0.png';

let finish = 4
girl = new Image(); 
girl.src= 'img/girl1.png';

let tileSize = 50;


// TID 

 let minusPoint = 0;

function time(){
    
    setInterval(()=>{

    minusPoint++;

},10)

}

// Når spillet starter, starter denne function; 
time();

// Point tæller 

function pointCount(){
let maxPoint = 30000; 

pointIAlt = maxPoint - minusPoint;
 clearInterval(time);
document.querySelector("#score1").value= pointIAlt;
document.querySelector(".navnform").style.display="block";

return pointIAlt;

}

// LIV

 function health() {
         minusPoint += 5000; 
 }

 
 
// LYD

let audio = new Audio('sound/Negev Desert Loop.wav');
audio.play();

function walk(){

    let gameSound = new Audio('sound/stepstone_1.wav');
    gameSound.play();

}

function playsound(){

    let gameSound = new Audio('/sound/background-game-melody-loop.mp3');
    gameSound.play();

}

function playgirl(){

    let gameSound = new Audio('sound/weirdwarriornosieslol.mp3');
    gameSound.play();

}

function playhit(){

    let gameSound = new Audio('sound/hit.mp3');
    gameSound.play();

}

// Reset button

let  = document.querySelector("#replay");



replay.addEventListener("click", ()=>{
    location.reload(); 

})

// Canvas 

let canvas = document.querySelector("#canvas"); 
let ctx = canvas.getContext('2d'); 


// Maze


maze =
[
    [0,0,0,0,0,2,2,2,2,2],
    [0,2,2,2,2,2,0,5,0,4],
    [0,0,2,0,6,0,6,0,6,0],
    [5,2,2,2,2,2,2,2,2,0],   
    [0,0,0,0,5,0,0,2,2,7],
    [0,2,2,2,2,2,2,2,2,0],
    [0,2,7,0,0,5,0,5,0,0],
    [0,2,0,6,0,6,0,6,0,0],
    [3,2,2,2,2,2,2,2,1,0],
    [0,0,0,0,0,0,0,0,0,0]

]


// Enemy Movement

const ninjaMovementChar3Arr = [{y:8, x:0},{y:8, x:1},{y:8, x:2},{y:6, x:1},{y:5, x:3},{y:5, x:5},{y:5, x:8},
    {y:4, x:7},{y:3, x:8},{y:3, x:6},{y:3, x:4},{y:3, x:2},{y:1, x:2},{y:1, x:4},{y:0, x:6},{y:0, x:7}];

const enemyPosition = {x:0, y:0};
let counter = 0;


setInterval(()=>{
    ninjaMovementChar3();
    
},1000)

function ninjaMovementChar3(){ 
    maze[ninjaMovementChar3Arr[counter].y][ninjaMovementChar3Arr[counter].x] = 3;
    maze[enemyPosition.y][enemyPosition.x] = 2;
 
   drawMaze();  

   if(counter === 15){
       counter = 0;
   }else{
    counter++;
   }

}

// Player Position


let playerPosition = {x:0, y:0};
ctx.drawImage(spiller,9*tileSize,9*tileSize,tileSize,tileSize);


function drawMaze(){
    if (health.value == 0) {
        playlose()
         alert('Game over !'); 
        location.reload()
    }
    else {
        for(let y= 0; y < maze.length; y++){

        for(let x = 0; x < maze[y].length; x++){

        if(maze[y][x] === 0){
            ctx.drawImage(kasse,x*tileSize,y*tileSize,tileSize,tileSize);
        }else if(maze[y][x] === 2){
             ctx.drawImage(sand,x*tileSize,y*tileSize,tileSize,tileSize);
        }else if(maze[y][x] === 1){
            playerPosition.x = x; 
            playerPosition.y = y; 
         ctx.drawImage(spiller,x*tileSize,y*tileSize,tileSize,tileSize);
        }else if(maze[y][x] === 3){   
            enemyPosition.x = x; 
            enemyPosition.y = y; 
            ctx.drawImage(bot1,x*tileSize,y*tileSize,tileSize,tileSize);
          }else if(maze[y][x] === 5){
         ctx.drawImage(bot2,x*tileSize,y*tileSize,tileSize,tileSize);
          }else if(maze[y][x] === 6){
         ctx.drawImage(bot3,x*tileSize,y*tileSize,tileSize,tileSize);
          }else if(maze[y][x] === 7){
         ctx.drawImage(bot4,x*tileSize,y*tileSize,tileSize,tileSize);
        }else if(maze[y][x] === 4){
            ctx.drawImage(girl,x*tileSize,y*tileSize,tileSize,tileSize);
        }
      }
    }
    }

  

}

drawMaze();

window.addEventListener("keydown", (e)=>{
  
    switch(e.keyCode){
        case 37: // Left
    
        if (maze[playerPosition.y] [playerPosition.x -1] === 2){ // Spørg om der er vej på venstre tile for playeren
            maze[playerPosition.y] [playerPosition.x -1] = 1 // Players nye position
            maze[playerPosition.y] [playerPosition.x ] = 2 // Players gamle postion
            console.log(minusPoint)
            drawMaze();
            walk();
            audio.play();
            
           
         
    } 
    else if (maze[playerPosition.y ] [playerPosition.x -1 ] === 3){
            alert ("HaHa GOT YOU !!")
            health()
            playhit();
            audio.play()
        }
        else if (maze[playerPosition.y ] [playerPosition.x +1 ] === 3){
            alert ("HaHa GOT YOU !!");
            health()
            playhit();
            audio.play()
        }
        break;
        case 39: // Right
    
        if (maze[playerPosition.y] [playerPosition.x +1] === 2){ // Spørg om der er vej på venstre tile for playeren
            maze[playerPosition.y] [playerPosition.x +1] = 1 // Players nye position
            maze[playerPosition.y] [playerPosition.x ] = 2 // Players gamle postion
            drawMaze();
            walk()
        }
        
        else if (maze[playerPosition.y ] [playerPosition.x +1 ] === 3){
            alert ("HaHa GOT YOU !!");
           health() 
            playhit();
            audio.play()
        }

        else if (maze[playerPosition.y -1] [playerPosition.x ] === 5){
            alert ("HaHa GOT YOU !!")
            health(); 
            playhit();
            audio.play()
        } 
        else if (maze[playerPosition.y -1] [playerPosition.x ] === 6){
            alert ("HaHa GOT YOU !!")
            health() 
            playhit();
            audio.play()
        }
        

        // Endgame
        
        
     
        break;

        case 40: // Down
    
        if (maze[playerPosition.y +1] [playerPosition.x ] === 2){ // Spørg om der er vej på venstre tile for playeren
            maze[playerPosition.y +1] [playerPosition.x ] = 1 // Players nye position
            maze[playerPosition.y] [playerPosition.x ] = 2 // Players gamle postion
            drawMaze();
            walk()
        }
         else if (maze[playerPosition.y +1 ] [playerPosition.x  ] === 4){
            console.log(pointCount())
            alert ("Tillyke du har vundet!");
            playgirl ();
            audio.pause()
            
        }

        else if (maze[playerPosition.y +1] [playerPosition.x ] === 3){
            alert ("HaHa GOT YOU !!")
            health() 
            playhit();
            audio.play()
        }
        else if (maze[playerPosition.y -1] [playerPosition.x ] === 5){
            alert ("HaHa GOT YOU !!")
            health() 
            playhit();
            audio.play()
        } 
        else if (maze[playerPosition.y -1] [playerPosition.x ] === 6){
            alert ("HaHa GOT YOU !!")
            health() 
            playhit();
            audio.play()
        } 


    
        break;
        case 38: // Up
    
        if (maze[playerPosition.y -1] [playerPosition.x ] === 2){ // Spørg om der er vej på venstre tile for playeren
            maze[playerPosition.y -1] [playerPosition.x ] = 1 // Players nye position
            maze[playerPosition.y] [playerPosition.x ] = 2 // Players gamle postion
            drawMaze();
            walk();
        }   
        else if (maze[playerPosition.y -1] [playerPosition.x ] === 3){
            alert ("HaHa GOT YOU !!")
            health() 
            playhit();
            audio.play()
        } 
        else if (maze[playerPosition.y -1] [playerPosition.x ] === 5){
            alert ("HaHa GOT YOU !!")
            health() 
            playhit();
            audio.play()
        } 
        else if (maze[playerPosition.y -1] [playerPosition.x ] === 6){
            alert ("HaHa GOT YOU !!")
            health() 
            playhit();
            audio.play()
        } 
    } 
} )


window.addEventListener("load", drawMaze);

