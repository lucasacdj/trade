<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<div class="container mt-5">

	<?php if (isset($error)) : ?>
		<div class="col-md-12 mt-5">

			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg>
				</button>
				<strong>Erro !</strong> <?= $error ?></button>
			</div>

		</div>
	<?php endif; ?>

	<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">

		<div class="collapse navbar-collapse" id="navbarSupportedContent">

			<ul class="navbar-nav mr-auto">

				<li class="nav-item active">
					<a class="nav-link" href="index">Home <span class="sr-only">(current)</span></a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="CEPS">Listar CEPs cadastrados</a>
				</li>

			</ul>

		</div>
	</nav>


	<?= form_open("cadastrar_cep") ?>

	<div class="form-group">

		<label for="cep">Informe um CEP</label>
		<input type="number" class="form-control" id="cep" min="100000" max="999999" name="cep">

	</div>

	<div class="form-group">
		<label for="cidade">Informe uma cidade</label>
		<input type="text" class="form-control" id="cidade" name="cidade">
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>

	</form>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>