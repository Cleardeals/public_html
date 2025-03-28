/*
 * Globalize Culture ms
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

Globalize.addCultureInfo( "ms", "default", {
	name: "ms",
	englishName: "Malay",
	nativeName: "Bahasa Melayu",
	language: "ms",
	numberFormat: {
		currency: {
			decimals: 0,
			symbol: "RM"
		}
	},
	calendars: {
		standard: {
			firstDay: 1,
			days: {
				names: ["Ahad","Isnin","Selasa","Rabu","Khamis","Jumaat","Sabtu"],
				namesAbbr: ["Ahad","Isnin","Sel","Rabu","Khamis","Jumaat","Sabtu"],
				namesShort: ["A","I","S","R","K","J","S"]
			},
			months: {
				names: ["Januari","Februari","Mac","April","Mei","Jun","Julai","Ogos","September","Oktober","November","Disember",""],
				namesAbbr: ["Jan","Feb","Mac","Apr","Mei","Jun","Jul","Ogos","Sept","Okt","Nov","Dis",""]
			},
			AM: null,
			PM: null,
			patterns: {
				d: "dd/MM/yyyy",
				D: "dd MMMM yyyy",
				t: "H:mm",
				T: "H:mm:ss",
				f: "dd MMMM yyyy H:mm",
				F: "dd MMMM yyyy H:mm:ss",
				M: "dd MMMM",
				Y: "MMMM yyyy"
			}
		}
	}
});

}( this ));
;