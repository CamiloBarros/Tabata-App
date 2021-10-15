<?php if(isset($_SESSION['message'])) {?>
    <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <script>console.log("entro")</script>
        <?=$_SESSION['message'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php unset($_SESSION['message']); } ?>
<!-- session_unset(); ?>-->