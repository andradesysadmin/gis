// Criando o mapas
var map = new ol.Map({
target: 'map',  // Elemento HTML onde o mapa será renderizado
layers: [
    // Camada de fundo (OpenStreetMap)
    new ol.layer.Tile({
        source: new ol.source.OSM()
    }),
    // Camada WMS (GeoServer)
    new ol.layer.Tile({
        source: new ol.source.TileWMS({
            url: 'http://localhost:8080/geoserver/ows',  // URL do seu GeoServer
            params: {
                'LAYERS': 'workspace:nome_da_sua_layer',  // Nome da camada que você criou no GeoServer
                'VERSION': '1.1.1'
            },
            serverType: 'geoserver'
        })
    })
],
view: new ol.View({
    //Usando coordernadas WGS 1984
                                //Long        // Lat
    center: ol.proj.fromLonLat([-56.10190914, -15.64856048]),  // Coordenadas do centro do mapa
    zoom: 12
})
});