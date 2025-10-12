<?php
$result = "";
if (isset($_POST['cekTensi'])) {
    $sistole = $_POST['sistole'];
    $diastole = $_POST['diastole'];
    if ($sistole <= 90 && $diastole >= 60 && $diastole <= 69) {
        $result = "
    <div class='alert alert-warning'>
        <h4>Hipotensi (<90/60 mmHg)</h4>
        <ul>
            <li>Jika pusing/lemas: minum cairan, bangun pelan dari duduk/berbaring, evaluasi obat (mis. diuretik).</li>
            <li>Segera ke fasilitas kesehatan bila pingsan, nyeri dada, sesak, atau kebingungan.</li>
        </ul>
    </div>";
    } elseif ($sistole <= 120 && $diastole >= 60 && $diastole <= 80) {
        $result = "TENSI ANDA NORMAL";
    } elseif ($sistole >= 120 && $sistole <= 129 && $diastole >= 80 && $diastole <= 89) {
        $result = "ELEVATED";
    } elseif ($sistole >= 130 && $sistole <= 139 && $diastole >= 80 && $diastole <= 89) {
        $result = "HIPERTENSI STADIUM 1";
    } elseif ($sistole >= 140 && $sistole <= 180 && $diastole >= 90 && $diastole <= 119) {
        $result = "HIPERTENSI STADIUM 2";
    } elseif ($sistole >= 180 && $diastole >= 120) {
        $result = "KRISIS HIPERTENSI";
    } else {
        $result = "INPUT MUNGKIN SALAH";
    }
}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Kategori Tekanan Darah</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f6f8fb
        }

        .card {
            box-shadow: 0 10px 30px rgba(0, 0, 0, .06)
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Cek Tensi</a>
        </div>
    </nav>

    <main class="container py-5">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Kalkulator Kategori Tekanan Darah</h5>
                    </div>
                    <div class="card-body">

                        <?php
                        // === POST-PROSES $result TANPA MENGUBAH KODE DI ATAS ===
                        // Jika $result adalah teks kategori, ubah menjadi alert Bootstrap dengan poin-poin yang diminta.
                        if (!empty($result)) {
                            // jika sudah berupa alert (hipotensi dari kode asli), tampilkan apa adanya
                            if (stripos($result, 'alert') === false) {
                                $detailMap = [
                                    "TENSI ANDA NORMAL" => "
                      <div class='alert alert-success'>
                        <h4>Normal (&lt;120/&lt;80 mmHg)</h4>
                        <ul class='mb-0'>
                          <li>Pertahankan pola DASH/Mediterania, gerak ≥150 menit/minggu, jaga berat badan, tidak merokok, batasi garam.</li>
                          <li>Cek tekanan darah minimal tahunan atau sesuai saran tenaga kesehatan.</li>
                        </ul>
                      </div>
                    ",
                                    "ELEVATED" => "
                      <div class='alert alert-info'>
                        <h4>Elevated / Prahipertensi (berdasarkan input)</h4>
                        <ul class='mb-0'>
                          <li>Fokus gaya hidup: kurangi natrium, tambah kalium dari makanan (sayur-buah), olahraga rutin, turunkan BB bila berlebih, batasi alkohol.</li>
                          <li>Home BP monitoring 3–4×/minggu; evaluasi ulang 3–6 bulan. Obat biasanya belum diperlukan bila tanpa komorbid.</li>
                        </ul>
                      </div>
                    ",
                                    "HIPERTENSI STADIUM 1" => "
                      <div class='alert alert-warning'>
                        <h4>Hipertensi Stadium 1 (130–139 atau 80–89 mmHg)</h4>
                        <ul class='mb-0'>
                          <li>Lakukan semua intervensi gaya hidup di atas.</li>
                          <li>Obat dipertimbangkan bila risiko 10-tahun penyakit jantung/ stroke tinggi atau ada DM/CKD/ASCVD; jika risiko rendah, evaluasi ulang 3–6 bulan.</li>
                        </ul>
                      </div>
                    ",
                                    "HIPERTENSI STADIUM 2" => "
                      <div class='alert alert-danger'>
                        <h4>Hipertensi Stadium 2 (≥140 atau ≥90 mmHg)</h4>
                        <ul class='mb-0'>
                          <li>Obat + gaya hidup; sering perlu ≥2 obat lini pertama (ACEi/ARB, CCB, diuretik tiazid) sesuai profil pasien.</li>
                          <li>Kontrol ulang sekitar 1 bulan untuk titrasi.</li>
                        </ul>
                      </div>
                    ",
                                    "KRISIS HIPERTENSI" => "
                      <div class='alert alert-danger'>
                        <h4>Krisis Hipertensi (≥180 dan/atau ≥120 mmHg)</h4>
                        <ul class='mb-0'>
                          <li>Ukur ulang setelah 1 menit. Jika tetap sangat tinggi dan ada gejala (nyeri dada, sesak, kebas/lemah, pandangan kabur, sulit bicara), hubungi layanan gawat darurat.</li>
                          <li>Jika tanpa gejala, kontak dokter segera untuk penilaian mendesak.</li>
                        </ul>
                      </div>
                    ",
                                    "INPUT MUNGKIN SALAH" => "
                      <div class='alert alert-dark'>
                        <h4>Input Mungkin Salah</h4>
                        <p class='mb-0'>Periksa kembali nilai sistolik/diastolik yang dimasukkan.</p>
                      </div>
                    ",
                                ];

                                echo $detailMap[$result] ?? "<div class='alert alert-secondary'><strong>$result</strong></div>";
                            } else {
                                // Sudah alert HTML (kasus hipotensi dari kode asli)
                                echo $result;
                            }
                        }
                        ?>

                        <!-- Form -->
                        <form method="post" class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label for="sistole" class="form-label fw-semibold">Sistolik (mmHg)</label>
                                <div class="input-group input-group-lg">
                                    <input type="number" class="form-control" id="sistole" name="sistole"
                                        placeholder="mis. 120" min="60" max="260" step="1" required
                                        value="<?php echo isset($_POST['sistole']) ? htmlspecialchars($_POST['sistole']) : '' ?>">
                                    <span class="input-group-text">mmHg</span>
                                </div>
                                <div class="form-text">Angka atas (saat jantung berkontraksi).</div>
                            </div>

                            <div class="col-md-6">
                                <label for="diastole" class="form-label fw-semibold">Diastolik (mmHg)</label>
                                <div class="input-group input-group-lg">
                                    <input type="number" class="form-control" id="diastole" name="diastole"
                                        placeholder="mis. 80" min="40" max="160" step="1" required
                                        value="<?php echo isset($_POST['diastole']) ? htmlspecialchars($_POST['diastole']) : '' ?>">
                                    <span class="input-group-text">mmHg</span>
                                </div>
                                <div class="form-text">Angka bawah (saat jantung relaksasi).</div>
                            </div>

                            <div class="col-12 d-flex gap-2">
                                <button type="submit" name="cekTensi" class="btn btn-primary btn-lg">
                                    Cek Tensi
                                </button>
                                <a href="<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>" class="btn btn-outline-secondary btn-lg">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer bg-light">
                        <small class="text-muted">
                            Catatan: hasil ini bersifat edukatif. Konsultasikan pembacaan tekanan darah Anda dengan tenaga kesehatan.
                        </small>
                    </div>
                </div>
            </div>

            <!-- Panel referensi (opsional) -->
            <div class="col-lg-4">
                <div class="card border-0">
                    <div class="card-header bg-white">
                        <h6 class="mb-0">Rentang Singkat</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Normal</span> <span class="badge text-bg-success">&lt;120 / &lt;80</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Elevated / Pra-HT*</span> <span class="badge text-bg-info">120–129 / &lt;80</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>HTN Stadium 1</span> <span class="badge text-bg-warning">130–139 / 80–89</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>HTN Stadium 2</span> <span class="badge text-bg-danger">≥140 / ≥90</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Krisis HTN</span> <span class="badge text-bg-danger">≥180 / ≥120</span>
                            </li>
                        </ul>
                        <small class="text-muted d-block mt-2">*Istilah “prahipertensi” (JNC7) sering kini disebut “elevated”.</small>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>