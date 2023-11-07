<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard Inventory</title>

    <!-- Custom fonts and styles -->
    <link href="<?= base_url() ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= base_url() ?>/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/css/custom.css" rel="stylesheet">
    <!-- <link href="<?= base_url() ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->

    <!-- JavaScript dependencies -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/simple-datatables.development"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Additional styles and scripts -->
    <link href="<?= base_url() ?>/css/styles.css" rel="stylesheet">
</head>

<!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?= $this->include('layout/sidebar'); ?>
        <!-- End of Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <?= $this->include('layout/topbar'); ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <?= $this->renderSection('content'); ?>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <?= $this->include('layout/footer'); ?>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom script for filtering -->
    <script>
        $(document).ready(function() {
            const filterDivisi = document.getElementById('filterDivisi');
            const filterStatus = document.getElementById('filterStatus');
            const filterButton = document.getElementById('filterButton');
            const dataRows = document.querySelectorAll("#datatablesSimple tbody tr");

            filterButton.addEventListener('click', () => {
                const selectedDivisi = filterDivisi.value;
                const selectedStatus = filterStatus.value;

                dataRows.forEach(row => {
                    const divisiCell = row.querySelector('td[data-category-id]');
                    const divisi = divisiCell.getAttribute('data-category-id');

                    const statusCell = row.querySelector('td[data-status-id]');
                    const status = statusCell.getAttribute('data-status-id');

                    const isDivisiMatch = selectedDivisi === 'all' || selectedDivisi === divisi;
                    const isStatusMatch = selectedStatus === 'all' || selectedStatus === status;

                    if (isDivisiMatch && isStatusMatch) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <script>
        // Fungsi untuk mengatur filter berdasarkan divisi yang dipilih
        function filterByDivisi() {
            var checkboxes = document.querySelectorAll('input[name="divisi[]"]:checked');
            var selectedDivisi = Array.from(checkboxes).map(checkbox => checkbox.value);

            var rows = document.querySelectorAll("#datatablesSimple tbody tr");
            rows.forEach(row => {
                var categoryID = row.querySelector("td[data-category-id]").getAttribute("data-category-id")
                document.getElementById('selectedDivisions').value = JSON.stringify(selectedDivisi);


                // Jika categoryID tidak ada dalam daftar yang dipilih, sembunyikan barisnya
                if (!selectedDivisi.includes(categoryID)) {
                    row.style.display = "none";
                } else {
                    row.style.display = ""; // Tampilkan baris yang sesuai

                }
            });
            updateButtonDisplay(selectedDivisi);
            updateExportPdfUrl()
        }

        // Tambahkan event listener untuk checkbox
        var checkboxes = document.querySelectorAll('input[name="divisi[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("change", filterByDivisi);
        });

        function updateButtonDisplay(selectedDivisi) {
            var exportPDFButton = document.getElementById('btn-export-pdf');
            var exportAkutansiButton = document.getElementById('btn-export-akutansi');

            if (selectedDivisi.length > 0) {
                exportAkutansiButton.style.display = "";
                exportPDFButton.style.display = "none";
            } else {
                exportPDFButton.style.display = "";
                exportAkutansiButton.style.display = "none";
            }
        }

        function updateExportPdfUrl() {
            var checkboxes = document.querySelectorAll('input[name="divisi[]"]:checked');
            var selectedDivisions = Array.from(checkboxes).map(checkbox => checkbox.value);
            var exportPdfUrl = "<?= site_url('report/exportpdfAkutansi?id=') ?>";

            if (selectedDivisions.length > 0) {
                exportPdfUrl += selectedDivisions.join(',');
            }

            document.getElementById('btn-export-akutansi').setAttribute('href', exportPdfUrl);
        }
    </script>



    <script>
        $(document).ready(function() {
            $('#datatablesSimple').DataTable({
                // Pengaturan DataTables disini
                "paging": true, // Aktifkan penyebaran/paginasi
                "pageLength": 50, // Jumlah entri per halaman
                "ordering": true, // Aktifkan pengurutan
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });
        });
    </script>



</body>

</html>