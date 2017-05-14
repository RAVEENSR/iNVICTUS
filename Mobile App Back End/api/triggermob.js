/**
 * This API will Accept two Parameters
 * 1) userID
 * 2) beaconID
 * It will then query the DB for the user items accroding to the ID
 * It will then query the DB for the items in the shop with
 * the atching beacon ID.
 * finally it will send the matching items back to a user
 * and update the DISPLAY table with the given DATA.
 */
var DataBase = require('./DB');
var sql = require('mssql');
var configuration = DataBase.dbconfig;
var express = require('express');
var router = express.Router();

router.post('/', function(req, res) {
    //Extract parameters from the post request.
    var bid = req.body.bid;
    var uid = req.body.uid;

    // covert parameters to string
    var BeID = String(bid);
    var UsID = String(uid);
    var items = [];
    var qu = "SELECT shopName FROM Shop WHERE beaconID ='"+BeID+"'";

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
                res.send({"Result":"Error in Process"});
            }
            else {
                console.log("res 1***********************************");
                //console.log(result)
                // changes over here eg :var shopname = result.recordset[0].shopName;
                var shopname = result[0].shopName;
                var qu2 = "SELECT itemName FROM itemShop WHERE shopName ='"+shopname+"'";

                var request2 = new sql.Request();
                request2.query(qu2, function (err2, result2) {
                    if(err2){
                        console.log("Error 2");
                        console.log(err2);
                        res.send({"Result":"Error in Process2"});
                    }
                    else{
                        // changes : var itemsfromshop = result2.recordset
                        var itemsfromshop = result2;
                        console.log("res 2***********************************");
                        //console.log(result2);
                        //res.send(result2);
                        var qu3 ="SELECT  * FROM userItem WHERE userID ='"+UsID+"'";
                        var request3 = new sql.Request();
                        request3.query(qu3, function (err3, result3) {
                            if(err3){
                                console.log("Error 3");
                                console.log(err3);
                                res.send({"Result":"Error in Process3"});
                            }
                            else{
                                console.log("res 3***********************************");
                                //console.log(result3);
                                //changes : var itemsfromuser = result3.recordset
                                var itemsfromuser = result3;
                                /*console.log(itemsfromuser[0].itemName);
                                 console.log(itemsfromshop[0].itemName);

                                 var eg= itemsfromuser[0].itemName.trim();
                                 var eg2= itemsfromshop[0].itemName.trim();
                                 if(eg==eg2){
                                 console.log("fi")
                                 }
                                 console.log(eg);
                                 console.log(eg2);*/

                                var N = itemsfromshop.length;
                                var N2 = itemsfromuser.length;

                                for(var i=0;i<N2;i++){
                                    for(var j=0;j<N;j++){
                                        if(itemsfromuser[i].itemName.trim()==itemsfromshop[j].itemName.trim()){
                                            var itif = {"itemName":itemsfromuser[i].itemName.trim(),"imageurl":itemsfromuser[i].imageurl}
                                            items.push(itif);
                                            break;
                                        }
                                    }
                                }
                                if(items.length>0) {

                                    var qu4 ="SELECT userName FROM EndUser WHERE userID ='"+UsID+"'";
                                    var request4 = new sql.Request();
                                    request4.query(qu4, function (err4, result4) {
                                        if(err4){
                                            console.log("Error in Process 4");
                                            console.log(err4);
                                        }
                                        else{
                                            //changes : var username = result4.recordset[0].userName;
                                            var username = result4[0].userName;
                                            var iti = items[0].itemName;
                                            //console.log(username);
                                            var qu5 ="INSERT INTO Dis (userName,shopName,itemName,beaconID)" +
                                                " VALUES ('"+username+"','"+shopname+"','"+iti+"','"+BeID+"')";
                                            var request5 = new sql.Request();
                                            request5.query(qu5, function (err5, result5) {
                                                if(err5){
                                                    console.log("Error in process 5");
                                                    console.log(err5);
                                                }
                                                else{
                                                    res.send({"items": items,"shop Name":shopname});
                                                }
                                            });


                                        }
                                    });

                                }
                                else {
                                    res.send({"items":"No items"});
                                }
                            }
                        });
                    }
                });

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

