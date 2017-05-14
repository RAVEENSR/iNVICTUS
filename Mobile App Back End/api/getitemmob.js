/**
 * This Api allows to retrieve all the items in the wishlist of a certain user
 * this api takes in one parameter
 * which is the user ID eg. S@S.com
 * it returns the list of items as the result
 * or empty if there are no items or
 * false if an error has occurred
 */
var DataBase = require('./DB');
var sql = require('mssql');
var configuration = DataBase.dbconfig;
var express = require('express');
var router = express.Router();

router.post('/', function(req, res, next) {
    //Extract parameters from the post request.
    var userID = req.body.userID;

    // Covert those parameters into string
    var ID = String(userID);

    // generate the quarry from the retrived parameters
    var qu = "SELECT * FROM  userItem WHERE userID='"+ID+"'";

    // close any existing connections to the SQL server
    sql.close();

    //// make a new connection to the sql server
    sql.connect(configuration, function(err) {
        console.log('in sql');

        // pass the quarry and two variables to capture the error and the result of the request
        var request = new sql.Request();
        request.query(qu, function (err, result) {
            // ... error checks
            console.log('in qu');
            if(err){
                console.log('Error!');
                console.log(err);
                res.send({"Result":"false"})
            }
            else {
                if(result.length == 0){
                    res.send({"Result":"Empty"})
                }
                else{
                    res.send({"Result":result});
                }

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