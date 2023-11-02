<?php
class Barang{
    private $id;
    private $nama;
    private $qty;

    public function __construct(){
        $this->id = "B01";
        $this->nama = "Beras";
        $this->qty = "100";
    }

    //mengembalikan informasi data kepada class controller
    public function getData(){
        return "data yang diminta dari model barang : $this->nama, $this->id, $this->qty";
    }

    Public function getDataOne(){
        $data = [
            'id' =>$this->id,
            'nama' =>$this->nama,
            'qty' =>$this->qty,
        ];
        return $data;
    }
}