<?php if ($session->msg()) : ?>
  <?php
  // Verifica si el mensaje es un array y conviértelo en string
  $msg = $session->msg();
  if (is_array($msg)) {
    $msg = implode(', ', $msg); // Convertir array en string
  }
  ?>
  <!-- Modal HTML -->
  <div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="msgModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="msgModalLabel">Información</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); // Imprimir mensaje sanitizado
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo HTTP_SERVER_ROOT; ?>/libs/js/functions.js"></script>
</body>

</html>

<?php if (isset($db)) {
  $db->db_disconnect();
} ?>