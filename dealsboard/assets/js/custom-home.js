//counter-count
$('.counter-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 5000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
//counter-count

//Chart code

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv", am4charts.XYChart);

chart.data = [{
  "country": "One",
  "value": 3025
}, {
  "country": "Two",
  "value": 1882
}, {
  "country": "Three",
  "value": 1809
}, {
  "country": "Four",
  "value": 1322
}, {
  "country": "Five",
  "value": 1122
}, {
  "country": "Six",
  "value": -1114
}, {
  "country": "Seven",
  "value": -984
}, {
  "country": "Eight",
  "value": 711
}, {
  "country": "Nine",
  "value": 665
}, {
  "country": "Ten",
  "value": -580
}, {
  "country": "Eleven",
  "value": 443
}, {
  "country": "Twelve",
  "value": 441
}];


var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.minGridDistance = 40;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

var series = chart.series.push(new am4charts.CurvedColumnSeries());
series.dataFields.categoryX = "country";
series.dataFields.valueY = "value";
series.tooltipText = "{valueY.value}"
series.columns.template.strokeOpacity = 0;

series.columns.template.fillOpacity = 0.75;

var hoverState = series.columns.template.states.create("hover");
hoverState.properties.fillOpacity = 1;
hoverState.properties.tension = 0.4;

chart.cursor = new am4charts.XYCursor();

// Add distinctive colors for each column using adapter
series.columns.template.adapter.add("fill", (fill, target) => {
  return chart.colors.getIndex(target.dataItem.index);
});
	

//Chart code



// Chart code
am4core.useTheme(am4themes_animated);
// Themes end

 
// Create map instance
var chart = am4core.create("chartmap", am4maps.MapChart);

// Set map definition
chart.geodata = am4geodata_worldLow;

// Set projection
chart.projection = new am4maps.projections.Miller();

// Export
chart.exporting.menu = new am4core.ExportMenu();

// Zoom control
chart.zoomControl = new am4maps.ZoomControl();

// Data for general and map use
var originCities = [
  {
    "id": "london",
    "title": "",
    "destinations": [" ", "reykjavik", "lisbon", "moscow", "belgrade", "ljublana", "madrid", "stockholm", "bern", "kiev", "new york"],
    "latitude": 51.5002,
    "longitude": -0.1262,
    "scale": 1.5,
    "zoomLevel": 2.74,
    "zoomLongitude": -20.1341,
    "zoomLatitude": 49.1712
  },
  {
    "id": "vilnius",
    "title": "Vilnius",
    "destinations": ["london", "brussels", "prague", "athens", "dublin", "oslo", "moscow", "bratislava", "belgrade", "madrid"],
    "latitude": 54.6896,
    "longitude": 25.2799,
    "scale": 1.5,
    "zoomLevel": 4.92,
    "zoomLongitude": 15.4492,
    "zoomLatitude": 50.2631
  }
];

var destinationCities = [{
  "id": "brussels",
  "title": "Brussels",
  "latitude": 50.8371,
  "longitude": 4.3676
}, {
  "id": "prague",
  "title": "Prague",
  "latitude": 50.0878,
  "longitude": 14.4205
}, {
  "id": "athens",
  "title": "Athens",
  "latitude": 37.9792,
  "longitude": 23.7166
}, {
  "id": "reykjavik",
  "title": "Reykjavik",
  "latitude": 64.1353,
  "longitude": -21.8952
}, {
  "id": "dublin",
  "title": "Dublin",
  "latitude": 53.3441,
  "longitude": -6.2675
}, {
  "id": "oslo",
  "title": "Oslo",
  "latitude": 59.9138,
  "longitude": 10.7387
}, {
  "id": "lisbon",
  "title": "Lisbon",
  "latitude": 38.7072,
  "longitude": -9.1355
}, {
  "id": "moscow",
  "title": "Moscow",
  "latitude": 55.7558,
  "longitude": 37.6176
}, {
  "id": "belgrade",
  "title": "Belgrade",
  "latitude": 44.8048,
  "longitude": 20.4781
}, {
  "id": "bratislava",
  "title": "Bratislava",
  "latitude": 48.2116,
  "longitude": 17.1547
}, {
  "id": "ljublana",
  "title": "Ljubljana",
  "latitude": 46.0514,
  "longitude": 14.5060
}, {
  "id": "madrid",
  "title": "Madrid",
  "latitude": 40.4167,
  "longitude": -3.7033
}, {
  "id": "stockholm",
  "title": "Stockholm",
  "latitude": 59.3328,
  "longitude": 18.0645
}, {
  "id": "bern",
  "title": "Bern",
  "latitude": 46.9480,
  "longitude": 7.4481
}, {
  "id": "kiev",
  "title": "Kiev",
  "latitude": 50.4422,
  "longitude": 30.5367
}, {
  "id": "paris",
  "title": "Paris",
  "latitude": 48.8567,
  "longitude": 2.3510
}, {
  "id": "new york",
  "title": "New York",
  "latitude": 40.43,
  "longitude": -74
}];

// Default to London view
chart.homeGeoPoint = { "longitude": originCities[0].zoomLongitude, "latitude": originCities[0].zoomLatitude };
chart.homeZoomLevel = originCities[0].zoomLevel;

var lineSeriesClass = 'MapLineSeries'; // for temp workaround

var homeButton = new am4core.Button();
homeButton.events.on("hit", function(){
  chart.goHome();
});

homeButton.icon = new am4core.Sprite();
homeButton.padding(7, 5, 7, 5);
homeButton.width = 20;
homeButton.icon.path = "";
homeButton.marginBottom = 10;
homeButton.parent = chart.zoomControl;
homeButton.insertBefore(chart.zoomControl.plusButton);

var targetSVG = "M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z";


// Texts
var labelContainer = chart.createChild(am4core.Container);
labelContainer.isMeasured = false;
labelContainer.x = 80;
labelContainer.y = 27;
labelContainer.zIndex = 10;

var plane = new am4core.Image();
plane.width = 25;
plane.height = 25;
plane.href = "";
plane.parent = labelContainer;

var title = chart.titles.create();
title.align = "left"; // prevent from shifting left/right when text updates
title.valign = "top";
title.verticalCenter = "top";
title.dx = 30;
title.dy = 10;
title.text = "";
title.fill = am4core.color("");
title.fontSize = 20;
title.parent = labelContainer;

var label = labelContainer.createChild(am4core.Label);
label.valign = "top";
label.verticalCenter = "top";
label.config = {
  cursorOverStyle: [
    {
      "property": "cursor",
      "value": "pointer"
    }
  ]
};
label.dx = 30;
label.dy = 35;
label.text = " ";
label.fontSize = 14;
var labelHover = label.states.create("hover");
labelHover.properties.fill = am4core.color("#cc0000");
label.events.on("hit", function(){
  mainSeries.mapImages.each(function(originCity){
    if (currentView && currentView !== originCity.id) {
      originCity.dispatch("hit");
    }
  });
});

// The world
var worldSeries = chart.series.push(new am4maps.MapPolygonSeries());
worldSeries.useGeodata = true;
worldSeries.mapPolygons.template.fill = chart.colors.getIndex(0).brighten(0.5);
worldSeries.fillOpacity = 0.4;
worldSeries.exclude = ["AQ"];

// Create a circle image in image series template so it gets replicated to all new images
var mainSeries = chart.series.push(new am4maps.MapImageSeries());
mainSeries.name = "Origin cities";

var mainSeriesTemplate = mainSeries.mapImages.template;
mainSeriesTemplate.config = {
  cursorOverStyle: [
    {
      "property": "cursor",
      "value": "pointer"
    }
  ]
};
mainSeriesTemplate.horizontalCenter = "middle";
mainSeriesTemplate.verticalCenter = "middle";
mainSeriesTemplate.align = "center";
mainSeriesTemplate.valign = "middle";
mainSeriesTemplate.width = 24;
mainSeriesTemplate.height = 24;
mainSeriesTemplate.nonScaling = true;
mainSeriesTemplate.tooltipText = "{title}";
mainSeriesTemplate.background.fillOpacity = 0;
mainSeriesTemplate.background.fill = "#fff";
mainSeriesTemplate.setStateOnChildren = true;
mainSeriesTemplate.states.create("hover");

var mainCircle = mainSeriesTemplate.createChild(am4core.Sprite);
mainCircle.fill = chart.colors.getIndex(1);
mainCircle.strokeWidth = 0;
mainCircle.scale = 1.3;
mainCircle.path = targetSVG;

var mainHover = mainCircle.states.create("hover");
mainHover.properties.fill = chart.colors.getIndex(1);

mainSeriesTemplate.propertyFields.id = "id";
mainSeriesTemplate.propertyFields.latitude = "latitude";
mainSeriesTemplate.propertyFields.longitude = "longitude";

var currentView;
mainSeriesTemplate.events.on("hit", function(event){
  var data = event.target.dataItem.dataContext;
  
  if (currentView === data.id) return;
  
  currentView = data.id;
  
  title.text = "" + data.title;
  label.text = "" + data.destinations[0][0].toUpperCase() + data.destinations[0].slice(1);
  
  chart.homeGeoPoint = { "longitude": data.zoomLongitude, "latitude": data.zoomLatitude };
  chart.homeZoomLevel = data.zoomLevel;
  chart.zoomToGeoPoint({
    "longitude": data.zoomLongitude,
    "latitude": data.zoomLatitude
  }, data.zoomLevel, true);
  chart.series.each(function(series){
    if (series.className === lineSeriesClass && series.name !== data.title) {
      series.mapLines.each(function(line){ line.hide(); });

    }
  });
  event.target.lineSeries.mapLines.each(function(line){ line.show(); });
});

// Create a circle image in image series template so it gets replicated to all new mainS
var imageSeries = chart.series.push(new am4maps.MapImageSeries());
imageSeries.name = "Destination cities";
var imageSeriesTemplate = imageSeries.mapImages.template;

imageSeriesTemplate.horizontalCenter = "middle";
imageSeriesTemplate.verticalCenter = "middle";
imageSeriesTemplate.align = "center";
imageSeriesTemplate.valign = "middle";
imageSeriesTemplate.width = 16;
imageSeriesTemplate.height = 16;
imageSeriesTemplate.nonScaling = true;
imageSeriesTemplate.tooltipText = "{title}";
imageSeriesTemplate.fill = chart.colors.getIndex(1);
imageSeriesTemplate.background.fillOpacity = 0;
imageSeriesTemplate.background.fill = "#fff";
imageSeriesTemplate.setStateOnChildren = true;
imageSeriesTemplate.states.create("hover");

imageSeriesTemplate.propertyFields.id = "id";
imageSeriesTemplate.propertyFields.latitude = "latitude";
imageSeriesTemplate.propertyFields.longitude = "longitude";

var circle = imageSeriesTemplate.createChild(am4core.Sprite);
circle.scale = 8/9; // from 18 to 16... (18 - (18-16))/18 = 16/18 = 8/9
circle.path = targetSVG;

imageSeries.events.once("inited", function(){  
  mainSeries.mapImages.each(function(originCity){
    var lineSeries = chart.series.push(new am4maps[lineSeriesClass]()); // Using MapArcSeries as temporary workaround until MapLineSeries.mapLines.create() works again.
    
    originCity.lineSeries = lineSeries;
    lineSeries.name = originCity.dataItem.dataContext.title;
    lineSeries.mapLines.template.shortestDistance = false; // keep the lines straight
    lineSeries.mapLines.template.stroke = chart.colors.getIndex(1);
    lineSeries.mapLines.template.visible = false;
    
    originCity.dataItem.dataContext.destinations.forEach(function(destinationCityId){
      lineSeries.mapLines.create().imagesToConnect = [originCity.id, destinationCityId];
    });
    
    // Trigger click event to make London the default view
    if (originCity.id === 'london') {
      originCity.dispatch("hit");
    }
  });
});
mainSeries.data = JSON.parse(JSON.stringify(originCities));
imageSeries.data = JSON.parse(JSON.stringify(destinationCities));


        
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Working Hours",
            value: 12,

        }, {
            label: "Working Hours",
            value: 30
        }, {
            label: "Working Hours",
            value: 20
        }],
        resize: true,
        colors:['#ff80ab', '#f50057', '#ff4081']
    });
	
	// LINE CHART
        var line = new Morris.Line({
          element: 'morris-line-chart',
          resize: true,
          data: [
            {y: '2011 Q1', item1: 2666},
            {y: '2011 Q2', item1: 2778},
            {y: '2011 Q3', item1: 4912},
            {y: '2011 Q4', item1: 3767},
            {y: '2012 Q1', item1: 6810},
            {y: '2012 Q2', item1: 5670},
            {y: '2012 Q3', item1: 4820},
            {y: '2012 Q4', item1: 15073},
            {y: '2013 Q1', item1: 10687},
            {y: '2013 Q2', item1: 8432}
          ],
          xkey: 'y',
          ykeys: ['item1'],
          labels: ['Item 1'],
          gridLineColor: '#e6ebf0',
          lineColors: ['#F14656'],
          lineWidth: 1,
          hideHover: 'auto'
        });
	
 });   



// LINE CHART
var line = new Morris.Line({
element: 'morris-line-chart',
resize: true,
data: [
{y: '2011 Q1', item1: 2666},
{y: '2011 Q2', item1: 2778},
{y: '2011 Q3', item1: 4912},
{y: '2011 Q4', item1: 3767},
{y: '2012 Q1', item1: 6810},
{y: '2012 Q2', item1: 5670},
{y: '2012 Q3', item1: 4820},
{y: '2012 Q4', item1: 15073},
{y: '2013 Q1', item1: 10687}

],
xkey: 'y',
ykeys: ['item1'],
labels: ['Item 1'],
gridLineColor: '#f2f4f7',
lineColors: ['#ff4c79'],
lineWidth: 3,
hideHover: 'auto'
});;