<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    :root {
        --header-bg-color: rgba(8, 30, 30, 0.8);
        --hero-bg-color: #7387bd;
        --text-color: #f4f3ef;
        --cta-bg-color: #f4f3ef;
        --mauve: #cfbaf0ff;
        --champagne-pink: #fde4cfff;
        --pink-lavender: #f1c0e8ff;
        --hitam: #060606;
        --coklat-tua: #bd8282;
        --biru-muda: #8aaeda;
        --biru-tua: #7387bd;
        --putih-bersih: #fff;
        --biru-muda1: #a6b3da;
    }

    /* footer Styling */
    html,
    body {
        height: 100%;

        margin: 0;
    }

    .main-containe {
        display: flex;
        flex-direction: column;
        min-height: 100vh;

    }

    main {
        flex-grow: 1;
    }

    .footer {
        margin-top: auto;
        padding: 20px;
        background-color: #f3f3f3;
        border-top: 1px solid #ddd;
        width: 100%;
        box-sizing: border-box;
    }

    .menu-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-left: 20px;
        padding-right: 20px;
        width: 100%;
    }

    .logo-footer {
        flex: 1;
        text-align: left;
    }

    .logo-footer img {
        height: 100px;

    }

    .footer .tentang-kami a {
        text-decoration: none;
        color: var(--hero-bg-color);
        font-weight: bold;
        flex: 1;
        text-align: center;
    }

    .footer .tentang-kami a:hover {
        text-decoration: underline;
        color: var(--coklat-tua) !important;

    }

    .footer-social {
        flex: 1;
        text-align: right;
    }

    .footer-social a {
        font-size: 20px;
        margin: 0 10px;
    }

    .footer-social a:hover {
        color: var(--coklat-tua) !important;
    }
    </style>
</head>
<div class="footer">
    <div class="menu-footer">
        <a href="" class="logo-footer"><img src="assets/logo.png" alt="logo"></a>
        <div class="tentang-kami">
            <a href="aboutus.php">Tentang Kami</a>
        </div>
        <div class="footer-social">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
    <div class="copyright">
        <p>&copy; 2024 by ECHOARTWORK</p>
    </div>
</div>