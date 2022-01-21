<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('data_pinjam');
        $this->load->model('data_alat');
        $this->load->model('data_lab');
    }

    public function index()
    {
        date_default_timezone_set('Asia/Makassar');

        $date = new DateTime("now");

        $curr_date = $date->format('Y-m-d');

        // $whel1 = array('ruang' => 'Lab 1', 'DATE(tanggal)' => $curr_date, 'status' => 'Digunakan');
        // $whel2 = array('ruang' => 'Lab 2', 'DATE(tanggal)' => $curr_date, 'status' => 'Digunakan');
        // $whel3 = array('ruang' => 'Lab 3', 'DATE(tanggal)' => $curr_date, 'status' => 'Digunakan');
        // $whel4 = array('ruang' => 'Lab 4', 'DATE(tanggal)' => $curr_date, 'status' => 'Digunakan');
        // $whel5 = array('ruang' => 'Lab 5', 'DATE(tanggal)' => $curr_date, 'status' => 'Digunakan');
        // $whel6 = array('ruang' => 'Lab 6', 'DATE(tanggal)' => $curr_date, 'status' => 'Digunakan');

        // $data['lab1'] = $this->data_lab->lab1($whel1, 'jadwal_lab')->result();
        // $data['lab2'] = $this->data_lab->lab2($whel2, 'jadwal_lab')->result();
        // $data['lab3'] = $this->data_lab->lab3($whel3, 'jadwal_lab')->result();
        // $data['lab4'] = $this->data_lab->lab4($whel4, 'jadwal_lab')->result();
        // $data['lab5'] = $this->data_lab->lab5($whel5, 'jadwal_lab')->result();
        // $data['lab6'] = $this->data_lab->lab6($whel6, 'jadwal_lab')->result();

        $data['ruang'] = $this->data_lab->ruang()->result();


        $where = array('proses' => 'Belum Selesai');
        $wher = array('id' => '1');
        $data['pinjam'] = $this->data_pinjam->edit_pinjam($where, 'pinjam')->result();
        $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();

        $data['title'] = 'Selamat Datang Di Aplikasi Peminjaman Alat ';
        $this->load->view('include/header', $data);
        $this->load->view('include/styles');
        $this->load->view('auth/index');
        $this->load->view('include/footer');
    }

    function kosongkan($id)
    {


        $where = array('id' => $id);
        $data['lab'] = $this->data_pinjam->edit_pinjam($where, 'jadwal_lab')->result();

        foreach ($data['lab'] as $u) {
            $nama_lab = $u->ruang;
        }

        
        $data1 = array(
            'status' => 'Kosong'
        );

        $data2 = array(
            'status' => 'Selesai'
        );

        $where1 = array(
            'nama_lab' => $nama_lab
        );

        $where2 = array('id' => $id);

        $this->data_pinjam->kembalikan($where2, $data2, 'jadwal_lab');

        $this->data_pinjam->kembalikan($where1, $data1, 'ruang_lab');
        
        redirect('auth/pinjam');
    }

    public function pinjam()
    {
        $data['user'] = $this->db->get_where('user', ['npm' =>
            $this->session->userdata('npm')])->row_array();
        if(isset($data['user']['role_id'])){
            if ($data['user']['role_id'] == 1) {
                redirect('admin');
            }else if ($data['user']['role_id'] == 2 OR 3) {
                $wheres = array('npm' => $this->session->userdata('npm'));
                $data['user'] = $this->data_pinjam->edit_pinjam($wheres, 'user')->result();

                $where = array('jumlah !=' => 0);
                $data['alat'] = $this->data_alat->edit_alat($where, 'alat')->result();

                $where = array('status' => 'Kosong');
                $data['ruang'] = $this->data_alat->edit_alat($where, 'ruang_lab')->result();

                $where = array('role_id' => '2');
                $data['dosen'] = $this->data_alat->edit_alat($where, 'user')->result();

                $where = array('nim' => $this->session->userdata('npm'));
                $data['pinjam'] = $this->data_pinjam->edit_pinjam($where, 'pinjam')->result();

                $where = array('npm' => $this->session->userdata('npm'));
                $data['gunakan'] = $this->data_pinjam->edit_pinjam($where, 'jadwal_lab')->result();

                $data['title'] = 'Halaman Peminjaman Alat | ';
                $wher = array('id' => '1');
                $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();
                $this->load->view('user/include/header', $data);
                $this->load->view('user/include/styles');
                $this->load->view('user/alat');
                $this->load->view('user/include/footer');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda harus login untuk melanjutkan!</div>');
            redirect('auth/index_login');
        }

    }

    function kembalikan($id)
    {
        $where = array('id' => $id);
        date_default_timezone_set("Asia/Makassar");
        $baru = date("Y-m-d");
        $data = array(
            'tgl_kembali' => $baru,
            'proses' => 'Selesai'
        );

        $this->data_pinjam->kembalikan($where, $data, 'pinjam');

        $where = array('id' => $id);
        $data['pinjam'] = $this->data_pinjam->edit_pinjam($where, 'pinjam')->result();
        foreach ($data['pinjam'] as $u) {
            $nama_alat = $u->nama_alat;
            $jumlah_alat = $u->jumlah_alat;
        }



        $where = array('nama_alat' => $nama_alat);
        $datas['alat'] = $this->data_alat->edit_alat($where, 'alat')->result();
        foreach ($datas['alat'] as $u) {
            $hasil = $u->jumlah;
            $jenis = $u->jenis;
        }
        $data1 = array(
            'jumlah' => $hasil + $jumlah_alat
        );

        $where = array(
            'nama_alat' => $nama_alat
        );

        if ($jenis == 'Tidak Habis') {
            $this->data_alat->update_alat($where, $data1, 'alat');
        } else {
        }

        redirect('auth/pinjam');
    }


    public function pinjam_daftar()
    {
        $nm_alat = $this->input->post('nama_alat', true);
        $where = array('nama_alat' => $nm_alat);
        $data['alat'] = $this->data_alat->edit_alat($where, 'alat')->result();

        $jenis_alat = $data['alat']['jenis'];

        if ($jenis_alat == 'Habis'){
            $pros = 'Selesai';
        }else{
            $pros = 'Belum Selesai';
        }

        $data = [

            'nim' => htmlspecialchars($this->input->post('nim', true)),
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'tujuan' => htmlspecialchars($this->input->post('tujuan', true)),
            'nama_alat' => htmlspecialchars($this->input->post('nama_alat', true)),
            'kondisi' => htmlspecialchars($this->input->post('kondisi', true)),
            'jumlah_alat' => htmlspecialchars($this->input->post('jumlah_alat', true)),
            'tgl_pinjam' => htmlspecialchars($this->input->post('tgl_pinjam', true)),
            'jaminan' => htmlspecialchars($this->input->post('jaminan', true)),
            'proses' => $pros
        ];
        $nama_alat = htmlspecialchars($this->input->post('nama_alat', true));
        $jumlah_alat = htmlspecialchars($this->input->post('jumlah_alat', true));

        $where = array('nama_alat' => $nama_alat);
        $datas['alat'] = $this->data_alat->edit_alat($where, 'alat')->result();
        foreach ($datas['alat'] as $u) {
            $hasil = $u->jumlah;
        }
        $data1 = array(
            'jumlah' => $hasil - $jumlah_alat
        );

        $where = array(
            'nama_alat' => $nama_alat
        );

        $this->data_alat->update_alat($where, $data1, 'alat');
        $this->db->insert('pinjam', $data);
        redirect('auth/pinjam');
    }

    public function gunakan_daftar()
    {
        $data = [

            'npm' => htmlspecialchars($this->input->post('npm', true)),
            'nama_matkul' => htmlspecialchars($this->input->post('nama_matkul', true)),
            'hari' => htmlspecialchars($this->input->post('hari', true)),
            'tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
            'jam_awal' => htmlspecialchars($this->input->post('jam_awal', true)),
            'jam_akhir' => htmlspecialchars($this->input->post('jam_akhir', true)),
            'ruang' => htmlspecialchars($this->input->post('ruang', true)),
            'dosen_pengampu' => htmlspecialchars($this->input->post('dosen_pengampu', true)),
            'status' => 'Digunakan'
        ];
        $ruang = htmlspecialchars($this->input->post('ruang', true));

        $where = array('nama_lab' => $ruang);
        $datas['raung'] = $this->data_alat->edit_alat($where, 'ruang_lab')->result();
        foreach ($datas['ruang'] as $u) {
            $hasil = $u->nama_lab;
        }
        $data1 = array(
            'status' => 'Digunakan'
        );

        $where = array(
            'nama_lab' => $ruang
        );

        $this->data_alat->update_alat($where, $data1, 'ruang_lab');
        $this->db->insert('jadwal_lab', $data);
        redirect('auth/pinjam');
    }

    public function index_login()
    {

        $this->form_validation->set_rules('npm', 'NPM', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        $data['user'] = $this->db->get_where('user', ['npm' =>
            $this->session->userdata('npm')])->row_array();
        $level = isset($data['user']['role_id']);
        if ($level != NULL) {
            redirect('auth/pinjam');
        } else {
            if ($this->form_validation->run() == false) {

                $data['title'] = 'Halaman Login | ';
                $wher = array('id' => '1');
                $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/login');
                $this->load->view('templates/auth_footer');
            } else {

                $this->_login();
            }
        }        
    }

    private function _login()
    {

        $npm = $this->input->post('npm');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['npm' => $npm])->row_array();

        if ($user) {

            if ($user['is_active'] == 1) {

                if (password_verify($password, $user['password'])) {

                    $data = [
                        'npm' => $user['npm'],
                        'role_id' => $user['role_id']
                    ];
                    if ($user['role_id'] == 1) {
                        $this->session->set_userdata($data);
                        redirect('admin');
                    }
                    else{
                        $this->session->set_userdata($data);
                        redirect('auth/pinjam');
                    }


                } else {

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                    redirect('auth/index_login');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">NPM tersebut belum diaktifkan!</div>');
                redirect('auth/index_login');
            }
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NPM tersebut belum terdaftar!</div>');
            redirect('auth/index_login');
        }
    }

    //Login via QR Code===============================================

    public function qrlogin()
    {
        $qrdata =  $this->input->post('code');
        // $arr = explode('|', $qrdata);
        // $npm = $arr[1];
        // $qrlog = $arr[2];    

        $user = $this->db->get_where('user', ['qrlog' => $qrdata])->row_array();

        if ($user) {

            if ($user['is_active'] == 1) {

                if ($user['qrlog'] == $qrdata) {

                    $data = [
                        'npm' => $user['npm'],
                        'role_id' => $user['role_id']
                    ];
                    if ($user['role_id'] == 1) {
                        $this->session->set_userdata($data);
                        redirect('admin');
                    }
                    else{
                        $this->session->set_userdata($data);
                        redirect('auth/pinjam');
                    }


                } else {

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">QR Code Tidak Benar!</div>');
                    redirect('auth/index_login');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">NPM tersebut belum diaktifkan!</div>');
                redirect('auth/index_login');
            }
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NPM tersebut belum terdaftar!</div>');
            redirect('auth/index_login');
        }
    }


    // Register=====================================================

    public function registration()
    {
        //pesan error
        $this->form_validation->set_rules('npm', 'NPM', 'required|trim|is_unique[user.npm]|min_length[10]|max_length[10]', [
            'required' => 'NPM tidak boleh kosong',
            'min_length' => 'NPM adalah 10 angka',
            'max_length' => 'NPM adalah 10 angka',
            'is_unique' => 'NPM sudah terdaftar'
        ]);
        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Nama Lengkap tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email tidak boleh kosong',
            'is_unique' => 'Email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Min. 3 Karakter',
            'matches' => 'Password Tidak Sama'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]', [
            'required' => 'Password tidak boleh kosong',
            'matches' => 'Password Tidak Sama'
        ]);
        $this->form_validation->set_rules('phone', 'Nomor HP', 'required|trim|min_length[10]|max_length[12]', [
            'required' => 'Nomor HP tidak boleh kosong',
            'min_length' => 'Nomor HP Minimal 10 angka',
            'max_length' => 'Nomor HP Maksimal 12 angka'
        ]);

        //kondisi
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Pendaftaran | ';
            $wher = array('id' => '1');
            $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {

            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $password = array(); 
            $alpha_length = strlen($alphabet) - 1; 
            for ($i = 0; $i < 10; $i++) 
            {
                $n = rand(0, $alpha_length);
                $password[] = $alphabet[$n];
            }
            $ranpass = implode($password); 

            $nim = htmlspecialchars($this->input->post('npm', true));


         $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/img/qr/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name=$nim.'.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $ranpass; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $data = [

            'npm' => htmlspecialchars($this->input->post('npm', true)),
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'foto' => 'default.jpg',
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'hp' => htmlspecialchars($this->input->post('phone', true)),
            'qrlog' => $ranpass,
            'role_id' => htmlspecialchars($this->input->post('role_id', true)),
            'is_active' => 0
        ];

        $this->db->insert('user', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat, Anda Berhasil Mendaftar! Silahkan Menunggu Sampai Akun Anda Aktif Untuk Login!</div>');
        redirect('auth/index_login');
    }
}

public function logout()
{

    $this->session->unset_userdata('npm');
    $this->session->unset_userdata('role_id');

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda Berhasil Keluar!</div>');
    redirect('auth');
}
}
