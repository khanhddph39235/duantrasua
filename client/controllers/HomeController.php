<?php 

class HomeController
{
    public $modelsanpham;
    public function __construct()
    {
        $this-> modelsanpham =  new sanpham();
    }
    public function home(){
        echo "Welcome";
    }
    public function TrangChu(){
        echo "Trang Chu";
    }
    public function dsSp(){
        // echo "Danh Sach San Pham";
        $listProduct = $this->modelsanpham->getAllProduct();
        // var_dump($listProduct);die();
        require_once 'views/listProduct.php';
    }
    

}