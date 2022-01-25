<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{


    public function __construct()
    {

        parent::__construct();
        $this->load->model('data_saldo');
        $this->load->model('data_pengeluaran');
        $this->load->model('data_user');
        $this->load->model('data_alat');
        $this->load->model('data_pinjam');
        $this->load->model('option');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {

        $data['user'] = $this->db->get_where('user', ['npm' =>
            $this->session->userdata('npm')])->row_array();
        $wher = array('id' => '1');
        $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();
        if (isset($data['user']['role_id']) == 1) {
            $this->pagelab();
        } else {
            $this->load->view('admin/login', $data);
        }
    }

    public function login()
    {

        $this->form_validation->set_rules('npm', 'NPM', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $wher = array('id' => '1');
        $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();

        if ($this->form_validation->run() == false) {

            $this->load->view('admin/login', $data);
        } else {

            $this->_login();
        }
    }

    private function _login()
    {

        $npm = $this->input->post('npm');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['npm' => $npm])->row_array();

        if ($user) {

            if ($user['is_active'] == 1) {

                if ($user['role_id'] == 1) {

                    if (password_verify($password, $user['password'])) {

                        $data = [
                            'npm' => $user['npm'],
                            'role_id' => $user['role_id']
                        ];

                        $this->session->set_userdata($data);
                        redirect('admin');
                    } else {

                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                        redirect('admin/login');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Maaf, Anda Bukan Admin!</div>');
                    redirect('admin/login');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">NPM tersebut belum diaktifkan!</div>');
                redirect('admin/login');
            }
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NPM tersebut belum terdaftar!</div>');
            redirect('admin/login');
        }
    }


    //PINJAM======================================================

    public function page()
    {


        $data['user'] = $this->db->get_where('user', ['npm' =>
            $this->session->userdata('npm')])->row_array();
        if ($data['user']['role_id'] == '1') {
            $where = array('jumlah!=' => 0);
            $data['alat'] = $this->data_alat->edit_alat($where, 'alat')->result();
            $d['pinjam'] = $this->data_pinjam->datapinjam()->result();

            $wher = array('id' => '1');
            $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();

            $data['maktif'] = 'pinjam';

            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/pinjam/pinjam', $d + $data);
            $this->load->view('admin/include/footer');
        } else {
            redirect('admin/login');
        }
    }

    public function pinjam_edit($id)
    {

        $where = array('id' => $id);
        $data['pinjam'] = $this->data_pinjam->edit_pinjam($where, 'pinjam')->result();
        $wher = array('id' => '1');
        $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();

        $data['maktif'] = 'pinjam';

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/pinjam/pinjamedit', $data);
        $this->load->view('admin/include/footer');
    }

    function pinjamupdate()
    {
        $id = $this->input->post('id');
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');
        $tujuan = $this->input->post('tujuan');
        $kondisi = $this->input->post('kondisi');
        $tgl_pinjam = $this->input->post('tgl_pinjam');
        $tgl_kembali = $this->input->post('tgl_kembali');
        $jaminan = $this->input->post('jaminan');


        $data = array(
            'nim' => $nim,
            'nama' => $nama,
            'tujuan' => $tujuan,
            'kondisi' => $kondisi,
            'tgl_pinjam' => $tgl_pinjam,
            'tgl_kembali' => $tgl_kembali,
            'jaminan' => $jaminan
        );

        $where = array(
            'id' => $id
        );

        $this->data_pinjam->update_pinjam($where, $data, 'pinjam');
        redirect('admin/page');
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

        redirect('admin/page');
    }


    function pinjam_hapus($id)
    {

        $wheres = array('id' => $id);
        $this->data_pinjam->hapus_pinjam($wheres, 'pinjam');
        redirect('admin/page');
    }


    public function pinjam_daftar()
    {
        $where = array('nama_alat' => htmlspecialchars($this->input->post('nama_alat', true)));
        $datas['alat'] = $this->data_alat->edit_alat($where, 'alat')->result();
        foreach ($datas['alat'] as $u) {
            $jenis = $u->jenis;
        }
        if($jenis=='Habis'){
            $prosess='Selesai';
            $kembalis= date("Y-m-d");

        }else{
            $prosess='Belum Selesai';
            $kembalis='';
        }

        $data = [

            'nim' => htmlspecialchars($this->input->post('nim', true)),
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'tujuan' => htmlspecialchars($this->input->post('tujuan', true)),
            'nama_alat' => htmlspecialchars($this->input->post('nama_alat', true)),
            'kondisi' => htmlspecialchars($this->input->post('kondisi', true)),
            'jumlah_alat' => htmlspecialchars($this->input->post('jumlah_alat', true)),
            'tgl_pinjam' => htmlspecialchars($this->input->post('tgl_pinjam', true)),
            'tgl_kembali' => $kembalis,
            'jaminan' => htmlspecialchars($this->input->post('jaminan', true)),
            'proses' => $prosess
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
        redirect('admin/page');
    }

    function pinjam_print()
    {
        $this->load->view('admin/fpdf/fpdf');
        $this->load->view('admin/pinjam/pinjam-print');
    }


    //GUNAKAN LAB======================================================

    public function pagelab()
    {
        $data['user'] = $this->db->get_where('user', ['npm' =>
            $this->session->userdata('npm')])->row_array();
        if ($data['user']['role_id'] == '1') {
            $where = array('status' => 'Kosong');
            $data['ruang'] = $this->data_alat->edit_alat($where, 'ruang_lab')->result();
            $where = array('role_id' => '2');
            $data['dosen'] = $this->data_alat->edit_alat($where, 'user')->result();
            // $where = array('role_id !=' => '1');
            // $data['users'] = $this->data_alat->edit_alat($where, 'user')->result();
            $data['lab'] = $this->data_pinjam->datapinjam2('jadwal_lab')->result();

            $data['npm'] = $this->session->userdata('npm');
            $data['user'] = $this->data_alat->edit_alat($where, 'user')->result();

            $wher = array('id' => '1');
            $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();

            $data['maktif'] = 'lab';

            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/lab/lab', $data);
            $this->load->view('admin/include/footer');
        } else {
            redirect('admin/login');
        }
    }

    public function lab_edit($id)
    {

        $where = array('id' => $id);
        $data['pinjam'] = $this->data_pinjam->edit_pinjam($where, 'pinjam')->result();
        $wher = array('id' => '1');
        $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();

        $data['maktif'] = 'lab';

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/pinjam/pinjamedit', $data);
        $this->load->view('admin/include/footer');
    }

    function labupdate()
    {
        $id = $this->input->post('id');
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');
        $tujuan = $this->input->post('tujuan');
        $kondisi = $this->input->post('kondisi');
        $tgl_pinjam = $this->input->post('tgl_pinjam');
        $tgl_kembali = $this->input->post('tgl_kembali');
        $jaminan = $this->input->post('jaminan');


        $data = array(
            'nim' => $nim,
            'nama' => $nama,
            'tujuan' => $tujuan,
            'kondisi' => $kondisi,
            'tgl_pinjam' => $tgl_pinjam,
            'tgl_kembali' => $tgl_kembali,
            'jaminan' => $jaminan
        );

        $where = array(
            'id' => $id
        );

        $this->data_pinjam->update_pinjam($where, $data, 'pinjam');
        redirect('admin');
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

        redirect('admin');
    }


    function lab_hapus($id)
    {

        $wheres = array('id' => $id);
        $this->data_pinjam->hapus_pinjam($wheres, 'jadwal_lab');
        redirect('admin');
    }


    public function lab_daftar()
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
        redirect('admin');
    }

    function lab_print()
    {
        $this->load->view('admin/fpdf/fpdf');
        $this->load->view('admin/lab/lab-print');
    }


    //ALAT========================================================

    public function alat()
    {


        $data['user'] = $this->db->get_where('user', ['npm' =>
            $this->session->userdata('npm')])->row_array();
        if ($data['user']['role_id'] == '1') {
            $d['alat'] = $this->data_alat->dataalat()->result();
            $wher = array('id' => '1');
            $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();

            $data['maktif'] = 'alat';

            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/alat/alat', $d);
            $this->load->view('admin/include/footer');
        } else {
            redirect('admin/login');
        }
    }

    public function alat_edit($id)
    {

        $where = array('id' => $id);
        $data['alat'] = $this->data_alat->edit_alat($where, 'alat')->result();
        $wher = array('id' => '1');
        $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();

        $data['maktif'] = 'alat';

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/alat/alatedit', $data);
        $this->load->view('admin/include/footer');
    }

    function alatupdate()
    {
        $id = $this->input->post('id');
        $nama_alat = $this->input->post('nama_alat');
        $jumlah = $this->input->post('jumlah');
        $jenis = $this->input->post('jenis');

        $data = array(
            'nama_alat' => $nama_alat,
            'jumlah' => $jumlah,
            'jenis' => $jenis
        );

        $where = array(
            'id' => $id
        );

        $this->data_alat->update_alat($where, $data, 'alat');
        redirect('admin/alat');
    }


    function alat_hapus($id)
    {
        $where = array('id' => $id);
        $this->data_alat->hapus_alat($where, 'alat');
        redirect('admin/alat');
    }


    public function alat_daftar()
    {

        $data = [

            'nama_alat' => htmlspecialchars($this->input->post('nama_alat', true)),
            'jumlah' => htmlspecialchars($this->input->post('jumlah', true)),
            'jenis' => htmlspecialchars($this->input->post('jenis', true))
        ];

        $this->db->insert('alat', $data);
        redirect('admin/alat');
    }

    function alat_print()
    {
        $this->load->view('admin/fpdf/fpdf');
        $this->load->view('admin/alat/alat-print');
    }


    //RUANGAN========================================================

    public function ruangan()
    {


        $data['user'] = $this->db->get_where('user', ['npm' =>
            $this->session->userdata('npm')])->row_array();
        if ($data['user']['role_id'] == '1') {
            $d['ruang'] = $this->data_alat->dataruang()->result();
            $wher = array('id' => '1');
            $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();

            $data['maktif'] = 'ruangan';

            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/ruang/ruang', $d);
            $this->load->view('admin/include/footer');
        } else {
            redirect('admin/login');
        }
    }

    public function ruang_edit($id_lab)
    {

        $where = array('id_lab' => $id_lab);
        $data['ruang'] = $this->data_alat->edit_alat($where, 'ruang_lab')->result();
        $wher = array('id' => '1');
        $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();

        $data['maktif'] = 'ruangan';

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/ruang/ruangedit', $data);
        $this->load->view('admin/include/footer');
    }

    function ruangupdate()
    {
        $id_lab = $this->input->post('id_lab');
        $nama_lab = $this->input->post('nama_lab');
        $status = $this->input->post('status');

        $data = array(
            'nama_lab' => $nama_lab,
            'status' => $status
        );

        $where = array(
            'id_lab' => $id_lab
        );

        $this->data_alat->update_alat($where, $data, 'ruang_lab');
        redirect('admin/ruangan');
    }


    function ruang_hapus($id_lab)
    {
        $where = array('id_lab' => $id_lab);
        $this->data_alat->hapus_alat($where, 'ruang_lab');
        redirect('admin/ruangan');
    }


    public function ruang_daftar()
    {

        $data = [

            'nama_lab' => htmlspecialchars($this->input->post('nama_lab', true)),
            'status' => 'Kosong'
        ];

        $this->db->insert('ruang_lab', $data);
        redirect('admin/ruangan');
    }

    function ruang_print()
    {
        $this->load->view('admin/fpdf/fpdf');
        $this->load->view('admin/ruang/ruang-print');
    }


    //USER====================================================

    public function user()
    {

        $data['user'] = $this->db->get_where('user', ['npm' =>
            $this->session->userdata('npm')])->row_array();
        $wher = array('id' => '1');
        $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();
        if ($data['user']['role_id'] == '1') {
            $d['users'] = $this->data_user->datauser()->result();

            $data['maktif'] = 'user';

            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/user/user', $d);
            $this->load->view('admin/include/footer');
        } else {
            redirect('admin/login');
        }
    }

    public function user_edit($id)
    {

        $where = array('id' => $id);
        $data['user'] = $this->data_user->edit_user($where, 'user')->result();
        $wher = array('id' => '1');
        $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();

        $data['maktif'] = 'user';

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/user/useredit', $data);
        $this->load->view('admin/include/footer');
    }

    function userupdate()
    {
        $id = $this->input->post('id');
        $npm = $this->input->post('npm');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $role_id = $this->input->post('role_id');
        $hp = $this->input->post('hp');
        $is_active = $this->input->post('is_active');

        $data = array(
            'npm' => $npm,
            'name' => $name,
            'email' => $email,
            'hp' => $hp,
            'is_active' => $is_active,
            'role_id' => $role_id
        );

        $where = array(
            'id' => $id
        );

        $this->data_user->update_user($where, $data, 'user');
        redirect('admin/user');
    }


    function user_hapus($id)
    {
        $where = array('id' => $id);
        $this->data_user->hapus_user($where, 'user');
        redirect('admin/user');
    }


    public function user_daftar()
    {

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
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'hp' => htmlspecialchars($this->input->post('phone', true)),
            'qrlog' => $ranpass,
            'role_id' => htmlspecialchars($this->input->post('level', true)),
            'is_active' => 1
        ];



        $this->db->insert('user', $data);
        redirect('admin/user');
    }

    function user_print()
    {
        $this->load->view('admin/fpdf/fpdf');
        $this->load->view('admin/user/user-print');
    }


    //KEUANGAN====================================================

    public function saldo_masuk()
    {

        $data['user'] = $this->db->get_where('user', ['npm' =>
            $this->session->userdata('npm')])->row_array();
        $wher = array('id' => '1');
        $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();
        if ($data['user']['role_id'] == '1') {
            $d['saldo'] = $this->data_saldo->datasaldo()->result();
            $d['saldosekarang'] = $this->data_saldo->saldo_terkini()->result();

            $data['maktif'] = 'saldom';

            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/keuangan/saldo-masuk', $d);
            $this->load->view('admin/include/footer');
        } else {
            redirect('admin/login');
        }
    }

    public function saldo_edit($id)
    {

        $where = array('id' => $id);
        $data['saldo'] = $this->data_saldo->edit_saldo($where, 'saldo')->result();
        $wher = array('id' => '1');
        $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();

        $data['maktif'] = 'saldom';

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/keuangan/saldo-edit', $data);
        $this->load->view('admin/include/footer');
    }

    function saldo_update()
    {
        $id = $this->input->post('id');
        $tanggal = $this->input->post('tanggal');
        $saldo = $this->input->post('saldo');
        $ket = $this->input->post('ket');


        $where = array('id' => $id);
        $saldoq = $this->data_saldo->edit_saldo($where, 'saldo')->result();
        $wheres = array('id' => '1');
        $total_saldoq = $this->data_saldo->edit_saldo_terkini($wheres)->result();

        foreach ($total_saldoq as $totsal) {
            $saldo_sekarang = $totsal->saldo_terkini;
        }

        foreach ($saldoq as $sal) {
            $saldo_masuk_terbaru = $sal->saldo_masuk;
        }

        $total_saldo_sementara = $saldo_sekarang - $saldo_masuk_terbaru;
        $total_saldo = $total_saldo_sementara + $saldo;

        $config['upload_path']  = './assets/img/saldo/';
        $config['allowed_types']  = 'jpg|jpeg|png|PNG';
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('bukti')) {
            $data = array(
                'tanggal' => $tanggal,
                'saldo_masuk' => $saldo,
                'ket' => $ket
            );

            $where = array(
                'id' => $id
            );

            $data2 = array(
                'saldo_terkini' => $total_saldo
            );

            $where2 = array(
                'id' => '1'
            );

            $this->data_saldo->update_saldo_terkini($where2, $data2);

            $this->data_saldo->update_saldo($where, $data, 'saldo');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Saldo Berhasil Diperbaharui!</div>');
            redirect('admin/saldo_masuk');
        } else {

            $bukti = $this->upload->data();
            $bukti = $bukti['file_name'];

            $data = array(
                'tanggal' => $tanggal,
                'saldo_masuk' => $saldo,
                'ket' => $ket,
                'bukti_saldo' => $bukti
            );

            $where = array(
                'id' => $id
            );

            $data2 = array(
                'saldo_terkini' => $total_saldo
            );

            $where2 = array(
                'id' => '1'
            );

            $this->data_saldo->update_saldo_terkini($where2, $data2);

            $this->data_saldo->update_saldo($where, $data, 'saldo');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Saldo Berhasil Diperbaharui!</div>');
            redirect('admin/saldo_masuk');
        }


    }


    function saldo_hapus($id)
    {

        $where = array('id' => $id);
        $saldoq = $this->data_saldo->edit_saldo($where, 'saldo')->result();
        $wheres = array('id' => '1');
        $total_saldoq = $this->data_saldo->edit_saldo_terkini($wheres)->result();

        foreach ($total_saldoq as $totsal) {
            $saldo_sekarang = $totsal->saldo_terkini;
        }

        foreach ($saldoq as $sal) {
            $saldo_masuk_terbaru = $sal->saldo_masuk;
        }

        $total_saldo = $saldo_sekarang - $saldo_masuk_terbaru;

        $data2 = array(
            'saldo_terkini' => $total_saldo
        );

        $where2 = array(
            'id' => '1'
        );

        $this->data_saldo->update_saldo_terkini($where2, $data2);

        $where = array('id' => $id);
        $this->data_user->hapus_user($where, 'saldo');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Saldo Berhasil Dihapus!</div>');
        redirect('admin/saldo_masuk');
    }


    public function saldo_tambah()
    {

        $config['upload_path']  = './assets/img/saldo/';
        $config['allowed_types']  = 'jpg|jpeg|png|PNG';
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('bukti')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Saldo gagal ditambahakan karena gagal mengunggah bukti!</div>');
            redirect('admin/saldo_masuk');
        } else {
            date_default_timezone_set("Asia/Makassar");
            $tanggal = date("Y-m-d");
            $bukti = $this->upload->data();
            $bukti = $bukti['file_name'];

            $sal = $this->data_saldo->saldo_terkini()->result();
            foreach ($sal as $s) {
                $terkini = $s->saldo_terkini;
            }

            $total_saldo = $this->input->post('saldo')+$terkini;

            $data = [
                'tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
                'saldo_masuk' => htmlspecialchars($this->input->post('saldo', true)),
                'ket' => htmlspecialchars($this->input->post('ket', true)),
                'bukti_saldo' => $bukti
            ];

            $data2 = array(
                'saldo_terkini' => $total_saldo
            );

            $where2 = array(
                'id' => '1'
            );

            $this->data_saldo->update_saldo_terkini($where2, $data2);

            $this->db->insert('saldo', $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Saldo Berhasil Ditambahkan!</div>');
            redirect('admin/saldo_masuk');
        }
    }

    function saldo_print()
    {
        $this->load->view('admin/fpdf/fpdf');
        $this->load->view('admin/keuangan/saldo-print');
    }




    public function pengeluaran()
    {

        $data['user'] = $this->db->get_where('user', ['npm' =>
            $this->session->userdata('npm')])->row_array();
        $wher = array('id' => '1');
        $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();
        if ($data['user']['role_id'] == '1') {
            $d['pengeluaran'] = $this->data_pengeluaran->datapengeluaran()->result();

            $data['maktif'] = 'saldok';

            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/keuangan/pengeluaran', $d);
            $this->load->view('admin/include/footer');
        } else {
            redirect('admin/login');
        }
    }

    public function pengeluaran_edit($id)
    {

        $where = array('id' => $id);
        $data['pengeluaran'] = $this->data_saldo->edit_saldo($where, 'pengeluaran')->result();
        $wher = array('id' => '1');
        $data['option'] = $this->data_pinjam->edit_pinjam($wher, 'option')->result();

        $data['maktif'] = 'saldok';

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/keuangan/pengeluaran-edit', $data);
        $this->load->view('admin/include/footer');
    }

    function pengeluaran_update()
    {
        $id = $this->input->post('id');
        $tanggal = $this->input->post('tanggal');
        $uraian = $this->input->post('uraian');
        $tipe = $this->input->post('tipe');
        $volume = $this->input->post('volume');
        $satuan = $this->input->post('satuan');
        $harga = $this->input->post('harga');

        $config['upload_path']  = './assets/img/pengeluaran/';
        $config['allowed_types']  = 'jpg|jpeg|png|PNG';
        $this->load->library('upload', $config);

        $kredit = $volume*$harga;

        $where = array('id' => $id);
        $pengeluaranq = $this->data_pengeluaran->edit_pengeluaran($where, 'pengeluaran')->result();
        $wheres = array('id' => '1');
        $total_saldoq = $this->data_saldo->edit_saldo_terkini($wheres)->result();

        foreach ($total_saldoq as $totsal) {
            $saldo_sekarang = $totsal->saldo_terkini;
        }

        foreach ($pengeluaranq as $peng) {
            $kredit_data = $peng->kredit;
        }

        $total_saldo_sementara = $saldo_sekarang + $kredit_data;
        $total_saldo = $total_saldo_sementara - $kredit;

        $data2 = array(
            'saldo_terkini' => $total_saldo
        );

        $where2 = array(
            'id' => '1'
        );

        $this->data_saldo->update_saldo_terkini($where2, $data2);

        if ( ! $this->upload->do_upload('bukti')) {


            $data = array(
                'tanggal' => $tanggal,
                'uraian' => $uraian,
                'tipe' => $tipe,
                'volume' => $volume,
                'satuan' => $satuan,
                'harga' => $harga,
                'kredit' => $kredit
            );

            $where = array(
                'id' => $id
            );

            $this->data_pengeluaran->update_pengeluaran($where, $data, 'pengeluaran');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Pengeluaran Berhasil Diperbaharui!</div>');
            redirect('admin/pengeluaran');
        } else {

            $bukti = $this->upload->data();
            $bukti = $bukti['file_name'];

            $data = array(
                'tanggal' => $tanggal,
                'uraian' => $uraian,
                'tipe' => $tipe,
                'volume' => $volume,
                'satuan' => $satuan,
                'harga' => $harga,
                'kredit' => $kredit,
                'bukti' => $bukti
            );

            $where = array(
                'id' => $id
            );

            $this->data_pengeluaran->update_pengeluaran($where, $data, 'pengeluaran');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Pengeluaran Berhasil Diperbaharui!</div>');
            redirect('admin/pengeluaran');
        }


    }


    function pengeluaran_hapus($id)
    {

        $where = array('id' => $id);
        $pengeluaranq = $this->data_pengeluaran->edit_pengeluaran($where, 'pengeluaran')->result();
        $wheres = array('id' => '1');
        $total_saldoq = $this->data_saldo->edit_saldo_terkini($wheres)->result();

        foreach ($total_saldoq as $totsal) {
            $saldo_sekarang = $totsal->saldo_terkini;
        }

        foreach ($pengeluaranq as $peng) {
            $kredit_data = $peng->kredit;
        }

        $total_saldo = $saldo_sekarang + $kredit_data;

        $data2 = array(
            'saldo_terkini' => $total_saldo
        );

        $where2 = array(
            'id' => '1'
        );

        $this->data_saldo->update_saldo_terkini($where2, $data2);
        $where = array('id' => $id);
        $this->data_pengeluaran->hapus_pengeluaran($where, 'pengeluaran');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Saldo Berhasil Dihapus!</div>');
        redirect('admin/pengeluaran');
    }


    public function pengeluaran_tambah()
    {

        $config['upload_path']  = './assets/img/pengeluaran/';
        $config['allowed_types']  = 'jpg|jpeg|png|PNG';
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('bukti')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Saldo gagal ditambahakan karena gagal mengunggah bukti!</div>');
            redirect('admin/pengeluaran');
        } else {
            date_default_timezone_set("Asia/Makassar");
            $tanggal = date("Y-m-d");
            $bukti = $this->upload->data();
            $bukti = $bukti['file_name'];

            $kredit = $this->input->post('volume')*$this->input->post('harga');

            $data = [
                'tanggal' => htmlspecialchars($this->input->post('tanggal', true)),
                'uraian' => htmlspecialchars($this->input->post('uraian', true)),
                'tipe' => htmlspecialchars($this->input->post('tipe', true)),
                'volume' => htmlspecialchars($this->input->post('volume', true)),
                'satuan' => htmlspecialchars($this->input->post('satuan', true)),
                'harga' => htmlspecialchars($this->input->post('harga', true)),
                'kredit' => $kredit,
                'bukti' => $bukti
            ];

            $this->db->insert('pengeluaran', $data);


            $wheres = array('id' => '1');
            $total_saldoq = $this->data_saldo->edit_saldo_terkini($wheres)->result();

            foreach ($total_saldoq as $totsal) {
                $saldo_sekarang = $totsal->saldo_terkini;
            }

            $total_saldo = $saldo_sekarang - $kredit;

            $data2 = array(
                'saldo_terkini' => $total_saldo
            );

            $where2 = array(
                'id' => '1'
            );

            $this->data_saldo->update_saldo_terkini($where2, $data2);


            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Pengeluaran Berhasil Ditambahkan!</div>');
            redirect('admin/pengeluaran');
        }
    }

    function pengeluaran_print()
    {
        $this->load->view('admin/fpdf/fpdf');
        $this->load->view('admin/keuangan/pengeluaran-print');
    }




    //Option===========================================================

    public function option()
    {
        $where = array('id' => '1');
        $data['option'] = $this->option->edit($where, 'option')->result();

        $data['maktif'] = 'option1';

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/option/option', $data);
        $this->load->view('admin/include/footer');
    }

    public function gantilogo()
    {
        $where = array('id' => '1');
        $data['option'] = $this->option->edit($where, 'option')->result();
        $data['title'] = 'Ganti Logo ';

        $this->load->view('include/header', $data);
        $this->load->view('admin/option/logo', $data);
    }

    public function savelogo()
    {
        $folderPath = './assets/img/';

        $image_parts = explode(";base64,", $_POST['image']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . 'logo.png';

        file_put_contents($file, $image_base64);

        echo json_encode(["Logo Berhasil Diganti."]);
    }

    public function saveicon()
    {

        $folderPath = './assets/img/';

        $image_parts = explode(";base64,", $_POST['image']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . 'icon.png';

        file_put_contents($file, $image_base64);

        echo json_encode(["Icon Berhasil Diganti."]);

    }

    public function gantiicon()
    {
        $where = array('id' => '1');
        $data['option'] = $this->option->edit($where, 'option')->result();
        $data['title'] = 'Ganti Icon ';

        $this->load->view('include/header', $data);
        $this->load->view('admin/option/icon', $data);
    }

    function optionupdate()
    {
        $nama = $this->input->post('nama');
        $deskripsi = $this->input->post('deskripsi');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $email = $this->input->post('email');

        $data = array(
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'alamat' => $alamat,
            'telp' => $telp,
            'email' => $email
        );

        $where = array(
            'id' => '1'
        );

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diperbaharui</div>');

        $this->option->update($where, $data, 'option');
        redirect('admin/option');
    }


    //Option Laporan===========================================================

    public function option_laporan()
    {
        $where = array('id' => '1');
        $data['option'] = $this->option->edit($where, 'option')->result();
        $data['laporan'] = $this->option->edit($where, 'option_laporan')->result();

        $data['maktif'] = 'option2';

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/option/option-laporan', $data);
        $this->load->view('admin/include/footer');
    }

    function olaporanupdate()
    {
        $header1 = $this->input->post('header1');
        $header2 = $this->input->post('header2');
        $alamat = $this->input->post('alamat');
        $telp = $this->input->post('telp');
        $situs = $this->input->post('situs');
        $email = $this->input->post('email');
        $kota = $this->input->post('kota');
        $an = $this->input->post('an');
        $nama = $this->input->post('nama');
        $nip = $this->input->post('nip');

        $data = array(
            'header1' => $header1,
            'header2' => $header2,
            'alamat' => $alamat,
            'telp' => $telp,
            'situs' => $situs,
            'email' => $email,
            'kota' => $kota,
            'an' => $an,
            'nama' => $nama,
            'nip' => $nip
        );

        $where = array(
            'id' => '1'
        );

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Diperbaharui</div>');

        $this->option->update($where, $data, 'option_laporan');
        redirect('admin/option_laporan');
    }


    //Logout===========================================================


    public function logout()
    {

        $this->session->unset_userdata('npm');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda Berhasil Keluar!</div>');
        redirect('admin/login');
    }





    function saldohapus($id)
    {
        $where = array('id' => $id);
        $this->data_user->hapus_user($where, 'saldo_terkini');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Saldo Berhasil Dihapus!</div>');
        redirect('admin/pengeluaran');
    }
}
