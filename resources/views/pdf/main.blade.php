<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PDF</title>
    <link rel="stylesheet" href="/pdf/style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="/pdf/logo.png">
      </div>
      <div id="logo">
        <h2 class="name">Leal Enterprise</h2>
        <div>Mazatlán, Sinaloa, México</div>
        <div>(669) 1971749</div>
        <div><a href="mailto:lealheda@gmail.com">lealheda@gmail.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div>
          @yield('content')
      </div>
      <div id="thanks">¡Gracias!</div>
      <div id="notices">
        <div>NOTA:</div>
        <div class="notice">Documentos de la empresa @Leal Enterprise.</div>
      </div>
    </main>
    <footer>
      Documento creado en computadora, no es valido sin firma y sello.
    </footer>
  </body>
</html>