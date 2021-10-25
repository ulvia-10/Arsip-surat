<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            <h3 class="m-0 text-dark">Ubah Arsip Surat</h3><br>
            <p>Unggah surat yang telah terbit pada form ini untuk dipersiapkan.</p>
            <b>Catatan : </b><br>
            <font color="red">* Gunakan file berformat PDF</font>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-11">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <form action="<?php echo base_url('arsip/ubah'); ?>" method="post" id="form_id" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label> Nomor Surat : </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="hidden" name="id_surat" id="id_surat">
                                        <input type="text" name="nomor_surat" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label> Kategori : </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <select class="form-control form-control-sm" name="kategori_surat" required>
                                                <option value="Undangan">Undangan</option>
                                                <option value="Pengumuman">Pengumuman</option>
                                                <option value="Nota Dinas">Nota Dinas</option>
                                                <option value="Pemberitahuan">Pemberitahuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label>Judul Surat : </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="judul_surat" class="form-control" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label>File Surat (PDF) : </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" name="userfile" class="form-control">
                                        <input type="hidden" name="before_path">
                                    </div>
                                </div><br>
                                <button type="submit" class="btn btn-info mr-2">Simpan Data</button>&nbsp;
                                <a href="<?php echo base_url('arsip/index'); ?>" type="button" class="btn btn-default"> Kembali</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>