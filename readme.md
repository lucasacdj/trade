Antes de mais nada crie um novo schema e execute este create table

---

CREATE TABLE `cep` (
	  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `cep` int(11) DEFAULT NULL,
	  `cidade` varchar(45) DEFAULT NULL,
	  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

------------

Para desenvolvimento do projeto foi utilizado o framework Codeigniter 3 junto ao PHP 7.2 e o  banco de dados MYSQL.  Como se trata de um framework é necessário algumas configurações . Primeiro após clonar o projeto informe as credencias de seu banco de dados dentro do do arquivo database.php , application\config\database.php.

```
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'trade',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
```
Só é necessário informar o hostname, username, password e database . Por fim é necessário informar a base_url do projeto essa alteração deve ser feita no arquivo config.php, application\config\config.php,  na linha 26 altere a rota de acordo com seu localhost :porta. 
```
$config['base_url'] = 'http://localhost:8081/trade/';
```
O controller responsável pelas ações do projeto se chama Welcome.php application\controllers\Welcome.php
As views utilizadas foram as listar_cep_cadastrados.php e welcome_message.php (application\views\)

Foram criadas algumas rotas para facilitar o desenvolvimento sendo possível observa-las no arquivo routes.php , application\config\routes.php.
 
```
$route['default_controller'] = 'welcome';
$route['cadastrar_cep'] = 'Welcome/cadastrar_novo_cep';
$route['CEPS'] = 'Welcome/listarCepsCadastrados';
$route['index'] = 'Welcome/index';
// ---------------WEB---------------
$route['endpoint'] = 'Welcome/endpoint';
$route['cadastro_por_lote'] = 'Welcome/cadastro_por_lote';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
```

É possível efetuar o cadastro e a listagem dos ceps de duas maneira a primeira é de maneira convencional acessando a aplicação pelo seu navegador ou por requisições HTTP. A primeira forma é bem simples é apresentado um formulário de cadastros onde é solicitado as informações dos cep e a cidade do mesmo, após o cadastro ter sucesso o usuário é redirecionado a listagem de CEPs cadastrados no sistema. Agora via requisições ,usando umas das  aplicação Insomnia ou Postman crie 3 novos Requests sendo eles :
	
	Cadastrar cep : Este requets é responsável por cadastrar um novo cep sua estrutura é de um POST 
	com a seguinte URL http://localhost:8081/trade/endpoint  e seu Json para envio segue esta estrutura .
	{
		"cep" : 159753,
		"cidade" : "nova cidade"
	}
	
	Recuperar CEPs cadastrados : Este request é responsável por listar todos os ceps cadastrados no sistema 
	sua estrutura é de um GET  com a seguinte URL http://localhost:8081/trade/endpoint . Você recebera um retorno como este ,
	[
		  {
			    "id": "1",
			    "cep": "123456",
			    "cidade": "teste 01"
		  },
		  {
			    "id": "2",
			    "cep": "123456",
			    "cidade": "teste 02"
		  }
	]
	
	Cadastrar CEPs em lote : Foi também disponibilizado a opção de cadastro em lotes  este request é do tipo POST com a seguinte 
	URL http://localhost:8081/trade/cadastro_por_lote já o seu JSON tem a seguinte estrutura .
	[
		  {
			    "cep": "123456",
			    "cidade": "teste 01"
		  },
		
		  {
			    "cep": "123456",
			    "cidade": "teste 02"
		  }
	]
	Vale lembrar que as URL's variam de acordo com a localização de seu projeto .
	

