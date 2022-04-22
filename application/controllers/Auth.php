<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
  }

  public function index()
  {

    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Login Page';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/login');
      $this->load->view('templates/auth_footer');
    } else {
      $this->_login();
    }
  }

  private function _login()
  {
    $email = $this->input->post('email');
    $password = $this->input->post('password');

    $this->db->select('user.*, departement.nama, departement.kode_loc');
    $this->db->from('user');
    $this->db->join('departement ', 'user.hub = departement.id_departement');
    $this->db->where('email', $email);
    $user = $this->db->get()->row_array();
    //usernya ada
    if ($user) {
      //jika usernya aktif
      if ($user['is_active'] == 1) {
        //cek password
        if (password_verify($password, $user['password'])) {
          $data = [
            'iduser' => $user['id'],
            'bagian_id' => $user['bagian_id'],
            'email' => $user['email'],
            'role_id' => $user['role_id'],
            'hub' => $user['hub'],
            'dc' => $user['nama'],
            'kodeloc' => $user['kode_loc']
          ];
         /* var_dump($data);
          die;*/
          $this->session->set_userdata($data);
          // admin
          if ($user['role_id'] == 1) {
            redirect('admin');
            // finance
          } elseif ($user['role_id'] == 2) {
            redirect('transaksi');
            // purchasing
          } elseif ($user['role_id'] == 3) {
            redirect('purchasing');
            // head
          } elseif ($user['role_id'] == 4) {
            redirect('approval');
            // ekspedisi
          } elseif ($user['role_id'] == 5) {
            redirect('ekspedisi');
            //maintenance
          }elseif ($user['role_id'] == 6) {
             redirect('maintenance');
          }elseif ($user['role_id']== 7){
              redirect('inventory');
        } elseif ($user['role_id']== 8) {
            redirect('hrd');

        } elseif ($user['role_id']== 9) {
            redirect('bd');

        }
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          Wrong password!..
          </div>');
          redirect('auth');
        }
      } else {

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          This Email has not been activated
          </div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          This Email is not registered!..
          </div>');
      redirect('auth');
    }
  }

  public function registration()
  {
    // mnllogistik190420
    if ($this->session->userdata('email')) {
      redirect('user');
    }

    $this->db->where('left(nama,2)', "DC");
    $data['dept'] = $this->db->get('departement')->result();

    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [

      'is_unique' => 'This email has already registered!'
    ]);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [

      'matches' => 'Password dont match!',
      'min_length' => 'Password Too Short!'

    ]);
    $this->form_validation->set_rules('password2', 'Name', 'required|trim|matches[password1]');

    if ($this->form_validation->run() == false) {

      $data['title'] = 'User Registration';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/registration', $data);
      $this->load->view('templates/auth_footer');
    } else {

      $email = $this->input->post('email', true);

      $data = [

        'name' => htmlspecialchars($this->input->post('name', true)),
        'email' => htmlspecialchars($email),
        'image' => 'default.jpg',
        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'role_id' => 2,
        'is_active' => 0,
        'hub' => $this->input->post('hub', TRUE),
        'date_created' => time()
      ];

      // siapkan token

      $token = base64_encode(random_bytes(32));
      $user_token = [
        'email' => $email,
        'token' => $token,
        'date_created' => time()
      ];

      $this->db->insert('user', $data);
      $this->db->insert('user_token',  $user_token);

      $this->_sendEmail($token, 'verify');

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Selamat!.. Akun Kamu Sudah Dibuat!. Mohon Aktifasi Akun.
          </div>');
      redirect('auth');
    }
  }

  private function _sendEmail($token, $type)
  {

    // $this->load->library('email');
    // $config = array();
    // $config['protocol'] = 'smtp';
    // $config['smtp_host'] = 'ssl://smtp.googlemail.com';
    // $config['smtp_user'] = 'mnl.logistik@gmail.com';
    // $config['smtp_pass'] = 'mnllogistik190420';
    // $config['smtp_port'] = 465;
    // $config['mailtype'] = 'html';
    // $config['charset'] = 'utf-8';
    // $this->email->initialize($config);
    // $this->email->set_newline("\r\n");

    $config = [

      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_user' => 'mnl.logistik@gmail.com',
      'smtp_pass' => 'mnllogistik190420',
      'smtp_port' => 465,
      'mailtype' => 'html',
      'charset' => 'utf-8',
      'newline' => "\r\n"
    ];

    $this->load->library('email', $config);
    $this->email->initialize($config);  //tambahkan baris ini

    $this->email->from('mnl.logistik@gmail.com', 'Matahari Nusantara Logistik');
    $this->email->to($this->input->post('email'));

    if ($type == 'verify') {
      $this->email->subject('Verifikasi Akun');
      $this->email->message('klik link ini untuk verifikasi akun kamu : <a
          href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktifasi</a>');
    }

    if ($this->email->send()) {
      return true;
    } else {
      echo $this->email->print_debuger();
      die;
    }
  }

  public function verify()
  {
    $email = $this->input->get('email');
    $token = $this->input->get('token');


    $user = $this->db->get_where('user', ['email' => $email])->row_array();

    if ($user) {

      $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

      if ($user_token) {
        if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
          $this->db->set('is_active', 1);
          $this->db->where('email', $email);
          $this->db->update('user');

          $this->db->delete('user_token', ['email' => $email]);

          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $email . ' sudah di aktifkan!. Silahkan Login!.
       </div>');

          redirect('auth');
        } else {

          $this->db->delete('user', ['email' => $email]);
          $this->db->delete('user_token', ['email' => $email]);
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token expired!..
       </div>');

          redirect('auth');
        }
      } else {

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Token tidak cocok!..
       </div>');

        redirect('auth');
      }
    } else {

      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun Verifikasi Gagal! Email Salah.
       </div>');

      redirect('auth');
    }
  }
  public function logout()
  {
    $this->session->unset_userdata('email');
    $this->session->unset_userdata('role_id');
    $this->session->unset_userdata('hub');
    $this->session->unset_userdata('dc');
    $this->session->unset_userdata('kodeloc');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> You have been logged out!
     </div>');
    redirect('auth');
  }


  public function blocked()
  {
    $this->load->view('auth/blocked');
  }
}
