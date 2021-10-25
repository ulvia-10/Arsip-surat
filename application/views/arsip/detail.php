<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h4 class="m-0 text-dark"><?php echo $title; ?></h4>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="col-sm-9 invoice-col">
                                <address>
                                    Nomor &nbsp; &nbsp; &nbsp;: <?php echo $list_surat['nomor_surat']; ?> <br>
                                    Kategori &nbsp; : <?php echo $list_surat['kategori_surat']; ?> <br>
                                    Judul &nbsp; &nbsp; &nbsp; &nbsp;: <?php echo $list_surat['judul_surat']; ?> <br>
                                    Waktu &nbsp; &nbsp; &nbsp; : <?php echo $list_surat['waktu_pengarsipan']; ?>
                                </address>
                            </div>
                            <iframe src="<?php echo base_url('assets/file/'); ?>abstrak.pdf" width="1150px" height="400px"></iframe><br><br>
                            <a href="<?php echo base_url('arsip/index'); ?>" type="button" class="btn btn-default"> Kembali</a>
                            <a href="<?php echo base_url('arsip/unduh/' . $list_surat['id_surat']); ?>" target="_blank" class="btn btn-warning">Unduh</a>
                            <a href="<?php echo base_url('arsip/ubah/' . $list_surat['id_surat']); ?>" class=" btn btn-primary">Ganti file</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</section>
</div>