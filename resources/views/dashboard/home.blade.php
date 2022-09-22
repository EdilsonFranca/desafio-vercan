<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href={{ asset("bootstrap-5.2.1/css/bootstrap.css") }} rel="stylesheet"/>
    <link href={{ asset("css/home.css") }} rel="stylesheet"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="app-container container-fluid vh-100 p-0 ">
    <nav class="navbar navbar-expand-lg bg-light p-2">
        <div class="py-2">
            <span class="logo-lg">Desafio <b>Vercan</b></span>
        </div>
    </nav>
    <div class="row h-100">
        <div class="col-md-3 h-100 menu">
            <div class="menu-box">

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="active nav-link text-white p-3 d-flex align-items-center" aria-current="page" href="#">
                            <svg width="16" height="16" fill="currentColor" class="bi bi-house me-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white p-3 d-flex align-items-center" href="fornecedor">
                            <svg width="16" height="16" fill="currentColor" class="bi bi-people me-2" viewBox="0 0 16 16">
                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                            </svg>
                            Fornecedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white p-3 d-flex align-items-center">
                            <svg width="16" height="16" fill="currentColor" class="bi bi-power me-2" viewBox="0 0 16 16">
                                <path d="M7.5 1v7h1V1h-1z"/>
                                <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
                            </svg>
                            Sair</a>
                    </li>
                </ul>

            </div>
        </div>
        <div class="col-md-9">
        </div>
    </div>
</div>

</body>
</html>
