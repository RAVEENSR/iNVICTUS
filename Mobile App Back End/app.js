// ----------------------------------------------------------------------------
// Copyright (c) 2015 Microsoft Corporation. All rights reserved. 
// ----------------------------------------------------------------------------

// This is a base-level Azure Mobile App SDK.
var express = require('express'),
    azureMobileApps = require('azure-mobile-apps');

// Set up a standard Express app
var app = express();


console.log("Server Now running");
var sql = require('mssql'); // importing mssql moudles for connecting to a MSSQL database.
var api1 = require('./api1');
// importing all api code middleware.
var login = require('./api/Login');
var signup = require('./api/signup');
var additem = require('./api/addItem');
var additemgen = require('./api/addItemgen');
var delitemmob = require('./api/delitemmob');
var getitemmob = require('./api/getitemmob');
var searcher = require('./api/searchmob');
var trig = require('./api/triggermob');
var bodyParser = require('body-parser');

app.use(bodyParser.json()); // for parsing application/json
app.use(bodyParser.urlencoded({ extended: true })); // for parsing application/x-www-form-urlencoded


app.use('/test',api1);
app.use('/login',login);
app.use('/signup',signup);
app.use('/additem',additem);
app.use('/additemgen',additemgen);
app.use('/delitemmob',delitemmob);
app.use('/getitemmob',getitemmob);
app.use('/search',searcher);
app.use('/trigger',trig);
// If you are producing a combined Web + Mobile app, then you should handle
// anything like logging, registering middleware, etc. here

// Configuration of the Azure Mobile Apps can be done via an object, the
// environment or an auxiliary file.  For more information, see
// http://azure.github.io/azure-mobile-apps-node/global.html#configuration
var mobileApp = azureMobileApps({
    // Explicitly enable the Azure Mobile Apps home page
    homePage: false,
    // Explicitly enable swagger support. UI support is enabled by
    // installing the swagger-ui npm module.
    swagger: true
});

// Import the files from the tables directory to configure the /tables endpoint
mobileApp.tables.import('./tables');

// Import the files from the api directory to configure the /api endpoint
mobileApp.api.import('./api');

// Initialize the database before listening for incoming requests
// The tables.initialize() method does the initialization asynchronously
// and returns a Promise.
mobileApp.tables.initialize()
    .then(function () {
        app.use(mobileApp);    // Register the Azure Mobile Apps middleware
        app.listen(process.env.PORT || 3000);   // Listen for requests
    });
