<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JVP Engenharia</title>
  <!-- Font Awesome e CSS -->
  <link rel="stylesheet" href="/JVP/public/css/all.min.css">
  <link rel="stylesheet" href="/JVP/public/css/fontawesome.min.css">
  <link rel="stylesheet" href="/JVP/public/css/home.css">
</head>
<body>
<!-- HEADER -->
<header>
  <img src="/JVP/public/img/logo.jpg" alt="JVP Engenharia">

  <div class="menu">
      <i onclick="show()" class="fas fa-bars"></i>
  </div>

  <div class="op">
      <a href="#Home">Home</a>
      <a href="#Sobre">Sobre nós</a>
      <a href="#Servicos">Serviços</a>
      <a href="#Contatos">Contatos</a>
  </div>

  <div class="social">
      <a href="#"><img src="/JVP/public/img/instagram-brands.svg" alt="Instagram"></a>
      <a href="#"><img src="/JVP/public/img/facebook-brands (1).svg" alt="Facebook"></a>
      <a href="#"><img src="/JVP/public/img/whatsapp-brands.svg" alt="WhatsApp"></a>
      <a href="#"><img src="/JVP/public/img/linkedin-brands.svg" alt="LinkedIn"></a>
  </div>

  <div id="op-menu" class="op-menu">
      <i onclick="close1()" id="close" class="fas fa-close"></i>
      <div class="op-menu-caixa">
      <a href="#Home">Home</a>
      <br>
      <a href="#Sobre">Sobre</a>
      <br>
      <a href="#Servicos">Serviços</a>
      <br>
      <a href="#Contatos">Contatos</a>
      </div>
  </div>
</header>

<!-- PRIMEIRA SESSÃO -->
<section class="hero" id="Home" style="background-image: url('/JVP/public/img/img1 (1).jpeg');">
  <div class="overlay"></div>
  <div class="hero-content">
    <h1 class="h11">Construa com Confiança,<br><span>Engenharia que Transforma</span></h1>
    <p>Projetamos estruturas seguras, modernas e eficientes. Da ideia ao concreto, somos seu parceiro técnico completo.</p>
    <a href="#contato">Fale com a gente</a>
  </div>
</section>

<!-- SEGUNDA SECTION -->
<section class="container" id="Sobre">
    <div class="text-section" id="text-section">
      <h1>JVP Engenharia: construindo confiança e excelência por mais de 35 Anos.</h1>
      <p>Desde 1989, a <strong>JVP Engenharia</strong> entrega soluções inteligentes e seguras para projetos estruturais, pareceres técnicos e execução de obras. Com mais de 500 projetos realizados em Rio das Ostras e em diversas regiões do Brasil, somos reconhecidos por transformar ambientes e encantar pessoas.</p>

      <h2>Por que escolher a JVP Engenharia?</h2>
      <ul>
        <li><strong>Experiência comprovada</strong> mais de três décadas garantindo segurança e qualidade em cada detalhe.</li>
        <li><strong>Serviços completos</strong> de projetos estruturais a pareceres técnicos e ensaios avançados e instalações prediais.</li>
        <li><strong>Compromisso com você</strong> de honestidade, praticidade e eficiência que fazem a diferença.</li>
      </ul>
      <button class="btn">Saiba mais</button>
    </div>

    <div class="image-grid">
      <img src="/JVP/public/img/servico1.webp" alt="Imagem 1">
      <img src="/JVP/public/img/2.webp" alt="Imagem 2">
      <img src="/JVP/public/img/3.webp" alt="Imagem 3">
      <img src="/JVP/public/img/4.webp" alt="Imagem 4">
    </div>
</section>

<!-- comentários -->
<div class="testimonial-box">
    <div class="testimonial-content">
      <div class="testimonial-quote">“</div>
      <p id="testimonial-text">
        Em busca de segurança, qualidade e economicidade, contratei os serviços da JVP engenharia para execução do cálculo estrutural, instalação elétrica e hidrossanitária de uma obra com 3 pavimentos em arraial do cabo. Minha experiência foi a melhor possível, pois a equipe sempre se manifestou solícita e cordial em todos os momentos para de pronto tirar dúvidas durante a execução e apresentar alternativas para superamos algumas intercorrências que surgiram. Diante do exposto, encaminho este depoimento como forma de agradecimento a todos da JVP
      </p>
      <button class="nav left" onclick="changeTestimonial(-1)">&#10094;</button>
      <button class="nav right" onclick="changeTestimonial(1)">&#10095;</button>
    </div>
    <div class="testimonial-person">
      <img id="testimonial-img" src="/JVP/public/img/avatar1.webp" alt="Foto">
      <h3 id="testimonial-name">João Paulo Develly de Castro</h3>
      <p id="testimonial-role">Empresário</p>
    </div>
  </div>

<!-- terceira sessão -->
<section class="sec3" id="Servicos">
  <h2 class="title" style=" margin: 50px 0px 0px 10px; ">Nossos Serviços</h2>

  <div class="grid-container" style="margin-top: 30px;">
    <div class="card">
      <img src="/JVP/public/img/servico1.webp" alt="Projetos Estruturais" />
      <div class="content">
        <h3>Projetos Estruturais</h3>
        <p>Projetamos fundações com precisão e segurança. Estruturas firmes e confiáveis que não comprometem a qualidade.</p>
      </div>
    </div>

    <div class="card">
      <img src="/JVP/public/img/servico2.webp" alt="Pareceres Técnicos" />
      <div class="content">
        <h3>Pareceres Técnicos</h3>
        <p>Relatórios técnicos imparciais e detalhados para apoio judicial e resolução de problemas estruturais.</p>
      </div>
    </div>

    <div class="card">
      <img src="/JVP/public/img/3.webp" alt="Laudos Técnicos" />
      <div class="content">
        <h3>Laudos Técnicos</h3>
        <p>Análises completas para garantir soluções eficazes e em conformidade com normas vigentes.</p>
      </div>
    </div>

    <div class="card">
      <img src="/JVP/public/img/servi4.webp" alt="Ensaios e Testes" />
      <div class="content">
        <h3>Ensaios e Testes</h3>
        <p>Métodos avançados para testar resistência e segurança dos materiais do seu projeto.</p>
      </div>
    </div>

    <div class="card">
      <img src="/JVP/public/img/projeto-estrutural-saindo-do-papel-qxxhhwg6hryyqj5417glz312lr79wuj0v4jjsvfsxk (1).webp" alt="Perícia Judicial" />
      <div class="content">
        <h3>Perícia Judicial</h3>
        <p>Inspeções planejadas e laudos técnicos para decisões fundamentadas e justas.</p>
      </div>
    </div>

    <div class="card">
      <img src="/JVP/public/img/img1 (1).jpeg" alt="Outros Serviços" />
      <div class="content">
        <h3>Outros Serviços</h3>
        <p>Projetos de sistemas elétricos, hidráulicos e sanitários para garantir o melhor funcionamento da sua construção.</p>
      </div>
    </div>
  </div>

  <div class="btn-container">
    <a href="#" class="btn">Saiba mais</a>
  </div>
</section>

<!-- linha do tempo -->
<p class="tt-linha-d-tempo">Elevador do tempo</p>
<div class="elevator-container">
  <div class="shaft">
    <div class="elevator" id="elevator">
      <div class="floor" id="floor-1989">
        <h1><i class="fas fa-flag"></i> 1989 - Início</h1>
        <p>Fundada em 1989, a JVP Engenharia iniciou sua atuação no mercado de engenharia civil, oferecendo serviços de execução de obras.</p>
      </div>
      <div class="floor" id="floor-1995">
        <h1><i class="fas fa-chart-line"></i> 1995 - Expansão de Serviços</h1>
        <p>Ampliação dos serviços com a inclusão de pareceres técnicos e visitas técnicas, atendendo à crescente demanda por soluções especializadas.</p>
      </div>
      <div class="floor" id="floor-2007">
        <h1><i class="fas fa-city"></i> 2007 - Impacto em Rio das Ostras</h1>
        <p>Mais de 100 projetos realizados em Rio das Ostras, incluindo projetos estruturais, consolidando a JVP como referência regional.</p>
      </div>
      <div class="floor" id="floor-2015">
        <h1><i class="fas fa-flask"></i> 2015 - Mais Expansão</h1>
        <p>Introdução de ensaios e testes especializados, como resistência do concreto e esclerometria.</p>
      </div>
    </div>
    <div class="doors" id="doors">
      <div class="door left"></div>
      <div class="door right"></div>
    </div>
  </div>
  <div class="panel">
    <button onclick="goToFloor(0)"><i class="fas fa-flag"></i>1989</button>
    <button onclick="goToFloor(1)"><i class="fas fa-chart-line"></i>1995</button>
    <button onclick="goToFloor(2)"><i class="fas fa-city"></i>2007</button>
    <button onclick="goToFloor(3)"><i class="fas fa-flask"></i>2015</button>
  </div>
</div>

<!-- footer -->
<footer class="footer" id="Contatos">
  <div class="footer-content">
    <div class="footer-logo">
      <img src="/JVP/public/img/Logo-JVP-branca.webp" alt="JVP Engenharia">
      <p>JVP Engenharia</p>
      <div class="social-icons">
        <a href="#"><img src="/JVP/public/img/facebook-brands (1).svg" alt="Facebook"></a>
        <a href="#"><img src="/JVP/public/img/instagram-brands.svg" alt="Instagram"></a>
        <a href="#"><img src="/JVP/public/img/linkedin-brands.svg" alt="LinkedIn"></a>
        <a href="#"><img src="/JVP/public/img/whatsapp-brands.svg" alt="WhatsApp"></a>
      </div>
    </div>

    <div class="footer-column">
      <h4>Institucional</h4>
      <ul>
        <li><a href="#Home">Home</a></li>
        <li><a href="#Projetos">Projetos</a></li>
        <li><a href="#">Cursos</a></li>
        <li><a href="#Contatos">Contato</a></li>
      </ul>
    </div>

    <div class="footer-column">
      <h4>Sobre JVP</h4>
      <ul>
        <li>Cálculo Estrutural</li>
        <li>Estrutura Metálica e Concreto</li>
        <li>Alvenaria Estrutural</li>
        <li>Projetos Elétricos e Hidráulicos</li>
        <li>Laudos</li>
      </ul>
    </div>

    <div class="footer-column">
      <h4>Contato</h4>
      <ul>
        <li><i class="fas fa-phone-alt"></i> (22) 2760-8090</li>
        <li><i class="fab fa-whatsapp"></i> (22) 9 9223-9914</li>
        <li><i class="fas fa-envelope"></i> jvp@jvp.eng.br</li>
        <li><i class="fas fa-map-marker-alt"></i> Rua Frei Damião, 345 - Rio das Ostras - RJ</li>
      </ul>
    </div>
  </div>
</footer>

<script src="/JVP/public/js/home.js"></script>
<script>
    var menu = document.getElementById('op-menu');
    function show() {
        menu.style.display="flex";
    }
    function close1() {
        menu.style.display="none";
    }

    // SCRIPT DA SEGUNDA SESSÃO
    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
          if (entry.target.classList.contains('text-section')) {
            entry.target.classList.add('reveal');
          } else if (entry.target.tagName === 'IMG') {
            setTimeout(() => {
              entry.target.classList.add('reveal');
            }, index * 200);
          }
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.image-grid img, .text-section').forEach(el => {
      observer.observe(el);
    });

    // linha do tempo
    const elevator = document.getElementById('elevator');
    const doors = document.getElementById('doors');

    function goToFloor(floor) {
      doors.classList.remove('open');
      setTimeout(() => {
        elevator.style.transform = `translateY(-${floor * 100}vh)`;
      }, 300);
      setTimeout(() => {
        doors.classList.add('open');
      }, 2300);
    }

    // Inicial: abrir portas
    window.onload = () => {
      setTimeout(() => doors.classList.add('open'), 800);
    };
</script>
</body>
