/**
 * This Api allows the mobile application user to make 
 * a new account in the system.
 * the api accepts 3 parameters 
 * 1) the user ID eg.S@S.com
 * 2) the user Password eg.1234
 * 3) the user Name eg.Sam
 * the API will respond with true if the user was added to the DB succesfuly
 * else it will resons with false.
 */

var DataBase = require('./DB');
var sql = require('mssql');
var configuration = DataBase.dbconfig;
var express = require('express');
var router = express.Router();

router.post('/', function(req, res, next) {
     //Extract parameters from the post request.
    var userID = req.body.userID;
    var Password = req.body.userPW;
    var userName = req.body.userName;

    // covert parameters to string
    var ID = String(userID);
    var PW = String(Password);
    var NM = String(userName);

    // generate quarry from parameters
    var qu = "INSERT INTO  EndUser(userName,userPW,userID) VALUES ('"+NM+"','"+PW+"','"+ID+"')";


    // close any existing connections to the sql server specified in the configuration
    sql.close();

    // make a new connection to the sql server
    sql.connect(configuration, function(err) {
        //console.log('in sql');

        // generate a new sql server request
        var request = new sql.Request();

        // pass the quarry a variable to capture the error and the result of the request
        request.query(qu, function (err, result) {
            // ... error checks
            console.log('in qu');
            if(err){

                // out put the error to the console of the server
                //console.log('errrororr');
                //console.log(err);
                /**
                 * Errors generated during this phase are considered to be errors relating to SQL server
                 * therefore any error generated during this phase is assuemed to be caused by invalid inputs.
                 */

                res.send({"Result":"false"})
            }
            else {
                /**
                 * Else the SQL quary is considered to have run successfully without errors respond success 
                 */
                res.send({"Result":"true"})
                }
                
                // statements below are used in testing 
                //console.log(iid)
               //console.log(qu)
                //console.log(result.recordset[0]);
                //console.log(result);


        });
    });

});
// finally export the router object
module.exports = router;