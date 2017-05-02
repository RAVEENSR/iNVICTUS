/**
 * This API allows the mobile application user to login
 * the api accepts 2 parameters
 * 1) the user ID eg. S@S.com  
 * 2) the user password eg.1234
 * if the user password and email mathces it will respond with true
 * the rspons will be false otherwise
 */

var DataBase = require('./DB');
var sql = require('mssql');
var configuration = DataBase.dbconfig;
var express = require('express');
var router = express.Router();
var bodyParser = require('body-parser');


router.post('/', function(req, res) {
    //Extract parameters from the post request.
    var userID = req.body.userID;
    var Password = req.body.userPW;

    // covert parameters to string
    var ID = String(userID);
    var PW = String(Password);
    // generate quarry from parameters
    var qu = "SELECT * FROM EndUser WHERE userID='"+ID+"' AND userPW='"+PW+"'";

    // close any existing connections to the sql server specified in the configuration
    sql.close();
    // make a new connection to the sql server
    sql.connect(configuration, function(err) {

        // generate a new sql server request
        var request = new sql.Request();
        // pass the quarry a variable to capture the error and the result of the request
        request.query(qu, function (err, result) {
            // ... error checks
            console.log('in qu');
            if(err){
                // out put the error to the console of the server
                console.log('Error !!');
                console.log(err);
            }
            else {
                // if the result returns no values 
                if(result.length == 0){
                    res.send({"Result":"false"})
                }
                else{
                    // else send the result below 
                    res.send({"Result":"true"})
                }
                // Code below are used for testing 
                //console.log(iid)
                //console.log(qu);
                //console.log(userID);
                //console.log(Password);
                //console.log(result.recordset[0]);
                //console.log(result);

            }
        });
    });

});
// finally return the router object.
module.exports = router;