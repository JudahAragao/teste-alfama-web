<div class="container--header-loged d-flex justify-content-between align-items-center">
    <div class="logo">
        <img src="/public/img/logo-light.png" alt="Alfama Web">
    </div>
    <div class="dropdown">
        <img src="/public/svg/icon-hamburger-menu.svg" alt="Hamburger Menu" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item" href="#" id="logout-button">Logout</a></li>
        </ul>
    </div>

    <script type="text/javascript">
        document.getElementById('logout-button').addEventListener('click', function(e) {
            e.preventDefault();

            fetch('http://teste_alfama_web.local/app/includes/process_logout.php', {
                    method: 'POST',
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        window.location.href = 'http://teste_alfama_web.local/?action=login'; // Redireciona para a página de login ou página inicial
                    } else {
                        alert('Erro ao fazer logout. Tente novamente.');
                    }
                })
                .catch(error => console.error('Erro:', error));
        });
    </script>
</div>