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
        $(document).ready(() => {
            $('#logout-button').click((event) => {
                $.ajax({
                    url: 'http://teste_alfama_web.local/app/includes/process_logout.php',
                    method: 'POST',
                    success: () => {
                        window.location.href = 'http://teste_alfama_web.local/?action=login';
                    }
                })
            })
        })
    </script>
</div>