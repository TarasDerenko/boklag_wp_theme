<?php 
function get_boklag_faq($attr = array()){
	$args = array('post_type' => 'faq');
	$title = "Часто задаваемые вопросы";

	if(isset($attr['count']))
		$args['posts_per_page'] = $attr['count'];

	if(isset($attr['title']))
		$title = $attr['title'];

	$faqs = get_posts($args);
	ob_start();
	?>
        <h3 class="help-title"><?php echo $title ?></h3>
        <div class="help-faq">
        	<?php foreach ($faqs as $faq): ?>
        		<a href="#" class="help-question"><?php echo $faq->post_title;?></a>
	            <div class="help-answer">
	            	<?php echo apply_filters('the_content',$faq->post_content);?>
	            </div>
        	<?php endforeach;?>         
        </div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode('show-faq','get_boklag_faq');