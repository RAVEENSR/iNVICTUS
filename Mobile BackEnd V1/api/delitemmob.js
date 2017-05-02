/**
 * This API allows the mobile app user to remove an item in the WishList
 * it accepts 2 parameters
 * 1) the user ID eg.S@S.com    
 * 2) the itemName eg.Levies 501 Jeans
 */
var DataBase = require('./DB');
var sql = require('mssql');
var configuration = DataBase.dbconfig;
var express = require('express');
var router = express.Router();

router.post('/', function(req, res) {

    //Extract parameters from the post request.
    var userID = req.body.userID;
    var itemName = req.body.itemName;

    // covert parameters to string
    var ID = String(userID);
    var IN = String(itemName);
    
    // generating quarry with the given parameters 
    var qu = "DELETE FROM  userItem WHERE userID='"+ID+"' AND itemName='"+IN+"'";


    // close any existing connections to the sql server specified in the configuration
    sql.close();
    sql.connect(configuration, function(err) {
        console.log('in sql');

        // make a new connection to the sql server
        var request = new sql.Request();
        
        // pass the quarry and two variables to capture the error and the result of the request
        request.query(qu, function (err, result) {
            // ... error checks
            console.log('in qu');
            if(err){
                //console.log('ERROR!');
                console.log(err);
                /**
                 * Errors generated during this phase are considered to be errors relating to SQL server
                 * therefore any error generated during this phase is assumed to be caused by invalid inputs.
                 */
                res.send({"Result":"false"})
            }
            else {
                /**
                 * Else the SQL quarry is considered to have run successfully without errors respond success
                 */
                res.send({"Result":"true"})
            }

            //console.log(iid)
            //console.log(qu)
            //console.log(result.recordset[0]);
            //console.log(result);


        });
    });

});

// finally export the router object
module.exports = router;