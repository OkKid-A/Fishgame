<?php

require __DIR__ . '/../src/controller/store.php';
require __DIR__ . '/../src/controller/index.php';
?>

<?php ver_inc('header', ['title' => 'Inicio'])?>

<!-- Wrapper -->
<div id="wrapper">
  <!-- Main -->
  <div id="main">
    <div class="inner">

      <!-- Header -->
      <header id="header">
        <a href="../index.html" class="logo"><strong>FishGame</strong></a>
      </header>

      <!-- Content -->
      <section>
        <header class="main">
          <h1>Personajes</h1>
        </header>
      </section>

     <section>
       <h1>Crear Personaje</h1>
       <form action="../src/controller/" method="post">
         <div>
           <label for="name">Nombre del Personaje:</label>
           <input type="text" name="name" id="name" value="<?= $inputs['name'] ?? '' ?>"
                  class="<?= error_class($errors, 'name') ?>">
           <small><?= is_null($errors['name']) ?   ''  : implode(" ",$errors['name']) ?></small>
         </div>
         <div>
           <p>
             <label for="trofico">Nivel Trofico</label>
             <select name="trofico" id="trofico" onchange="showSection()">
               <option value="">Select...</option>
               <?php
               $troficos = retrive_tropics();
               foreach ($troficos as $trofico) : ?>
                 <option value="<?= $trofico['jerarquia']?>"><?= $trofico['nombre']?></option>
               <?php endforeach; ?>
             </select>
           </p>
         </div>


           <?php
           $troficos = retrive_tropics();
           foreach ($troficos as $trofico):?>
               <div id="section<?=$trofico['id']?>">
                   <?php $categorias = retrieve_categories($trofico['id']);
                   ?>
           <?php foreach ($categorias as $categoria) : ?>
                   <label for="<?= $categoria['nombre']?>">Categoria <?= $categoria['nombre']?></label>
               <select name="<?= $categoria['nombre']?>" id="<?= $categoria['nombre']?>">
                   <option value="">Select...</option>
                   <?php $partes = retrieve_parts(get_user_id(),$categoria['id'])?>
            <?php foreach ($partes as $parte) : ?>
                <option value="<?= $parte['nombre']?>"><?= $parte['nombre']?></option>
            <?php endforeach; ?>
               </select>
           <?php endforeach;?>
           </div>
           <?php endforeach; ?>
         <div>
           <button type="submit">Crear Personaje</button>
         </div>
       </form>
     </section>

    </div>
  </div>

  <!-- Sidebar -->
  <div id="sidebar">
    <div class="inner">

      <!-- Search -->
      <section id="logout" class="alt">
        <a href="../src/controller/logout.php" class="button">Cerrar Sesion</a>
      </section>

      <!-- Menu -->
      <nav id="menu">
        <header class="major">
          <h2>Menu</h2>
        </header>
        <ul>
          <li><a href="../index.html">Personajes</a></li>
          <li><a href="../index.html.html">Botin</a></li>
        </ul>
      </nav>

      <!-- Footer -->
      <footer id="footer">
        <p class="copyright">&copy; Untitled. All rights reserved. Demo Images: <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
      </footer>

    </div>
  </div>

</div>

<!-- Scripts -->
<script>
    function showSection() {
        const option = document.getElementById("trofico").value;
        document.getElementById("section1 ").style.display = "none";
        document.getElementById("section2 ").style.display = "none";

        if (option === "1") {
            document.getElementById("section1 ").style.display = "block";
        } else if (option === "2") {
            document.getElementById("section2 ").style.display = "block";
        }
    }
</script>
<?php ver_inc('footer');?>
