/*
 * Globalize Culture iu-Cans
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

Globalize.addCultureInfo( "iu-Cans", "default", {
	name: "iu-Cans",
	englishName: "Inuktitut (Syllabics)",
	nativeName: "ᐃᓄᒃᑎᑐᑦ",
	language: "iu-Cans",
	numberFormat: {
		groupSizes: [3,0],
		percent: {
			pattern: ["-n%","n%"],
			groupSizes: [3,0]
		},
		currency: {
			groupSizes: [3,0]
		}
	},
	calendars: {
		standard: {
			days: {
				names: ["ᓈᑦᑏᖑᔭ","ᓇᒡᒐᔾᔭᐅ","ᐊᐃᑉᐱᖅ","ᐱᖓᑦᓯᖅ","ᓯᑕᒻᒥᖅ","ᑕᓪᓕᕐᒥᖅ","ᓯᕙᑖᕐᕕᒃ"],
				namesAbbr: ["ᓈᑦᑏ","ᓇᒡᒐ","ᐊᐃᑉᐱ","ᐱᖓᑦᓯ","ᓯᑕ","ᑕᓪᓕ","ᓯᕙᑖᕐᕕᒃ"],
				namesShort: ["ᓈ","ᓇ","ᐊ","ᐱ","ᓯ","ᑕ","ᓯ"]
			},
			months: {
				names: ["ᔮᓐᓄᐊᕆ","ᕖᕝᕗᐊᕆ","ᒫᑦᓯ","ᐄᐳᕆ","ᒪᐃ","ᔫᓂ","ᔪᓚᐃ","ᐋᒡᒌᓯ","ᓯᑎᐱᕆ","ᐅᑐᐱᕆ","ᓄᕕᐱᕆ","ᑎᓯᐱᕆ",""],
				namesAbbr: ["ᔮᓐᓄ","ᕖᕝᕗ","ᒫᑦᓯ","ᐄᐳᕆ","ᒪᐃ","ᔫᓂ","ᔪᓚᐃ","ᐋᒡᒌ","ᓯᑎᐱ","ᐅᑐᐱ","ᓄᕕᐱ","ᑎᓯᐱ",""]
			},
			patterns: {
				d: "d/M/yyyy",
				D: "dddd,MMMM dd,yyyy",
				f: "dddd,MMMM dd,yyyy h:mm tt",
				F: "dddd,MMMM dd,yyyy h:mm:ss tt",
				Y: "MMMM,yyyy"
			}
		}
	}
});

}( this ));
;