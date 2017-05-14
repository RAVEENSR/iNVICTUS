/**
 * this API allows to add general items to the Item database
 * it accepts 7 parameters
 * 1) an item name eg. Levies Blue Jeans
 * 2) five(5) item search strings eg. #BLUE , #JEANS , #Levies...
 * 3) An item image URL
 * it returns true on success
 * and false on failure
 *
 */

var DataBase = require('./DB');
var sql = require('mssql');
var configuration = DataBase.dbconfig;
var express = require('express');
var router = express.Router();

router.post('/', function(req, res) {
    //Extract parameters from the post request.
    var itemName = req.body.itemName;
    var tag1 = req.body.tag1;
    var tag2 = req.body.tag2;
    var tag3 = req.body.tag3;
	var tag4 = req.body.tag4;
	var tag5 = req.body.tag5;
    var imageurl = req.body.imageurl;

    // covert parameters to string
    var IN = String(itemName);
    var TAG1 = String(tag1);
    var TAG2 = String(tag2);
    var TAG3 = String(tag3);
	var TAG4 = String(tag4);
	var TAG5 = String(tag5);
    var URL = String(imageurl);

    var qu = "INSERT INTO  Item(itemName,tag1,tag2,tag3,tag4,tag5,imageurl)"+ 
	"VALUES ('"+IN+"','"+TAG1+"','"+TAG2+"','"+TAG3+"','"+TAG4+"','"+TAG5+"','"+URL+"')";

    // close any existing connections to the sql server specified in the configuration
    sql.close();

    // make a new connection to the sql server
    sql.connect(configuration, function(err) {
        // console.log('in sql');

        // generate a new sql server request
        var request = new sql.Request();

        // pass the quarry and two variables to capture the error and the result of the request
        request.query(qu, function (err, result) {
            // ... error checks
            console.log('in qu');
            if(err){
                // out put the error to the console of the server
                //console.log('Error!');
                console.log(err);
                /**
                 * Errors generated during this phase are considered to be errors relating to SQL server
                 * therefore any error generated during this phase is assumed to be caused by invalid inputs.
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