<?php

ob_flush();
header("Content-type: application/json");

if (isset($_GET['nik'])) {
    $nik = htmlspecialchars($_GET['nik']);

    if (strlen($nik) != 16) {
        $api['error'] = 'Panjang NIK harus 16 angka. Angka yang anda masukan adalah ' . strlen($nik);
        echo json_encode($api, JSON_PRETTY_PRINT);
    } else {

        function cek_prov($i)
        {
            $i = intval($i);
            $data = json_decode(file_get_contents('data.json'), true);
            $provinsi = $data['provinsi'];
            if (isset($provinsi[$i])) {
                return trim($provinsi[$i]);
            }
            return 'Invalid';
        }

        function cek_kab($i)
        {
            $i = intval($i);
            $data = json_decode(file_get_contents('data.json'), true);
            $provinsi = $data['kabkot'];
            if (isset($provinsi[$i])) {
                return trim($provinsi[$i]);
            }
            return 'Invalid';
        }

        function cek_kecamatan($i)
        {
            $i = intval($i);
            $data = json_decode(file_get_contents('data.json'), true);
            $provinsi = $data['kecamatan'];
            if (isset($provinsi[$i])) {
                return trim($provinsi[$i]);
            }
            return 'Invalid';
        }

        function hitung_usia($tanggal_lahir)
        {
            $birthDate = new DateTime($tanggal_lahir);
            $today = new DateTime("today");
            if ($birthDate > $today) {
                return "0 tahun 0 bulan 0 hari";
            }
            $y = $today->diff($birthDate)->y;
            $m = $today->diff($birthDate)->m;
            $d = $today->diff($birthDate)->d;
            return $y . " tahun " . $m . " bulan " . $d . " hari";
        }

        // Variable Dikosongkan
        $rumus = array();
        $gender = '';
        $hasil = '';

        //Rumus NIK
        $rumus['provinsi'] = substr($nik, 0, 2);
        // $rumus['kabupaten '] = substr($nik, 2, 2);
        // $rumus['k_kecamatan'] = substr($nik, 4, 2);
        $rumus['tanggal'] = substr($nik, 6, 2);
        $rumus['bulan'] = substr($nik, 8, 2);
        $rumus['tahun'] = substr($nik, 10, 2);
        $rumus['k_unik'] = substr($nik, 12, 4);

        // if ($rumus['tanggal'] > 40) {
        //     $hasil = $rumus['tanggal'] - 40;
        // } else {
        //     $hasil = $rumus['tanggal'];
        // }

        if (intval($rumus['tanggal']) > 40) {
            $rumus['tanggal2'] = intval($rumus['tanggal'] - 40);
            $hasil = $rumus['tanggal'] - 40;
            $gender = 'Wanita';
        } else {
            $rumus['tanggal2'] = intval($rumus['tanggal']);
            $hasil = $rumus['tanggal'];
            $gender = 'Pria';
        }

        $lahir = $hasil . '/' . $rumus['bulan'] . '/' . $rumus['tahun'];
        $lahir2 = $rumus['tahun'] . '/' . $rumus['bulan'] . '/' . $hasil;

        $c_prov = cek_prov($rumus['provinsi']);
        $c_kab = cek_kab(substr($nik, 0, 4));
        $c_kecamatan = preg_replace("/--.*/", '', cek_kecamatan(substr($nik, 0, 6)));
        $c_kecamatan = str_replace(' ', '', $c_kecamatan);
        $k_pos = preg_replace("/.*--/", '', cek_kecamatan(substr($nik, 0, 6)));
        $k_pos = str_replace(' ', '', $k_pos);

        $api = array();
        $api = [
            'status' => 'success',
            'pesan' => 'NIK valid',
            'data' => [
                'nik' => $nik,
                'kelamin' => $gender,
                'lahir' => $lahir,
                'provinsi' => $c_prov,
                'kotakab' => $c_kab,
                'kecamatan' => $c_kecamatan,
                'uniqkode' => $rumus['k_unik'],
                'tambahan' => [
                    'kodepos' => $k_pos,
                    'usia' => hitung_usia(str_replace('/', '-', $lahir2)),
                ],
            ],
        ];
        echo json_encode($api, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
} else {
    $api['error'] = 'Key NIK kosong';
    echo json_encode($api, JSON_PRETTY_PRINT);
}
