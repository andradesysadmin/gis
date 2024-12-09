#!/bin/bash

# Utilitário de linha de comando para criar novos usuários

echo "Insira o nome do novo usuário: "; read NOME
echo "Insira o email do novo usuário: "; read EMAIL
echo "Insira a senha: "; read SENHA
echo "Insira a longitude: "; read LON
echo "Insira a latitude: "; read LAT

php ../src/Model/CreateUser.php "$NOME" "$EMAIL" "$SENHA" "$LON" "$LAT"
