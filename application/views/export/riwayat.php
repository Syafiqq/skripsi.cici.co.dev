<table border="1">
    <thead>
        <tr>
            <th style="vertical-align: middle; text-align: center">Anggota Keluarga</th>
            <th style="vertical-align: middle; text-align: center">Tekanan Darah</th>
            <th style="vertical-align: middle; text-align: center">Irama Denyut</th>
            <th style="vertical-align: middle; text-align: center">Jumlah Rokok per Hari</th>
            <th style="vertical-align: middle; text-align: center">Mempunyai Riwayat Kolesterol?</th>
            <th style="vertical-align: middle; text-align: center">Mempunyai Riwayat Diabetes?</th>                                                                               
            <th style="vertical-align: middle; text-align: center">Intensitas Olahraga?</th>                                                                               
            <th style="vertical-align: middle; text-align: center">Tinggi Badan</th>                                                                               
            <th style="vertical-align: middle; text-align: center">Berat Badan</th>                                                                               
            <th style="vertical-align: middle; text-align: center">Mempunyai Riwayat Stroke?</th>                                                                               
            <th style="vertical-align: middle; text-align: center">Keluarga Mempunyai Riwayat Stroke?</th>                                                                               
            <th style="vertical-align: middle; text-align: center">Diagnosa</th>                                                                               
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($data1->result() as $baris) :
            ?>
            <tr class="even pointer">
                <td><?php echo $baris->anggota_keluarga; ?></td>
                <td><?php echo $baris->td_sistole . '/' . $baris->td_diastole; ?></td>
                <td><?php echo $baris->irama_denyut; ?></td>
                <td><?php echo $baris->merokok . ' batang'; ?></td>
                <td>
                    <?php
                    if ($baris->kolesterol == 0) {
                        echo 'Tidak';
                    } else {
                        echo 'Ya';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if ($baris->diabetes == 0) {
                        echo 'Tidak';
                    } else {
                        echo 'Ya';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if ($baris->olahraga == 0) {
                        echo 'Tidak Pernah';
                    } else if (0 < $baris->olahraga && $baris->olahraga < 1) {
                        echo 'Jarang';
                    } else if ($baris->olahraga == 1) {
                        echo 'Sering';
                    }
                    ?>
                </td>
                <td><?php echo $baris->tinggi_badan . ' cm'; ?></td>
                <td><?php echo $baris->berat_badan . ' Kg'; ?></td>
                <td>
                    <?php
                    if ($baris->riwayat_sakit == 0) {
                        echo 'Tidak';
                    } else {
                        echo 'Ya';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if ($baris->riwayat_keluarga == 0) {
                        echo 'Tidak';
                    } else {
                        echo 'Ya';
                    }
                    ?>
                </td>
                <td><?php echo $baris->diagnosa; ?></td>
            </tr>
            <?php
            $no++;
        endforeach;
        ?>
    </tbody>    
</table>