 <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>
                   
                </h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                
              </div>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">
     <div class="col-md-12 portlets">
              <div class="x_panel">
                <div class="x_title">
                  <h2><strong><big>Pesan Masuk</big></strong></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                   
                   
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <?php
                    if (isset($_SESSION['alert'])) {
                        echo $_SESSION['alert'];
                    } unset($_SESSION['alert']);
                    ?>
                <div class="x_content">
               

                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>

                          <th>#</th>
                          <th>Tgl Masuk</th>
                            <th>Pengirim</th>
                            <th>Isi Sms</th>
                           <!--  <th>Proses</th> -->
                            <th>Aksi</th>
                      </tr>
                    </thead>

                     <?php
                        //include 'config/koneksi.php';


                        $query = mysqli_query($link,"SELECT * FROM inbox  order by ReceivingDateTime asc");

                        // tampilkan data siswa selama masih ada
                        while ($data = mysqli_fetch_array($query)) {
                           $nomer = mysqli_query($link,"SELECT nama_lengkap FROM tbl_siswa WHERE telpon = '$data[SenderNumber]'");
                            $d = mysqli_fetch_array($nomer);
                            if ($d['nama_lengkap'] == "")
                                $sendingname = $data['SenderNumber'];
                            else
                                $sendingname = $d['nama_lengkap'];
                            ?>
                            <tr class="">
                                <td><?php echo $data['ID']; ?></td>
                                <td><?php echo $data['ReceivingDateTime']?></td>
                                <td><?php echo $sendingname; ?></td>
                                <td><?php echo $data['TextDecoded']; ?></td>
                               <!--  <td><?php echo $data['Processed']; ?></td> -->

                                <td>

                                    <a href="index.php?admin=hapus_inbox&ID=<?php echo $data['ID']; ?>" title="" data-toggle="tooltip" data-original-title="Hapus Data" onclick="return confirm('Anda yakin menghapus Inbox dengan Pengirim : <?php echo $data['SenderNumber']; ?> ?');">
                                        <i class="glyphicon glyphicon-trash"></i>

                                    </a>

                                     <a href="#" class="edit-record" data-id="<?php echo $data['SenderNumber'];?>" title="" data-original-title="">
                                                    <button type="button" class="btn btn-info btn-flat btn-xs"><i class="fa fa-mail-reply"></i> Balas</button>
                                                </a>
                                </td>

                            </tr>
    <?php
}
?>
                    <tbody>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            <!-- </div>

           
               </div> -->
               <div class="modal fade" id="balas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-comment fa-fw fa-lg"></i> Balas Pesan</h4>
            </div>
            <div class="modal-body">

            </div>



        </div>
    </div>
</div>

               

              <!-- footer content -->
              <script src="../js/bootstrap-transition.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>
<script>
  $(function(){
    $(document).on('click','.edit-record',function(e){
        e.preventDefault();
        $("#balas").modal('show');
        $.post('modules/inbox/hasil.php',
            {SenderNumber:$(this).attr('data-id')},

            function(html){
                $(".modal-body").html(html);
            }   
            );
    });
});

</script>
              

        <!-- <script src="js/bootstrap.min.js"></script>

        <!-- bootstrap progress js -->
        <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="js/icheck/icheck.min.js"></script>

        <script src="js/custom.js"></script>
 

        <!-- Datatables -->
        <!-- <script src="js/datatables/js/jquery.dataTables.js"></script>
  <script src="js/datatables/tools/js/dataTables.tableTools.js"></script> -->

        <!-- Datatables-->
        <script src="js/datatables/jquery.dataTables.min.js"></script>
        <script src="js/datatables/dataTables.bootstrap.js"></script>
        <script src="js/datatables/dataTables.buttons.min.js"></script>
        <script src="js/datatables/buttons.bootstrap.min.js"></script>
        <script src="js/datatables/jszip.min.js"></script>
        <script src="js/datatables/pdfmake.min.js"></script>
        <script src="js/datatables/vfs_fonts.js"></script>
        <script src="js/datatables/buttons.html5.min.js"></script>
        <script src="js/datatables/buttons.print.min.js"></script>
        <script src="js/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="js/datatables/dataTables.keyTable.min.js"></script>
        <script src="js/datatables/dataTables.responsive.min.js"></script>
        <script src="js/datatables/responsive.bootstrap.min.js"></script>
        <script src="js/datatables/dataTables.scroller.min.js"></script>


        <!-- pace -->
        <script src="js/pace/pace.min.js"></script>
        <script>
          var handleDataTableButtons = function() {
              "use strict";
              0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                dom: "Bfrtip",
                buttons: [{
                  extend: "copy",
                  className: "btn-sm"
                }, {
                  extend: "csv",
                  className: "btn-sm"
                }, {
                  extend: "excel",
                  className: "btn-sm"
                }, {
                  extend: "pdf",
                  className: "btn-sm"
                }, {
                  extend: "print",
                  className: "btn-sm"
                }],
                responsive: !0
              })
            },
            TableManageButtons = function() {
              "use strict";
              return {
                init: function() {
                  handleDataTableButtons()
                }
              }
            }();
        </script>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#datatable-responsive').DataTable();
            $('#datatable-scroller').DataTable({
              ajax: "js/datatables/json/scroller-demo.json",
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({
              fixedHeader: true
            });
          });
          TableManageButtons.init();
        </script>

