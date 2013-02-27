<?php echo head(array('bodyid'=>'home', 'bodyclass' =>'two-col')); ?>

<div id="primary">
    <div id="homepage-text">
	<?php if ($homepageText = get_theme_option('Homepage Text')): ?>
    <p><?php echo $homepageText; ?></p>
	</div>
    <?php endif; ?>

    <!-- Featured Collection -->
    <?php if (get_theme_option('content') === 'collection'): ?>
    <div id="featured-collection">
		<?php $collections=get_records("collection", array("public"=>"true","featured"=>"true"));
		$current_collection=end($collections);?>
		<h2><?php echo metadata($current_collection, array('Dublin Core', 'Title'));?></h2>
		<?php if (get_theme_option('photo')):?>
			<div id="main_image">
				<img src="<?php echo absolute_url('files/theme_uploads/'.get_theme_option('photo'));?>">
			</div>
		<?php endif?>
		<p><?php echo metadata($current_collection, array('Dublin Core', 'Description'));?></p>
    </div>
	<div>
		<h2><?php echo __('Collection Images'); ?></h2>
		<div id="lesphotos">
		<?php $items=get_records("item", array("collection"=>$current_collection));
		$num=0;
		foreach ($items as $item){			
			
				foreach($item->Files as $file) {
					if ($file->hasThumbnail()):?>
				<a href="<?php echo metadata($file, 'uri');?>"><img src="<?php echo metadata($file, 'square_thumbnail_uri');?>"></a>
			<?php endif;}
			$num++;}?>
		</div>
	</div>
    <?php endif; ?>
	<!-- end featured collection -->


    <!-- Featured Exhibit -->
	<?php if (get_theme_option('content') === 'exhibit' && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
    <?php echo exhibit_builder_display_random_featured_exhibit(); ?>
    <?php endif; ?>
	<!-- end Featured Exhibit -->
	
	<!-- Recent Items -->
		<?php if (get_theme_option('content') === 'items'): ?>
    <div id="recent-items">
        <h2><?php echo __('Recent Items'); ?></h2>
        <?php 
        $homepageRecentItems = (int)get_theme_option('Homepage Recent Items') ? get_theme_option('Homepage Recent Items') : '3';
        set_loop_records('items', get_recent_items($homepageRecentItems));
        if (has_loop_records('items')): 
        ?>
        <ul class="items-list">
        <?php foreach (loop('items') as $item): ?>
        <li class="item">
            <h3><?php echo link_to_item(); ?></h3>
            <?php if($itemDescription = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>150))): ?>
                <p class="item-description"><?php echo $itemDescription; ?></p>
            <?php endif; ?>						
        </li>
        <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p><?php echo __('No recent items available.'); ?></p>
        <?php endif; ?>
        <p class="view-items-link"><?php echo link_to_items_browse(__('View All Items')); ?></p>
		<?php endif; ?>
    </div><!-- end recent-items -->

</div><!-- end primary -->

<div>
	<audio class="projekktor speakker dark">
	</audio>
</div>

<?php echo foot(); ?>