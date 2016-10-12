<?php
//header("Content-type: application/pdf");
//header("Content-Disposition: attachment; filename=DATA_PEGAWAI_DINKES.pdf");
//header("Pragma: no-cache");
//header("Expires: 0");
?>
<table border="1" style="width: 100%;">
    <thead>
        <tr>
            <th style="vertical-align: middle; text-align: center">Nama Posbindu</th>
            <th style="vertical-align: middle; text-align: center">Alamat</th>
            <th style="vertical-align: middle; text-align: center">Kecamatan</th>
            <th style="vertical-align: middle; text-align: center">Kelurahan</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($data1->result() as $baris) :
            ?>
            <tr class="even pointer">   
                <td> <?php echo $baris->nama_posbindu; ?></td>
                <td> <?php echo $baris->alamat . ' RT ' . $baris->rt . ' RW ' . $baris->rw; ?></td>
                <td> <?php echo $this->m_index->getNamaKecamatan($baris->id_kecamatan); ?></td>
                <td> <?php echo $this->m_index->getNamaKelurahan($baris->id_kelurahan); ?></td>             
            </tr>
            <?php
            $no++;
        endforeach;
        ?>
    </tbody>    
</table>