<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

 <!-- page content -->
 <div class="right_col" role="main">
    <div class="">
		<div class="page-title">
            <div class="title_left" >
                <h3>Daftar Ruangan Terpakai</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div>
            <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('ruangan/cari');?>">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <div class="input-group date col-md-3 col-sm-3" style="padding-left: 0;">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                        <input placeholder="pilih tanggal" type="text" value="<?= old('tanggal'); ?>" class="form-control datepicker" name="tanggal">
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-search" style="margin-right: 5px;"></i>Cari</button>
                    </div>
                </div>
            </form>
            <form class="form-horizontal form-label-left" method="POST" action="<?= base_url('ruangan/hapus-cari'); ?>">
                <?= csrf_field(); ?>
                <button type="submit" class="btn btn-lg btn-success">Lihat Semua</button>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
            <?php if(session()->getFlashdata('sukses')) : ?>
                    <div class="alert alert-success alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Sukses!</strong> <?= session()->getFlashdata('sukses'); ?>.
                    </div>
                <?php endif; ?>
			<div class="x_panel">
                    <div class="x_title">
                        <?php if(session()->get('tanggal_pencarian_pemakaian_ruangan')){ ?>
                            <h2>Data Pemakaian Ruangan Tanggal <?= session()->get('tanggal_pencarian_pemakaian_ruangan'); ?></h2>
                        <?php }else { ?>
                            <h2>Data Pemakaian Ruangan</h2>
                        <?php }  ?>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jarak dengan hari ini</th>
                                                <th>Tanggal</th>
                                                <th>Hari</th>
                                                <th>Sesi</th>
                                                <th>Ruangan</th>
                                                <th>Jenis Pemakaian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach($semua_ruangan_terpakai as $srt): ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= perbedaan_hari($srt['smr_tanggal']); ?></td>
                                                <td><?= $srt['smr_tanggal']; ?></td>
                                                <td><?= $srt['nama_hari']; ?></td>
                                                <td><?= $srt['nama_sesi']; ?></td>
                                                <td><?= $srt['nama_ruangan']; ?></td>
                                                <td><?= $srt['jenis_pemakaian']; ?></td>
                                            <?php $no++ ?>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    		</div>
        </div>
    </div>
</div>
<!-- /page content -->

<script type="text/javascript">
 $(function(){
  $(".datepicker").datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
  });
 });
</script>
<?= $this->endSection(); ?>
