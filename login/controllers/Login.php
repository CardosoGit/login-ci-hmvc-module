<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Controller Class do Módulo de Login com HMVC
class Login extends MX_Controller
{
    //Seta os nomes dos models
    public $model = 'login_model';
    public $apelido = 'login';

    function __construct()
    {
        parent::__construct();
        //Carrega o model conrespondente
        $this->load->model($this->model, $this->apelido);
        # VERIFICA SE O USU�RIO ESTÁ LOGADO
        ($this->{$this->apelido}->validar() ? redirect(base_url("admin")) : redirect(base_url("login")));
    }

    function index()
    {
        //chama a view login
        $this->load->view('login');
    }

    // Método executado após o submit do formulário de login
    public function logar()
    {
        //Rerifica se o campos foram digitados
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required');
        //Seta layout da msg de erro
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            //Mensagem de erro
            $msg = '<div class="alert alert-danger">
                             <i class="fa fa-check"></i>  Preencha todos os campo!
                            </div>';
            //Seta a msg de erro em uma sessão
            $this->session->set_flashdata('msg', $msg);
            //Redireciona para tela de login
            redirect(base_url("login"));
        } else {
            // VERIFICA LOGIN E SENHA
            if ($this->{$this->apelido}->validar()) {
                //Se os dados de login estiverem corretos, entra no sistema
                redirect(base_url("admin"));
            } else {
                //Mensagem de erro
                $msg = '<div class="alert alert-danger">
                             <i class="fa fa-check"></i>  E-mail e/ou Senha inválida.
                            </div>';
                //Seta a msg de erro em uma sessão
                $this->session->set_flashdata('msg', $msg);
                //Redireciona para tela de login
                redirect(base_url("login"));
            }
        }
    }

    public function logout()
    {
        // Destroi a sessão do login
        $this->session->sess_destroy();
        //Redireciona para tela de login
        redirect(base_url("login"), 'refresh');
    }
}

/* End of file Login.php */
/* Location: ./application/modules/login/controllers/Login.php */