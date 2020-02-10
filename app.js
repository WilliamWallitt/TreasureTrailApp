const express  = require("express"),
    app        = express(),
    bodyParser = require("body-parser")
    ejs        = require('ejs')
    path       = require('path');

// parse application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: false }))
// parse application/json
app.use(bodyParser.json())

// so we dont need to type .ejs at the end of references ejs files
app.set('view engine', 'ejs');
// need to tell express to look for our css stuff in /public
app.use(express.static(__dirname + "/public"));
// /public

// clue page gallery
app.get('/cluepage', function(req, res) {
    res.render('cluepage');
});

app.get('/login', function(req, res) {
    res.render('LoginPage');
});

app.get('/modify', function(req, res) {
    res.render('ModifyDataPage');
});

app.get('/', function(req, res) {
    res.render('DepartmentPage');
});

// user get redirected to home page (department page)
app.get('*', function(req, res){
    res.redirect('/');
});

// process.env.PORT, process.env.IP also port 8080 for local setup
app.listen(process.env.PORT || 8080, process.env.IP, function(){
    console.log('The Server Has Started!');
});