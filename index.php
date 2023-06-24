<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;700;900&display=swap" <link
        rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="icons8-código-fonte-100.png" type="image/x-icon">
    <title>CyberGen.</title>
    <style>
        .whatsapp-fixed {
            position: fixed;
            bottom: 40px;
            right: 62px;
            z-index: 9;
        }

        .btn-whatsapp {
            background-color: #4ae054;
            color: #fff;
            border-radius: 100%;
            transition: background-color .5s;
            width: 60px !important;
            height: 60px !important;
            line-height: 70px;
            position: relative !important;
            display: block;
            transform: none !important;
            z-index: 9;
            text-align: center;
            box-shadow:
                0 1px 2px rgba(0, 0, 0, 0.07),
                0 2px 4px rgba(0, 0, 0, 0.07),
                0 4px 8px rgba(0, 0, 0, 0.07),
                0 8px 16px rgba(0, 0, 0, 0.07),
                0 16px 32px rgba(0, 0, 0, 0.07),
                0 32px 64px rgba(0, 0, 0, 0.07);
        }

        .btn-whatsapp:hover {
            background-color: #53ca5b;
        }

        .whatsapp-fixed a.video-vemo-icon.btn-whatsapp i {
            font-size: 32px;
            color: #fff;
            animation: sm-shake-animation linear 1.5s infinite;
            animation-delay: 3s;
        }

        .rs-video .animate-border .video-vemo-icon:before {
            content: "";
            border: 2px solid #fff;
            position: absolute;
            z-index: 0;
            left: 50%;
            top: 50%;
            opacity: 0;
            transform: translateX(-50%) translateY(-50%);
            display: block;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            animation: zoomBig 3.25s linear infinite;
            -webkit-animation-delay: 4s;
            animation-delay: 4s;
        }

        .rs-video .animate-border .video-vemo-icon:after {
            content: "";
            border: 2px solid #fff;
            position: absolute;
            opacity: 0;
            z-index: 0;
            left: 50%;
            top: 50%;
            transform: translateX(-50%) translateY(-50%);
            display: block;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            animation: zoomBig 3.25s linear infinite;
            -webkit-animation-delay: 3s;
            animation-delay: 3s;
        }

        .btn-whatsapp:after,
        .btn-whatsapp:before {
            border: 2px solid #30bf39 !important;
            width: 130px !important;
            height: 130px !important;
        }

        .sm-red-dot {
            position: absolute;
            right: 4px;
            top: 4px;
            width: 12px;
            height: 12px;
            margin: 0 auto;
            background: red;
            transform: scale(0);
            border-radius: 50%;
            animation-name: notificationPoint;
            animation-duration: 300ms;
            animation-fill-mode: forwards;
            animation-delay: 3s;
        }

        .quick-message {
            position: absolute;
            bottom: 4px;
            right: 88px;
            width: max-content;
            border-radius: 0;
            background: #393b39;
        }

        .line-up {
            opacity: 0;
            animation-name: anim-lineUp;
            animation-duration: 0.75s;
            animation-fill-mode: forwards;
            animation-delay: 5s;
        }

        .quick-message p {
            line-height: 40px;
            font-size: 15px;
            padding: 4px 16px;
            height: 40px;
            position: relative;
            color: #fff;
            margin: 0;
        }

        .quick-message .seta-direita:before {
            display: inline-block;
            content: "";
            vertical-align: middle;
            width: 0;
            height: 0;
            border-top: 20px solid transparent;
            border-bottom: 20px solid transparent;
            border-left: 20px solid #393b39;
            position: absolute;
            bottom: 3px;
            right: -30px;
        }

        #hover-message {
            display: none;
        }

        .whatsapp-fixed:hover #hover-message {
            display: block;
        }

        @keyframes zoomBig {
            0% {
                transform: translate(-50%, -50%) scale(.5);
                opacity: 1;
                border-width: 3px
            }

            40% {
                opacity: .5;
                border-width: 2px
            }

            65% {
                border-width: 1px
            }

            100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 0;
                border-width: 1px
            }
        }

        @keyframes sm-shake-animation {
            0% {
                transform: rotate(0) scale(1) skew(0.017rad)
            }

            25% {
                transform: rotate(0) scale(1) skew(0.017rad)
            }

            35% {
                transform: rotate(-0.3rad) scale(1) skew(0.017rad)
            }

            45% {
                transform: rotate(0.3rad) scale(1) skew(0.017rad)
            }

            55% {
                transform: rotate(-0.3rad) scale(1) skew(0.017rad)
            }

            65% {
                transform: rotate(0.3rad) scale(1) skew(0.017rad)
            }

            75% {
                transform: rotate(0) scale(1) skew(0.017rad)
            }

            100% {
                transform: rotate(0) scale(1) skew(0.017rad)
            }
        }

        @keyframes notificationPoint {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        @keyframes anim-lineUp {
            from {
                transform: translateY(100%);
            }

            to {
                opacity: 1;
                transform: translateY(0%);
            }
        }

        .collapse:not(.show) {
            display: block;
        }
    </style>

</head>

<body style="background:#1e1d2a; color: white;">
    <nav class="nav" id="nav">
        <div class="nav-title" id="title-nav"><a href="index.html" style="text-decoration: none;">CyberGen.</a></div>
        <div class="d-flex justify-content-center nav-menu">
            <a href="index.php" class="line text-nav" onclick="linkOpenNav('secao1')">Home</a>
            <a href="#about" class="line text-nav" onclick="linkOpenNav('secao2')">O que Fazemos</a>
            <a href="#modelo" class="line text-nav" onclick="linkOpenNav('secao3')">Modelos</a>
            <a href="#contato" class="line text-nav" onclick="linkOpenNav('secao4')">Contato</a>
        </div>
    </nav>

    <!-- Whatsapp botão -->
    <div class="rs-video whatsapp-fixed">
        <div class="animate-border">
            <a alt="Whatsapp" class="video-vemo-icon btn-whatsapp" aria-label="WhatsApp"
                href="http://api.whatsapp.com/send?1=pt_BR&amp;phone=5537999066606" target="_blank"
                rel="noopener noreferrer" onclick="gtag_report_conversion(undefined)">
                <i class="fab fa-whatsapp"></i>
                <div class="sm-red-dot"></div>
            </a>
        </div>
    </div>



    <div class="container d-block gtx-aport text-center ">
        <div class="row">
            <div class=" mt-5">
                <div class=" d-flex">
                    <div class="d-block gtx">
                        <div class="before_name ">Olá, meu nome é</div><br>
                        <div class="name">
                            <div class=" joaoname"><span class="nameone"> João</span> <span
                                    class="nametwo">Guilherme</span> </div>
                        </div>
                        <div class="icons">
                            <a href="https://t.me/cybergenn" target="_blank"><img src="img/icons8-telegram-48.png"
                                    alt=""></a>
                            <a href="" target="_blank"><img src="img/icons8-instagram-94.png" alt=""></a>
                            <a href="https://github.com/Joaodev777" target="_blank"><img src="img/icons8-github-48.png"
                                    alt=""></a>
                        </div>
                        <div class="div">
                            <div data-bs-toggle="modal" data-bs-target="#modalsaiba" class="btn-gtx gradient-border mb-5 btn-side">
                                <button class="btn-dark btn-general-m1 text-light"><a data-bs-toggle="modal"
                                        data-bs-target="#modalsaiba">Saiba
                                        mais</a></button>
                            </div>
                            <div href="#contato" class=" btn-gtx gradient-border mb-5 btn-con btn-side btn-si">
                                <button class="btn-dark btn-general-m1 text-light"><a href="#contato">Faça seu
                                        orçamento</a></button>
                            </div>

                        </div>
                        <a href="#about">
                            <div class="scroll-arrows">

                                <i class="fas fa-chevron-down text-light"></i>
                                <i class="fas fa-chevron-down  text-light"></i>
                            </div>
                        </a>

                    </div>


                    <div class="main">
                        <a href="saibamais.htlm" target="_blank">

                            <img src="img/svgviewer-output (8).png " class="img-abrend"
                                style="  margin-top: 20vh;    height: 35vh; " alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <i id="about"></i>
    <div class="d-block">

        <br>
        <div class="conteiner apre">
            <div class="apresentacao d-flex" style="width: 100%;background-color: rgb(37, 37, 37);">
                <div class="img-joao-gtx"><img class="border-img"
                        src="https://img.icons8.com/ios/100/000000/user--v1.png" alt="user--v1" /
                        style="border-radius: 50%;" alt="">
                </div>
                <div class="text-apre-gtx1 text-center mt-1">
                    <div class="text-center">
                        <h1>Me conhecendo</h1>
                    </div>
                    <div class="content font-5 mt-3">
                        <p>Olá, meu nome é <span class="Joao">João Guilherme</span>, um desenvolvedor web apaixonado
                            pelo que faço. Desde 2015, tenho me dedicado incansavelmente a aprimorar minhas habilidades
                            e conhecimentos nesse campo em constante evolução </p>
                    </div>
                    <div class="button gradient-border animationhover mb-5">

                        <button class="btn-dark text-light text " type="button" data-bs-toggle="modal"
                            data-bs-target="#modalsaiba">Saiba Mais</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="container-block">
        <div class="container-fluid" id="secao1">
            <div class="row">
                <div class="col-lg-6 col-md-12 align-self-center text-center" style="margin: 0 auto;">
                    <h2 class="title-section">O que Fazemos</h2>
                    <p class="description-section">
                        Somos uma agência de desenvolvimento web especializada na criação de sites personalizados para
                        empresas e empreendedores. Nossa missão é ajudar nossos clientes a alcançar seus objetivos de
                        negócio
                        através da criação de uma presença online impactante e eficaz.
                    </p>
                    <p class="description-section">
                        Durante minha jornada como desenvolvedor de software, mergulhei em diversos desafios e
                        oportunidades de
                        aprendizado que me permitiram aprimorar minhas habilidades e me tornar um especialista nessas
                        áreas. Ao
                        longo dos anos, tenho me dedicado intensamente a dominar as seguintes tecnologias:
                    </p>
                    <div class="img-cont">
                        <img src="img/icons8-html-96.png" alt="" class="card-img-top">
                        <img src="img/icons8-css-96.png" alt="" class="card-img-top">
                        <img src="img/icons8-js-96.png" alt="" class="card-img-top">
                        <img src="img/icons8-vue-js-96.png" alt="" class="card-img-top">
                        <img src="img/png-clipart-batch-file-computer-icons-computer-file-ms-dos-cmd-icon-electronics-commandline-interface.png"
                            alt="" class="card-img-top">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/sass/sass-original.svg" alt=""
                            class="card-img-top">
                    </div>
                    <button class="btn-portifolio btn-dark" style="font-family: 'Poppins', sans-serif;">
                        <a href="http://api.whatsapp.com/send?1=pt_BR&amp;phone=5537999066606"" class="
                            text-decoration-none">Entre em contato</a>
                    </button>
                </div>
                <div class="col-lg-5 col-md-12 display-teste">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="card bg-dark">
                                <img src="img/icons8-html-96.png" alt="" class="card-img-top">
                                <button class="bnt cont-btn" type="button" data-bs-toggle="modal"
                                    data-bs-target="#modalhtml">HTML</button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="card bg-dark">
                                <img src="img/icons8-css-96.png" alt="" class="card-img-top">
                                <button class="bnt cont-btn" type="button" data-bs-toggle="modal"
                                    data-bs-target="#modalcss">CSS</button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="card bg-dark">
                                <img src="img/icons8-js-96.png" alt="" class="card-img-top">
                                <button class="bnt cont-btn" type="button" data-bs-toggle="modal"
                                    data-bs-target="#meujs">JavaScript</button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="card bg-dark">
                                <img src="img/icons8-vue-js-96.png" alt="" class="card-img-top">
                                <button class="bnt cont-btn" type="button" data-bs-toggle="modal"
                                    data-bs-target="#meuvue">Vue.js</button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="card bg-dark">
                                <img src="img/png-clipart-batch-file-computer-icons-computer-file-ms-dos-cmd-icon-electronics-commandline-interface.png"
                                    alt="" class="card-img-top">
                                <button class="bnt cont-btn" type="button" data-bs-toggle="modal"
                                    data-bs-target="#modalpython">Batch</button>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="card bg-dark">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/sass/sass-original.svg"
                                    alt="" class="card-img-top">
                                <button class="bnt cont-btn" data-bs-toggle="modal"
                                    data-bs-target="#modalscss">Sass</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <i id="modelo"></i>




    <div class="container-fluid">
        <div class="row">
            <div class="models">
                <div class=" align-self-center text-center">
                    <h2 class="title-section models-title">Meus Projetos</h2>
                    <div class="grid__projetos" style="flex-direction: column;">
                        <div class="row-cont">
                            <div class="box__models">
                                <div class="content-text-hover"><a href="restaurante-exemplo/index.html">
                                        <div class="content-text">
                                            <img src="img/page-down-restaurante.png" alt="">

                                            <div class="text-card">
                                                <h2 class="h2-card">Restaurante</h2>
                                                <span>Este é um site foi desenvolvido para restaurantes, com uma página
                                                    inicial atraente. Logo
                                                    abaixo, você encontrará informações de localização e um sistema onde
                                                    os
                                                    pedido são enviados
                                                    diretamente à cozinha.</span><br>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box__models">
                        <div class="content-text-hover"><a href="loja-cell-new/index.php"">
              <div class=" content-text">
                                <img src="img/pagamento.png" alt="">

                                <div class="text-card">
                                    <h2 class="h2-card">Controle de Financeiro</h2>
                                    <span>Esse site em especifico, foi ultilizado um sistema para lhe ajudar a organizar
                                        suas finanças no
                                        dia a dia, tanto para pagamentos quanto à recebimentos. </span>
                            </a>

                        </div>

                    </div>
                </div>
            </div>
            <div class="box__models">
                <div class="content-text-hover"><a href="consorcio/index.html" target="_blank">
                        <div class="content-text">
                            <img src="img/consorcio.png" alt="">

                            <div class="text-card">
                                <h2 class="h2-card">Consórcio</h2>
                                <span>A estrutura do site é excelente, facilitando a navegação. A combinação de cores
                                    transmite
                                    profissionalismo e destaca os pontos-chave do seu negócio.</span>
                    </a>

                </div>
            </div>
        </div>
    </div>
    </div>
    <button class="btn  hover-btn" onclick="modeModal()" style="margin-left: auto;margin-right: auto;">Clique para
        mais</button>
    <div id="moreModel ">


    </div>

    </div>
    </div>

    <!-- Modal -->
    <div class="modal text-dark fade" id="modalhtml" tabindex="-1" aria-labelledby="meuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="meuModalLabel">O que é HTML?</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <h6>HTML (HyperText Markup Language) é a linguagem de marcação padrão para a criação e estruturação
                        de
                        páginas web. Ele define a estrutura e os elementos que compõem uma página, como títulos,
                        parágrafos,
                        imagens, links e muito mais. Com o HTML, você pode criar a estrutura básica de uma página web e
                        definir
                        o conteúdo que será exibido.</h6>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modalcss" tabindex="-1" aria-labelledby="meuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="meuModalLabel">O que é CSS?</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <h6>CSS (Cascading Style Sheets) é uma linguagem de estilo usada para definir a aparência e o layout
                        de
                        elementos HTML em uma página web. Com o CSS, você pode controlar a cor, o tamanho, a fonte, o
                        espaçamento e outros aspectos visuais dos elementos. Ele permite separar a estrutura e o
                        conteúdo do
                        estilo, oferecendo uma maior flexibilidade na personalização e na criação de um design atraente
                        e
                        consistente.</h6>
                </div>

            </div>
        </div>
    </div>




    <div class="contato" style="height: auto;">
        <h4 class="before_name text-center" style="color: white; font-family:'Quicksand'; text-align: center;">Entre em
            contato</h4>
        <div class="respo">
            <i id="contato"></i>
            <img src="img/logo-brando.png" alt="" class="img-foo">
            <div class="login-box">
                <form data-aos="fade-left" data-aos-delay="700" data-aos-easing="ease-in" data-aos-duration="1000"
                    action="https://formsubmit.co/joaosocial1704@gmail.com" method="POST">
                    <input type="text" name="name" class="inputs"
                        style="width: 40vh;border: none;outline: none;color: #1e1d2a;" placeholder="Seu nome"
                        required=""><br>
                    <input type="email" name="email" class="inputs"
                        style="width:40vh;border: none;outline: none;color: #1e1d2a;" placeholder="Email"
                        required=""><br>
                    <textarea class="inputs textarea" name="message" placeholder="Escreva sua mensagem"
                        style="width: 40vh;border: none;outline: none;text-align: center;"></textarea>
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="text-footer">
            <h6>Trabalhando para oferecer o melhor para você.</h6>
            <div class="icons">
                <a href=""><img src="img/icons8-telegram-48.png" alt=""></a>
                <a href=""><img src="img/icons8-twitter-48.png" alt=""></a>
                <a href=""> <img src="img/icons8-github-48.png" alt=""></a>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="meujs" tabindex="-1" aria-labelledby="meuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="meuModalLabel">O que é JS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <h6>JavaScript é uma linguagem de programação de alto nível que é executada no navegador do cliente.
                        Ele
                        permite adicionar interatividade, comportamento dinâmico e manipulação de elementos HTML em uma
                        página
                        web. Com o JavaScript, você pode responder a eventos, criar animações, validar formulários,
                        fazer
                        requisições para servidores e muito mais. É uma linguagem poderosa que permite a criação de
                        aplicativos
                        web mais ricos e interativos.</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="meuvue" tabindex="-1" aria-labelledby="meuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="meuModalLabel">O que é VueJS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <h6>
                        Vue.js é um framework JavaScript progressivo e de código aberto usado para criar interfaces de
                        usuário
                        (UI) interativas e reativas. Ele permite que você crie componentes reutilizáveis e os combine
                        para
                        construir aplicativos web complexos. O Vue.js adota uma abordagem baseada em componentes,
                        facilitando a
                        criação, manutenção e reutilização de código. Ele oferece recursos avançados, como manipulação
                        de dados
                        reativa, diretivas personalizadas, roteamento e gerenciamento de estado. Com o Vue.js, é
                        possível criar
                        aplicativos web modernos e escaláveis.</h6>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modalpython" tabindex="-1" aria-labelledby="meuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="meuModalLabel">O que é Batch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <h6>Batch Scripting (ou Windows Batch Scripting) é uma linguagem de programação utilizada no sistema
                        operacional Windows para criar scripts que automatizam tarefas relacionadas ao sistema. Os
                        arquivos em
                        lote, com a extensão ".bat", contêm uma sequência de comandos que são executados em ordem pelo
                        interpretador de comandos do Windows. </h6>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="modalsaiba" tabindex="-1" aria-labelledby="meuModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modal-co bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="meuModalLabel">Minhas Estatísticas</h5>
                    <button type="button" class="btn-close text-light" data-bs-dismiss="modal"
                        aria-label="Fechar"></button>
                </div>
                <div class="modal-body" style="max-height: 560px; overflow-y: auto;">
                    <div class="before_name">Bem Vindo!</div><br>
                    <img src="img/logo.png" alt=""
                        style="margin-right: auto;height: 150px;margin-top: 10px;margin-bottom: 10px;">
                    <div class="d-flex">
                        <div class="d-block CONT">
                            <div class="d-flex">
                                <p class="skill a">HTML</p>
                                <div class="progress">
                                    <div class="progress-done progress-done1 active" data-done="100"
                                        style="width: 100%; opacity: 1;">100%</div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <p class="skill skill2 ">CSS</p>
                                <div class="progress">
                                    <div class="progress-done progress-done2 active" data-done="90"
                                        style="width: 90%; opacity: 1;">90%</div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <p class="skill skill3">JS</p>
                                <div class="progress">
                                    <div class="progress-done progress-done3 active" data-done="75"
                                        style="width: 75%; opacity: 1;">75%</div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <p class="skill skill4">BATCH</p>
                                <div class="progress">
                                    <div class="progress-done progress-done4 active" data-done="100"
                                        style="width: 100%; opacity: 1;">100%</div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <p class="skill skill5">SCSS</p>
                                <div class="progress">
                                    <div class="progress-done progress-done5 active" data-done="100%"
                                        style="width: 100%; opacity: 1;">100%</div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>


        </div>


    </div>

    </div>
    </div>
    </div>


    <div class="modal fade " id="modalscss" tabindex="-1" aria-labelledby="meuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="meuModalLabel">O que é SCSS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p>SCSS (Sassy CSS) é uma extensão do CSS que traz recursos avançados para a estilização de páginas
                        web.
                        Ele permite escrever código CSS de forma mais eficiente e organizada, adicionando recursos como
                        variáveis, aninhamento, mixins, importação de arquivos e muito mais.</p>

                    <h2>Recursos do SCSS</h2>
                    <ul>
                        <li><strong>Variáveis:</strong> Com o SCSS, você pode definir variáveis para reutilizar valores,
                            como
                            cores, tamanhos de fonte e margens, em diferentes partes do seu código. Isso facilita a
                            manutenção e a
                            atualização de estilos em toda a sua aplicação.</li>
                        <li><strong>Aninhamento:</strong> O SCSS permite aninhar seletores CSS, tornando mais intuitiva
                            a
                            estrutura do seu código. Você pode escrever estilos para elementos aninhados dentro de
                            outros
                            elementos, tornando o código mais legível e organizado.</li>
                        <li><strong>Mixins:</strong> Outra característica poderosa do SCSS são os mixins, que permitem
                            criar
                            blocos de código reutilizáveis. Você pode definir um mixin para um conjunto de estilos e, em
                            seguida,
                            chamá-lo em diferentes partes do seu código, evitando repetição e tornando seu código mais
                            modular.
                        </li>
                        <li><strong>Importação de arquivos:</strong> O SCSS oferece suporte à importação de arquivos,
                            permitindo
                            dividir seu código em vários arquivos SCSS menores e importá-los conforme necessário. Isso
                            ajuda a
                            organizar seus estilos em módulos independentes e facilita a colaboração em projetos
                            maiores.</li>
                    </ul>

                    <p>Para utilizar o SCSS, você precisa compilar seu código em CSS regular, que é o formato entendido
                        pelos
                        navegadores. Felizmente, existem várias ferramentas disponíveis, como o compilador SASS ou
                        pré-processadores integrados em frameworks de desenvolvimento front-end, que fazem a compilação
                        automaticamente durante o processo de construção.</p>

                    <p>O SCSS é uma ferramenta poderosa para estilização de páginas web, permitindo que você escreva CSS
                        de
                        forma mais eficiente, modular e fácil de manter. Ao adotar o SCSS, você pode melhorar
                        significativamente
                        o fluxo de trabalho de desenvolvimento front-end e criar estilos mais robustos e escaláveis para
                        seus
                        projetos.</p>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.emailjs.com/sdk/2.6.4/email.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/fc1c19f0f3.js" crossorigin="anonymous"></script>
    <script>
        // modal aparecencimaneto

    </script>
</body>

</html>
