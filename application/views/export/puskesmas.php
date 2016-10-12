<table border="1">
    <thead>
        <tr>
            <th style="vertical-align: middle; text-align: center">Kode Puskesmas</th>
            <th style="vertical-align: middle; text-align: center">Nama Puskesmas</th>
            <th style="vertical-align: middle; text-align: center">Alamat Puskesmas</th>
            <th style="vertical-align: middle; text-align: center">Kecamatan</th>
            <th style="vertical-align: middle; text-align: center">Kelurahan</th>
            <th style="vertical-align: middle; text-align: center">Jenis Puskesmas</th>
            <th style="vertical-align: middle; text-align: center">Nomor Telepon</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($data1->result() as $baris) :
            ?>
            <tr class="even pointer">   
                <td style="text-align: center"> <?php echo $baris->kode_puskesmas; ?></td>
                <td> <?php echo $baris->nama_puskesmas; ?></td>
                <td> <?php echo $baris->alamat . ' RT ' . $baris->rt . ' RW ' . $baris->rw; ?></td>
                <td> <?php echo $this->m_index->getNamaKecamatan($baris->id_kecamatan); ?></td>
                <td> <?php echo $this->m_index->getNamaKelurahan($baris->id_kelurahan); ?></td>
                <td style="text-align: center"> <?php
                    if ($baris->jenis_puskesmas == 1) {
                        echo "Rawat Inap";
                    } else {
                        echo "Non Rawat Inap";
                    }
                    ?>
                </td>
                <td> <?php echo $baris->telepon; ?></td>
            </tr>
            <?php
            $no++;
        endforeach;
        ?>
    </tbody>    
</table>