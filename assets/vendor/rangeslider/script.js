$(function () {
$('input[type="range"]').rangeslider({
polyfill: false,
onInit: function () {
$('.header .pull-right').text($('input[type="range"]').val() + '');
},
onSlide: function (position, value) {
//console.log('onSlide');
//console.log('position: ' + position, 'value: ' + value);
$('.header .pull-right').text(value + '');
},
onSlideEnd: function (position, value) {
//console.log('onSlideEnd');
//console.log('position: ' + position, 'value: ' + value);
} });

});;