<?php
class AdminDanhMucController {
    public $modelDanhMuc;
    public function __construct()
    {
        $this -> modelDanhMuc = new AdminDanhMuc();
    }
    public function danhSachDanhMuc(){
        $listDanhMuc = $this -> modelDanhMuc->getAllDanhMuc();
        require_once './views/danhmuc/listDanhMuc.php';
        
    }
    public function formAddDanhMuc(){
        //hiển thị form nhập
        require_once './views/danhmuc/addDanhMuc.php';

    }
    public function postAddDanhMuc(){
        //hàm này dùng để xử lý thêm dữ liệu
        // var_dump($_POST);
        // kiểm tra xem dữ liệu có được submit lên không
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //lấy dữ liệu từ forrm
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            // tạo mảng trống để chứa dữ liệu
            $errors= [];
            if (empty($ten_danh_muc)){
                $errors ['ten_danh_muc']='ten danh mục k được để trống';
            }
            // nếu k có lỗi thì tiêns hành thêm
            if(empty($errors)){
                //thêm dữ liệu vào csdl
                // var_dump("oke");
                $this->modelDanhMuc->insertDanhMuc($ten_danh_muc, $mo_ta);
                header("Location: ". BASE_URL_ADMIN. '?act=danh-muc');
                exit();
            }else{
                //hiển thị lại form với các thông báo l��i
                require_once './views/danhmuc/addDanhMuc.php';
            }
        }


        
    }
    public function formEditDanhMuc(){
        //hiển thị form nhập
        //lấy ra thông tin danh mục cần sửa 
        $id=$_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if ($danhMuc) {
            require_once './views/danhmuc/editDanhMuc.php';
        }else {
            header("Location: ". BASE_URL_ADMIN. '?act=danh-muc');
                exit();

        }

    }
    public function postEditDanhMuc(){
        //hàm này dùng để xử lý thêm dữ liệu
        // var_dump($_POST);
        // kiểm tra xem dữ liệu có được submit lên không
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //lấy dữ liệu từ forrm
            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            // tạo mảng trống để chứa dữ liệu
            $errors= [];
            if (empty($ten_danh_muc)){
                $errors ['ten_danh_muc']='ten danh mục k được để trống';
            }
            // nếu k có lỗi thì tiêns hành sửa 
            if(empty($errors)){
                //thêm dữ liệu vào csdl
                // var_dump("oke");
                $this->modelDanhMuc->updateDanhMuc($id,$ten_danh_muc, $mo_ta);
                header("Location: ". BASE_URL_ADMIN. '?act=danh-muc');
                exit();
            }else{
                //hiển thị lại form với các thông báo l��i
                $danhMuc  = ['id' => $id, 'ten_danh_muc' => $ten_danh_muc, 'mo_ta' => $mo_ta];
                require_once './views/danhmuc/editDanhMuc.php';
            }
        }   
    }
    public function deleteDanhMuc(){
        $id =  $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if($danhMuc){
            $this ->modelDanhMuc->destroyDanhMuc($id); 
        }
        header("Location: ". BASE_URL_ADMIN. '?act=danh-muc');
        exit();
    }
}