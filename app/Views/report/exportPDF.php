<html>

<head>
    <!-- berisi css -->
    <style>
        .title {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;
            font-weight: bold;
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .border-table {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }

        .border-table th {
            border: 1px solid #000;
            background-color: #e1e3e9;
            font-weight: bold;
        }

        .border-table td {
            border: 1px solid #000;
        }
    </style>
</head>

<body>
    <main>
        <div class="title">
            <h1>LAPORAN Inventory</h1>
        </div>
        <div>
            <!-- isi laporan -->
            <table class="border-table">
    <thead>
        <tr>
            <th style="width: 11,1%">No</th>
            <th style="width: 11,1%">Nama Divisi</th>
            <th style="width: 11,1%">Nama User</th>
            <th style="width: 11,1%">IP Address</th>
            <th style="width: 11,1%">Serial Number</th>
            <th style="width: 11,1%">Computer Name</th>
            <th style="width: 11,1%">Monitor</th>
            <th style="width: 11,1%">Tipe Komputer</th>
            <th style="width: 11,1%">Status Komputer</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($result as $value) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $divisiAssociations[$value['master_category_id']] ?></td>
                <td><?= $value['nama_user'] ?></td>
                <td><?= $value['ip_address'] ?></td>
                <td><?= $value['serial_number'] ?></td>
                <td><?= $value['computer_name'] ?></td>
                <td><?= $value['monitor'] ?></td>
                <td><?= $value['tipe_komputer'] ?></td>
                <td><?= $statusAssociations[$value['master_category_status_id']] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


      
        </div>
        <!-- Tambahkan kode ini setelah tabel laporan -->
        <div>
    <p>Jumlah Pengguna per Divisi:</p>
    <table class="border-table">
        <thead>
            <tr>
                <th width="50%">Nama Divisi</th>
                <th width="50%">Jumlah Pengguna</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($divisionUserCounts as $divisionId => $userCount) : ?>
                <tr>
                    <td><?= $divisiAssociations[$divisionId] ?></td>
                    <td><?= $userCount . ' Pengguna' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
    </main>
</body>

</html>
