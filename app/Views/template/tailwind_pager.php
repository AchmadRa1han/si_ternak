<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation" class="flex justify-center mt-10">
    <ul class="flex items-center -space-x-px h-10 text-base">
        <?php if ($pager->hasPrevious()) : ?>
            <li>
                <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-stone-500 bg-white border border-e-0 border-stone-200 rounded-s-xl hover:bg-stone-100 hover:text-[#1a120b] transition-all duration-300">
                    <span aria-hidden="true"><i class="fas fa-angle-double-left"></i></span>
                </a>
            </li>
            <li>
                <a href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-stone-500 bg-white border border-stone-200 hover:bg-stone-100 hover:text-[#1a120b] transition-all duration-300">
                    <span aria-hidden="true"><i class="fas fa-angle-left"></i></span>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li>
                <a href="<?= $link['uri'] ?>" class="flex items-center justify-center px-4 h-10 leading-tight <?= $link['active'] ? 'text-white bg-[#1a120b] border-[#1a120b] z-10' : 'text-stone-500 bg-white border-stone-200 hover:bg-stone-100 hover:text-[#1a120b]' ?> border transition-all duration-300">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li>
                <a href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-stone-500 bg-white border border-stone-200 hover:bg-stone-100 hover:text-[#1a120b] transition-all duration-300">
                    <span aria-hidden="true"><i class="fas fa-angle-right"></i></span>
                </a>
            </li>
            <li>
                <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-stone-500 bg-white border border-stone-200 rounded-e-xl hover:bg-stone-100 hover:text-[#1a120b] transition-all duration-300">
                    <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>
