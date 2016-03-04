<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Model Class do Módulo de Login com HMVC
class Login_model extends CI_Model
{
    // Nome da tabela na variável $tb1
    public $tb1 = "usuarios";

    function validar()
    {
        //Pega os dados do formulário de login
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');
        //Ferifica se existe um usuário com esse e-mail
        $this->db->where('emailUser', $email);
        $query = $this->db->get($this->tb1);
        if ($query->num_rows() == 1) {
            //Pega a senha do banco de dados
            $pw = self::pegarUsuario($email);
            //Verifica senha passando a senha do banco de dados e a senha digitada pelo usuário
            if (Bcrypt::check($senha, $pw->senhaUser)) {
                //pega o dados do usuário
                $dados = $this->detalhes($email);
                $data = array(
                    'idUser' => $dados->idUser,
                    'nomeUser' => $dados->nomeUser,
                    'emailUser' => $dados->emailUser,
                    'loggedUser' => true
                );
                //Seta os dados na sessão de login
                $this->session->set_userdata($data);
                return TRUE; // RETORNA VERDADEIRO
            }
            return FALSE;// RETORNA VERDADEIRO
        }

        return FALSE;// RETORNA VERDADEIRO

    }

    //Método para pegar a senha para comparação
    function pegarUsuario($email)
    {
        //Pega a senha de acordo com o email enviado pelo parametro
        $this->db->where('emailUser', $email);
        $usuarios = $this->db->get($this->tb1)->result();
        //Se encontrar, retorna a senha
        if ($usuarios->num_rows() == 1) {
            foreach ($usuarios as $usuario) {
                $this->idUser = $usuario->idUser;
                $this->nomeUser = $usuario->nomeUser;
                $this->emailUser = $usuario->emailUser;
                $this->senhaUser = $usuario->senhaUser;
            }
            return $this;
        }
    }

    # VERIFICA SE O USUÁRIO ESTÁ LOGADO
    function logado()
    {
        $logged = $this->session->userdata('loggedUser');
        if (!isset($logged) || $logged != true) {
            return FALSE;
        }
        return TRUE;
    }


}

/* End of file Login_model.php */
/* Location: ./application/modules/login/models/Login_model.php */