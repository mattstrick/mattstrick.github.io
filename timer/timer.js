init = function(sec) {

    //Find our div containers in the DOM

    var gameState = {
      state : "play",
      started_timestamp : ((!!sec)? Date.now() : -1),
      timer : ((!!sec)? sec : 5),

    }

    var updateTimerDisplay = function(newDisplay) {
      if (!newDisplay) return;

      var _units, _display;  

      _display = newDisplay;  

      if (newDisplay <= 0) {
        _units = "";
        _display.toFixed(0);

      } else {
        _units = "sec";
        _display.toFixed(2);
      }

      document.getElementById('timer').getElementsByClassName('value')[0].innerHTML = _display;
      document.getElementById('timer').getElementsByClassName('units')[0].innerHTML = _units;
    }


    

    var step = function () {    
      if (gameState.state == "play") {
//console.log("Play");
        if ((Date.now() - gameState.started_timestamp) / 1000 > gameState.timer) {
          gameState.state = "paused";
          updateTimerDisplay(0);
        } else {
          updateTimerDisplay(gameState.timer - ((Date.now() - gameState.started_timestamp) / 1000));
        }

      }

      if (gameState.state == "paused") {
//console.log("Paused");
      }


      window.requestAnimationFrame(step);
    };

    window.requestAnimationFrame(step);
  }

init(7);