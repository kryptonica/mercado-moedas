<?php if ($this->session->flashdata('alertas')): ?>
    <?php foreach ($this->session->flashdata('alertas') as $alerta): ?>
        <div class="<?php echo $alerta['class']; ?> alert-dismissible text-center">
            <?php echo $alerta['mensagem'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endforeach; ?>
 <?php $this->session->set_flashdata('alertas', null); ?>
<?php endif; ?>