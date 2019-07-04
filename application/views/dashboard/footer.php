</div>
</div>
<!-- arahkan url ke direktori 'assets' -->
<script src="<?php echo base_url();?>assets/jquery-3.3.1.slim.min.js.download" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
      
      <!-- arahkan url ke direktori 'assets' -->
      <script src="<?php echo base_url();?>assets/bootstrap.bundle.min.js.download" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>

      	<!-- arahkan url ke direktori 'assets' -->
        <script src="<?php echo base_url();?>assets/feather.min.js.download"></script>
        <script src="<?php echo base_url();?>assets/Chart.min.js.download"></script>
        <?php
			$conn = new mysqli('localhost', 'root', '', 'books');
			$sql = "SELECT *FROM kategori";
			$sql3 = "SELECT COUNT(*) FROM kategori";
			$kategori = $conn->query($sql);
			$index = $conn->query($sql3);
			($c = mysqli_fetch_array($index))
		?>
        <script>
		  /* globals Chart:false, feather:false */

		  /* menampilkan grafik rekap jumlah buku per kategori */

		(function () {
		  'use strict'

		  feather.replace()

		  // Graphs
		  var ctx = document.getElementById('myChart')
		  // eslint-disable-next-line no-unused-vars
		  var myChart = new Chart(ctx, {
		    type: 'line',
		    data: {
		      labels: [<?php while($b = mysqli_fetch_array($kategori)) { echo '"' . $b['kategori'] . '",'; } ?>],
		      datasets: [{
				data: [
				<?php 
				for ($x = 1; $x <=$c['COUNT(*)'] ; $x++) {
					$sql2 = "SELECT COUNT(*) FROM books WHERE idkategori=$x";
					$jumlah = $conn->query($sql2);
					$a = mysqli_fetch_array($jumlah);
					echo $a['COUNT(*)'] . ', ';
				} 
				?>],
		        lineTension: 0,
		        backgroundColor: 'transparent',
		        borderColor: '#007bff',
		        borderWidth: 4,
		        pointBackgroundColor: '#007bff'
		      }]
		    },
		    options: {
		      scales: {
		        yAxes: [{
		          ticks: {
		            beginAtZero: false
		          }
		        }]
		      },
		      legend: {
		        display: false
		      }
		    }
		  })
		}())
		</script>

</body></html>