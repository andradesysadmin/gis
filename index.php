<?php $long = $_POST['long']; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIS</title>
    <!--baixando o OpenLayers-->
    <script src="https://cdn.jsdelivr.net/npm/ol@latest/dist/ol.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@latest/dist/ol.css" />
    <link rel="stylesheet" href="./app/public/css/index.css" />    
</head>
<body>
    
    <div id="map" style="width: 50%; height: 500px">
    <h2>Mapa com OpenLayers e GeoServer</h2>
    </div>
    <?php 
        $long = $_POST['long'];
        $lat = $_POST['lat'];
    ?>
    <script>
        // Pegando as coordenadas do PHP e passando para o JavaScript
        var longitude = <?php echo json_encode($long); ?>;
        var latitude = <?php echo json_encode($lat); ?>;

        // Criando o mapa
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
                // Usando as coordenadas passadas via PHP
                center: ol.proj.fromLonLat([longitude, latitude]),  // Coordenadas do centro do mapa
                zoom: 12
            })
        });
        console.log(<?php echo json_encode($long); ?>);
        console.log(<?php echo json_encode($lat); ?>);
    </script>
    <div class="dashboard">
        <h2>Consulta</h2>
        <hr><br>
        <form action="" method="post">
            <label for="">Longitude:</label>
            <input type="text" name="long" id="">
            <label for="">Latitude:</label>
            <input type="text" name="lat" id="">
            <button>Enviar</button>
        </form>
    </div>
</body>
</html>