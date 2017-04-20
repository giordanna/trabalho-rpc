#Trabalho de RPC#
O trabalho consiste em utilizar o [JSON-RPC](https://github.com/fguillot/JsonRPC) para realizar remotamente algumas fun��es no servidor que foram requisitadas por um cliente. O projeto consiste em um site para upload de imagens.

Um computador (Exemplo de seu IP: 192.168.0.13) ficar� respons�vel pela manuten��o de requisi��es do banco de dados do projeto. Este computador mant�m o arquivo server.php, que possui um n�mero de fun��es ligadas a consultas, inser��o e exclus�o de dados.

O outro computador (Exemplo de seu IP: 192.168.0.12) ir� manter o arquivo client.php, que serve como ponte para as fun��es do server.php. Este computador possui os arquivos de layout do site e realiza diversas chamadas remotas para o banco. � importante utilizar o endere�o correto do servidor no arquivo do cliente. Neste caso, foi utilizado http://192.168.0.13:80/server.php.

###Instru��es###

**Para o Servidor:**
1. Em um computador, insira os arquivos na pasta "UpaImagemServidor" na pasta "www" do Wamp;
2. Em httpd-vhosts.conf, modifique o "Require local" para "Require all granted"; 
3. Crie o banco de dados "upaimagem", com nome de usu�rio "giordanna" e senha "88986521";
4. Neste banco de dados, importe os dados do arquivo "upaimagem.sql";
5. Verifique o IP do computador.

**Para o Cliente:**
1. Em um computador, insira os arquivos na pasta "UpaImagemCliente" na pasta "www" do Wamp;
2. Certifique-se que o IP utilizado seja correspondente ao do computador do Servidor. Exemplo:
	"$client = new Client('http://192.168.0.13:80/server.php');"
	
###D�vidas###
Favor ler o .pdf informando as funcionalidades encontradas no trabalho desenvolvido.