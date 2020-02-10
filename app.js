const express  = require("express"),
    app        = express(),
    bodyParser = require("body-parser")
    ejs        = require('ejs')
    path       = require('path')
    device     = require('express-device');

// parse application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: false }))
// parse application/json
app.use(bodyParser.json())

// getting req device
app.use(device.capture());

// so we dont need to type .ejs at the end of references ejs files
app.set('view engine', 'ejs');
// need to tell express to look for our css stuff in /public
app.use(express.static(__dirname + "/public"));


// clue page gallery
app.get('/cluepage', function(req, res) {
    if (!req.device.type == "desktop") {
        res.render('DepartmentPage');
    } else {
        res.render('LoginPage');
    }
});

app.get('/login', function(req, res) {
    if (req.device.type == "desktop") {
        res.render('LoginPage');
    } else {
        res.render('DepartmentPage');
    }
});

app.get('/modify', function(req, res) {
    if (req.device.type == "desktop") {
        res.render('ModifyDataPage');
    } else {
        res.render('DepartmentPage');
    }
});

app.get('/faq', function(req, res) {
    res.render('faqPage');
});

app.get('/', function(req, res) {
    if (!req.device.type == "phone") {
        res.render('DepartmentPage');
    } else {
        res.render('LoginPage');
    }
});

// user get redirected to home page (department page)
app.get('*', function(req, res){
    res.redirect('/');
});

// process.env.PORT, process.env.IP also port 8080 for local setup
app.listen(process.env.PORT || 8080, process.env.IP, function(){
    console.log('The Server Has Started!');
});