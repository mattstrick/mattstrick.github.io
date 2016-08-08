init = function(sec) {
    var startElem = document.getElementById('startBtn');
    var pauseElem = document.getElementById('pauseBtn');
    var resetElem = document.getElementById('resetBtn');
    var setElem = document.getElementById('setBtn');

    var sections = {
      timer : document.getElementById('timer'),
      setup: document.getElementById('setup')
    }

    var gameState = {
      state : "paused",
      timer : ((!!sec)? sec : 5),
      used_time : 0,
      last_step : -1
    };

    window.gameState = gameState || {};

    var updateTimerDisplay = function(newDisplay) {
      if (!newDisplay) return;

      var _units, _display;  

      _display = parseFloat(newDisplay.toFixed(2));  

      if (newDisplay <= 0) {
        _units = "";
        _display.toFixed(0);
      } else {
        _units = "sec";
      }

      document.getElementById('timer').getElementsByClassName('value')[0].innerHTML = _display;
      document.getElementById('timer').getElementsByClassName('units')[0].innerHTML = _units;
    }

    var startTimer = function() {
      gameState.state = "play";
      gameState.last_step = Date.now();
    };

    var pauseTimer = function() {
      gameState.state = "paused";
      gameState.last_step = -1;
    };

    var resetTimer = function() {
      gameState.state = "paused";
      gameState.used_time = 0;
      updateTimerDisplay(gameState.timer);
      gameState.last_step = -1;
    };

    var setTimer = function() {
      // show/hide    
      sections.timer.style.display = "block";
      sections.setup.style.display = "none";

      // set game state
      gameState.state = "paused";
      gameState.used_time = 0;
      gameState.timer = parseInt(document.getElementById('timerVal').value);      
      gameState.last_step = -1;

      updateTimerDisplay(gameState.timer);
    };
    
    var step = function () {  
      if (gameState.state == "play") {    
//console.log("Play");
        if (gameState.used_time >= gameState.timer) {
          gameState.state = "paused";
          updateTimerDisplay(0);
        } else {
          updateTimerDisplay(gameState.timer - gameState.used_time);
          gameState.used_time += ((Date.now() - gameState.last_step) / 1000);
          gameState.last_step = Date.now();
        }

      }

      if (gameState.state == "paused") {
//console.log("Paused");
      }


      window.requestAnimationFrame(step);
    };

    // Attach Click Events
    startElem.addEventListener('click', startTimer);
    pauseElem.addEventListener('click', pauseTimer);
    resetElem.addEventListener('click', resetTimer);
    setElem.addEventListener('click', setTimer);


    updateTimerDisplay(gameState.timer);

    window.requestAnimationFrame(step);
  }

init(17);