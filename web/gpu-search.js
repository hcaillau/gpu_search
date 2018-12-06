/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/AppBundle/Resources/js/main.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/AppBundle/Resources/js/components/Viewer.js":
/*!*********************************************************!*\
  !*** ./src/AppBundle/Resources/js/components/Viewer.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("\n\nvar Viewer = function(targetElement){\n    /**\n     * Creation de la carte\n     */\n\n    const centerlonlat = [0.615136820113158, 43.3664292098984];\n    const zoom = 12;\n    const minZoom = 4;\n    const maxZoom = 19;\n\n    this.map = new ol.Map({\n        target: targetElement,\n        layers: [\n            new ol.layer.Tile({\n                source: new ol.source.OSM()\n            })\n        ],\n        view: new ol.View({\n            center: ol.proj.fromLonLat(centerlonlat),\n            zoom: zoom,\n            minZoom: minZoom,\n            maxZoom: maxZoom\n        })\n    });\n\n    this.geomLayer = new ol.layer.Vector({\n        source: new ol.source.Vector(),\n        style: new ol.style.Style({\n            stroke: new ol.style.Stroke({\n                width: 2, color: '#4286f4'\n            })\n        })\n    });\n};\n\nViewer.prototype.getMap = function(){\n    return this.map;\n}\n\nfunction bounce(t) {\nvar s = 7.5625;\nvar p = 2.75;\nvar l;\nif (t < (1 / p)) {\n  l = s * t * t;\n} else {\n  if (t < (2 / p)) {\n    t -= (1.5 / p);\n    l = s * t * t + 0.75;\n  } else {\n    if (t < (2.5 / p)) {\n      t -= (2.25 / p);\n      l = s * t * t + 0.9375;\n    } else {\n      t -= (2.625 / p);\n      l = s * t * t + 0.984375;\n    }\n  }\n}\nreturn l;\n}\n\nfunction elastic(t) {\n    return Math.pow(2, -10 * t) * Math.sin((t - 0.75) * (Math.PI) / 0.3) + 1;\n}\n\nViewer.prototype.zoomItem = function(name, features, map){\n    features.forEach(function(elem, i, array) {\n        if (elem.get('name') == name){\n            var featureExtent = elem.getGeometry().getExtent();\n            var center = ol.extent.getCenter(featureExtent);\n            map.getView().setZoom( this.minZoom );\n            map.getView().animate({\n                center: [center[0] , center[1]],\n                duration: 2500,\n                easing: elastic,\n            });\n            map.getView().fit(featureExtent, {duration: 2500});\n        } \n    });\n    // TODO \n    // https://openlayersbook.github.io/ch03-charting-the-map-class/example-04.html\n}\n\nfunction create_feature(item){\n    var wktFormat = new ol.format.WKT();\n    var feature = wktFormat.readFeature(item.geometry, {\n            dataProjection: 'EPSG:4326',\n            featureProjection: 'EPSG:3857'\n    });\n    feature.set('name', item.name);\n    return feature;\n}\n\nViewer.prototype.loadItems = function(items){\n    features = [];\n    items.forEach(\n        function(item) {\n            element = create_feature(item);\n            features.push(element);\n    });\n    return features;\n}\n\nViewer.prototype.addGeometryToLayer = function(features, layer, item_name) {\n    var format = new ol.format.GeoJSON();\n    features.forEach(function(elem, i, array) {\n        if (elem.get('name') == item_name){\n            style = new ol.style.Style({\n                stroke: new ol.style.Stroke(\n                    {color : '#f45c42',\n                    width : 2\n                })});\n            elem.setStyle(style);\n        }\n        layer.getSource().addFeature(elem);\n    });\n}\n\nViewer.prototype.getGeometryLayer = function() {\n    return this.geomLayer;\n}\n\nViewer.prototype.loadLayer = function(layer) {\n    this.map.addLayer(layer);\n};\n\nViewer.prototype.centerOnAllFeatures = function(map, layer){\n    map.getView().fit(layer.getSource().getExtent(), map.getSize());\n}\n\nmodule.exports = Viewer;\n\n\n//# sourceURL=webpack:///./src/AppBundle/Resources/js/components/Viewer.js?");

/***/ }),

/***/ "./src/AppBundle/Resources/js/main.js":
/*!********************************************!*\
  !*** ./src/AppBundle/Resources/js/main.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

eval("\nconst Viewer = __webpack_require__(/*! ./components/Viewer */ \"./src/AppBundle/Resources/js/components/Viewer.js\");\n\n\nwindow.gpuSearch = {\n    /**\n     * Initialisation d'un viewer cartographique\n     */\n    loadViewer: function(targetElement, items){\n        var viewer = new Viewer(targetElement);\n        viewer.loadLayer(viewer.getGeometryLayer());\n        features = viewer.loadItems(items);\n      \tviewer.addGeometryToLayer(features, viewer.getGeometryLayer(), '');\n        viewer.centerOnAllFeatures(viewer.getMap(), viewer.getGeometryLayer());\n        return viewer;\n    },\n\n    zoomOnFeature: function(name, viewer){\n    \tviewer.getGeometryLayer().getSource().clear();\n\t    features = viewer.loadItems(items);\n\t    viewer.addGeometryToLayer(features, viewer.getGeometryLayer(), name);\n\t    viewer.zoomItem(name, features, viewer.getMap());\n    }\n}\n\n\n\n//# sourceURL=webpack:///./src/AppBundle/Resources/js/main.js?");

/***/ })

/******/ });