#/bin/bash

sudo docker-compose up -d
cd bin/
chmod +x *
# testa conexão do banco
sudo ./testdb.sh
# criadno as tabelas no banco
sudo ./createtables.sh
# cria usuario de teste
php ../src/Model/CreateUser.php "gabriel" "gandradecortez50@gmail.com" "gabriel" -74.0060 40.7128
#iniciar servidor php
php -S localhost:80 