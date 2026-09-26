<?php if (isset($_SESSION['aviso'])): ?>
    <section class="avisos">
        <div>
            <p><?= $_SESSION['aviso'] ?></p>
        </div>
    </section>

    <?php unset($_SESSION['aviso']); ?>

<?php endif; ?>