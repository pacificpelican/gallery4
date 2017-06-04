//  rotor.js code by Dan McKeown http://danmckeown.info
//  copyright 2016 Licensed under MIT License
//  requires jQuery
//  v0.1.0-beta5
//  http://rotor.pacificio.com

'use strict';

var flipPic = function flipPic(next, current, parentSelector, childSelector) {
    var call1 = arguments.length <= 4 || arguments[4] === undefined ? 'fadeOut()' : arguments[4];
    var call2 = arguments.length <= 5 || arguments[5] === undefined ? 'fadeIn()' : arguments[5];

    //  this function effects the DOM in order to swap elements
    //  by default the visible child[ren] of div#rotor fades out and the 'next' child fades in
    //  child elements should each have a unique id
    //  implicit default values currently set in the code:
    //  current = $( childSelector + ":visible" )   //  set as selector to disappear
    //  next = $(current).next()                    //  set as selector to appear
    //  parentSelector = 'div#rotor'        //  the parent div that contains the divs
    //  childSelector = 'div.rotor_image'   //  the class given to each child div

    var nth_pos;
    var flip_pos;
    var current_id;
    var n_selector;
    var f_selector;

    if (typeof childSelector === 'undefined' || childSelector === 'null') {
        childSelector = 'div.rotor_image';
    }
    if (typeof parentSelector === 'undefined' || parentSelector === 'null') {
        parentSelector = 'div#rotor';
    }

    var current_check = current;
    var maxPos = $(parentSelector).children().length;

    if (typeof current_check !== 'undefined' && current_check !== 'null') {
        console.log('using current parameter');
        nth_pos = $(current_check).index() + 1;
    } else if (typeof current_check === 'undefined' || current_check === 'null') {
        current = $(childSelector + ":visible");
        console.log('current id is:');
        current_id = $(current).attr('id');
        console.log(current_id);
        n_selector = '#'.current_id;
    }

    if (typeof next === 'undefined' || next === 'null') {
        //   if no parameters:
        console.log('using no params');
        current = $(childSelector + ":visible");
        console.log('current id is:');
        current_id = $(current).attr('id');
        console.log(current_id);
        var zero_n_selector = current;
        n_selector = zero_n_selector.selector;
        nth_pos = $(current).index() + 1;
        console.log('nth_pos: ' + nth_pos + "   flip_pos: " + flip_pos);
        var zero_f_selector = void 0;
        if (nth_pos == maxPos) {
            zero_f_selector = $(parentSelector + ' div:first-child');
        } else {
            zero_f_selector = $(current).next();
        }
        f_selector = "#" + zero_f_selector[0].id;
    } else if (typeof next !== 'undefined' || next !== 'null') {
        flip_pos = $(next).index() + 1;
        if (typeof current !== 'undefined') {
            nth_pos = $(current).index() + 1;
        }
        console.log('nth_pos: ' + nth_pos + "   flip_pos: " + flip_pos);
    }

    console.log('current is:');
    console.log(current);
    console.log('maxPos:' + maxPos);

    if (flip_pos === 1) {
        nth_pos = maxPos;
    }

    if (typeof n_selector === 'undefined') {
        console.log('nth_pos: ' + nth_pos + "   flip_pos: " + flip_pos);
        n_selector = "div div:nth-child(" + nth_pos + ")";
    }
    if (typeof f_selector === 'undefined') {
        f_selector = "div div:nth-child(" + flip_pos + ")";
    }

    console.log('n_selector: ');
    console.log(n_selector);
    console.log('f_selector: ');
    console.log(f_selector);

    var callback1 = "$('" + n_selector + "')." + call1;
    var callback2 = "$('" + f_selector + "')." + call2;

    console.log(callback1);
    console.log(callback2);

    var callRunner = function callRunner() {
        var runCalls = function runCalls(callback1, callback2) {
            var c1 = new Function('return ' + callback1)();
            var c2 = new Function('return ' + callback2)();
        };
        runCalls(callback1, callback2);
    };

    callRunner();
}; //	DOM element swapping tool

var positionElement = function positionElement() {
    var selector = arguments.length <= 0 || arguments[0] === undefined ? '.main' : arguments[0];
    var yCoefficient = arguments.length <= 1 || arguments[1] === undefined ? '0.5' : arguments[1];

    $(window).scroll(function () {
        var topPos = $(this).scrollTop();
        $(selector).css('transform', 'translateY(' + yCoefficient * topPos + 'px)');
    });
}; //  Parallax Positioning Tool