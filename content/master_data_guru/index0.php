<script src="content/master_data_guru/index.js"></script>
<div class="card" style="overflow:scroll">
    <div class="card-body">
        <div class="table table-responsive">
            <form name="frm-example" id="frm-example" action="javascript:void(0)">
            <table class="display nowrap table table-hover table-striped table-bordered" id="tabel_guru" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <td width="20">
                            <input type="checkbox">
                        </td>
                        <td width="150">NIP</td>
                        <td width="200">Nama Lengkap</td>
                        <td width="200">Tempat & Tgl Lahir</td>
                        <td width="100">JK</td>
                        <td width="150">Sekolah</td>
                        <td width="100">Status</td>
                        <td width="120"></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../../koneksi_db/Koneksi.php";
                    $table_guru = TABLE_GURU;
                    $table_sekolah = TABLE_SEKOLAH;
                    $query = "SELECT a.user_id_login, nip,nama_lengkap,CONCAT(tempat_lahir,',',DATE_FORMAT(tanggal_lahir,'%d/%m/%Y')) AS tgl_lahir,
                    jenis_kelamin, IF(a.flag_aktif='Y','Aktif','N. Aktif') AS flag_aktif, b.nama as nama_sekolah, a.flag_aktif as status_aktif
                    FROM $db.$table_guru AS a
                    LEFT JOIN $db.$table_sekolah AS b ON b.id = a.id_sekolah
                    WHERE a.deleted_date IS NULL";

                    $ex_query = mysqli_query($con, $query);
                    while($rows = mysqli_fetch_assoc($ex_query)){
                        $user_id = $rows['user_id_login'];
                        $nis = $rows['nip'];
                        $nama_lengkap = $rows['nama_lengkap'];
                        $tgl_lahir = $rows['tgl_lahir'];
                        $jenis_kelamin = $rows['jenis_kelamin'];
                        $flag_aktif = $rows['flag_aktif'];
                        $nama_sekolah = $rows['nama_sekolah'];
                        $status_aktif = $rows['status_aktif'];

                        $onclick_update = "FormUpdateDataGuru('$user_id','$status_aktif')";
                        $onclick_delete = "prosesDeleteDataGuru('$user_id','$nama_lengkap')";
                    ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="id[]" value="<?php echo $user_id;?>">
                        </td>
                        <td><?php echo $nis;?></td>
                        <td><?php echo $nama_lengkap;?></td>
                        <td><?php echo $tgl_lahir;?></td>
                        <td><?php echo $jenis_kelamin;?></td>
                        <td><?php echo $nama_sekolah;?></td>
                        <td><?php echo $flag_aktif;?></td>
                        <td align="center">
                            <button type="button" class="btn btn-info" onclick="<?php echo $onclick_update;?>">
                                <span class="fa fa-edit"></span>
                            </button>&nbsp;
                            <button type="button" class="btn btn-danger" onclick="<?php echo $onclick_delete;?>">
                                <span class="fa fa-trash"></span>
                            </button>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                  </form>
              </table>
          </div>
        </div>
        </div>
    </div>
</div>
