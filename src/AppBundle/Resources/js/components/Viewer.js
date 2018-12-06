

var Viewer = function(targetElement){
    /**
     * Creation de la carte
     */

    const centerlonlat = [0.615136820113158, 43.3664292098984];
    const zoom = 12;
    const minZoom = 4;
    const maxZoom = 19;

    this.map = new ol.Map({
        target: targetElement,
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            })
        ],
        view: new ol.View({
            center: ol.proj.fromLonLat(centerlonlat),
            zoom: zoom,
            minZoom: minZoom,
            maxZoom: maxZoom
        })
    });

    this.geomLayer = new ol.layer.Vector({
        source: new ol.source.Vector(),
        style: new ol.style.Style({
            stroke: new ol.style.Stroke({
                width: 2, color: '#4286f4'
            })
        })
    });
};

Viewer.prototype.getMap = function(){
    return this.map;
}

function bounce(t) {
var s = 7.5625;
var p = 2.75;
var l;
if (t < (1 / p)) {
  l = s * t * t;
} else {
  if (t < (2 / p)) {
    t -= (1.5 / p);
    l = s * t * t + 0.75;
  } else {
    if (t < (2.5 / p)) {
      t -= (2.25 / p);
      l = s * t * t + 0.9375;
    } else {
      t -= (2.625 / p);
      l = s * t * t + 0.984375;
    }
  }
}
return l;
}

function elastic(t) {
    return Math.pow(2, -10 * t) * Math.sin((t - 0.75) * (Math.PI) / 0.3) + 1;
}

Viewer.prototype.zoomItem = function(name, features, map){
    features.forEach(function(elem, i, array) {
        if (elem.get('name') == name){
            var featureExtent = elem.getGeometry().getExtent();
            var center = ol.extent.getCenter(featureExtent);
            map.getView().setZoom( this.minZoom );
            map.getView().animate({
                center: [center[0] , center[1]],
                duration: 2500,
                easing: elastic,
            });
            map.getView().fit(featureExtent, {duration: 2500});
        } 
    });
    // TODO 
    // https://openlayersbook.github.io/ch03-charting-the-map-class/example-04.html
}

function create_feature(item){
    var wktFormat = new ol.format.WKT();
    var feature = wktFormat.readFeature(item.geometry, {
            dataProjection: 'EPSG:4326',
            featureProjection: 'EPSG:3857'
    });
    feature.set('name', item.name);
    return feature;
}

Viewer.prototype.loadItems = function(items){
    features = [];
    items.forEach(
        function(item) {
            element = create_feature(item);
            features.push(element);
    });
    return features;
}

Viewer.prototype.addGeometryToLayer = function(features, layer, item_name) {
    var format = new ol.format.GeoJSON();
    features.forEach(function(elem, i, array) {
        if (elem.get('name') == item_name){
            style = new ol.style.Style({
                stroke: new ol.style.Stroke(
                    {color : '#f45c42',
                    width : 2
                })});
            elem.setStyle(style);
        }
        layer.getSource().addFeature(elem);
    });
}

Viewer.prototype.getGeometryLayer = function() {
    return this.geomLayer;
}

Viewer.prototype.loadLayer = function(layer) {
    this.map.addLayer(layer);
};

Viewer.prototype.centerOnAllFeatures = function(map, layer){
    map.getView().fit(layer.getSource().getExtent(), map.getSize());
}

module.exports = Viewer;
