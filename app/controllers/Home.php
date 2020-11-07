<?php 

class Home extends Controller {
    public function index (){
        //penggunaan templates header dan footer
        $data['judul'] = 'Home';
        $data['nama'] = $this->model('User_model')->getUser();

        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}

?>