<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
        :root {
            --primary-color: #00292b;
            --primary-color-dark: #001111;
            --secondary-color: #c58255;
            --white: #ffffff;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f0f0f0;
            font-family: sans-serif;
            background-image: linear-gradient(to right, var(--primary-color-dark), var(--primary-color));
            min-height: 100vh;
            display: flex;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: row;
        }

        .container__right {
            flex: 1;
            background-color: var(--primary-color-dark);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .right__content {
            text-align: right;
            max-width: 400px;
        }

        .right__content h4 {
            margin-bottom: 1rem;
            font-size: 2rem;
            font-weight: 600;
            color: var(--secondary-color);
        }

        .right__content p {
            color: var(--white);
        }

        .container__left {
            flex: 1.5;
            position: relative;
            background-image: url("uploaded/lp2.jpg");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .left__content {
            text-align: left;
            max-width: 600px;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 2rem;
            border-radius: 1rem;
        }

        .left__content h1 {
            font-size: 3rem;
            font-weight: 600;
            line-height: 3.5rem;
            color: var(--secondary-color);
        }

        .left__content h4 {
            margin-bottom: 2rem;
            font-size: 1.5rem;
            font-weight: 500;
            color: var(--white);
        }

        .left__content p {
            margin-bottom: 3rem;
            color: var (--white);
        }

        .btn {
            margin-bottom: 3rem;
            min-width: 120px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            outline: none;
            border: 1px solid var(--secondary-color);
            cursor: pointer;
        }

        .primary__btn {
            margin-right: 1rem;
            color: var(--primary-color);
            background-color: var(--secondary-color);
        }

        .secondary__btn {
            color: var(--secondary-color);
            background-color: transparent;
        }

        .socials {
            padding-top: 20px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 1.5rem;
        }

        .socials span {
            font-size: 1.5rem;
            color: var(--white);
            cursor: pointer;
            transition: 0.3s;
        }

        .socials span:hover {
            color: var(--secondary-color);
        }

        @media (width < 780px) {
            nav {
                justify-content: center;
            }

            .nav__links {
                gap: 1rem;
            }

            .container {
                flex-direction: column;
            }

            .container__right {
                min-height: 700px;
            }

            .right__content {
                max-width: none;
                margin: 6rem 0;
                text-align: center;
            }

            .container__left {
                min-height: 700px;
                background-position: top;
            }

            .left__content {
                text-align: center;
                margin: 8rem auto;
            }

            .socials {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="container__left">
            <div class="left__content">
                <h1>DREAMWEARLY</h1>
                <h4>Toko Baju Online Ter-Estetik</h4>
                <p>
                Selamat datang di Dreamwearly.co, tempat di mana fashion bertemu dengan keanggunan
                dalam gaya dan keindahan. Koleksi kami yang terbukti dengan cermat dirancang
                untuk memikat nilai estetika, menawarkan perpaduan antara klasik yang abadi dan 
                tren kekinian. 

                
                </p>
                <div class="action__btns">
                    
                <a href="produk.php" class="btn primary__btn">SHOP NOW!!!</a>
                </div>
                <div class="socials ">
                    <a href="https://instagram.com"><span><i class="ri-instagram-line"></i></span></a>
                    <a href="https://x.com/home"><span><i class="ri-twitter-fill"></i></span></a>
                    <a href="https://facebook.com"><span><i class="ri-facebook-fill"></i></span></a>
                </div>
            </div>
        </div>
        <div class="container__right">
            <div class="right__content">
                <h4>Baju-Baju Import dan Premium</h4>
                <p>
                Di Dreamwearly.co, kami percaya bahwa pakaian adalah lebih dari sekadar kain. Potongan estetik kami dibuat 
                dengan perhatian terhadap detail, menggunakan bahan berkualitas premium yang memastikan 
                kenyamanan dan daya tahan. Apakah Anda mencari gaun sempurna untuk acara spesial atau 
                pakaian sehari-hari yang anggun, koleksi kami menjanjikan untuk meningkatkan lemari 
                pakaian Anda dan memperkuat gaya pribadi Anda.
                </p>
            </div>
        </div>

    </div>
    
    
</body>

</html>
