public function driver()
{

      $data['title'] = "Driver";
      $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

      $this->load->model('Driver_model', 'driver');

      $data['driver'] = $this->db->get('driver')->result_array();
      

      $this->form_validation->set_rules('suplier','Driver','required');
      $this->form_validation->set_rules('bank','Bank','required');
      $this->form_validation->set_rules('account','Account','required');
      $this->form_validation->set_rules('city','City','required');
      $this->form_validation->set_rules('branch','Branch','required');

      if ($this->form_validation->run() == false) {
      
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('master/driver', $data);
      $this->load->view('templates/footer');

      } else {

        $this->driver->simpanDriver();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The driver have been Added..</div>');
        redirect('master/driver');

   }
  
  }

  public function getchangeddriver()
  {
    $id = $this->input->post('id');

     $this->load->model('Driver_model', 'driver');

     echo json_encode($data['driver'] = $this->driver->getchangeDriverById($id));
  }

  public function getchangingdriver()
  {
    $this->load->model('Driver_model', 'driver');
    $this->driver->getUpdateDriver();
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The driver have been Changed..</div>');
     redirect('master/driver');
  }


  public function hapusdriver($id)
  {
    $this->load->model('Driver_model', 'driver');
    $this->driver->getHapusDriver($id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The driver have been Deleted..</div>');
     redirect('master/driver');
  }