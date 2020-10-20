<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<div class="container mt-5">

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

    <h1>Lista de Ceps cadastrados</h1>

    <table id="cep" class="display mb-5" style="width:100%">

        <thead>
            <tr>
                <th>Id</th>
                <th>Cep</th>
                <th>Cidade</th>

            </tr>

        </thead>

        <tbody>
            <?php
            for ($contadorDeCep = 0; $contadorDeCep < count($info_cep); $contadorDeCep++) { ?>

                <tr>
                    <td>
                        <?= $info_cep[$contadorDeCep]->id; ?>
                    </td>

                    <td>
                        <?= $info_cep[$contadorDeCep]->cep; ?>
                    </td>

                    <td>
                        <?= $info_cep[$contadorDeCep]->cidade; ?>
                    </td>

                </tr>

            <?php }
            ?>

        </tbody>

        <tfoot>
            <tr>
                <th>Código</th>
                <th>Cep</th>
                <th>Cidade</th>

            </tr>
        </tfoot>
    </table>

</div>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#cep').DataTable();
    });
</script>