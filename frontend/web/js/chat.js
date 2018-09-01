  var conn = new WebSocket('ws://localhost:8081');
  var idMessages = 'chatMessages';

  conn.onopen = function(e) {
      console.log("Connection established!");
  };

  conn.onmessage = function(e) {
      console.log(e.data);
      document.getElementById(idMessages).value = e.data + '\n' +
        document.getElementById(idMessages).value;
  };

  conn.onerror = function(e) {
    console.log('Connection FAIL');
  };
