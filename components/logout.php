<button class="logout-button" onclick="sairConta()">
    Sair da conta
</button>

<style>
    .logout-button {
        width: 100%;

        padding: 16px;

        border: 1px solid rgba(255, 101, 122, .25);
        border-radius: 17px;

        background: rgba(255, 101, 122, .06);
        color: var(--vermelho);

        font-size: 15px;
        font-weight: 600;

        cursor: pointer;
        transition: .2s;
    }

    .logout-button:hover {
        background: rgba(255, 101, 122, .12);
        border-color: rgba(255, 101, 122, .45);
    }
</style>

<script>
    function sairConta() {

        const confirmar =
            confirm(
                "Deseja realmente sair da sua conta?"
            );


        if (confirmar) {

            mostrarMensagem(
                "Saindo da conta..."
            );


            setTimeout(
                function () {

                    window.location.href =
                        "logout.php";

                },
                800
            );

        }

    }
</script>