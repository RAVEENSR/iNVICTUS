/**
 * This API will Accept a Search String as a Parameter.
 * The parameter MUST contain at least 3 words.
 * This API will return Matching Items from the Database
 * IFF at least 3 words from the Search String Match
 * with any 3 of the Item tags.
 * IF no Items are found the result would be
 * {"items":"No Items"}
 */
var DataBase = require('./DB');
var sql = require('mssql');
var configuration = DataBase.dbconfig;
var express = require('express');
var router = express.Router();

router.post('/', function(req, res) {
    //Extract parameters from the post request.
    var SS = req.body.SearchString;

    // covert parameters to string
    var SearchString = String(SS);

    var qu = "SELECT * FROM Item";

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
                //console.log('errrororr');
                console.log(err);
                /**
                 * Errors generated during this phase are considered to be errors relating to SQL server
                 * therefore any error generated during this phase is assumed to be caused by invalid inputs.
                 */
                res.send({"Result":"false"})
            }
            else {
                /**
                 * The code below weill do the matching process and return the results
                 * accordingly
                 * it will first query the DB for all Items,
                 * Then each item tag will be scanned for the length of the Search String words
                 * if 3 tags or more are simillar it will consider that item as an
                 * atching item and send the result to the user.
                 */
                var items = [];
                var N = result.length;
                for(var i =0;i<N;i++){
                    var sim =0;
                    var obj = result[i];
                    var starr = SearchString.split(" ");
                    var len = starr.length;

                    for(var j=0;j<len;j++){
                        var istru = starr[j].toUpperCase()===obj.tag1.toUpperCase();
                        if(istru){
                            sim++;
                            break;
                        }
                    }
                    for(var j=0;j<len;j++){
                        var istru = starr[j].toUpperCase()===obj.tag2.toUpperCase();
                        if(istru){
                            sim++;
                            break;
                        }
                    }
                    for(var j=0;j<len;j++){
                        var istru = starr[j].toUpperCase()===obj.tag3.toUpperCase();
                        if(istru){
                            sim++;
                            break;
                        }
                    }
                    for(var j=0;j<len;j++){
                        var istru = starr[j].toUpperCase()===obj.tag4.toUpperCase();
                        if(istru){
                            sim++;
                            break;
                        }
                    }
                    for(var j=0;j<len;j++){
                        var istru = starr[j].toUpperCase()===obj.tag5.toUpperCase();
                        if(istru){
                            sim++;
                            break;
                        }
                    }
                    if(starr.length==sim || starr.length>3 && sim>=3){
                        var itemurl = obj.imageurl;
                        var itemname = obj.itemName;
                        //console.log(itemname);
                        var finitem = { "item name" : itemname , "item url" : itemurl};
                        items.push(finitem);
                    }

                }

                if(items.length>0) {
                    res.send({"items": items});
                }
                else {
                    res.send({"items":"No Items"});
                }

            }

            // statements below are used in testing
            //console.log(iid)
            //console.log(qu)
            //console.log(result.recordset[0]);
            //console.log(result.recordset.length)
            //console.log(result);



        });
    });

});

// finally export the router object
module.exports = router;
