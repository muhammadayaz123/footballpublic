var app = require('express')();
var https = require('https').Server(app);
var io = require('socket.io')(https);
var db = require('./db.js');
var mydb = new db();

app.get('/', function(req, res) {
    res.send('Working Fine');
});
var sockets = {};
var arr = [];
io.on('connection', function(socket) {

    socket.on('for_all_send', function(data) {
        io.emit('for_all_recieve', {
            type: data.type,
            additional_data: data.additional_data,
        });
    });

});

https.listen(1056, function() {
    console.log('Socket is working fine');
});
