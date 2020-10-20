<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{

		parent::__construct();

		$this->load->model('Model_cep');

		$this->load->helper('url');
		$this->load->helper('form');
	}


	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function cadastrar_novo_cep()
	{

		$data = new stdClass();

		$dados = $this->input->post();

		$recebeVerificacao = $this->verificarDigitoRepetitivoAlternado($dados["cep"]);

		if ($recebeVerificacao === TRUE) {

			$dadosDeCadastro = array(
				'cep' => $dados["cep"],
				'cidade' => $dados["cidade"]
			);

			$this->Model_cep->cadastrar_cep($dadosDeCadastro);

			redirect('/welcome/listarCepsCadastrados');
		} else {

			$data->error = 'O CEP informado não segue as diretrizes necessarias !! ';

			$this->load->view('welcome_message', $data);
		}
	}

	public function verificarDigitoRepetitivoAlternado($cep)
	{

		$recebeArraySplit = str_split($cep);

		$verificador = FALSE;

		if (
			$recebeArraySplit[0] != $recebeArraySplit[2] && $recebeArraySplit[1] != $recebeArraySplit[3]
			&& $recebeArraySplit[2] != $recebeArraySplit[4] && $recebeArraySplit[3] != $recebeArraySplit[5]
		) {

			$verificador = TRUE;
		}

		return $verificador;
	}

	public function listarCepsCadastrados()
	{
		$recebeListaDeCeps = $this->Model_cep->listar_cep_cadastrados();

		$dados = array(
			'info_cep' => $recebeListaDeCeps,
		);

		$this->load->view('listar_cep_cadastrados', $dados);
	}

	public function web()
	{
		$recuperaMetodo = $_SERVER['REQUEST_METHOD'];

		$body =  file_get_contents("php://input");

		$json = json_decode($body);

		if ($recuperaMetodo == "POST") {

			$recebeVerificacao = $this->verificarDigitoRepetitivoAlternado($json->cep);

			if ($recebeVerificacao === TRUE) {

				$dadosDeCadastro = array(
					'cep' => $json->cep,
					'cidade' => $json->cidade
				);

				$this->Model_cep->cadastrar_cep($dadosDeCadastro);

			} else {
				
				$response = array('status' => 'Erro, o CEP informado não segue as diretrizes necessarias !!');

				$this->output
				->set_status_header(500)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
				
				exit;
			}
		}

		if ($recuperaMetodo == "GET") {

			$recebeListaDeCeps = $this->Model_cep->listar_cep_cadastrados();
			
			$recebeJson = $this->converteArrayEmJson($recebeListaDeCeps);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($recebeJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
				
				exit;
		}

	}

	public function converteArrayEmJson($array)
	{
		
		$arrayJson = NULL;

		for ($contador = 0; $contador < count($array); $contador++) { 
			
			$arrayJson[$contador] = array(
				'id' => $array[$contador]->id,
				'cep' => $array[$contador]->cep, 
				'cidade' => $array[$contador]->cidade
			);
		}
	
		return json_encode($arrayJson);

	}
}
