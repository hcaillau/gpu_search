
const Viewer = require('./components/Viewer');


window.gpuSearch = {
    /**
     * Initialisation d'un viewer cartographique
     */
    loadViewer: function(targetElement, items){
        var viewer = new Viewer(targetElement);
        viewer.loadLayer(viewer.getGeometryLayer());
        features = viewer.loadItems(items);
      	viewer.addGeometryToLayer(features, viewer.getGeometryLayer(), '');
        viewer.centerOnAllFeatures(viewer.getMap(), viewer.getGeometryLayer());
        return viewer;
    },

    zoomOnFeature: function(name, viewer){
    	viewer.getGeometryLayer().getSource().clear();
	    features = viewer.loadItems(items);
	    viewer.addGeometryToLayer(features, viewer.getGeometryLayer(), name);
	    viewer.zoomItem(name, features, viewer.getMap());
    }
}

