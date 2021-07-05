<?php
    class CoSoDuLieu {
        public $hostname = "localhost";
        public $username = "root";
        public $password = "" ;
        public $database = "danh_sach_lop";
        public $connect;
    
        public function __construct($hostname,$username,$password,$database,$connect)
        {
            $this->hostname = $hostname;
            $this->username = $username;
            $this->password = $password;
            $this->database = $database;
            $this->connect = $connect;
        }
        public function ket_noi_du_lieu()
        {
            $this->connect = new mysqli($this->hostname, $this->username, $this->password, $this->database);
            if($this->connect->connect_error){
                die("Kết nối thất bại" . $this->connect->connect_error);
            }else{
                echo "Kết nối thành công";
            }
        }
        public function truy_van_du_lieu($query){
            $sql = $query;
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
            $danh_sach = truy_van_du_lieu("SELECT * FROM hoc_sinh ORDER BY id DESC");
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
?>