<table border="1">
    <thead>
        <tr>
            <th style="vertical-align: middle; text-align: center">Nomor KTP</th>
            <th style="vertical-align: middle; text-align: center">Nama</th>
            <th style="vertical-align: middle; text-align: center">Tempat, Tanggal Lahir</th>
            <th style="vertical-align: middle; text-align: center">Alamat</th>
            <th style="vertical-align: middle; text-align: center">Jenis Kelamin</th>
            <th style="vertical-align: middle; text-align: center">Telepon</th>                                                                               
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($data1->result() as $baris) :
            ?>
            <tr class="even pointer">   
                <td> <?php echo $baris->ktp; ?></td>
                <td> <?php echo $baris->nama; ?></td>
                <td><?php echo $baris->alamat . ' Kecamatan ' . $this->m_index->getNamaKecamatan($baris->id_kecamatan) . ' Kelurahan ' . $this->m_index->getNamaKelurahan($baris->id_kelurahan) . ' RT ' . $baris->rt . ' RW ' . $baris->rw; ?></td>
                <td> <?php
                    $jk = $baris->jenis_kelamin;
                    if ($jk == 0) {
                        echo "Laki-laki";
                    } else {
                        echo "Perempuan";
                    }
                    ?></td>
                <td style="width: 8%;">
                    <?php
                    $rubah = date_format(date_create($baris->tgl_lahir), 'Y');
                    $thn_skrg = date('Y');
                    $usia = $thn_skrg - $rubah;
                    echo $usia . ' tahun';
                    ?>
                </td>
                <td> <?php echo $baris->hp; ?></td>
            </tr>
            <?php
            $no++;
        endforeach;
        ?>
    </tbody>    
</table>