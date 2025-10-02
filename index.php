<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hope4Pets – Online Pet Adoption & Rehoming</title>
    <meta
      name="description"
      content="Hope4Pets connects rescuers, shelters, and adopters to help every pet find a loving home."
    />

    <!-- Tabler Icons (local) -->
    <link
      rel="stylesheet"
      href="assets/css/icons/tabler-icons/tabler-icons.css"
    />

    <!-- Base styles (keep project styles loaded, if any) -->
    <link rel="preload" href="assets/css/styles.min.css" as="style" />
    <link rel="stylesheet" href="assets/css/styles.min.css" />

    <style>
      :root {
        --bg: #f7fbfb;
        --bg-alt: #ffffff;
        --text: #24333d;
        --muted: #5f7381;
        --primary: #5cbdb9; /* soft teal */
        --primary-600: #49a8a4;
        --accent: #8cc0de; /* soft blue */
        --success: #72c472;
        --ring: rgba(92, 189, 185, 0.35);
        --shadow: 0 10px 30px rgba(23, 43, 77, 0.08);
        --radius: 14px;
      }

      html {
        scroll-behavior: smooth;
      }
      body {
        margin: 0;
        font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica,
          Arial, "Apple Color Emoji", "Segoe UI Emoji";
        color: var(--text);
        background: var(--bg);
        line-height: 1.6;
      }

      /* Layout helpers */
      .container {
        width: 100%;
        max-width: none;
        margin: 0;
        padding-inline: 0.7rem;
      }
      .grid {
        display: grid;
        gap: 1.5rem;
      }
      .btn {
    /* Skip link */
    .skip-link { position: absolute; left: -9999px; top: auto; width: 1px; height: 1px; overflow: hidden; }
    .skip-link:focus { position: fixed; left: 0.7rem; top: 0.7rem; width: auto; height: auto; background: #fff; border: 2px solid var(--primary); padding: .5rem .75rem; border-radius: 8px; z-index: 2000; }

    /* Mobile nav backdrop */
    .nav-backdrop { position: fixed; inset: 64px 0 0 0; background: rgba(0,0,0,.35); opacity: 0; pointer-events: none; transition: opacity .2s ease; z-index: 900; }
    .nav-backdrop.show { opacity: 1; pointer-events: auto; }

    /* Filter chips */
    .chips { display: flex; gap: .5rem; flex-wrap: wrap; justify-content: center; margin: .5rem 0 1rem; }
    .chip { border: 1px solid #dbe9e8; background: #fff; color: var(--text); padding: .4rem .75rem; border-radius: 999px; cursor: pointer; font-weight: 600; transition: background .15s ease, border-color .15s ease, color .15s ease; }
    .chip:hover { background: #f2f9f8; }
    .chip[aria-pressed="true"] { background: #e9f7f6; color: var(--primary-600); border-color: #cfe8e6; }

    /* Back to top */
    .back-to-top { position: fixed; right: 12px; bottom: 14px; width: 44px; height: 44px; display: grid; place-items: center; border-radius: 50%; background: var(--primary); color: #fff; box-shadow: var(--shadow); border: 0; cursor: pointer; opacity: 0; transform: translateY(12px); pointer-events: none; transition: opacity .2s ease, transform .2s ease, background .15s ease; z-index: 1000; }
    .back-to-top:hover { background: var(--primary-600); }
    .back-to-top.show { opacity: 1; transform: none; pointer-events: auto; }

    /* Stats strip */
    .stats { padding-top: 0; }
    .stats .grid { grid-template-columns: repeat(3, 1fr); }
    .stat { display: flex; align-items: center; gap: .6rem; justify-content: center; background: #fff; border: 1px solid #e7efef; padding: .85rem 1rem; border-radius: 12px; box-shadow: var(--shadow); }
    .stat i { color: var(--primary-600); }
    .stat strong { font-size: 1.1rem; }
    @media (max-width: 800px) { .stats .grid { grid-template-columns: 1fr; } }
        appearance: none;
        border: 0;
        cursor: pointer;
        background: var(--primary);
        color: #fff;
        padding: 0.9rem 1.25rem;
        border-radius: 999px;
        font-weight: 600;
        letter-spacing: 0.2px;
        box-shadow: var(--shadow);
        transition: transform 0.15s ease, background 0.2s ease,
          box-shadow 0.2s ease;
      }
      .btn:hover {
        background: var(--primary-600);
        transform: translateY(-1px);
      }
      .btn.secondary {
        background: #e9f7f6;
        color: var(--primary-600);
        box-shadow: none;
      }
      .btn.secondary:hover {
        background: #dff1f0;
        color: var(--primary);
      }
      .btn.ghost {
        background: transparent;
        color: var(--primary-600);
        box-shadow: none;
        border: 1px solid #dbe9e8;
      }
      .btn.ghost:hover {
        background: #edf6f5;
      }

      img {
        max-width: 100%;
        height: auto;
        display: block;
      }
      section {
        padding: 72px 0;
      }
      h1,
      h2,
      h3 {
        line-height: 1.2;
        margin: 0 0 0.5rem;
      }
      h1 {
        font-size: clamp(2rem, 3.6vw + 1rem, 3.25rem);
      }
      h2 {
        font-size: clamp(1.5rem, 1.8vw + 1rem, 2rem);
      }
      p.lead {
        font-size: clamp(1rem, 0.7vw + 0.9rem, 1.2rem);
        color: var(--muted);
      }

      /* Header / Nav */
      header.site-header {
        position: sticky;
        top: 0;
        z-index: 50;
        background: rgba(255, 255, 255, 0.82);
        backdrop-filter: saturate(180%) blur(8px);
        border-bottom: 1px solid #eef3f3;
      }
      .nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: 64px;
      }
      .brand {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-weight: 800;
        font-size: 1.15rem;
        color: var(--text);
        text-decoration: none;
      }
      .brand .logo {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        display: grid;
        place-items: center;
        color: #fff;
        box-shadow: var(--shadow);
      }
      nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        gap: 1rem;
      }
      nav a {
        position: relative;
        text-decoration: none;
        color: var(--muted);
        font-weight: 700;
        padding: 0.55rem 0.8rem;
        border-radius: 8px;
      }
      nav a:hover {
        color: var(--text);
        background: #eef6f5;
      }
      nav a.active { color: var(--text); }
      nav a.active::after {
        content: "";
        position: absolute;
        left: 0.8rem;
        right: 0.8rem;
        bottom: 6px;
        height: 2px;
        background: var(--primary);
        border-radius: 2px;
      }

      .nav-cta {
        display: flex;
        align-items: center;
        gap: 0.75rem;
      }
  .only-mobile { display: none; }
      .hamburger {
        display: none;
        background: none;
        border: 0;
        font-size: 1.6rem;
        cursor: pointer;
        padding: .5rem;
        line-height: 0;
        border-radius: 10px;
      }
      .hamburger:hover { background: #eef6f5; }

      /* Mobile menu */
      @media (max-width: 900px) {
        nav.primary {
          position: fixed;
          inset: 64px 0 auto 0;
          background: #ffffff;
          border-bottom: 1px solid #eef3f3;
          transform: translateY(-110%);
          transition: transform 0.25s ease, opacity 0.25s ease;
          z-index: 1000;
          opacity: 0;
          pointer-events: none;
        }
        nav.primary.open {
          transform: translateY(0);
          opacity: 1;
          pointer-events: auto;
        }
        nav.primary ul {
          flex-direction: column;
          gap: 0;
          padding: 0.5rem;
        }
        nav.primary li a {
          display: block;
          padding: 0.8rem 1rem;
        }
        .hamburger {
          display: inline-grid;
          place-items: center;
        }
        .nav-cta {
          display: none;
        }
  .only-mobile { display: list-item; }
      }

      /* Hero */
      .hero {
        padding: 120px 0 88px;
        background: linear-gradient(
            180deg,
            rgba(92, 189, 185, 0.06),
            rgba(140, 192, 222, 0.06)
          ),
          radial-gradient(
            1200px 600px at 90% -10%,
            rgba(92, 189, 185, 0.15),
            transparent
          ),
          radial-gradient(
            900px 500px at -10% 0%,
            rgba(140, 192, 222, 0.18),
            transparent
          ),
          url('assets/images/backgrounds/product-tip.png');
        background-repeat: no-repeat;
        background-position: right -60px top -40px;
        background-size: clamp(420px, 50vw, 820px) auto;
      }
      .hero-wrap {
        display: grid;
        grid-template-columns: 1.15fr 0.85fr;
        gap: 2rem;
        align-items: center;
      }
      .hero .kickers {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #e9f7f6;
        color: var(--primary-600);
        padding: 0.35rem 0.7rem;
        border-radius: 999px;
        font-weight: 700;
        font-size: 0.8rem;
      }
      .hero-actions {
        display: flex;
        gap: 0.8rem;
        flex-wrap: wrap;
        margin-top: 1rem;
      }
  .hero-actions .btn { padding: 1rem 1.25rem; font-size: 1.05rem; }
      .hero-illus {
        position: relative;
      }
      .hero-card {
        background: var(--bg-alt);
        border: 1px solid #e7efef;
        border-radius: var(--radius);
        padding: 1rem;
        box-shadow: var(--shadow);
        width: 86%;
        margin: -1rem auto 0;
        display: flex;
        gap: 0.75rem;
        align-items: center;
      }
      .hero-card img {
        width: 64px;
        height: 64px;
        object-fit: cover;
        border-radius: 12px;
      }
      .hero-card .meta small {
        color: var(--muted);
      }
      @media (max-width: 900px) {
        .hero-wrap {
          grid-template-columns: 1fr;
        }
      }

      /* About */
      .about {
        background: var(--bg-alt);
      }
      .bullets {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-top: 1rem;
      }
      .bullet {
        background: #f5fbfb;
        border: 1px solid #e2efef;
        border-radius: 12px;
        padding: 1rem;
        display: flex;
        gap: 0.75rem;
        align-items: flex-start;
      }
      .bullet i {
        color: var(--primary-600);
        font-size: 1.25rem;
        margin-top: 0.2rem;
      }
      @media (max-width: 800px) {
        .bullets {
          grid-template-columns: 1fr;
        }
      }

      /* Steps */
      .steps {
        background: linear-gradient(180deg, #f7fbfb, #ffffff);
      }
      .steps .grid {
        grid-template-columns: repeat(3, 1fr);
      }
      .step {
        background: var(--bg-alt);
        border: 1px solid #e7efef;
        border-radius: 16px;
        padding: 1.25rem;
        box-shadow: var(--shadow);
      }
      .step .icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #ecf7f6;
        color: var(--primary-600);
        display: grid;
        place-items: center;
        font-size: 1.2rem;
        margin-bottom: 0.6rem;
      }
      @media (max-width: 900px) {
        .steps .grid {
          grid-template-columns: 1fr;
        }
      }

      /* Pets */
      .pets .grid {
        grid-template-columns: repeat(4, 1fr);
      }
      .pet-card {
        background: var(--bg-alt);
        border: 1px solid #e7efef;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow);
        display: flex;
        flex-direction: column;
        transition: transform 0.18s ease, box-shadow 0.18s ease,
          border-color 0.18s ease;
      }
      .pet-card:hover { transform: translateY(-3px); box-shadow: 0 16px 40px rgba(23,43,77,.12); border-color: #dceaea; }
      .pet-card img {
        aspect-ratio: 4/3;
        object-fit: cover;
        transition: transform 0.4s ease;
      }
      .pet-card:hover img { transform: scale(1.05); }
      .pet-card .body {
        padding: 1rem;
      }
      .pet-meta {
        display: flex;
        gap: 0.5rem 1rem;
        flex-wrap: wrap;
        color: var(--muted);
        font-size: 0.95rem;
      }
      .pet-actions {
        margin-top: 0.75rem;
      }
      @media (max-width: 1100px) {
        .pets .grid {
          grid-template-columns: repeat(3, 1fr);
        }
      }
      @media (max-width: 800px) {
        .pets .grid {
          grid-template-columns: repeat(2, 1fr);
        }
      }
      @media (max-width: 520px) {
        .pets .grid {
          grid-template-columns: 1fr;
        }
      }

      /* Donate */
      .donate {
        background: linear-gradient(
          135deg,
          rgba(92, 189, 185, 0.12),
          rgba(140, 192, 222, 0.12)
        );
        border-block: 1px solid #e2efef;
      }
      .donate .card {
        background: #fff;
        border: 1px solid #e7efef;
        border-radius: 18px;
        padding: 1.25rem;
        box-shadow: var(--shadow);
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 1rem;
        align-items: center;
      }
      @media (max-width: 680px) {
        .donate .card {
          grid-template-columns: 1fr;
        }
      }

      /* Testimonials */
      .testimonials .grid {
        grid-template-columns: repeat(3, 1fr);
      }
      .t-card {
        background: var(--bg-alt);
        border: 1px solid #e7efef;
        border-radius: 16px;
        padding: 1rem;
        box-shadow: var(--shadow);
      }
      .t-head {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
      }
      .t-head img {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
      }
      .t-card:hover .t-head img { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(23,43,77,.15); }
      .hero-illus img { transition: transform 0.5s ease; }
      .hero-illus:hover img { transform: translateY(-4px) scale(1.02); }
      .t-quote {
        color: var(--muted);
        font-style: italic;
      }
      @media (max-width: 900px) {
        .testimonials .grid {
          grid-template-columns: 1fr;
        }
      }

      /* Contact */
      .contact .grid {
        grid-template-columns: 1.1fr 0.9fr;
      }
      .card {
        background: var(--bg-alt);
        border: 1px solid #e7efef;
        border-radius: 16px;
        padding: 1rem;
        box-shadow: var(--shadow);
      }
      form.grid {
        grid-template-columns: 1fr 1fr;
      }
      .full {
        grid-column: 1 / -1;
      }
      label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.25rem;
      }
      input,
      textarea {
        width: 100%;
        border: 1px solid #dbe9e8;
        border-radius: 12px;
        padding: 0.8rem 0.9rem;
        background: #fbfefe;
        font: inherit;
        color: var(--text);
      }
      input:focus,
      textarea:focus {
        outline: 3px solid var(--ring);
        border-color: var(--primary);
      }
      textarea {
        min-height: 120px;
        resize: vertical;
      }
      @media (max-width: 900px) {
        .contact .grid {
          grid-template-columns: 1fr;
        }
        form.grid {
          grid-template-columns: 1fr;
        }
      }

      /* Footer */
      footer {
        background: #0f1720;
        color: #c7d3db;
        padding-top: 56px;
      }
      footer a {
        color: #d6eef1;
        text-decoration: none;
      }
      footer a:hover {
        text-decoration: underline;
      }
      .f-top {
        display: grid;
        grid-template-columns: 1.3fr 0.7fr 0.7fr 0.7fr;
        gap: 1.25rem;
        margin-bottom: 24px;
      }
      .f-col h3 {
        font-size: 1rem;
        margin-bottom: 0.6rem;
        color: #e6f5f6;
      }
      .f-col ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        gap: 0.4rem;
      }
      .f-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        padding: 14px 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        font-size: 0.95rem;
      }
      .socials {
        display: flex;
        gap: 0.6rem;
      }
      .socials a {
        width: 36px;
        height: 36px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        background: #12202a;
        color: #d6eef1;
      }
      .socials a:hover {
        background: #183040;
      }
      @media (max-width: 900px) {
        .f-top {
          grid-template-columns: 1fr 1fr;
        }
        .f-bottom {
          flex-direction: column;
          align-items: flex-start;
        }
      }

      /* Utilities */
      .center {
        text-align: center;
      }
      .sub {
        color: var(--muted);
      }
      .spacer {
        height: 8px;
      }

  /* Skip link */
  .skip-link { position: absolute; left: -9999px; top: auto; width: 1px; height: 1px; overflow: hidden; }
  .skip-link:focus { position: fixed; left: 0.7rem; top: 0.7rem; width: auto; height: auto; background: #fff; border: 2px solid var(--primary); padding: .5rem .75rem; border-radius: 8px; z-index: 2000; }

  /* Mobile nav backdrop */
  .nav-backdrop { position: fixed; inset: 64px 0 0 0; background: rgba(0,0,0,.35); opacity: 0; pointer-events: none; transition: opacity .2s ease; z-index: 900; }
  .nav-backdrop.show { opacity: 1; pointer-events: auto; }

  /* Filter chips */
  .chips { display: flex; gap: .5rem; flex-wrap: wrap; justify-content: center; margin: .5rem 0 1rem; }
  .chip { border: 1px solid #dbe9e8; background: #fff; color: var(--text); padding: .4rem .75rem; border-radius: 999px; cursor: pointer; font-weight: 600; transition: background .15s ease, border-color .15s ease, color .15s ease; }
  .chip:hover { background: #f2f9f8; }
  .chip[aria-pressed="true"] { background: #e9f7f6; color: var(--primary-600); border-color: #cfe8e6; }

  /* Back to top */
  .back-to-top { position: fixed; right: 12px; bottom: 14px; width: 44px; height: 44px; display: grid; place-items: center; border-radius: 50%; background: var(--primary); color: #fff; box-shadow: var(--shadow); border: 0; cursor: pointer; opacity: 0; transform: translateY(12px); pointer-events: none; transition: opacity .2s ease, transform .2s ease, background .15s ease; z-index: 1000; }
  .back-to-top:hover { background: var(--primary-600); }
  .back-to-top.show { opacity: 1; transform: none; pointer-events: auto; }

  /* Stats strip */
  .stats { padding-top: 0; }
  .stats .grid { grid-template-columns: repeat(3, 1fr); }
  .stat { display: flex; align-items: center; gap: .6rem; justify-content: center; background: #fff; border: 1px solid #e7efef; padding: .85rem 1rem; border-radius: 12px; box-shadow: var(--shadow); }
  .stat i { color: var(--primary-600); }
  .stat strong { font-size: 1.1rem; }
  @media (max-width: 800px) { .stats .grid { grid-template-columns: 1fr; } }
  /* Page load transition */
  .page-fade { opacity: 1; transform: none; transition: opacity 0.6s ease, transform 0.6s ease; }
  body.preload .page-fade { opacity: 0; transform: translateY(8px); }
  /* Prevent background scroll when mobile menu open */
  body.no-scroll { overflow: hidden; }
      /* Section headings accent */
      section h2 { position: relative; padding-bottom: 0.4rem; }
      section h2::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 56px;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--accent));
        border-radius: 3px;
      }
      section h2.center::after { left: 50%; transform: translateX(-50%); }

      /* Header shadow on scroll */
      .site-header.elevated { box-shadow: 0 6px 20px rgba(23,43,77,.08); }

      /* Scroll reveal */
      .reveal {
        opacity: 0;
        transform: translateY(16px);
        transition: opacity 0.6s ease, transform 0.6s ease;
        transition-delay: var(--delay, 0ms);
      }
      .reveal.in-view {
        opacity: 1;
        transform: none;
      }
      @media (prefers-reduced-motion: reduce) {
        * {
          transition: none !important;
        }
        .reveal {
          opacity: 1 !important;
          transform: none !important;
        }
  .page-fade { opacity: 1 !important; transform: none !important; }
      }
    </style>
  </head>

  <body class="preload">
    <a class="skip-link" href="#home">Skip to content</a>
    <!-- Header / Navigation -->
    <header class="site-header page-fade" role="banner">
      <div class="container nav" aria-label="Primary">
        <a href="#home" class="brand">
          <span class="logo" aria-hidden="true"><i class="ti ti-paw"></i></span>
          <span>Hope4Pets</span>
        </a>

        <button
          class="hamburger"
          aria-label="Toggle menu"
          aria-expanded="false"
          aria-controls="site-nav"
        >
          <i class="ti ti-menu-2"></i>
        </button>

        <nav class="primary" id="site-nav">
          <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#how">How It Works</a></li>
            <li><a href="#pets">Available Pets</a></li>
            <li><a href="#donate">Donate</a></li>
            <li><a href="#contact">Contact</a></li>
            <!-- Mobile-only auth links -->
            <li class="only-mobile"><a href="admin/authentication-login.php">Log in</a></li>
            <li class="only-mobile"><a href="admin/authentication-register.php">Sign up</a></li>
          </ul>
        </nav>
        <div class="nav-cta">
          <a class="btn ghost" href="admin/authentication-login.php">Log in</a>
          <a class="btn" href="admin/authentication-register.php">Sign up</a>
        </div>
      </div>
  </header>
  <div class="nav-backdrop" hidden></div>

    <main id="home">
      <!-- Hero -->
      <section class="hero" aria-labelledby="hero-title">
        <div class="container hero-wrap page-fade">
          <div class="reveal">
            <span class="kickers"
              ><i class="ti ti-heart"></i> Non-profit initiative</span
            >
            <h1 id="hero-title">Find a Forever Home for Every Pet</h1>
            <p class="lead">
              Connecting rescuers, shelters, and adopters in one safe platform.
            </p>
            <div class="hero-actions">
              <a class="btn" href="#pets" aria-label="Go to Available Pets"
                >Adopt Now</a
              >
              <a class="btn secondary" href="#contact" aria-label="Rehome a Pet"
                >Rehome a Pet</a
              >
            </div>
          </div>
          <div class="hero-illus reveal">
            <img
              src="assets/images/backgrounds/rocket.png"
              alt="Dogs and cats illustration"
            />
            <div
              class="hero-card reveal"
              role="note"
              aria-label="Recently adopted"
            >
              <img
                src="assets/images/products/s1.jpg"
                alt="Happy adopted dog"
              />
              <div class="meta">
                <strong>Max found his family!</strong>
                <div><small>Adopted yesterday in 2 days.</small></div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Stats strip -->
      <section class="stats" aria-label="Key stats">
        <div class="container">
          <div class="grid">
            <div class="stat reveal"><i class="ti ti-paw"></i> <strong>1,200+</strong> pets listed</div>
            <div class="stat reveal"><i class="ti ti-heart"></i> <strong>980+</strong> successful adoptions</div>
            <div class="stat reveal"><i class="ti ti-users"></i> <strong>300+</strong> shelters & rescuers</div>
          </div>
        </div>
      </section>
      <!-- About -->
      <section id="about" class="about" aria-labelledby="about-title">
        <div class="container">
          <h2 id="about-title">About Hope4Pets</h2>
          <p class="lead">
            We help pets in need find loving homes by empowering shelters,
            rescues, and individuals with a simple, safe adoption process.
          </p>
          <div class="bullets" role="list">
            <div class="bullet reveal" role="listitem">
              <i class="ti ti-shield-check" aria-hidden="true"></i>
              <div>
                <strong>Safety First</strong>
                <div class="sub">
                  Verified profiles and guided adoption to protect pets and
                  people.
                </div>
              </div>
            </div>
            <div class="bullet reveal" role="listitem">
              <i class="ti ti-search" aria-hidden="true"></i>
              <div>
                <strong>Smart Matching</strong>
                <div class="sub">
                  Filter by breed, age, and temperament to find your perfect
                  companion.
                </div>
              </div>
            </div>
            <div class="bullet reveal" role="listitem">
              <i class="ti ti-hand-heart" aria-hidden="true"></i>
              <div>
                <strong>Welfare Matters</strong>
                <div class="sub">
                  Education and post-adoption resources to ensure lifelong
                  well‑being.
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- How it works -->
      <section id="how" class="steps" aria-labelledby="how-title">
        <div class="container">
          <h2 id="how-title" class="center">How It Works</h2>
          <p class="center sub">Three simple steps to bring a pet home.</p>
          <div class="grid">
            <article class="step reveal" aria-label="Create a Profile">
              <div class="icon" aria-hidden="true">
                <i class="ti ti-user-plus"></i>
              </div>
              <h3>Step 1: Create a Profile</h3>
              <p class="sub">
                Set up your adopter or rescuer profile with preferences and
                location.
              </p>
            </article>
            <article class="step reveal" aria-label="Browse Pets">
              <div class="icon" aria-hidden="true">
                <i class="ti ti-paw"></i>
              </div>
              <h3>Step 2: Browse Pets</h3>
              <p class="sub">
                Explore available dogs, cats, and small animals ready for
                adoption.
              </p>
            </article>
            <article class="step reveal" aria-label="Connect and Adopt">
              <div class="icon" aria-hidden="true">
                <i class="ti ti-message-heart"></i>
              </div>
              <h3>Step 3: Connect & Adopt</h3>
              <p class="sub">
                Message shelters, schedule meetups, and complete the adoption.
              </p>
            </article>
          </div>
        </div>
      </section>

      <!-- Featured Pets -->
      <section id="pets" class="pets" aria-labelledby="pets-title">
        <div class="container">
          <h2 id="pets-title" class="center">Featured Pets</h2>
          <div class="chips" role="tablist" aria-label="Filter pets">
            <button class="chip" role="tab" aria-pressed="true" data-filter="all">All</button>
            <button class="chip" role="tab" aria-pressed="false" data-filter="dog">Dogs</button>
            <button class="chip" role="tab" aria-pressed="false" data-filter="cat">Cats</button>
          </div>
          <p class="center sub">
            Meet some of the lovely friends waiting for you.
          </p>
          <div class="grid">
            <!-- Card 1 -->
      <article class="pet-card reveal" data-type="dog">
              <img
                src="assets/images/products/s11.jpg"
        loading="lazy"
                alt="Bella the Labrador"
              />
              <div class="body">
                <h3>Bella</h3>
                <div class="pet-meta">
                  <span><i class="ti ti-calendar"></i> 2 yrs</span>
                  <span><i class="ti ti-dog"></i> Labrador Mix</span>
                </div>
                <div class="pet-actions">
                  <a class="btn" href="#contact">Adopt Me</a>
                </div>
              </div>
            </article>

            <!-- Card 2 -->
      <article class="pet-card reveal" data-type="cat">
              <img
                src="assets/images/products/s4.jpg"
        loading="lazy"
                alt="Milo the Tabby Cat"
              />
              <div class="body">
                <h3>Milo</h3>
                <div class="pet-meta">
                  <span><i class="ti ti-calendar"></i> 1 yr</span>
                  <span><i class="ti ti-cat"></i> Tabby</span>
                </div>
                <div class="pet-actions">
                  <a class="btn" href="#contact">Adopt Me</a>
                </div>
              </div>
            </article>

            <!-- Card 3 -->
            <article class="pet-card reveal" data-type="dog">
              <img src="assets/images/products/s5.jpg" loading="lazy" alt="Luna the Husky" />
              <div class="body">
                <h3>Luna</h3>
                <div class="pet-meta">
                  <span><i class="ti ti-calendar"></i> 3 yrs</span>
                  <span><i class="ti ti-dog"></i> Husky</span>
                </div>
                <div class="pet-actions">
                  <a class="btn" href="#contact">Adopt Me</a>
                </div>
              </div>
            </article>

            <!-- Card 4 -->
            <article class="pet-card reveal" data-type="dog">
              <img src="assets/images/products/s7.jpg" loading="lazy" alt="Coco the Mixed Breed" />
              <div class="body">
                <h3>Coco</h3>
                <div class="pet-meta">
                  <span><i class="ti ti-calendar"></i> 10 mos</span>
                  <span><i class="ti ti-dog"></i> Mixed Breed</span>
                </div>
                <div class="pet-actions">
                  <a class="btn" href="#contact">Adopt Me</a>
                </div>
              </div>
            </article>
          </div>
        </div>
      </section>

      <!-- Donate -->
      <section id="donate" class="donate" aria-labelledby="donate-title">
        <div class="container">
          <div class="card reveal">
            <div>
              <h2 id="donate-title">Your Donation Saves Lives</h2>
              <p class="sub">
                Every contribution funds rescue operations, medical care, and
                fostering for pets in need.
              </p>
            </div>
            <a class="btn" href="#" aria-label="Support Our Mission"
              >Support Our Mission</a
            >
          </div>
        </div>
      </section>

      <!-- Testimonials (Optional) -->
      <section class="testimonials" aria-labelledby="t-title">
        <div class="container">
          <h2 id="t-title" class="center">Happy Tails</h2>
          <p class="center sub">
            Stories from families who found their perfect match.
          </p>
          <div class="grid">
            <article class="t-card reveal">
              <div class="t-head">
                <img
                  src="assets/images/profile/user-1.jpg"
                  alt="Photo of Emma and Max"
                />
                <div>
                  <strong>Emma</strong>
                  <div class="sub">Adopted Max (Beagle)</div>
                </div>
              </div>
              <p class="t-quote">
                “The process was so easy and transparent. Max has brought so
                much joy to our home!”
              </p>
            </article>

            <article class="t-card reveal">
              <div class="t-head">
                <img
                  src="assets/images/profile/user-2.jpg"
                  alt="Photo of Daniel and Luna"
                />
                <div>
                  <strong>Daniel</strong>
                  <div class="sub">Adopted Luna (Husky)</div>
                </div>
              </div>
              <p class="t-quote">
                “We loved the safety checks and guidance. We knew Luna would be
                a great fit.”
              </p>
            </article>

            <article class="t-card reveal">
              <div class="t-head">
                <img
                  src="assets/images/profile/user-3.jpg"
                  alt="Photo of Ava and Milo"
                />
                <div>
                  <strong>Ava</strong>
                  <div class="sub">Adopted Milo (Tabby)</div>
                </div>
              </div>
              <p class="t-quote">
                “Such a caring community. Milo found us, and we couldn’t be
                happier.”
              </p>
            </article>
          </div>
        </div>
      </section>

      <!-- Contact -->
      <section id="contact" class="contact" aria-labelledby="contact-title">
        <div class="container">
          <div class="grid">
            <div class="card reveal">
              <h2 id="contact-title">Contact Us</h2>
              <p class="sub">
                Questions or want to rehome a pet? Send us a message and we’ll
                get back shortly.
              </p>
              <form id="contact-form" class="grid" novalidate>
                <div>
                  <label for="name">Name</label>
                  <input
                    id="name"
                    name="name"
                    type="text"
                    placeholder="Your full name"
                    required
                  />
                </div>
                <div>
                  <label for="email">Email</label>
                  <input
                    id="email"
                    name="email"
                    type="email"
                    placeholder="you@example.com"
                    required
                  />
                </div>
                <div class="full">
                  <label for="message">Message</label>
                  <textarea
                    id="message"
                    name="message"
                    placeholder="How can we help?"
                    required
                  ></textarea>
                </div>
                <div class="full">
                  <button class="btn" type="submit">Send Message</button>
                </div>
              </form>
            </div>

            <aside class="card reveal" aria-label="Organization info">
              <h3>Hope4Pets</h3>
              <p class="sub">
                We operate with local shelters and rescuers to ensure humane,
                ethical adoptions.
              </p>
              <ul
                style="
                  list-style: none;
                  padding: 0;
                  margin: 0;
                  display: grid;
                  gap: 0.6rem;
                "
              >
                <li><i class="ti ti-mail"></i> hello@hope4pets.org</li>
                <li><i class="ti ti-phone"></i> +1 (555) 123‑4567</li>
                <li><i class="ti ti-map-pin"></i> 123 Paws Ave, Petville</li>
              </ul>
              <div class="spacer"></div>
              <div class="socials">
                <a href="#" aria-label="Facebook"
                  ><i class="ti ti-brand-facebook"></i
                ></a>
                <a href="#" aria-label="Instagram"
                  ><i class="ti ti-brand-instagram"></i
                ></a>
                <a href="#" aria-label="Twitter"
                  ><i class="ti ti-brand-twitter"></i
                ></a>
              </div>
            </aside>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <footer role="contentinfo">
      <div class="container">
        <div class="f-top">
          <div class="f-col">
            <a href="#home" class="brand" style="color: #e6f5f6">
              <span class="logo" aria-hidden="true"
                ><i class="ti ti-paw"></i
              ></span>
              <span>Hope4Pets</span>
            </a>
            <p class="sub" style="margin-top: 0.5rem">
              A simple, safe way to adopt or rehome pets with love.
            </p>
          </div>
          <div class="f-col">
            <h3>Quick Links</h3>
            <ul>
              <li><a href="#about">About Us</a></li>
              <li><a href="#how">How It Works</a></li>
              <li><a href="#pets">Available Pets</a></li>
              <li><a href="#donate">Donate</a></li>
            </ul>
          </div>
          <div class="f-col">
            <h3>Resources</h3>
            <ul>
              <li><a href="#">Adoption Guide</a></li>
              <li><a href="#">Rehoming Tips</a></li>
              <li><a href="#">Care & Training</a></li>
            </ul>
          </div>
          <div class="f-col">
            <h3>Follow</h3>
            <div class="socials">
              <a href="#" aria-label="Facebook"
                ><i class="ti ti-brand-facebook"></i
              ></a>
              <a href="#" aria-label="Instagram"
                ><i class="ti ti-brand-instagram"></i
              ></a>
              <a href="#" aria-label="Twitter"
                ><i class="ti ti-brand-twitter"></i
              ></a>
            </div>
          </div>
        </div>
        <div class="f-bottom">
          <div>© 2025 Hope4Pets. All Rights Reserved.</div>
          <div style="opacity: 0.8">
            Made with <i class="ti ti-heart" aria-hidden="true"></i> for
            animals.
          </div>
        </div>
      </div>
    </footer>

  <button class="back-to-top" aria-label="Back to top" title="Back to top"><i class="ti ti-arrow-up"></i></button>

    <script>
      // Mobile menu toggle
      const burger = document.querySelector(".hamburger");
  const nav = document.querySelector("nav.primary");
  const backdrop = document.querySelector('.nav-backdrop');
      burger?.addEventListener("click", () => {
        const open = nav.classList.toggle("open");
        burger.setAttribute("aria-expanded", String(open));
        document.body.classList.toggle('no-scroll', open);
        if (backdrop) {
          backdrop.hidden = !open;
          backdrop.classList.toggle('show', open);
        }
      });
      // Close menu when clicking a link (mobile)
      nav?.querySelectorAll("a").forEach((a) =>
        a.addEventListener("click", () => {
          if (nav.classList.contains("open")) {
            nav.classList.remove("open");
            burger.setAttribute("aria-expanded", "false");
            document.body.classList.remove('no-scroll');
            if (backdrop) { backdrop.hidden = true; backdrop.classList.remove('show'); }
          }
        })
      );
      // Close when tapping backdrop
      backdrop?.addEventListener('click', () => {
        nav.classList.remove('open');
        burger.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('no-scroll');
        backdrop.hidden = true; backdrop.classList.remove('show');
      });

      // Basic client-side validation feedback (no backend)
      const form = document.getElementById("contact-form");
      form?.addEventListener("submit", (e) => {
        e.preventDefault();
        const data = new FormData(form);
        const name = data.get("name")?.toString().trim();
        const email = data.get("email")?.toString().trim();
        const message = data.get("message")?.toString().trim();
        if (!name || !email || !message) {
          alert("Please complete all fields.");
          return;
        }
        alert("Thanks! Your message has been recorded locally (no backend).");
        form.reset();
      });

      // Scroll reveal animations
      const setStagger = (nodes, step = 80) => {
        nodes?.forEach?.((el, i) =>
          el.style.setProperty("--delay", `${i * step}ms`)
        );
      };
      setStagger(document.querySelectorAll(".steps .step"));
      setStagger(document.querySelectorAll(".pets .pet-card"));
      setStagger(document.querySelectorAll(".testimonials .t-card"));
      setStagger(document.querySelectorAll(".bullets .bullet"), 60);
      setStagger(
        document.querySelectorAll(".contact .card, .contact aside.card"),
        100
      );

      const observer =
        "IntersectionObserver" in window
          ? new IntersectionObserver(
              (entries) => {
                entries.forEach((entry) => {
                  if (entry.isIntersecting) {
                    entry.target.classList.add("in-view");
                    observer.unobserve(entry.target);
                  }
                });
              },
              { threshold: 0.15 }
            )
          : null;

      document.querySelectorAll(".reveal").forEach((el) => {
        if (observer) observer.observe(el);
        else el.classList.add("in-view");
      });

      // Header shadow on scroll
      const header = document.querySelector('.site-header');
      const setHeaderElevation = () => {
        if (window.scrollY > 8) header.classList.add('elevated');
        else header.classList.remove('elevated');
      };
      setHeaderElevation();
      window.addEventListener('scroll', setHeaderElevation, { passive: true });

      // Scrollspy for active nav link
      const sections = ['home','about','how','pets','donate','contact'].map(id => ({id, el: document.getElementById(id)}));
      const links = Array.from(document.querySelectorAll('nav.primary a'));
      const activate = (id) => {
        links.forEach(a => a.classList.toggle('active', a.getAttribute('href') === `#${id}`));
      };
      const spyObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            activate(entry.target.id);
          }
        });
      }, { threshold: 0.5 });
      sections.forEach(({el}) => el && spyObserver.observe(el));

      // Page load: fade-in transition
      window.addEventListener('load', () => {
        document.body.classList.remove('preload');
      });

      // Back-to-top button
      const backToTop = document.querySelector('.back-to-top');
      const toggleTopBtn = () => {
        if (window.scrollY > 300) backToTop?.classList.add('show');
        else backToTop?.classList.remove('show');
      };
      toggleTopBtn();
      window.addEventListener('scroll', toggleTopBtn, { passive: true });
      backToTop?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

      // Featured pets filter chips
      const chips = Array.from(document.querySelectorAll('.chips .chip'));
      const petCards = Array.from(document.querySelectorAll('.pets .pet-card'));
      const setFilter = (type) => {
        petCards.forEach(card => {
          const t = card.getAttribute('data-type') || 'dog';
          const show = type === 'all' || t === type;
          card.style.display = show ? '' : 'none';
        });
      };
      chips.forEach(chip => chip.addEventListener('click', () => {
        chips.forEach(c => c.setAttribute('aria-pressed', 'false'));
        chip.setAttribute('aria-pressed', 'true');
        setFilter(chip.dataset.filter);
      }));
    </script>
  </body>
</html>
