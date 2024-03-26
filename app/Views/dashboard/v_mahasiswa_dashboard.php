<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="right_col" role="main">
            <!-- top tiles -->
    <div class="row" style="display: inline-block;" >
        <div class="tile_count">
            <h1>Mahasiswa</h1>
            <?php if(session()->getFlashdata('sukses')) : ?>
            <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="alert alert-success alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Sukses!</strong> <?= session()->getFlashdata('sukses'); ?>.
            </div>
            </div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('gagal')) : ?>
            <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="alert alert-danger alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Gagal!</strong> <?= session()->getFlashdata('gagal'); ?>.
            </div>
            </div>
            <?php endif; ?>
           
        </div>
    </div>
    <!-- /top tiles -->


</div>
<?= $this->endSection(); ?>