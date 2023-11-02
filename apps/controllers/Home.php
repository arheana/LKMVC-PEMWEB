<?php

require "Controller.php";

class Home extends Controller{
    private $dt;
    private $df;

    public function __construct(){
        //berisi objek
        $this->dt = $this->loadmodel("barang");
        $this->df = $this->loadmodel("daftarBarang");
    }

    //fungsi action default
    public function index(){
        echo "anda memanggil action index \n";
    }

    public function home($data1, $data2){
        echo "anda memanggil action home dengan data1= $data1 dan data2 = $data2 \n";
    } 

    public function lihatdata($id){
        $data = $this->df->getDataById($id);

        $this->loadview('templates/header', ['title'=>'Detail Barang']);
        $this->loadview('home/detailbarang', $data);
        $this->loadview('templates/footer');
    }

    public function listbarang(){
        $data = $this->df->getDataAll();

        $this->loadview('templates/header', ['title'=>'List Barang']);
        $this->loadview('home/listbarang', $data);
        $this->loadview('templates/footer');
    }

    public function insertbarang(){
        if(!empty($_POST)){
            if ($this->df->tambahBarang($_POST)){
                header('Location: ' . BASE_URL . 'index.php?r=home/listbarang');
                exit;
            }
        }

        $this->loadview('templates/header', ['title'=>'Insert Barang']);
        $this->loadview('home/insert');
        $this->loadview('templates/footer');
    }

    public function updatebarang($id){
        $data = $this->df->getDataById($id);

        if(!empty($_POST)){
            if ($this->df->updateBarang($_POST)){
                header('Location: ' . BASE_URL . 'index.php?r=home/listbarang');
                exit;
            }
        }

        $this->loadview('templates/header', ['title'=>'Update Barang']);
        $this->loadview('home/update', $data);
        $this->loadview('templates/footer');
    }

    public function deletebarang($id){
        $data = $this->df->getDataById($id);

        if ($this->df->updateBarang($id)){
            header('Location: ' . BASE_URL . 'index.php?r=home/listbarang');
            exit;
        }
    }
}