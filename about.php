<?php
$page_title = 'Nosotros';
// Obtener el nombre del archivo actual
$current_page = basename($_SERVER['PHP_SELF']);
// Verificar si es index.php
if ($current_page !== 'index.php') {
   include_once('layouts/header.php');
}
?>
<!-- about section start -->
<div class="about_section layout_padding">
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <?php $sections = find_content('historia'); ?>
            <h1 class="about_taital"><?php echo $sections[0]['name'] ?></h1>
            <p class="about_text"><?php echo $sections[0]['content'] ?></p>
            <?php if ($current_page == 'index.php') {
            ?>
               <div class="read_bt_1"><a href="about.php">Leer más</a></div>
         </div>
         <div class="col-md-6">
            <div class="about_img">
               <div class="video_bt">
                  <div class="play_icon"><img src="images/play-icon.png"></div>
               </div>
            </div>
         </div>
      </div>
   <?php
            } else {
   ?>
   </div>
   <div class="col-md-6">
      <div class="about_img">
         <div class="video_bt">
         </div>
      </div>
   </div>
</div>
<br>
<br>
<br>
<div class="row">
   <div class="col-md-6">
      <div class="about_img_2">
         <div class="video_bt">
         </div>
      </div>
   </div>
   <div class="col-md-6">
      <?php $sections = find_content('mision'); ?>
      <h1 class="about_taital"><?php echo $sections[0]['name'] ?></h1>
      <p class="about_text"><?php echo $sections[0]['content'] ?></p>
   </div>
</div>
<br>
<br>
<br>
<div class="row">
   <div class="col-md-6">
      <?php $sections = find_content('vision'); ?>
      <h1 class="about_taital"><?php echo $sections[0]['name'] ?></h1>
      <p class="about_text"><?php echo $sections[0]['content'] ?></p>
   </div>
   <div class="col-md-6">
      <div class="about_img_3">
         <div class="video_bt">
         </div>
      </div>
   </div>
</div>
<br>
<br>
<br>
<div class="row">
   <div class="col-md-6">
      <div class="about_img_4">
         <div class="video_bt">
         </div>
      </div>
   </div>
   <div class="col-md-6">
      <?php $sections = find_content('valores'); ?>
      <h1 class="about_taital"><?php echo $sections[0]['name'] ?></h1>
      <p class="about_text"><?php
                              echo $sections[0]['content'];
                              echo "<br>";
                              ?>
      </p>
      <ul id="lista-valores">
         <?php
               $data = json_decode($sections[0]['data'], true);
               foreach ($data as $key => $value) {
                  echo "<li><i><b>" . first_character($key) . ":</b> $value</i></li>";
               }
         ?>
      </ul>
   </div>
</div>
<?php
            }
?>
</div>
<br>
</div>
<!-- about section end -->
<!-- footer section start -->
<?php
// Verificar si es index.php
if ($current_page !== 'index.php') {
   include_once('layouts/footer.php');
}
?>