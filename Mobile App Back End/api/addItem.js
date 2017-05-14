/**
 * This Api allows the mobile app user to add items to the wishlist
 * only items that are in the database can be added to the wishlist
 * the api accepts 2 parameters
 * 1) the User ID eg. S@S.com
 * 2) the item name eg . Levies 511 Jeans
 * the Api will respond with true if item was succesfully added to the DB
 * it will respond false otherwise
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
    var IN = String(itemName).trim();
    console.log(IN);
    var qu2w ="SELECT imageurl FROM Item WHERE itemName = '"+IN+"'";

    //console.log(qu2);
    //console.log(qu2w);

    // close any existing connections to the sql server specified in the configuration
    sql.close();

    // make a new connection to the sql server
    sql.connect(configuration, function(err) {
        // console.log('in sql');

        // generate a new sql server request
        var request = new sql.Request();

        // pass the quarry and two variables to capture the error and the result of the request
        request.query(qu2w, function (err, result) {
            // ... error checks
            console.log('in qu');
            if(err){
                // out put the error to the console of the server
                //console.log('Error!');
                //console.log(err);
                /**
                 * Errors generated during this phase are considered to be errors relating to SQL server
                 * therefore any error generated during this phase is assumed to be caused by invalid inputs.
                 */
                res.send({"Result":"false"});
            }
            else {
                /**
                 * Else the SQL quary is considered to have run successfully without errors respond success
                 */
                //console.log(result);
                var url = result[0].imageurl;
                var request2 = new sql.Request();

                var qu = "INSERT INTO  userItem(userID,itemName,imageurl) VALUES ('"+ID+"','"+IN+"','"+url+"')";
                request2.query(qu, function (err2, result2) {
                    if(err2){
                        console.log(err2);
                        res.send({"Result":"false"});
                    }
                    else{
                        res.send({"Result":"true"})
                    }
                });
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
