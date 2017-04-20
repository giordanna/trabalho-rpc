# Trabalho de RPC #
O trabalho consiste em utilizar o [JSON-RPC](https://github.com/fguillot/JsonRPC) para realizar remotamente algumas funções no servidor que foram requisitadas por um cliente. O projeto consiste em um site para upload de imagens.

Um computador (Exemplo de seu IP: `192.168.0.13`) ficará responsável pela manutenção de requisições do banco de dados do projeto. Este computador mantém o arquivo server.php, que possui um número de funções ligadas a consultas, inserção e exclusão de dados.

O outro computador (Exemplo de seu IP: `192.168.0.12`) irá manter o arquivo client.php, que serve como ponte para as funções do server.php. Este computador possui os arquivos de layout do site e realiza diversas chamadas remotas para o banco. É importante utilizar o endereço correto do servidor no arquivo do cliente. Neste caso, foi utilizado `http://192.168.0.13:80/server.php`.

### Instruções ###

**Para o Servidor:**
1. Em um computador, insira os arquivos na pasta "UpaImagemServidor" na pasta "www" do Wamp;
2. Em `httpd-vhosts.conf`, modifique o "Require local" para "Require all granted"; 
3. Crie o banco de dados "upaimagem", com nome de usuário `giordanna` e senha `88986521`;
4. Neste banco de dados, importe os dados do arquivo upaimagem.sql;
5. Verifique o IP do computador.

**Para o Cliente:**
1. Em um computador, insira os arquivos na pasta "UpaImagemCliente" na pasta "www" do Wamp;
2. Certifique-se que o IP utilizado seja correspondente ao do computador do Servidor. Exemplo:
```php
$client = new Client('http://192.168.0.13:80/server.php');
```
	
### Dúvidas ###
Favor ler o .pdf informando as funcionalidades encontradas no trabalho desenvolvido.
