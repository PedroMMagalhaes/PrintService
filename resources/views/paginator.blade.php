<?php
    $presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
?>

<?php if ($paginator->getLastPage() > 1): ?>
    <ul class="pagination">
        <?php echo $presenter->render(); ?>
        <li>
            <?php
                echo Form::open(array('url' => $paginator->getUrl(0), 'method' => 'GET'));
            ?>
            <input type="number" name="page" min="0" max="<?php echo $paginator->getLastPage(); ?>" value="<?php echo $paginator->getCurrentPage(); ?>" placeholder="Page #" class="form-control" style="width: 150px; float: left; margin-left: 20px;">
            <?php echo Form::close(); ?>
        </li>
    </ul>
<?php endif; ?>
