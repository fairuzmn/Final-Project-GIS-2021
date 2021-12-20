<?php

$API_KEY = 'AIzaSyCyMdLBykhIR5ajjOnNjrmp8nnw8RZaObQ';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Postest GIS 2021</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row" style="height: 100%;">
            <div class="col-4">
                <div class="container-fluid mt-4" style="overflow-y:scroll;height: 790px;">
                    <div class="text-center">
                        <h3>Daftar Rumah Sakit Gresik</h3>
                    </div>
                    <div class="mt-4" id="formLokasi">
                    </div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-success" id="btnTambahData" onclick="handleAddData()">
                            <i class="bi-plus"></i>
                            Tambah Data
                        </button>
                        <button type="button" class="btn btn-primary" id="btnLokasiSaya" onclick="handleMyLocation()">
                            <i class="bi-pin-map"></i>
                            Lokasi Saya
                        </button>
                    </div>
                    <div class="mt-4" id="listRsDiv"></div>
                </div>
            </div>
            <div class="col-8">
                <div class="card mt-4 mb-4 h-95">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal form -->
    <div class="modal fade" tabindex="-1" id="modalForm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formTitle">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formId">
                        <input type="hidden" name="id" id="id" value="0">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea type="text" class="form-control" id="alamat" name="alamat" autocomplete="off" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="number" class="form-control" id="lat" name="lat" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="text" class="form-control" id="lng" name="lng" autocomplete="off" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-success" onclick="handleSaveData()">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="assets/js/index.js"></script>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= $API_KEY ?>&v=weekly&callback=initData" async>
    </script>
</body>

</html>