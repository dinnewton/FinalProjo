<div class="container">
  <h3>Administrator Panel<?php echo $_SESSION['ADMIN_UNAME']; ?></h3>

  <div class="panel-group" id="accordion">


    <?php if ($_SESSION['ADMIN_UROLE'] == "Administrator") { ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapsesix">
              Welcome Mr Newton, Glad you are here to manage.
            </a>
          </h4>
        </div>
        <div id="collapsesix" class="panel-collapse collapse">
          <div class="panel-body">
            <a href="#">HERE.</a>
          </div>
        </div>
      </div>

    <?php } ?>
  </div>
</div>