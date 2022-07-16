<?php 
include '../Config/koneksi.php';
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM pengguna WHERE email = '$email' AND password = '$password'";
    $query = mysqli_query($koneksi,$sql);
    $row = mysqli_fetch_array($query);
    if($row['email'] == $email && $row['password'] == $password){
        if($row['role'] == '0'){
            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            header("Location:".admin());
        }elseif($row['role'] == '1'){
            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            header("Location:../Admin/user/profile");
        }
    }else{      
        session_start();
        $_SESSION['error'] = '<div class="alert alert-danger">Email atau Password Salah</div>';
        header('location:'.login());
    }
    
}elseif(isset($_POST['daftar'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "INSERT INTO pengguna (email,password) VALUES ($email,$password)";
    $query = mysqli_query($koneksi,$sql);
    if($query){
        header('location:'.login());
    }else{
    header('location:'.admin());
    }
}elseif(isset($_GET['logout'])){
    session_start();
    session_destroy();
    header('location:index.php');
}else{
    header('location:'.login());
}

?>