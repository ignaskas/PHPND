let gametimer = 100;
let score = 0;

// button press starts timer and game
function start() {
    let gametime = setInterval(function () {
        gametimer--;
        if (gametimer <= 0) {
            clearInterval(gametime);
            $('#timer').html("<h3>Time_is_up</h3>");
            callajax(score);
            console.log("score:", score);
        } else {
            $('#time').text(gametimer);
            // console.log("Timer --> " + gametimer);
        }
    }, 1000);
}
// on beer pickup add +1 to score and update score on screen
function addscore() {
    score += 1;
    document.getElementById("addscore").innerText = score;
}
// function GetPlayerName() {
//     name = document.getElementById("myname").value;
//     return name;
// }
// when timer is up sends score to php script
function callajax(X) {
    $.ajax({
        type: "POST",
        url: 'scorew.php',
        data: {
            myscore: score
        },
        success: function (data) {
            $('#result').html(data);
            // console.log("i am working");
        }
    });
}
//controls for divs
verg.style.left = 400 + 'px';
verg.style.top = 230 + 'px';
document.addEventListener('keydown', logKey);
// laukas = document.getElementById("laukas");
function logKey(e) {
    let x = verg.style.left.slice(0,-2);
    let y = verg.style.top.slice(0,-2);
    x = parseInt(x);
    y = parseInt(y);
    switch (e.code) {
        case "KeyW"  || "ArrowUp":
            y = y - 20;
            verg.style.transform = "scaleY(-1)";
            break;
        case "KeyS"  || "ArrowDown":
            y = y + 20;
            verg.style.transform = "scaleY(1)";
            break;
        case "KeyD"  || "ArrowRigth":
            verg.style.transform = "scaleX(-1)";
            x = x + 20;
            break;
        case "KeyA"  || "ArrowLeft":
            verg.style.transform = "scaleX(1)";
            x = x - 20;
            break;

    }
    if (artelpa(x, y)) {
        verg.style.position = "absolute";
        verg.style.left = x + 'px';
        verg.style.top = y + 'px';
        // console.log(x + "  " + y); //Debug cordinates to console
        // colision();
        colision();
    }
}

// function artelpa(vergX, vergY) {
//     let leist = true;
//     if ((parseInt(laukas.style.top.slice(0,-2)) + 2) > (parseInt(verg.style.top.slice(0, -2)) + vergY)) {
//         leist = false;
//         console.log("stop v");
//     }
//     if ((parseInt(laukas.style.bottom.slice(0,-2)) + 50) > (parseInt(verg.style.bottom.slice(0, -2)) + vergY)) {
//         leist = false;
//         console.log("stop a");
//     }
//     if ((parseInt(laukas.style.left.slice(0,-2)) + 20) > (parseInt(verg.style.left.slice(0, -2)) + vergX)) {
//         leist = false;
//         console.log("stop k");
//     }
//     if (    (parseInt(laukas.style.right.slice(0,-2)) - 20) < (parseInt(verg.style.right.slice(0, -2)) + vergX)) {
//         leist = false;
//         console.log("stop d");
//     }
//     return leist;
// }

//game bounds
function artelpa(vergX, vergY) {
    let leist = true;
    if (60 > (parseInt(verg.style.top.slice(0, -2)) + vergY)){
        leist = false;
        // console.log("stop v");
    }
    if (950 < (parseInt(verg.style.top.slice(0, -2)) + vergY)) {
        leist = false;
        // console.log("stop a");
    }
    if (22 > (parseInt(verg.style.left.slice(0, -2)) + vergX)) {
        leist = false;
        // console.log("stop k");
    }
    if (1800 < (parseInt(verg.style.left.slice(0, -2)) + vergX)) {
        leist = false;
        // console.log("stop d");
    }
    return leist;
}
// let score = 0;
//colision detector on colide call addscore and spawn a new beer in a random location

function colision(vergX,vergY) {
    let centobox = cento.getBoundingClientRect();
    let vergbox =  verg.getBoundingClientRect();
    let colide = false;
    // console.log("chek");
    if (centobox.left < vergbox.left + vergbox.width && centobox.left + centobox.width > vergbox.left &&
        centobox.top < vergbox.top + vergbox.height && centobox.top + centobox.height > vergbox.top) {
        colide = true;
        cento.style.left = Math.floor(Math.random() * 750) + 1 + 'px';
        cento.style.top = Math.floor(Math.random() * 470) + 1 + 'px';

        addscore()
        // let score = document.getElementById("cento")
        // score = document.getElementById("cento").innerHTML;
        // score = parseInt(score) + 1;
        // document.getElementById("cento").innerHTML = score;
    }

    return colide;
}

$("#showscore").hide();
$(".showhighscore").click(function(){
    $("#showscore").toggle();
});