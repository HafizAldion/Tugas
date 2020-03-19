<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class produk extends CI_Controller
{
    // method load model(produk_model) dan libary(form_validation)
    public function __construct()
    {
        parent::__construct();
        $this->load->model("produk_model");
        $this->load->library('form_validation');
        // memerlukan login untuk mengakses halaman ini
        $this->load->model("user_model");
        if($this->user_model->isNotLogin()) redirect(site_url('admin/login'));
    }

    // mengambil data dari model dan menggil methode getAll
    public function index()
    {
        $data["produk"] = $this->produk_model->getAll(); // ambil data dari model
        $this->load->view("admin/produk/list", $data); // kirim data ke view
    }

    // method menampilkan form add dan menyimpan ke database
    public function add()
    {
        $produk = $this->produk_model;
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());

        if ($validation->run()) {
            $produk->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/produk/new_form");
    }

    // menampilkan method form untuk edit dan menyimpan ke database 
    public function edit($id = null)
    {
        if (!isset($id)) redirect('admin/produk');
       
        $produk = $this->produk_model;
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());

        if ($validation->run()) {
            $produk->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["produk"] = $produk->getById($id);
        if (!$data["produk"]) show_404();
        
        $this->load->view("admin/produk/edit_form", $data);
    }

    // menampilkan method form untuk hapus data database
    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->produk_model->delete($id)) {
            redirect(site_url('admin/produk'));
        }
    }
}