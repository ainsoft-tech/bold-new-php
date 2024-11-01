<?php
require_once 'db_connection.php';

// Öğrenci sayısını al
$stmt = $db->query("SELECT COUNT(*) as total FROM ogrenci");
$total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

// Öğrenci listesini al
$stmt = $db->query("SELECT * FROM ogrenci ORDER BY id DESC");
$ogrenciler = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Yönetim Sistemi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <style>
        .top-header {
            background-color: #f8f9fa;
            padding: 5px 0;
            font-size: 14px;
        }
        .back-to-top {
            position: fixed;
            bottom: 25px;
            right: 25px;
            display: none;
        }
    </style>
</head>
<body>
    <!-- Top Header -->
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="https://aliihsannasli.com.tr" class="text-decoration-none text-dark">
                        aliihsannasli.com.tr
                    </a>
                </div>
                <div class="col-md-6 text-end">
                    <i class="fas fa-phone"></i> 551 745 1968
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Ana Sayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Öğrenci</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sınıf</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Okul</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Bölüm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hakkımızda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">İletişim</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Öğrenci Listesi</h5>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#yeniOgrenciModal">
                    <i class="fas fa-plus"></i> Yeni Kayıt
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Adı</th>
                                <th>Soyadı</th>
                                <th>TC Kimlik</th>
                                <th>Telefon</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($ogrenciler as $ogrenci): ?>
                            <tr>
                                <td><?= $ogrenci['id'] ?></td>
                                <td><?= htmlspecialchars($ogrenci['adi']) ?></td>
                                <td><?= htmlspecialchars($ogrenci['soyadi']) ?></td>
                                <td><?= htmlspecialchars($ogrenci['tckimlik']) ?></td>
                                <td><?= htmlspecialchars($ogrenci['telefon']) ?></td>
                                <td>
                                    <button class="btn btn-info btn-sm" title="Detay">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-warning btn-sm" title="Düzenle">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" title="Sil">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    Toplam kayıt sayısı: <?= $total ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>İletişim Bilgileri</h5>
                    <p>
                        <i class="fas fa-phone"></i> 551 745 1968<br>
                        <i class="fas fa-globe"></i> aliihsannasli.com.tr
                    </p>
                </div>
                <div class="col-md-8">
                    <h5>İletişim Formu</h5>
                    <form action="send_mail.php" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Ad Soyad" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" class="form-control" placeholder="E-posta" required>
                            </div>
                            <div class="col-12 mb-3">
                                <input type="text" class="form-control" placeholder="Konu" required>
                            </div>
                            <div class="col-12 mb-3">
                                <textarea class="form-control" rows="3" placeholder="Mesajınız" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Gönder</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button class="btn btn-primary back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- New Student Modal -->
    <div class="modal fade" id="yeniOgrenciModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Öğrenci Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="ogrenciForm" action="save_student.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Adı</label>
                            <input type="text" class="form-control" name="adi" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Soyadı</label>
                            <input type="text" class="form-control" name="soyadi" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">TC Kimlik</label>
                            <input type="text" class="form-control" name="tckimlik" maxlength="11" required>
                        </div>
                        <!-- Other fields... -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="submit" form="ogrenciForm" class="btn btn-primary">Kaydet</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Back to top button
        window.onscroll = function() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("backToTop").style.display = "block";
            } else {
                document.getElementById("backToTop").style.display = "none";
            }
        };

        document.getElementById("backToTop").onclick = function() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        };
    </script>
</body>
</html>