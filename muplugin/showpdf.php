<?php
session_start();
if(isset($_GET['actionpdf'])){
    if($_GET['actionpdf'] === 'step2' && isset($_SESSION['tmp_pdf_file'])){
        if(@is_array(getimagesize($_SESSION['tmp_pdf_file']))){
            header('Content-Type:image/jpg');
        } else {
            header('Content-Type:application/pdf');
        }
        
        readfile($_SESSION['tmp_pdf_file']);
        unset($_SESSION['tmp_pdf_file']);
        die();
    }
}