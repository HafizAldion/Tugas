<?php defined('BASEPATH') OR exit('No direct script access allowed');

class produk_model extends CI_Model
{
    // ini adalah variabel yang dibutuhkan dalam modal produk
    private $_table = "produk";
    public $ID;
    public $NAMA;
    public $HARGA_SEWA;
    public $GAMBAR = "default.jpg";
    public $DESKRIPSI;

    // method mengembalikan sebuah array rules(dibutuhkan untuk validasi input)
    public function rules()
    {
        return [
            ['field' => 'NAMA',
            'label' => 'Nama',
            'rules' => 'required'],

            ['field' => 'HARGA_SEWA',
            'label' => 'Harga',
            'rules' => 'numeric'],
            
            ['field' => 'DESKRIPSI',
            'label' => 'Deskripsi',
            'rules' => 'required']
        ];
    }

    // mengambil data dari database
    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["ID" => $id])->row();
    }

    // method untuk menyimpan
    public function save()
    {
        $post = $this->input->post();
        $this->ID = uniqid();
        $this->NAMA = $post["NAMA"];
        $this->HARGA_SEWA = $post["HARGA_SEWA"];
        $this->GAMBAR = $this->_uploadImage();
        $this->DESKRIPSI = $post["DESKRIPSI"];
        return $this->db->insert($this->_table, $this);
    }

    // method untuk edit atau memperbarui
    public function update()
    {
        $post = $this->input->post();
        $this->ID = $post["ID"];
        $this->NAMA = $post["NAMA"];
        $this->HARGA_SEWA = $post["HARGA_SEWA"];

        if (!empty($_FILES["GAMBAR"]["name"])) {
            $this->GAMBAR = $this->_uploadImage();
        } else {
            $this->GAMBAR = $post["old_image"];
        }
        
        $this->DESKRIPSI = $post["DESKRIPSI"];
        return $this->db->update($this->_table, $this, array('ID' => $post['ID']));
    }

    // method untuk hapus
    public function delete($id)
    {
        return $this->db->delete($this->_table, array("ID" => $id));
    }

    // upload file 
    private function _uploadImage()
    {
        $config['upload_path']          = './upload/produk/'; // lokasi file akan terupload
        $config['allowed_types']        = 'gif|jpg|png'; // tipe file yang boleh di upload
        $config['file_name']            = $this->ID; // nama file ambil dari id produk
        $config['overwrite']			= true; // menindih file yang sudah terupload saat di upload file baru
        $config['max_size']             = 1024; // 1MB
        // batas ukuran file(membatasi ukuran lebar dan tinggi agar ukuran gambar sama)
        // $config['max_width']            = 1024; // lebar maksimal
        // $config['max_height']           = 768;  // tinggi maksimal

        $this->load->library('upload', $config); // memanggil libary upload

        // mengembalikan nama file yang sudah terupload, apabila upload gagal maka kembalikan nama menjadi default.jpg
        if ($this->upload->do_upload('GAMBAR')) {
            return $this->upload->data("file_name");
        }
        print_r($this->upload->display_errors());
        return "default.jpg";
    }

    // hapus gambar
    private function _deleteImage($id)
    {
        $produk = $this->getById($id);
            if ($produk->GAMBAR != "default.jpg") {
	            $filename = explode(".", $produk->GAMBAR)[0];
		        return array_map('unlink', glob(FCPATH."upload/produk/$filename.*"));
            }
            print_r($this->upload->display_errors());
    }
}