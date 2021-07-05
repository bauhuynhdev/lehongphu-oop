<?php
class CoSoDuLieu {
    private $hostname;
    public $username = "root";
    public $password = "" ;
    public $database = "danh_sach_lop";
    public $connect;
    private $version = 1;
    public $total = 10;

    public function setHostname($hostname) {
        if ($hostname !== 'localhost') {
            $hostname = 'localhost';
        }
        $this->hostname = $hostname;
    }

    public function getVersion() {
        return $this->version;
    }

    // public function __construct($hostname,$username,$password,$database)
    // {
    //     $this->hostname = $hostname;
    //     $this->username = $username;
    //     $this->password = $password;
    //     $this->database = $database;
    // }
    public function ket_noi_du_lieu()
    {
        $this->connect = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        if($this->connect->connect_error){
            die("Kết nối thất bại" . $this->connect->connect_error);
        }else{
            echo "Kết nối thành công";
        }
    }
    protected function truy_van_du_lieu($sql){
        $this->ket_noi_du_lieu();
        $ket_qua = $this->connect->query($sql);
        $danh_sach = [];
        if (!empty($ket_qua->num_rows) && $ket_qua->num_rows > 0) {
            while ($row = $ket_qua->fetch_assoc()) {
                array_push($danh_sach, $row);
            }
            mysqli_close($this->connect);
            return $danh_sach;
        }
    }
}

class ChucNang extends CoSoDuLieu {
    public function lay_danh_sach(){
        $danh_sach = $this->truy_van_du_lieu("SELECT * FROM hoc_sinh ORDER BY id DESC");
        return $danh_sach;
    }
    public function xoa_du_lieu($id){
        truy_van_du_lieu("DELETE FROM hoc_sinh WHERE id='" . $id . "' ");
    }
    public function them_du_lieu($du_lieu){
        truy_van_du_lieu("INSERT INTO hoc_sinh(ho, ten, lop) VALUES('{$du_lieu['ho']}','{$du_lieu['ten']}','{$du_lieu['lop']}')");
    }
    public function cap_nhat_du_lieu($id,$du_lieu){
        truy_van_du_lieu("UPDATE hoc_sinh SET ho = '{$du_lieu['ho']}', ten = '{$du_lieu['ten']}', lop = '{$du_lieu['lop']}' WHERE id ={$id}");
    }
}

$chuc_nang = new ChucNang();

// $chuc_nang->hostname = 123;
$chuc_nang->setHostname(123);
$data = $chuc_nang->lay_danh_sach();
var_dump($data);
?>