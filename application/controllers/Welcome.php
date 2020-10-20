<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function __construct() {
		
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
		
		if ($recebeArraySplit[0] != $recebeArraySplit[2] && $recebeArraySplit[1] != $recebeArraySplit[3] 
				&& $recebeArraySplit[2] != $recebeArraySplit[4] && $recebeArraySplit[3] != $recebeArraySplit[5] ) {
			
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

}
