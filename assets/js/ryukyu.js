//	ryukyu.js JavaScript library
//	v 0.2.5
//	copyright July 2015 Dan McKeown
//      http://danmckeown.info/code/ryukyu
//	Released under MIT license:
//      https://github.com/pacificpelican/ryukyu/blob/master/LICENSE

/*jshint esnext: true */
"use strict";
//  class declarations require ES6/ES2015 and strict mode

var ryukyu_retArr = [];
var ryukyu_bigCount = 0;
var ryukyu_nodeRetObj = {};

var ryukyu_listItem = class linkedListItem {  // This class instantiates a single variable that contains an id, a value and a next reference
    constructor(place, next, value) {
        if (value === undefined) {
            this.value = null;
        }
        else {
            this.value = value;
        }
        this.id = place;  // Let place be undefined rather than null by default since it is the id and should have a value
        if (((next === undefined) || (next === "auto")) && (place !== undefined)) {
            this.next = place+1;
        }
        else {
            this.next = next;
        }
    }
};

var ryukyu_list = class listNode {  //  This class generates a series of variables, each w/a next pointer to the next one's id
                                    //  It also separately returns all the node items grouped together as an object
    constructor(theLength, baseName, defaultValue) {
        if (baseName === undefined) {
            console.log("basename automatically assigned as node");
            baseName = "node";
        }
        if (defaultValue === undefined) {
            console.log("setting default value to null");
            defaultValue = null;
        }
        ryukyu_nodeRetObj = {};
        for (var i=1; i<theLength; i++) {
            var nodeName;
            nodeName = baseName + "_" + i;
            console.log("about to construct " + nodeName);
            var name0 = nodeName;
            window[name0] = new ryukyu_listItem(i, "auto", defaultValue);
            ryukyu_nodeRetObj[i] = window[name0];
        }
        var nodeName;
        var pos = i;
        nodeName = baseName + "_" + pos;
        console.log("about to construct " + nodeName);
        var name0 = nodeName;
        window[name0] = new ryukyu_listItem(pos, null, defaultValue);
        ryukyu_nodeRetObj[i] = window[name0];
        return ryukyu_nodeRetObj;
    }
};

function ryukyu_listToArray(head_id, nodeBaseName, arrName) { 	// This function takes info about the head list variable,
                                                                //	works along the chain of separate but nodeBaseName-linked variables,
                                                                //  and generates an array based on nodeBaseName and also returns an array
    if ((head_id === undefined) || (nodeBaseName === undefined)) {
        return false;
    }
    else {
        if ((arrName === undefined) || (arrName === "null")) {
            arrName = "array";
        }
        window[arrName] = [];
        var headNodeName = nodeBaseName + "_" + head_id;
        var name0 = headNodeName;
        var value1 = window[name0].value;
        console.log("looking to add value " + value1 + " to " + ryukyu_retArr);
        ryukyu_retArr[ryukyu_bigCount] = value1;
        ryukyu_bigCount++;
        var next = window[name0].next;
        console.log("next is " + next);
        if ((next !== null) && (next !== undefined)) {
            ryukyu_listToArray(next, nodeBaseName);
        }
    }
    var theRet = ryukyu_retArr;
    ryukyu_bigCount = 0;
    window[arrName] = theRet;
    console.log("resulting array " + arrName + " is " + window[arrName]);
    return theRet;  //  The array returned is the same as the one generated but named based on class instantiation
}

function ryukyu_arrayToList(arr, nodeBaseName) {    //  This function takes an array and creates a series of linked items
                                                    //  based on nodeBaseName and also separately returns an object of all those items
                                                    // arr should be a variable not in quotes (or a literal maybe)
                                                    // while nodeBaseName should be a name in quotes
    if ((arr === undefined) || (arr === "null")) {
        return false;
    }
    else {
        if ((nodeBaseName === undefined) || (nodeBaseName === "null") || (arr.length < 1)) {
            nodeBaseName = "node";
        }
        ryukyu_nodeRetObj = {};
        var node_num = 1;
        for (var i=0; i<arr.length; i++) {
            console.log("array is " + arr);
            var name0 = nodeBaseName + "_" + node_num;
            if (i<(arr.length - 1)) {
                window[name0] = new ryukyu_listItem(node_num, "auto", arr[i]);
                console.log("array item " + arr[i] + " at " + i + " converted into linked list item " + name0 + " with value " + arr[i]);
            }
            else{
                window[name0] = new ryukyu_listItem(node_num, null, arr[i]);
                console.log("array item " + arr[i] + " at " + i + " converted into linked list item " + name0 + " with value " + arr[i]);
            }
            ryukyu_nodeRetObj[node_num] = window[name0];
            node_num++;
        }
        console.log("..return object is " + ryukyu_nodeRetObj);
        return ryukyu_nodeRetObj;
    }
}

function ryukyu_listObjectToArray(obj, arrName) {   // This function takes an object in the style returned by ryukyu_list
                                                    // and returns an array and creates an array based on arrName
    if ((obj === undefined) || (obj === null)) {
        return false;
    }
    else {
        if ((arrName === undefined) || (arrName === "null")) {
            arrName = "array";
        }
        ryukyu_retArr = [];
        var $count = 0;
        window[arrName] = [];
        for (var prop in obj) {
            console.log("key " + prop + " = " + obj[prop].value);
            ryukyu_retArr[$count] = obj[prop].value;
            window[arrName].push(obj[prop].value);
            $count++;
        }
    console.log(obj + " has been converted into array " + arrName + " with values " + ryukyu_retArr);
    return ryukyu_retArr;
    }
}

var $ryukyu = function ryukyu(feature, payload) {  // This function can be called e.g. as $ryukyu("bubbleSort",[3,6,2,1]);
	function sortResultArr(set) {
		console.log("about to sort: " + set + "  using Ryukyu default sort");
		var x = 0;
		function bubbleOne(set0) {
		    if (set0[x+1] < set0[x]) {
		        console.log("inside swap (bubbleOne)...x=" + x + " " + set0);
		        var temp = set0[x+1];
		        set0[x+1] = set0[x];
		        set0[x] = temp;
		        console.log(set0);
		    }
		    return set0;
		}
		function bubbleSort() {
			zs1 = set;
		    console.log(zs1.length);
		    var length1 = zs1.length;
		    var tmp = (zs1.length * length1);
		    for (i=0; i<tmp; i++) {
		        console.log("run " + i);
		        console.log("i=" + i + "  length1=" + length1 + "  x=" + x);
		        if (i % length1 == 0) {
		            x = 0;
		        }
		        else {
		            x = (i % length1);
		        }
		        bubbleOne(zs1);
		    }
		}
		bubbleSort();
		console.log("final order set: " + set);
		resultArr = set;
		return set;
	}
	if (feature == "crush") {
		var retStr = [];
		for (var i=0; i<payload.length; i++) {
			if ((payload[i] !== null) && (typeof payload[i] !== 'undefined')) {
				retStr = retStr + payload[i];
			}
		}
		return retStr;
	}
	if (feature == "bubbleSort") {
		var set = payload;
		console.log("about to sort: " + set + "  using Ryukyu Bubble Sort");
		zs1 = set;
		var x = 0;
		function bubbleOne(set) {
		    if (set[x+1] < set[x]) {
		        console.log("inside swap (bubbleOne)...x=" + x + " " + set);
		        var temp = set[x+1];
		        set[x+1] = set[x];
		        set[x] = temp;
		        console.log(set);
		    }
		    return set;
		}
		function bubbleSort() {
		    console.log(zs1.length);
		    var length1 = zs1.length;
		    var tmp = (zs1.length * length1);
		    for (var i=0; i<tmp; i++) {
		        console.log("run " + i);
		        console.log("i=" + i + "  length1=" + length1 + "  x=" + x);
		        if (i % length1 === 0) {
		            x = 0;
		        }
		        else {
		            x = (i % length1);
		        }
		        bubbleOne(zs1);
		    }
		}
		bubbleSort();
		console.log("final order set: " + set);
		return set;
	}
	if (feature == "selectionSort") {
		set = payload;
		console.log("about to sort: " + set + " using Ryukyu Selection Sort");
		var zs1 = set;
		var x = 0;
		resultArr = [];
		var bubbleCount = 0;
		var arr = set;
		var sortedSize = 0;
		function selectionSort() {
		    console.log("running at " + size + " on the array: " + arr);
		    var x = arr[size];
		        for (var i=0; i<set.length; i++) {
		            for (i=0; i<arr.length; i++) {
		                if (arr[i] > arr[i+1]) {
		                    console.log("swapping arr[size] and arr[size+i]: " + arr[size] + " "+ arr[size+i]);
		                    var t = arr[i];
		                    arr[i] = arr[1+i];
		                    arr[1+i] = t;
		                    size++;
		                    selectionSort();
		                }
		            }
		        }
		        return arr;
		}
		var size = sortedSize;
		resultArr = selectionSort();
		console.log("final sort:" + resultArr);
		return resultArr;
	}
	if (feature == "insertionSort") {
		set = payload;
		console.log("about to sort: " + set + " using Ryukyu Insertion Sort");
		var zs1 = set;
		var x = 0;
		function insertionSortSpotFinder(set, x) {  // find the position of the first value that needs to shift right
		    console.log('spot finder run ' + x);
		    while (x<set.length) {
		        if (((set[x] != 'undefined') && (set[x+1] != 'undefined')) && (set[x] <= set[x+1])) {
		            x++;
		        }
		        else {
		            console.log('spot is ' + x);
		            return x;
		        }
		    }
		    return false;
		}
		function insertionSortDepthFinder(set, x) {  //  find how far to the right the SpotFinder-flagged item needs to be moved
		    console.log('depth finder run ' + x);
		    var count = 0;
		    var basis = set[x];
		    while (x<set.length) {
		        console.log("set at x is " + x + " " + set[x]);
		        if (((set[x] != 'undefined') && (set[x+1] != 'undefined')) && (basis >= set[x+1])) {
		            count++;
		            x++;
		        }
		        else {
		            console.log('depth is ' + count);
		            return count;
		        }
		    }
		    return false;
		}
		function implementInsertionSort(zs1, place, distance) {
		    var tempe = zs1[place];
		    var dest = zs1[place+distance];
		    for (var i=distance; i>0; i--) {
		        console.log("replacing " + zs1[i+place-1] + " with " + zs1[i+place]);
		        var t = zs1[i+place-1];
		        console.log("trailer is " + trailer + " and zs1[i+place-1] is " + zs1[i+place-1] +  " and zs1[i+place] is " + zs1[i+place]);
		        if (i == distance) {
		            console.log("run ZERO");
		            zs1[i+place-1] = zs1[i+place];
		            var trailer = t;
		        }
		        else if (i != distance - 0){
		            zs1[i+place-1] = trailer;
		            var trailer = t;
		        }
		    }
		    zs1[place+distance] = tempe;
		}
		function insertionSort() {
		    var xvar = 0;
		    var count = 0;
		    console.log("zs1.length is " + zs1.length);
		    while (count<zs1.length+10) {
		        console.log("sort tool run " + count);
		        var spot = insertionSortSpotFinder(zs1, xvar);
		        var depth = insertionSortDepthFinder(zs1, spot);
		        var result = implementInsertionSort(zs1, spot, depth);
		        console.log("current set at" + count + " is " + zs1);
		        count++;
		    }
		}
		insertionSort();
		console.log("final order set: " + zs1);
		return zs1;
	}
	if (feature == "quickSort") {
		set = payload;
		console.log("about to sort: " + set + " using Ryukyu Quick Sort");
		var zs1 = set;
		var x = 0;
		var resultArr = [];
		function swap(seti, z) {
		    console.log("seti is " + seti);
		    z = 1;
		    if (seti[z-1] != 'undefined') {
		        console.log("inside swap function with z at " + z + " and array at " + seti);
		        console.log("SWAP: about to compare if " + seti[z] + " is less than < " + seti[z-1]);
		        if (seti[z] < seti[z-1]) {
		            console.log('attempting to swap ' + seti[z] + " and " + seti[z-1]);
		            var temp = seti[z];
		            seti[z] = seti[z-1];
		            seti[z-1] = temp;
		            return seti;
		        }
		        else {
		            return seti;
		        }
		    }
		}
		function checkLeft(z) {
		    if (set[z-1] > set[z]) {
		        return true;
		    }
		    else {
		        return false;
		    }
		}
		function quickOne(arr) {
		    console.log("running quickOne with array " + arr);
		    var pivotPosition = arr.length - 1;
		    var pivot = arr[pivotPosition];
		    for (i=0; i<arr.length; i++) {
		        var doTest = checkLeft(pivot+i);
		            arr = swap(arr, pivot+i);
		    }
		    return arr;
		}
		function quickSort(set) {
		    console.log("current result array: " + resultArr);
		    var ar2 = [];
		    var ar3 = [];
		    if (set.length > 1) {
		        var half = (set.length / 2);
		        half = Math.floor(half);
		        for (i=0; i<half; i++) {
		            ar2[i] = set[i];
		        }
		        quickSort(ar2);
		        var runner = 0;
		        for (i=half; i<set.length; i++) {
		            ar3[runner] = set[i];
		            runner++;
		        }
		        quickSort(ar3);
		    }
		    else {
		        var st = quickOne(set);
		        var middle = Math.floor(resultArr.length / 2);
		        console.log("SET IS " + set);
		        var pivot1 = resultArr[middle];
		        console.log("comparing " + st + " > " + pivot1);
		        st = parseInt(st);
		        pivot1 = parseInt(pivot1);
		        if (st > pivot1) {
		            console.log("TRUE: about to push " + st + " onto the result array");
		            resultArr.push(st);
		        }
		        else {
		            console.log("FALSE: about to unshift " + st + " onto the result array");
		            resultArr.unshift(st);
		        }
		        resultArr = sortResultArr(resultArr);
		    }
		}
		quickSort(set);
		var zs2 = resultArr;
		console.log("final order set: " + zs2);
		return zs2;
	}
	else {
		return false;
	}
};
