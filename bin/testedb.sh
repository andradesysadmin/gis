#!/bin/bash

# Cetifique-se que o script tenha permissão x

if command -v php > /dev/null 2>&1; then
    php ../src/Model/TesteDatabase.php

    if [ $? -eq 0 ]; then
        echo "BANCO CONECTADO COM SUCESSO!";
        exit 0
    else
        echo "ERRO AO CONECTAR AO BANCO DE DADOS!";
        exit 1
    fi
else
    echo "PHP não está instalado ou não está no PATH!";
    exit 1
fi