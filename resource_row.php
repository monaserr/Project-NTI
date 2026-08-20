<?php
?>
<div class="pf-resource-row">
    <div  class="pf-resource-icon" style="background: <?= htmlspecialchars($item['bg']) ?>;"><i class="bi <?= htmlspecialchars($item['icon']) ?>"></i></div>
    <div class="flex-grow-1">
        <div class="pf-resource-title"> <?= htmlspecialchars($item['title']) ?> </div>
        <p class="pf-resource-desc"> <?= htmlspecialchars($item['desc']) ?></p>
    </div
    <span class="pf-badge">
        <?= htmlspecialchars($item['badge']) ?>
    </span>
    
    <a href="<?= htmlspecialchars($item['link']) ?>" target="_blank" rel="noopener noreferrer" class="pf-link-btn text-decoration-none" title="Open Resource">
        <i class="bi bi-box-arrow-up-right"></i>
    </a>

</div>