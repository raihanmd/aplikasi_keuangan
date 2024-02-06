  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">

    </div>
    <strong>Copyright &copy; 2022</strong> - Pakarangan Apps


    </div>


    <script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>

    <script src="../assets/bower_components/jquery-ui/jquery-ui.min.js"></script>

    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>

    <script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="../assets/bower_components/raphael/raphael.min.js"></script>
    <script src="../assets/bower_components/morris.js/morris.min.js"></script>

    <script src="../assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>


    <script src="../assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

    <script src="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <script src="../assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>

    <script src="../assets/bower_components/moment/min/moment.min.js"></script>
    <script src="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script src="../assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

    <script src="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

    <script src="../assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../assets/bower_components/fastclick/lib/fastclick.js"></script>

    <script src="../assets/dist/js/adminlte.min.js"></script>

    <script src="../assets/dist/js/pages/dashboard.js"></script>

    <script src="../assets/dist/js/demo.js"></script>
    <script src="../assets/bower_components/ckeditor/ckeditor.js"></script>
    <script src="../assets/bower_components/chart.js/Chart.min.js"></script>

    <script>
      $(document).ready(function() {

        // $(".edit").hide();

        $('#table-datatable').DataTable({
          'paging': true,
          'lengthChange': false,
          'searching': true,
          'ordering': false,
          'info': true,
          'autoWidth': true,
          "pageLength": 50
        });



      });

      $('#datepicker').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
      }).datepicker("setDate", new Date());

      $('.datepicker2').datepicker({
        autoclose: true,
        format: 'yyyy/mm/dd',
      });
    </script>


    <script>
      var randomScalingFactor = function() {
        return Math.round(Math.random() * 100)
      };

      var barChartData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
        datasets: [{
            label: 'Pemasukan',
            fillColor: "rgba(51, 240, 113, 0.61)",
            strokeColor: "rgba(11, 246, 88, 0.61)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data: [
              <?php
              for ($bulan = 1; $bulan <= 12; $bulan++) {
                $thn_ini = date('Y');
                $pemasukan = mysqli_query($koneksi, "select sum(transaksi_nominal) as total_pemasukan from transaksi_umum where transaksi_jenis='Pemasukan' and month(transaksi_tanggal)='$bulan' and year(transaksi_tanggal)='$thn_ini'");
                $pem = mysqli_fetch_assoc($pemasukan);

                // $total = str_replace(",", "44", number_format($pem['total_pemasukan']));
                $total = $pem['total_pemasukan'];
                if ($pem['total_pemasukan'] == "") {
                  echo "0,";
                } else {
                  echo $total . ",";
                }
              }
              ?>
            ]
          },
          {
            label: 'Pengeluaran',
            fillColor: "rgba(255, 51, 51, 0.8)",
            strokeColor: "rgba(248, 5, 5, 0.8)",
            highlightFill: "rgba(151,187,205,0.75)",
            highlightStroke: "rgba(151,187,205,1)",
            data: [
              <?php
              for ($bulan = 1; $bulan <= 12; $bulan++) {
                $thn_ini = date('Y');
                $pengeluaran = mysqli_query($koneksi, "select sum(transaksi_nominal) as total_pengeluaran from transaksi_umum where transaksi_jenis='pengeluaran' and month(transaksi_tanggal)='$bulan' and year(transaksi_tanggal)='$thn_ini'");
                $peng = mysqli_fetch_assoc($pengeluaran);

                // $total = str_replace(",", "44", number_format($peng['total_pengeluaran']));
                $total = $peng['total_pengeluaran'];
                if ($peng['total_pengeluaran'] == "") {
                  echo "0,";
                } else {

                  echo $total . ",";
                }
              }
              ?>
            ]
          }
        ]

      }


      var barChartData2 = {
        labels: [
          <?php
          $tahun = mysqli_query($koneksi, "select distinct year(transaksi_tanggal) as tahun from transaksi_umum order by year(transaksi_tanggal) asc");
          while ($t = mysqli_fetch_array($tahun)) {
          ?> "<?php echo $t['tahun']; ?>",
          <?php
          }
          ?>
        ],
        datasets: [{
            label: 'Pemasukan',
            fillColor: "rgba(51, 240, 113, 0.61)",
            strokeColor: "rgba(11, 246, 88, 0.61)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data: [
              <?php
              $tahun = mysqli_query($koneksi, "select distinct year(transaksi_tanggal) as tahun from transaksi_umum order by year(transaksi_tanggal) asc");
              while ($t = mysqli_fetch_array($tahun)) {
                $thn = $t['tahun'];
                $pemasukan = mysqli_query($koneksi, "select sum(transaksi_nominal) as total_pemasukan from transaksi_umum where transaksi_jenis='Pemasukan' and year(transaksi_tanggal)='$thn'");
                $pem = mysqli_fetch_assoc($pemasukan);
                $total = $pem['total_pemasukan'];
                if ($pem['total_pemasukan'] == "") {
                  echo "0,";
                } else {
                  echo $total . ",";
                }
              }
              ?>
            ]
          },
          {
            label: 'Pengeluaran',
            fillColor: "rgba(255, 51, 51, 0.8)",
            strokeColor: "rgba(248, 5, 5, 0.8)",
            highlightFill: "rgba(151,187,205,0.75)",
            highlightStroke: "rgba(254, 29, 29, 0)",
            data: [
              <?php
              $tahun = mysqli_query($koneksi, "select distinct year(transaksi_tanggal) as tahun from transaksi_umum order by year(transaksi_tanggal) asc");
              while ($t = mysqli_fetch_array($tahun)) {
                $thn = $t['tahun'];
                $pemasukan = mysqli_query($koneksi, "select sum(transaksi_nominal) as total_pengeluaran from transaksi_umum where transaksi_jenis='Pengeluaran' and year(transaksi_tanggal)='$thn'");
                $pem = mysqli_fetch_assoc($pemasukan);
                $total = $pem['total_pengeluaran'];
                if ($pem['total_pengeluaran'] == "") {
                  echo "0,";
                } else {
                  echo $total . ",";
                }
              }
              ?>
            ]
          }
        ]

      }


      window.onload = function() {
        var ctx = document.getElementById("grafik1").getContext("2d");
        window.myBar = new Chart(ctx).Bar(barChartData, {
          responsive: true,
          animation: true,
          barValueSpacing: 5,
          barDatasetSpacing: 1,
          tooltipFillColor: "rgba(0,0,0,0.8)",
          multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
        });

        var ctx = document.getElementById("grafik2").getContext("2d");
        window.myBar = new Chart(ctx).Bar(barChartData2, {
          responsive: true,
          animation: true,
          barValueSpacing: 5,
          barDatasetSpacing: 1,
          tooltipFillColor: "rgba(0,0,0,0.8)",
          multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
        });







      }
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        const namaPengembangSelect = document.getElementById("nama_pengembang");
        const namaPerumahanSelect = document.getElementById("nama_perumahan");
        const dirutInput = document.getElementById("dirut");
        const alamatPerumahanInput = document.getElementById("alamat_perumahan");

        namaPengembangSelect.addEventListener("change", function() {
          const selectedPengembangId = namaPengembangSelect.value;

          namaPerumahanSelect.disabled = false;
          namaPerumahanSelect.innerHTML = '<option value="">- Pilih -</option>';

          if (selectedPengembangId !== "") {
            fetch('../utils/fetch_perumahan.php?id=' + selectedPengembangId)
              .then(response => response.json())
              .then(data => {
                data.forEach(perumahan => {
                  console.log(perumahan)
                  let option = document.createElement('option');
                  option.value = perumahan.id;
                  option.textContent = perumahan.nama_perumahan;
                  option.setAttribute("data-alamat", perumahan.alamat_perumahan);
                  namaPerumahanSelect.appendChild(option);
                });
              })
              .catch(error => console.error('Error fetching data:', error));
          } else {
            namaPerumahanSelect.disabled = true;
          }

          // Set value and disable property for Dirut input
          const selectedOption = namaPengembangSelect.options[namaPengembangSelect.selectedIndex];
          const dirutValue = selectedOption.getAttribute("data-dirut");
          dirutInput.value = dirutValue;
          dirutInput.disabled = (selectedPengembangId === "");

          // Reset alamatPerumahanInput when changing pengembang
          alamatPerumahanInput.value = "";
        });

        namaPerumahanSelect.addEventListener("change", function() {
          const selectedOption = namaPerumahanSelect.options[namaPerumahanSelect.selectedIndex];
          const alamatPerumahanValue = selectedOption.dataset.alamat;
          alamatPerumahanInput.value = alamatPerumahanValue;
        });

        const hargaJualRumahInput = document.getElementById("harga_jual_rumah");
        const uangMukaInput = document.getElementById("uang_muka");
        const plafonKreditInput = document.getElementById("plafon_kredit");

        // Fungsi untuk mengisi nilai Plafon Kredit secara otomatis
        function updatePlafonKredit() {
          const hargaJualRumah = parseFloat(hargaJualRumahInput.value) || 0;
          const uangMuka = parseFloat(uangMukaInput.value) || 0;

          const plafonKredit = hargaJualRumah - uangMuka;

          // Mengatur nilai Plafon Kredit pada input
          plafonKreditInput.value = plafonKredit >= 0 ? plafonKredit : 0;
        }

        // Menanggapi perubahan pada input Harga Jual Rumah dan Uang Muka
        hargaJualRumahInput.addEventListener("input", updatePlafonKredit);
        uangMukaInput.addEventListener("input", updatePlafonKredit);
      });
    </script>
    </body>

    </html>