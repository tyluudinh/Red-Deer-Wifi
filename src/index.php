<?php
/**
 * Created by dinhty.luu@gmail.com
 * Date: 17/02/2017
 * Time: 13:16
 */

?>
<!DOCTYPE html>
<html>
<head>
    <title>Wireless Security Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Tiny Ui Login Form template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> 
    addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 



    </script>
    <script type="text/javascript">
        /*! superplaceholder.js - v0.1.0 - 2016-02-29
* http://kushagragour.in/lab/superplaceholderjs/
* Copyright (c) 2016 Kushagra Gour; Licensed CC-BY-ND-4.0 */

;(function () {
    var test = document.createElement('input');
    var isPlaceHolderSupported = ('placeholder' in test);

    // Helpers
    function extend(obj1, obj2) {
        var obj = {};
        for (var key in obj1) {
            obj[key] = obj2[key] === undefined ? obj1[key] : obj2[key];
        }
        return obj;
    }

    var defaults = {
        letterDelay: 100, //milliseconds
        sentenceDelay: 1000, //milliseconds
        loop: false,
        startOnFocus: true
    };

    // Constructor: PlaceHolder
    function PlaceHolder(el, texts, options) {
        this.el = el;
        this.texts = texts;
        options = options || {};
        this.options = extend(defaults, options);
        this.timeouts = [];
        this.begin();
    }

    PlaceHolder.prototype.begin = function() {
        var self = this;
        self.originalPlaceholder = self.el.getAttribute('placeholder');
        if (self.options.startOnFocus) {
            self.el.addEventListener('focus', function () {
                self.processText(0);
            });
            self.el.addEventListener('blur', function () {
                self.cleanUp();
            });
        }
        else {
            self.processText(0);
        }
    };

    PlaceHolder.prototype.cleanUp = function () {
        // Stop timeouts
        for (var i = this.timeouts.length; i--;) {
            clearTimeout(this.timeouts[i]);
        }
        this.el.setAttribute('placeholder', this.originalPlaceholder);
        this.timeouts.length = 0;
    };

    PlaceHolder.prototype.typeString = function (str, callback) {
        var self = this,
            timeout;

        if (!str) { return false; }
        function setTimeoutCallback(index) {
            // Add cursor `|` after current substring unless we are showing last
            // character of the string.
            self.el.setAttribute('placeholder', str.substr(0, index + 1) + (index === str.length - 1 ? '' : '|'));
            if (index === str.length - 1) {
                callback();
            }
        }
        for (var i = 0; i < str.length; i++) {
            timeout = setTimeout(setTimeoutCallback, i * self.options.letterDelay, i);
            self.timeouts.push(timeout);
        }
    };

    PlaceHolder.prototype.processText = function(index) {
        var self = this,
            timeout;

        self.typeString(self.texts[index], function () {
            timeout = setTimeout(function () {
                self.processText(self.options.loop ? ((index + 1) % self.texts.length) : (index + 1));
            }, self.options.sentenceDelay);
            self.timeouts.push(timeout);
        });
    };

    var superplaceholder = function (params) {
        if (!isPlaceHolderSupported) { return; }
        new PlaceHolder(params.el, params.sentences, params.options);
    };

    // open to the world.
    // commonjs
    if( typeof exports === 'object' )  {
        module.exports = superplaceholder;
    }
    // AMD module
    else if( typeof define === 'function' && define.amd ) {
        define(function () {
            return superplaceholder;
        });
    }
    // Browser global
    else {
        window.superplaceholder = superplaceholder;
    }
})();

    </script>
    <style type="text/css">
        /*--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
--*/
/*-- reset --*/
html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,dl,dt,dd,ol,nav ul,nav li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline;}
article, aside, details, figcaption, figure,footer, header, hgroup, menu, nav, section {display: block;}
ol,ul{list-style:none;margin:0px;padding:0px;}
blockquote,q{quotes:none;}
blockquote:before,blockquote:after,q:before,q:after{content:'';content:none;}
table{border-collapse:collapse;border-spacing:0;}
/*-- start editing from here --*/
a{text-decoration:none;}
.txt-rt{text-align:right;}/* text align right */
.txt-lt{text-align:left;}/* text align left */
.txt-center{text-align:center;}/* text align center */
.float-rt{float:right;}/* float right */
.float-lt{float:left;}/* float left */
.clear{clear:both;}/* clear float */
.pos-relative{position:relative;}/* Position Relative */
.pos-absolute{position:absolute;}/* Position Absolute */
.vertical-base{ vertical-align:baseline;}/* vertical align baseline */
.vertical-top{  vertical-align:top;}/* vertical align top */
nav.vertical ul li{ display:block;}/* vertical menu */
nav.horizontal ul li{   display: inline-block;}/* horizontal menu */
img{max-width:100%;}
/*-- end reset --*/
body {
    font-family: 'Open Sans', sans-serif;
    background: url(/images/1.jpg)repeat 0px 0px;
    background-attachment: fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover; 
    background-size: cover;
}
h1 {
    font-size: 3em;
    text-align: center;
    color: #fff;
    font-weight: 100;
}
/*-- main --*/
.main-agileits{
    padding: 2em 0 0;
}
.mainw3-agileinfo{
    width: 40%;
    margin: 3em auto;
}
.login-form {
    background: rgba(18, 39, 23, 0.2);
    padding:2.5em;
    background-size: cover;
    -webkit-box-shadow: 0px 5px 9px 0px rgba(0, 0, 0, 0.68);
    -moz-box-shadow: 0px 5px 9px 0px rgba(0, 0, 0, 0.68);
    -o-box-shadow: 0px 5px 9px 0px rgba(0, 0, 0, 0.68);
    -ms-box-shadow: 0px 5px 9px 0px rgba(0, 0, 0, 0.68);
    box-shadow: 0px 5px 9px 0px rgba(0, 0, 0, 0.68);
    text-align: left;
    border:1px solid rgba(255, 255, 255, 0.52);
} 
.login-form input[type="text"], .login-form input[type="password"] {
    outline: none;
    font-size: 1em;
    color: #000;
    padding: .7em;
    margin: 0 0 2em;
    width: 96%;
    border: none;
    -webkit-appearance: none;
    display: block;
    background: #fff;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -o-border-radius: 2px;
    -ms-border-radius: 2px;
    border-radius: 2px;
}  
.login-form p {
    font-size: 1em;
    color: #fff;
    margin-bottom: .5em;
    font-weight: 300;
    letter-spacing: 3px;
} 
.login-form input[type="submit"] {
    font-size: 1em;
    color: #fff;
    background: #00BCD4;
    border: 1px solid #00BCD4;
    outline: none;
    cursor: pointer;
    padding: .7em 1em;
    margin-top: 2em;
    -webkit-appearance: none;
    width: 100%;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    -ms-border-radius: 2px;
    -o-border-radius: 2px;
    border-radius: 2px;
}
.login-form input[type="submit"]:hover {
    background: transparent;
    color: #00BCD4;  
    transition: 0.5s all ;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
} 
.login-agileits-bottom {
    margin: 2.5em 0;
    text-align: center;
}
.login-agileits-bottom h6 {
    font-size: 1em;
    font-weight: 300;
    letter-spacing: 3px;
}
.login-agileits-bottom h6 a {
    color: #fff;
    transition: 0.5s all ;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
}
.login-agileits-bottom h6 a:hover{
    color: #00BCD4; 
}
::-webkit-input-placeholder { /* Chrome/Opera/Safari */
    color: #999; 
}
::-moz-placeholder { /* Firefox 19+ */
    color: #999;      
}
:-ms-input-placeholder { /* IE 10+ */
    color: #999; 
}
:-moz-placeholder { /* Firefox 18- */
    color: #999; 
}
/*-- checkbox --*/
.anim {
    font-size: 0.9em;
    color: #fff;
    cursor: pointer;
    position: relative;
    margin: 0;
    font-weight: 300;
    display: inline-block;
    letter-spacing: 4px;
}
input.checkbox {
    background: #201548;
    cursor: pointer;
    vertical-align: middle;
}
input.checkbox:before {
    content: "";
    position: absolute;
    width: 1em;
    height: 1em;
    background: inherit; 
}
input.checkbox:after {
    content: ""; 
    position: absolute;
    top: 1px;
    left: 0;
    z-index: 1;
    width: 1em;
    height: 1em;
    border: 1px solid #00BCD4; 
    -webkit-transition: .4s all;
    -moz-transition: .4s all;
    -o-transition: .4s all;
    -ms-transition: .4s all;
    transition: .4s all;
}
input.checkbox:checked:after {
    -webkit-transform: rotate(-45deg);
    -moz-transform: rotate(-45deg);
    -o-transform: rotate(-45deg);
    -ms-transform: rotate(-45deg);
    transform: rotate(-45deg);
    height: .5rem;
    border-color: #00BCD4;
    border-top-color: transparent;
    border-right-color: transparent;
}
 
@keyframes rippling {
    50% {
        border-left-color: #00BCD4;
    }
    100% {
        border-bottom-color: #00BCD4;
        border-left-color: #00BCD4;
    }
}  
/*-- //check box --*/
/*-- //main --*/   
/*-- social-icons --*/  
.social-w3lsicon {
    text-align: center;
}
.social-w3lsicon a {
    font-size: 0.8em;
    color: #fff;
    margin: 0 .5em;
    display: inline-block;
    text-align: center;
    position: relative;
    z-index: 999;
    -webkit-transition: .5s all;
    -moz-transition: .5s all;
    -o-transition: .5s all;
    -ms-transition: .5s all;
    transition: .5s all;
    border: 1px solid rgba(255, 255, 255, 0.21);
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -o-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    line-height: 2.4em;
}
.social-w3lsicon a:hover {
    color: #fff;
    border-color:#fff;
    -webkit-transform: scale(1.2);
    -moz-transform: scale(1.2);
    -o-transform: scale(1.2);
    -ms-transform: scale(1.2);
    transform: scale(1.2);
}
/*-- //social-icons --*/
/*-- copyright --*/
.w3copyright-agile {
    margin: 2em 0;
    text-align: center;
}
.w3copyright-agile p {
    font-size: 0.9em;
    color: #fff;
    line-height: 1.8em;
    letter-spacing: 2px;
    font-weight: 300;
}
.w3copyright-agile p a{
    color: #fff;
}
.w3copyright-agile p a:hover{
    color: #00BCD4;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
}
/*-- //copyright --*/ 
/*-- responsive-design --*/ 
@media(max-width:1366px){
.mainw3-agileinfo {
    width: 45%; 
}
}
@media(max-width:1280px){ 
.login-form input[type="text"], .login-form input[type="password"] { 
    width: 95%; 
}
}
@media(max-width:1080px){
.mainw3-agileinfo {
    width: 50%;
}
h1 {
    font-size: 2.8em; 
}
.login-agileits-bottom {
    margin: 2em 0; 
}
} 
@media(max-width:991px){
.mainw3-agileinfo {
    width: 53%;
}
}
@media(max-width:800px){
h1 {
    font-size: 2.5em;
}
.main-agileits {
    padding: 1.5em 0 0;
}
.mainw3-agileinfo {
    width: 61%;
    margin: 2.5em auto;
}  
.login-form input[type="text"], .login-form input[type="password"] {
    width: 94%;
}
}
@media(max-width:736px){
.login-form { 
    padding: 2.2em; 
}
.mainw3-agileinfo {
    width: 65%; 
}
.login-form input[type="text"], .login-form input[type="password"] { 
    margin: 0 0 1.5em; 
}
.login-form input[type="submit"] { 
    margin-top: 1.6em; 
}
.w3copyright-agile p { 
    letter-spacing: 1px; 
} 
}
@media(max-width:667px){
.mainw3-agileinfo {
    width: 70%;
}
}
@media(max-width:600px){
.mainw3-agileinfo {
    width: 72%;
    margin: 2em auto;
}
h1 {
    font-size: 2.3em;
}
}
@media(max-width:480px){
h1 {
    font-size: 2em;
}
.login-form {
    padding: 1.8em;
}
.mainw3-agileinfo {
    width: 80%;
    margin: 1.5em auto;
}
.login-form input[type="text"], .login-form input[type="password"] {
    width: 93%;
    font-size: 0.9em;
}
.login-form input[type="submit"] {
    font-size: 0.9em;
}
.login-agileits-bottom h6 {
    font-size: 0.9em; 
    letter-spacing: 1px;
}
.anim { 
    letter-spacing: 2px;
}
.w3copyright-agile p {
    font-size: 0.85em; 
}
}
@media(max-width:414px){
h1 {
    font-size: 1.8em;
}
.login-form p {
    font-size: 0.9em; 
    letter-spacing: 2px;
}
.login-agileits-bottom {
    margin: 1.5em 0;
}
.social-w3lsicon a { 
    margin: 0 .1em; 
}
.w3copyright-agile p {
    font-size: 0.8em;
    padding: 0 1em;
}
}
@media(max-width:384px){
.mainw3-agileinfo {
    width: 84%; 
}
.login-form input[type="text"], .login-form input[type="password"] {
    width: 92%; 
} 
.w3copyright-agile {
    margin: 1em 0; 
}
} 
@media(max-width:320px){  
h1 {
    font-size: 1.5em;
}
.mainw3-agileinfo {
    width: 87%;
}
.login-form {
    padding: 1.5em;
}
.login-form input[type="text"], .login-form input[type="password"] { 
    font-size: 0.8em;
}
.login-form input[type="submit"] {
    font-size: 0.85em;
    padding: .6em 1em;
    letter-spacing: 1px;
}
.login-agileits-bottom h6 {
    font-size: 0.8em; 
}
.social-w3lsicon a {
    font-size: 0.6em; 
    width: 28px;
    height: 28px;
    line-height: 3.1em;
}
.w3copyright-agile p {
    letter-spacing: 0.5px;
}
}
/*-- //responsive-design --*/

    </style>
</head>
<body>
<!-- main -->
<div class="main-agileits">
    <h1>Wireless Security Login</h1>
    <div class="mainw3-agileinfo">
        <!-- login form -->
        <div class="login-form">
            <div class="login-agileits-top">
                <form action="login.php" method="post">
                    <p>Username </p>
                    <input id="input1" type="text" class="name" name="username" placeholder="Username" required=""/>
                    <p>Password</p>
                    <input id="input2" type="password" class="password" name="password" placeholder=".........." required=""/>
                    <label class="anim">
                        <input type="checkbox" class="checkbox">
                        <span> Remember me ?</span>
                    </label>
                    <input type="submit" value="Login">
                </form>
            </div>
            <div class="login-agileits-bottom">
                <h6><a href="#">Forgot password?</a></h6>
            </div>
            <div class="social-w3lsicon">
                <a href="#" class="social-button twitter"><i class="fa fa-twitter"></i></a>
                <a href="#" class="social-button facebook"><i class="fa fa-facebook"></i></a>
                <a href="#" class="social-button google"><i class="fa fa-google-plus"></i></a>
                <a href="#" class="social-button drble"><i class="fa fa-dribbble"></i></a>
                <a href="#" class="social-button be"><i class="fa fa-behance"></i></a>
                <a href="#" class="social-button in"><i class="fa fa-linkedin"></i></a>
            </div>

        </div>
    </div>
</div>
<!-- //main -->
<!-- copyright -->
<div class="w3copyright-agile">
    <p>© 2017 Wireless Security Login . All rights reserved </p>
</div>
<!-- //copyright -->
<!-- js -->
<!-- <script src="resources/js/superplaceholder.js"></script> -->
<script>
    superplaceholder({
        el: input1,
        sentences: [ 'tyluudinh', 'tyluu', 'dinhty.luu' ],
        options: {
            loop: true,
            startOnFocus: false
        }
    })
    superplaceholder({
        el: input2,
        sentences: [ '********', '******', '*****' ],
        options: {
            loop: true,
            startOnFocus: false
        }
    })
</script>
<!-- //js -->
</body>
</html>
