<?php
class daftarBarang extends Model{
    private $daftar = [];

    public function __construct(){
        $this->db = new DB();
        $this->db->connect('mysql', 'localhost', 'root', '',  'mvcapp');
    }

    public function getDataAll(){
        $stmt = "select * from daftarbarang";
        $query = $this->db->quey($stmt);
        $data = [];
        while($result = $this->db->fetch_array($query)){
            $data[] =$result;
        }
        return $data;
    }

    public function getDataById($id){
        $data = [];
        $stmt = "select * from daftarbarang where id = $id";
        $query = $this->db->quey($stmt);
        $data = $this->db->fetch_array($query);

        return $data;
    }

    public function tambahBarang($param){
        $stmt = "insert into daftarbarang (nama, qty) values (:nama,qty)";
        $query = $this->db->query($stmt, $param);

        if($this->db->last_id()>0){
            return true;
        } else {
            return false;
        }
    }

    public function updateBarang($param){
        $stmt = "UPDATE daftarbarang SET nama = :nama, qty = :qty WHERE id = :id";
        $query = $this->db->prepare($stmt);

        $query->bindParam(':nama', $param['nama']);
        $query->bindParam(':qty', $param['qty']);
        $query->bindParam(':id', $param['id']);

        $query->execute();

        if($query->rowCount()>0){
            return true;
        } else {
            return false;
        }
    }

    public function hapusBarang($id){
        $stmt = "DELETE FROM daftarbarang WHERE id = $id";
        $query = $this->db->prepare($stmt);

        $query->bindParam(':id', $id, PDO::PARAM_INT);

        $query->execute();

        if($query->rowCount()>0){
            return true;
        } else {
            return false;
        }
    }
}
