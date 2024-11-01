<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tckimlik = $_POST['tckimlik'];
    
    // TC Kimlik kontrolü
    if (strlen($tckimlik) !== 11) {
        die("TC Kimlik numarası 11 karakter olmalıdır!");
    }

    try {
        $stmt = $db->prepare("INSERT INTO ogrenci (adi, soyadi, tckimlik, telefon, cinsiyet, veli_adi, velitelefon, dogumyeri, dogumtarihi, adres) 
                             VALUES (:adi, :soyadi, :tckimlik, :telefon, :cinsiyet, :veli_adi, :velitelefon, :dogumyeri, :dogumtarihi, :adres)");
        
        $stmt->execute([
            'adi' => $_POST['adi'],
            'soyadi' => $_POST['soyadi'],
            'tckimlik' => $tckimlik,
            'telefon' => $_POST['telefon'],
            'cinsiyet' => $_POST['cinsiyet'],
            'veli_adi' => $_POST['veli_adi'],
            'velitelefon' => $_POST['velitelefon'],
            'dogumyeri' => $_POST['dogumyeri'],
            'dogumtarihi' => $_POST['dogumtarihi'],
            'adres' => $_POST['adres']
        ]);

        header('Location: index.php?success=1');
    } catch(PDOException $e) {
        die("Kayıt hatası: " . $e->getMessage());
    }
}