#!/bin/bash

if command -v php > /dev/null 2>&1; then

    for i in $(ls ../src/Model/migrations/); do
        php ../src/Model/migrations/$i
        if [ $? -eq 0 ]; then
            echo "TABELA USER CRIADA!";
            exit 0
        else
            echo "ERRO AO CRIAR TABELA $i";
            exit 1
        fi
    done
else
    echo "PHP não está instalado ou não está no PATH!";
    exit 1
fi