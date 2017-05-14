var sql = require('mssql'); // importing mssql moudles for connecting to a MSSQL database.
var express = require('express');
var router = express.Router();
var fin;
var config = {
    user: 'umen',
    password: 'Fat123Man',
    server: 'phatman.database.windows.net',
    database: 'UDB',

    options: {
        encrypt: true //used to when connecting to an Windows Azure DB
    }
}




sql.connect(config, function(err) {

   var request = new sql.Request();

        request.query('SELECT * FROM ToDoitem', function (err, recordset) {
        // ... error checks
            if(err){
                console.log(err);
            }
            else {
                fin = recordset;
                console.dir(recordset);
            }
    });
});
router.get('/', function(req, res, next) {
 // var id = req.param('id');
  res.send(fin);
});

module.exports = router;