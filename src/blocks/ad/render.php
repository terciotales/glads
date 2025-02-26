<?php
$wrapper_attributes = get_block_wrapper_attributes( [] );

ob_start();
?>
    <div <?= $wrapper_attributes ?>>
        <h2>Ad Block</h2>
        <p>Ad content</p>
    </div>
<?php
echo ob_get_clean();

