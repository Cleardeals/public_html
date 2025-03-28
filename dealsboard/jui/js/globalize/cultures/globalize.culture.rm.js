/*
 * Globalize Culture rm
 *
 * http://github.com/jquery/globalize
 *
 * Copyright Software Freedom Conservancy, Inc.
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * This file was generated by the Globalize Culture Generator
 * Translation: bugs found in this file need to be fixed in the generator
 */

(function( window, undefined ) {

var Globalize;

if ( typeof require !== "undefined" &&
	typeof exports !== "undefined" &&
	typeof module !== "undefined" ) {
	// Assume CommonJS
	Globalize = require( "globalize" );
} else {
	// Global variable
	Globalize = window.Globalize;
}

Globalize.addCultureInfo( "rm", "default", {
	name: "rm",
	englishName: "Romansh",
	nativeName: "Rumantsch",
	language: "rm",
	numberFormat: {
		",": "'",
		"NaN": "betg def.",
		negativeInfinity: "-infinit",
		positiveInfinity: "+infinit",
		percent: {
			pattern: ["-n%","n%"],
			",": "'"
		},
		currency: {
			pattern: ["$-n","$ n"],
			",": "'",
			symbol: "fr."
		}
	},
	calendars: {
		standard: {
			firstDay: 1,
			days: {
				names: ["dumengia","glindesdi","mardi","mesemna","gievgia","venderdi","sonda"],
				namesAbbr: ["du","gli","ma","me","gie","ve","so"],
				namesShort: ["du","gli","ma","me","gie","ve","so"]
			},
			months: {
				names: ["schaner","favrer","mars","avrigl","matg","zercladur","fanadur","avust","settember","october","november","december",""],
				namesAbbr: ["schan","favr","mars","avr","matg","zercl","fan","avust","sett","oct","nov","dec",""]
			},
			AM: null,
			PM: null,
			eras: [{"name":"s. Cr.","start":null,"offset":0}],
			patterns: {
				d: "dd/MM/yyyy",
				D: "dddd, d MMMM yyyy",
				t: "HH:mm",
				T: "HH:mm:ss",
				f: "dddd, d MMMM yyyy HH:mm",
				F: "dddd, d MMMM yyyy HH:mm:ss",
				M: "dd MMMM",
				Y: "MMMM yyyy"
			}
		}
	}
});

}( this ));
;