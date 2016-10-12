<?php
//header("Content-type: application/pdf");
//header("Content-Disposition: attachment; filename=DATA_PEGAWAI_DINKES.pdf");
//header("Pragma: no-cache");
//header("Expires: 0");
?>
<table border="1">
    <thead>
        <tr>
            <th style="vertical-align: middle; text-align: center">Nama</th>                                                                            
            <th style="vertical-align: middle; text-align: center">Tempat, Tanggal Lahir</th>
            <th style="vertical-align: middle; text-align: center">Alamat</th>                                                                            
            <th style="vertical-align: middle; text-align: center">Telepon</th>                                                                            
            <th style="vertical-align: middle; text-align: center">Email</th>                                                                            
            <th style="vertical-align: middle; text-align: center">Whatsapp</th>                                                                            
            <th style="vertical-align: middle; text-align: center">Twitter</th>                                                                            
            <th style="vertical-align: middle; text-align: center">BBM</th>                                                                            
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        foreach ($data1->result() as $baris) :
            ?>
            <tr class="even pointer">   
                <td> <?php echo $baris->nama_kader; ?></td>                
                <td> <?php echo $baris->tempat_lahir . ', ' . $baris->tanggal_lahir; ?></td>                
                <td> <?php echo $baris->alamat . ' RT ' . $baris->rt . ' RW ' . $baris->rw; ?></td>
                <td> <?php echo $baris->hp; ?></td>                
                <td> <?php echo $baris->email; ?></td>                
                <td> <?php echo $baris->sosmed1; ?></td>                
                <td> <?php echo $baris->sosmed2; ?></td>                
                <td> <?php echo $baris->sosmed3; ?></td>                
            </tr>
            <?php
            $no++;
        endforeach;
        ?>
    </tbody>    
</table>