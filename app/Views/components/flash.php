<?php if (session()->getFlashdata('success')) : ?>
    <script>
        swal({
            title: "Success!",
            text: "<?= session()->getFlashdata('success'); ?>",
            icon: "success",
        });
    </script>
<?php elseif (session()->getFlashdata('error')) : ?>
    <script>
        swal({
            title: "Oops!",
            text: "<?= session()->getFlashdata('error'); ?>",
            icon: "error",
        });
    </script>
<?php endif; ?>