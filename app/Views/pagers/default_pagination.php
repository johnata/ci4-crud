<!-- Limit to 3 Links each side of the current page -->
<?php $pager->setSurroundCount(3)  ?>
<!-- END-->
 
<div class="row">
    <!-- Pagination --> 
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <ul class="pagination">
            <!-- Previous and First Links if available -->
            <?php if($pager->hasPrevious()): ?>
                <li class="page-item">
                    <a href="<?= $pager->getFirst() ?>" class="page-link">Primeira</a>
                </li>
                <li class="page-item">
                    <a href="<?= $pager->getPrevious() ?>" class="page-link">Anterior</a>
                </li>
            <?php endif; ?>
            <!-- End of Previous and First -->
 
            <!-- Page Links -->
            <?php foreach($pager->links() as $link): ?>
            <?php
            // dd($link);
            ?>
                <li class="page-item <?= $link['active'] ? 'active' : '' ?>"><a class="page-link" href="<?= $link['uri'] ?>"><?= $link['title'] ?></a></li>
            <?php endforeach; ?>
            <!-- End of Page Links -->
 
            <!-- Next and Last Page -->
            <?php if($pager->hasNext()): ?>
                <li class="page-item">
                    <a href="<?= $pager->getNext() ?>" class="page-link">Próxima</a>
                </li>
                <li class="page-item">
                    <a href="<?= $pager->getLast() ?>" class="page-link">Última</a>
                </li>
            <?php endif; ?>
            <!-- End of Next and Last Page -->
        </ul>
    </div>
    <!-- End of Pagination -->
   
    <!-- Pagination Details -->
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="fw-light fs-italic text-muted text-end">
            Showing <?= $pager->getPerPageStart() ?> to <?= $pager->getPerPageEnd() ?> of <?= $pager->getTotal() ?> results
        </div>
    </div>
    <!-- End of Pagination Details -->
</div>