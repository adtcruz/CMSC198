<?php
class Home extends Controller {

 function Pagination_Controller(){
  parent::Controller();
  $this->load->model('pagination_model');
  $this->load->library('pagination');
 }
 public function index($offset=0){
  
  $config['total_rows'] = $this->pagination_model->totalJR();
  
  $config['base_url'] = base_url()."index.php/pagination_controller";
  $config['per_page'] = 5;
  $config['uri_segment'] = '2';

  $config['full_tag_open'] = '<div class="pagination"><ul>';
  $config['full_tag_close'] = '</ul></div>';

  $config['first_link'] = '« First';
  $config['first_tag_open'] = '<li class="prev page">';
  $config['first_tag_close'] = '</li>';

  $config['last_link'] = 'Last »';
  $config['last_tag_open'] = '<li class="next page">';
  $config['last_tag_close'] = '</li>';

  $config['next_link'] = 'Next →';
  $config['next_tag_open'] = '<li class="next page">';
  $config['next_tag_close'] = '</li>';

  $config['prev_link'] = '← Previous';
  $config['prev_tag_open'] = '<li class="prev page">';
  $config['prev_tag_close'] = '</li>';

  $config['cur_tag_open'] = '<li class="active"><a href="">';
  $config['cur_tag_close'] = '</a></li>';

  $config['num_tag_open'] = '<li class="page">';
  $config['num_tag_close'] = '</li>';


  $this->pagination->initialize($config);
   

  $query = $this->pagination_model->getJR(5,$this->uri->segment(2));
  
  $data['JR'] = null;
  
  if($query){
   $data['JR'] =  $query;
  }

  $this->load->view('pagination_view.php', $data);
 }
}
?>