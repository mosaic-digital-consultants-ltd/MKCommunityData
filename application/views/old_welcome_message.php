<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>MX</title>
	<link rel="icon" href="<?=site_url('images/logo/logo-enblem-inverse.png')?>">

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
		margin-block-end: 0px!important;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}


	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	</style>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<?php echo $map['js']; ?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
</head>
<body style="background: #295a9f;overflow: hidden;">

<div class="container-fluid" style="padding-left: 0px; padding-right: 0px">
	<h1 style="background: #295a9f;    font-family: 'Oswald', sans-serif;     color: white;">
		<img src="<?=site_url('images/logo/logo-enblem-inverse.png')?>" style="height: 30px; margin-top: -7px; padding-right: 5px">MX
	</h1>
	<div >
		<div class="row">
			<div class="col-8" style="padding:0px">
				<?=$map['html']?>
			</div>
			<div class="col" style="padding: 20px; margin-right: 10px; background:white;">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" href="#location_tab" role="tab" data-toggle="tab">location</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#data_tab" role="tab" data-toggle="tab">data</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#settings_tab" role="tab" data-toggle="tab">settings</a>
					</li>
				</ul>
				<div class="tab-content" style="border-right: 1px solid #dee2e6;border-bottom: 1px solid #dee2e6;border-left:  1px solid #dee2e6; min-height:748px">
					<div role="tabpanel" class="tab-pane fade in active" id="location_tab">
					</div>
					<div role="tabpanel" class="tab-pane fade" id="data_tab">bbb</div>
					<div role="tabpanel" class="tab-pane fade" id="settings_tab">ccc</div>
				</div>
			</div>
		</div>
	</div>
	<footer style="text-align: right; margin-top: 10px; padding-right: 10px; background: #295a9f; font-family: 'Oswald', sans-serif; color: white;">
			© <script type="text/javascript">
							document.write(new Date().getFullYear());
						</script> Mosaic Digital Consultants Ltd
						<a href="#" class="seperated-anchor-list" onclick="$('#pop-up-disclaimer').show()"></a>
		<a data-fancybox data-type="ajax" data-src="<?=site_url('Policies')?>" href="javascript:;">
			Terms and Conditions
		</a>

	</footer>
</div>



<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

</body>
</html>
