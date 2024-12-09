<?php

//logica de teste
$host = 'localhost';
$dbname = 'postgres';
$username = 'postgres';
$password = 'postgres';
try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
    exit;
}

// coordenadas padrão de nova york
$long = -73.96807654663033;
$lat = 40.78910044668983;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $stmt = $conn->prepare('SELECT lon, lat FROM "user" WHERE email = :email AND senha = :senha');
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $long = $row['lon'];
        $lat = $row['lat'];
    } else {
        echo "Credenciais inválidas. Verifique seu email e senha.";
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIS</title>
    <script src="https://cdn.jsdelivr.net/npm/ol@latest/dist/ol.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@latest/dist/ol.css" />
    <link rel="stylesheet" href="./src/public/css/index.css" />
</head>
<body>

<div id="map" style="width: 50%; height: 500px">
    <h2>Mapa com OpenLayers e GeoServer</h2>
</div>

<?php if ($long !== null && $lat !== null): ?>
    <script>
        // Pegando as coordenadas do PHP e passando para o JavaScript
        var longitude = <?php echo json_encode($long); ?>;
        var latitude = <?php echo json_encode($lat); ?>;

        // Criando o mapa
        var map = new ol.Map({
            target: 'map',  // Elemento HTML onde o mapa será renderizado
            layers: [
                new ol.layer.Tile({
                    source: new ol.source.OSM()
                }),
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
                center: ol.proj.fromLonLat([longitude, latitude]),  // Coordenadas do centro do mapa
                zoom: 12
            })
        });
    </script>
<?php endif; ?>

<div class="dashboard">
    <h2>Consulta</h2>
    <hr><br>

    <form action="" method="post">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" required>
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Enviar</button>
    </form>
</div>

</body>
</html>
