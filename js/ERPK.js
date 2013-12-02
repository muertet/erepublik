/*
 * js/ERPK.js
 *
 * Copyright (c) 2010 ERPK WEB S.A.
 * All rights reserved.
 */

// compatibility 
// IE - array indexOf
if(typeof Array.prototype.indexOf != 'function'){
    Array.prototype.indexOf = function(what){
        var l = this.length;
        for(i=0; i<l; i++) if(this[i] == what) return i;
        return -1;
    }
}

// ERPK namespace
if(typeof ERPK == 'undefined') var ERPK = {
    // jQuery reference
    $: typeof jQuery != 'undefined' ? jQuery : (    // 1. jQuery
            typeof $ != 'undefined' ? $ : (         // 2. $
                typeof $j != 'undefined' ? $j : (   // 3. $j
                    null
                )
            )
        ),
    // converts an Arguments object into an array
    args:function(argsObj){
        if(argsObj.length == 0) return [];
        if(argsObj.length == 1) return [argsObj[0]];
        var l=argsObj.length; ret = [];
        for(i=0;i<l;i++) ret.push(argsObj[i]);
        return ret;
    },
    
    // jquery data() wrapper
    data: function(node, key, defaultVal){
        if(typeof defaultVal == 'undefined') defaultVal = null;
        
        var data = ERPK.$(node).data('_erpk');
        var keys = key.split('.');

        for(i=0; i< keys.length; i++){
            if(typeof data[ERPK.String.trim(keys[i])] == 'undefined') return defaultVal;
            data = data[ERPK.String.trim(keys[i])];
        }
        return data;
    },
    // logger
    log: function(){
        if(typeof console != 'undefined' && typeof console['log'] == 'function')
            return console.log.apply(window, arguments);
        return alert(ERPK.args(arguments));
    }
};

// ERPK.String namespace
if(typeof ERPK.String == 'undefined') ERPK.String = {
    // left trim a string
    ltrim: function(str){ return str.replace(/^\s+/gi, ''); },
    
    // right trim a string
    rtrim: function(str){ return str.replace(/\s+$/gi, ''); },
    
    // trim a string
    trim: function(str){ return ERPK.String.ltrim(ERPK.String.rtrim(str)); },
    
    // pass a string through a regexp replace filter
    filter: function(str, filters){
        for(r in filters) str = str.replace(r, '');
        return str;
    },
    // match a string to a set of regexps
    check: function(str, filters){
        for(r in filters) if(str.match(r)) return true;
        return false;
    },
    
    // limited string (max length)
    limited_string: function(str, max){
        if(typeof max == 'undefined') return str;
        return str.length <= max ? str : str.substr(0, max);
    }    
};
// ERPK.Number namespace
if(typeof ERPK.Number == 'undefined') ERPK.Number = { 
    // arbitrary precision round
    round: function(str, precision){
        var num  = parseFloat(str);
        var prec = Math.pow(10, precision);
        return Math.round(num * prec)/prec;
    }

}

// ERPK.String namespace
if(typeof ERPK.RegExp == 'undefined') ERPK.RegExp = {
    
    // an arbitrary precision float number
    positive_float: function(val, precision){
        // default precision is 2
        if(typeof precision == 'undefined') precision = 2;
        
        var r = new RegExp('^[0-9]+(?:\\.[0-9]{0,'+precision+'})?$');
        var tmp = r.exec(val);
        
        if(tmp == null || typeof tmp.join == 'undefined') return null;
        return tmp[0].replace(/\+/gi,'');
    },
    positive_int: function(val){
        return val.match(/^(0{1}|[1-9](?=[0-9]*)[0-9]*)$/gi);
    },

    negative_int: function(val){
        return val.match(/^-?(0{1}|[1-9](?=[0-9]*)[0-9]*)?$/gi);
    }

    // add more here
}

// ERPK.Form namespace
if(typeof ERPK.Form == 'undefined') ERPK.Form = {
    // initialize filters for form elements
    // (store data in the DOM nodes)
    init: function(filterSpec){
        // class rules
        if(typeof filterSpec['classes'] != 'undefined') for(fltr in filterSpec['classes']){
            var rules = fltr.split(',');
            for(i=0;i<rules.length;i++)
                ERPK.$('.'+ERPK.String.trim(rules[i])).data('_erpk', filterSpec['classes'][fltr]);
        }
        // name rules
        if(typeof filterSpec['names'] != 'undefined') for(fltr in filterSpec['names']){
            var rules = fltr.split(',');
            for(i=0;i<rules.length;i++)
                ERPK.$('*[name='+ERPK.String.trim(rules[i])+']').data('_erpk', filterSpec['names'][fltr]);
        }
    },
    filter: function(config){
        // defaults
        var defaults = {
            keypress: [], click: [],  change: [], focus: [], blur: []
        };
        // merge config
        for(key in defaults)
            if(typeof config[key] != 'undefined' && typeof config[key].join == 'function')
                defaults[key] = config[key];
        
        // keypress event
        (ERPK.$(defaults['keypress'].join(','))).keypress(ERPK.Form._evtKeyPress);
        // click event
        (ERPK.$(defaults['click'].join(','))).click(ERPK.Form._evtClick);
        // change event
        (ERPK.$(defaults['change'].join(','))).change(ERPK.Form._evtChange);
    },
    _getFilterRules: function(field){
        ERPK.$(field).data('_filter')
    },
    
    // complex filter (behavior depends on external factors, like values of other form fields)
    _evtDependantFilter: function(evt, rules){
        // skip non char codes
        if(evt.charCode == 0) return true;
        if(evt.metaKey == true)  return true;

        // retrieve validate callbacks
        var fltrs = rules;
        if(fltrs == null) fltrs = ERPK.$(this).data('_erpk');

        if(fltrs == null) return true;
        if(typeof fltrs['filters'] == 'undefined') return true;

        // master and checker function
        if(typeof fltrs['master']  == 'undefined') return true;
        if(typeof fltrs['checker'] == 'undefined') return true;
        if(typeof fltrs['filters'] == 'undefined') return true;
        
        // compute master value
        var master_el  = ERPK.$(fltrs['master']);
        if(master_el.length == 0) return true;
        master_el = master_el.get(0);
        var master_val = fltrs['checker'].call(master_el);
        
        if(typeof fltrs['filters'][master_val] == 'undefined') return true;
        
        // filter as usual using the proper filter spec
        return ERPK.Form._evtKeyPress.call(this, evt, fltrs['filters'][master_val]);
    },
    _evtKeyPress: function(evt, rules){
        // skip non char codes
        
        if(evt.charCode == 0) return true;
        if(evt.metaKey == true)  return true;
                
        // retrieve validate callbacks
        var fltrs = rules;
        if(fltrs == null) fltrs = ERPK.$(this).data('_erpk');

        if(fltrs == null) return true;
         
        // check for complex filter
        if(typeof fltrs['filters'] != 'undefined')
            return ERPK.Form._evtDependantFilter.call(this, evt, fltrs['filters']);
        
        
        if(typeof fltrs['filter'] == 'undefined') return true;
        
        var fltr = fltrs['filter'];
        var v = ERPK.$(this).val();
        
        var val = v + String.fromCharCode(evt.charCode);
        
        if(typeof fltr == 'function') {
            val = fltr.call(this, val);
            if(val == null) return false;
            ERPK.$(this).val(val);
        }
        
        if(typeof fltr['join'] == 'function') {
            var i=0, flcount = fltr.length;
            for(i=0;i<flcount;i++){
                val = fltr[i].call(this, (val));
                if(val == null) {
                    evt.preventDefault();
                    evt.stopPropagation();
                    return false;
                }
            }
            return true;
        }
        return true;
    },
    _evtClick: function(){
    },
    _evtChange: function(){
    },
    _evtFocus: function(){
    },
    _evtBlur: function(){
    }
}

//EOF



/**
 * Example usage:
 *
 * ERPK.countDown({
 *		display   : $("#count-down"),
 *		startTime : "00:01:20",
 *		stopTime  : "00:01:00", <- defaults to 00:00:00
 * 		onTick    : function (hours, mins, secs) {
 * 			console.log(hours, mins, secs);
 * 		},
 *		onExpire  : function (hours, mins, secs) {
 *			console.log("Time has expired");
 *		}
 * });
 */
ERPK.countDown = (function () {
	var SECOND = SECONDS = 1000;

	var noop = function () {};

	var zeroFill = function (value) {
		return value >= 10 ? value : "0" + value;
	};

	var parseTime = function (time) {
		var parts = time.split(":");

		return {
			hours   : parseInt(parts[0], 10),
			minutes : parseInt(parts[1], 10),
			seconds : parseInt(parts[2], 10),

			asArray : function () {
				return [this.hours, this.minutes, this.seconds];
			}
		};
	};

	return function (options) {
		var display   = options.display;
		var start     = parseTime( options.startTime );
		var stop      = parseTime( options.stopTime );
		var onTick    = options.onTick   || noop;
		var onExpire  = options.onExpire || noop;
		var timeParts = start.asArray();
		var interval;
		var hideSeconds = options.hideSeconds;

		var coreTicker = function () {
			start.seconds--;

			if (start.seconds === -1) {
				start.seconds = 59;
				start.minutes--;

				if (start.minutes === -1) {
					start.minutes = 59;
					start.hours--;
				}
			}

			timeParts = start.asArray();

			if(hideSeconds){
				var noSeconds = new Array(timeParts[0], timeParts[1]);
				display.text( jQuery.map(noSeconds, zeroFill).join(":") );
			}else{
				display.text( jQuery.map(timeParts, zeroFill).join(":") );
			}
			onTick.apply(display, timeParts);

			if (start.hours === stop.hours && start.minutes === stop.minutes && start.seconds === stop.seconds) {
				window.clearInterval(interval);
				onExpire.apply(display, timeParts);
			}
		};

		if(hideSeconds){
			var noSeconds = new Array(timeParts[0], timeParts[1]);
			display.text( jQuery.map(noSeconds, zeroFill).join(":") );
		}else{
			display.text( jQuery.map(timeParts, zeroFill).join(":") );
		}
		onTick.apply(display, timeParts);

		interval = window.setInterval(coreTicker, 1 * SECOND);
	};
})();


/**
 * Example usage:
 *
 * ERPK.countUp({
 *		display   : $("#count-down"),
 *		startTime : "00:01:00",
 *		stopTime  : "00:01:20", <- defaults to 00:00:00
 * 		onTick    : function (hours, mins, secs) {
 * 			console.log(hours, mins, secs);
 * 		},
 *		onExpire  : function (hours, mins, secs) {
 *			console.log("Time has expired");
 *		}
 * });
 */
ERPK.countUp = (function () {
	var SECOND = SECONDS = 1000;

	var noop = function () {};

	var zeroFill = function (value) {
		return value >= 10 ? value : "0" + value;
	};

	var parseTime = function (time) {
		var parts = time.split(":");

		return {
			hours   : parseInt(parts[0], 10),
			minutes : parseInt(parts[1], 10),
			seconds : parseInt(parts[2], 10),

			asArray : function () {
				return [this.hours, this.minutes, this.seconds];
			}
		};
	};

	return function (options) {
		var display   = options.display;
		var start     = parseTime( options.startTime );
		var stop      = parseTime( options.stopTime );
		var onTick    = options.onTick   || noop;
		var onExpire  = options.onExpire || noop;
		var timeParts = start.asArray();
		var interval;

		var coreTicker = function () {
			start.seconds++;

			if (start.seconds === 60) {
				start.seconds = 0;
				start.minutes++;

				if (start.minutes === 60) {
					start.minutes = 0;
					start.hours++;
				}
			}

			timeParts = start.asArray();

			display.text( jQuery.map(timeParts, zeroFill).join(":") );
			onTick.apply(display, timeParts);

			if (start.hours === stop.hours && start.minutes === stop.minutes && start.seconds === stop.seconds) {
				window.clearInterval(interval);
				onExpire.apply(display, timeParts);
			}
		};

		display.text( jQuery.map(timeParts, zeroFill).join(":") );
		onTick.apply(display, timeParts);

		interval = window.setInterval(coreTicker, 1 * SECOND);
	};
})();
