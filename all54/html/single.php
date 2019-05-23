<?php
/**
* The Template for displaying all single posts.
*
* @package cactus
*/
//
$post_format = get_post_format();
if($post_format == 'video') {
get_template_part('single-video');
return;
}
$query=get_the_ID();
global $wpdb;
$postObject=get_post($query);
$doctors=get_field('doctorsss',$query);
get_header();
$videopro_sidebar = get_post_meta(get_the_ID(),'post_sidebar',true);
if(!$videopro_sidebar){
$videopro_sidebar = ot_get_option('post_sidebar','right');
}
if($videopro_sidebar == 'hidden') $videopro_sidebar = 'full';
$videopro_page_title = videopro_global_page_title();
$videopro_layout = videopro_global_layout();
$videopro_sidebar_style = 'ct-small';
videopro_global_sidebar_style($videopro_sidebar_style);
$videopro_post_layout = videopro_global_post_layout();
?>
<style>.cactus-sidebar.ct-small{display:none !important;}
.cactus-row{margin-left:0 !important; margin-right:0 !important;}</style>
<div id="cactus-body-container">
<div class="cactus-sidebar-control <?php if($videopro_sidebar != 'full' && $videopro_sidebar != 'left'){?>sb-ct-medium<?php }if($videopro_sidebar != 'full' && $videopro_sidebar != 'right'){?> sb-ct-small<?php }?>"> 
<div class="cactus-container <?php if($videopro_layout == 'wide'){ echo 'ct-default';}?>">                        	
<div class="wrapper">
<div class="cactus-row">
<?php if($layout=='boxed'&& $sidebar=='both'){?>
<div class="open-sidebar-small open-box-menu"><i class="fa fa-bars"></i></div>
<?php }?>
<?php if($sidebar!='full' && $sidebar!='right'){ get_sidebar('left'); } ?>
<?php if(is_active_sidebar('content-top-sidebar')){
echo '<div class="content-top-sidebar-wrap">';
dynamic_sidebar( 'content-top-sidebar' );
echo '</div>';
} ?>
<div class="main-content-col">
<div class="main-content-col-body">
<?php if(is_active_sidebar('content-top-sidebar')){
echo '<div class="content-top-sidebar-wrap">';
dynamic_sidebar( 'content-top-sidebar' );
echo '</div>';
} ?>
<div class="single-post-content">                                    	
<h1><?php echo $postObject->post_title; ?></h1>
<?php if(strcmp($postObject->post_content,'')!=0){ ?>
<div class="single_con"> 
<div class="hide_content"><p class="desktop_text"><?php echo wp_trim_words( $postObject->post_content,50) ?></p><p class="mobile_text"><?php echo wp_trim_words( $postObject->post_content,20) ?></p></div>
<div class="full_content"><?php the_content(); ?></div>
<div class="treatment_r_btn"><a class="show_btn" href="#">READ MORE <?php /*?><?php echo  str_replace("What is","","$postObject->post_title");  ?><?php */?></a></div>
<div class="treatment_r_btn"><a class="hide_btn" href="#">READ LESS</a></div>
<?php
$approve = get_field('approved_by',$query,true); 
if(strcmp($approve,'')!=0) {?>
<div class="approve_by"><b>Medically Reviewed by : <?php echo get_field('approved_by',$query); ?></b></div>
<?php } ?>
</div>
<?php } ?>
<script>
$(".full_content").hide();
$(".hide_btn").hide();
$(".show_btn").click(function(e) {
e.preventDefault();
$(this).hide();
$(".hide_btn").show();
$(this).closest(".treatment_r_btn").siblings(".full_content").slideDown(300);
$(this).closest(".treatment_r_btn").siblings(".hide_content").slideUp()
});
$(".hide_btn").click(function(e) {
e.preventDefault();
$(this).hide();
$(".show_btn").show();
$(this).closest(".treatment_r_btn").siblings(".full_content").slideUp(300);
$(this).closest(".treatment_r_btn").siblings(".hide_content").slideDown()
});
</script>
<div class="category-tools channel-list">
</div>
<?php $doctorPremium=array();
$doctorNotPremium=array();
if(isset($doctors[0]))
{ 
foreach($doctors as $doctor)
{
$colors = get_field('premier_doctor',$doctor['doctor']->ID,true);
if( $colors ){
array_push($doctorPremium,$doctor);
}	 else	 {
array_push($doctorNotPremium,$doctor);
}
}
} 
foreach($doctors as $doctor)
{
?>
<div class="doc_one story_sec">
<div class="doc_all afclr">
<div class="doc_video_treatment">
<img src="http://projectstatus.info/cleardoc/wp-content/uploads/2016/12/blank.jpg" alt="">
<?php echo $doctor['videolink_new']; ?>
</div>
<?php $doctorApp=get_post($doctor['doctor']->ID); ?>
<div class="doc_out_t">
<div class="doc_details_t">
<div class="doc_info_t"><?php  
if(strcmp($doctorApp->post_type,'story')!=0)
{
	?><h3><?php echo $doctor['doctor']->post_title;?></h3><?php 
}
else
{
	
	echo $doctor['content'];
}
?>
<div class="address_t_s"><b><?php echo get_field('specialty', $doctor['doctor']->ID,true); ?></b></div>
<div class="address_t" style="width:150px;"><i><?php echo get_field('doctor_address', $doctor['doctor']->ID,true); ?></i></div>
</div>
<div class="p_doc_t">
<?php
// vars	
$colors = get_field('premier_doctor',$doctor['doctor']->ID,true);
if( $colors ): ?>
<img src="http://projectstatus.info/cleardoc/wp-content/uploads/2016/12/premium_doctor.png">
<?php endif; ?>
</div>
<div class="clr"></div>
</div>
<?php 


if(strcmp($doctorApp->post_type,'story')!=0)
{
 ?>
<div class="btn_g afclr">
<div class="doc_btn_t">
<a href="<?php echo get_permalink($doctor['doctor']->ID); ?>?query=<?php echo str_replace(' ','-',$query); ?>"> View Profile</a>
<?php /*?>
<a class="popup_btn appoinment_email" attr-email="<?php echo get_field('doctor_email',$doctor['doctor']->ID,true); ?>"> Make Appoinment</a>
<div class="popup_form">
<div class="close_btn">
<div class="cb_inner">Close</div>
</div>
<?php echo do_shortcode('[contact-form-7 id="1123" title="Appoinment Form"]'); ?>
</div>
<a href="tel:<?php echo get_field('phone_no.',$doctor['doctor']->ID,true); ?>"> Call Now!</a>
<?php */?>
</div>
<?php $DoctorTag = wp_get_post_terms($query, 'post_tag' ); ?>
<div class="doc_tag">
<div class="show_tag">
<?php 
$i=0;
foreach($DoctorTag as $tag)
{
if($i < 3 )
{
?>
<a href="<?php echo get_term_link($tag); ?>"><?php echo $tag->name; ?></a>
<?php  } $i++;}  ?>
</div>
<div class="hide_tag">
<?php 
$i=0;
foreach($DoctorTag as $tag)
{
if($i > 2)
{
?>
<a href="<?php echo get_term_link($tag); ?>"><?php echo $tag->name; ?></a>
<?php  } $i++;}  ?>
</div>
<a class="show_more_btn" href="#"><i class="fa fa-plus" aria-hidden="true"></i>Show More</a>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
<?php } ?>
<script>
jQuery(document).ready(function(e) {
jQuery(".show_more_btn").click(function(e) {
e.preventDefault();
jQuery(this).parent(".doc_tag").children(".hide_tag").css("display","inline-block");
jQuery(this).hide();
});
});
</script>
<?php
// check if the repeater field has rows of data
if( have_rows('stories',$query) ):
// loop through the rows of data
while ( have_rows('stories',$query) ) : the_row(); ?>
<div class="doc_one story_sec">
<div class="doc_all afclr">
<div class="doc_video_treatment">
<img src="http://projectstatus.info/cleardoc/wp-content/uploads/2016/12/blank.jpg" alt="">
<?php echo the_sub_field('story_video',$query); ?>
</div>
<div class="doc_out_t">
<div class="doc_details_t afclr">
<div class="doc_info_t"><h3><?php the_sub_field('story_heading',$query); ?></h3>
<div class="address_t"><?php the_sub_field('story_content',$query); ?></div>
</div>
<div class="clr"></div>
</div>
</div>
</div>
</div>
<?php     endwhile;
else :
// no rows found
endif; ?>
<div class="related_video">
<h3>Premier Doctors</h3>
<div class="doc_p afclr">
<?php $args = array(
'posts_per_page'   => -1,
'offset'           => 0,
'category'         => '',
'orderby'          => 'post_date',
'order'            => 'DESC',
'include'          => '',
'exclude'          => '',
'meta_key'         => '',
'meta_value'       => '',
'post_type'        => 'doctor',
'post_mime_type'   => '',
'post_parent'      => '',
'post_status'      => 'publish',
'suppress_filters' => true ); ?>
<?php $posts_array = get_posts( $args ); 
$i=0;
?> 
<?php foreach($posts_array as $post)
{?>
<?php
if($i < 7)
{
// vars	
$colors = get_field('premier_doctor');
// check
if( $colors ): 
$i++;?>
<div class="doc_p_one afclr">
<a href="<?php echo get_permalink($post->ID); ?>">
<div class="doc_p_img"><?php echo get_the_post_thumbnail( $post->ID, 'docimgp' ); ?></div>
<h5><?php  echo get_the_title(); ?>
<div class="p_tag_doc_s afclr">
<div class="p_tag_doc_s_one">
<div class="specality_doc"><?php the_field("specialty"); ?></div>
<div class="address_doc"><?php the_field("doctor_address"); ?></div>
</div>
<div class="p_tag_doc_s_tag">
<img src="http://projectstatus.info/cleardoc/wp-content/uploads/2016/11/premium-tag.png">
</div>
</div>
</h5>
</a>
</div>
<?php endif; ?>
<?php } } ?>
</div>
</div>
<div class="related_video">
<?php
//for use in the loop, list 5 post titles related to first tag on current post
$tags = wp_get_post_tags($query);
if ($tags) {
echo '<h3>Related Videos</h3>';
$first_tag = $tags[0]->term_id;
$tagArray=array();
foreach($tags as $tag)
{
array_push($tagArray,$tag->term_id);
}
$args=array(
'tag__in' => $tagArray, 
'post__not_in' => array($posts[0]->ID),
'posts_per_page'=>2,
'caller_get_posts'=>1
);
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
while ($my_query->have_posts()) : $my_query->the_post();
$post1=get_post(get_the_ID());
?>
<div class="video_r_one afclr">
<div class="video_r">
<a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'thumbsvideo' ); ?></a>
</div>
<div class="video_c"><h5><a href="<?php echo get_permalink(get_the_ID()); ?>"><?php the_title(); ?></a></h5>
</div>
</div>
<?php
endwhile;
}
wp_reset_query();
}
?>
</div>
</div>
<?php 
if(is_active_sidebar('content-bottom-sidebar')){
echo '<div class="content-bottom-sidebar-wrap">';
dynamic_sidebar( 'content-bottom-sidebar' );
echo '</div>';
} 
?>           
<?php 
$videopro_sidebar_style = 'ct-medium';
videopro_global_sidebar_style($videopro_sidebar_style);
if($videopro_sidebar!='full' && $videopro_sidebar!='left'){  ?>
<?php	} ?>
</div>
</div>
<div class="cactus-sidebar ct-medium sidebar_custom">
<div class="sd_right">
<div class="related_video">
<h3>TRENDING</h3>
<div class="doc_p afclr">
<?php $args = array (
    'cat' => array(327),
    'posts_per_page' => 4, //showposts is deprecated
    'orderby' => 'date',
);

$cat_posts = new WP_query($args) ?>

<?php  if ($cat_posts->have_posts()) : while ($cat_posts->have_posts()) : $cat_posts->the_post();  ?>
      <div class="video_r_one afclr">
<div class="video_r">
<a href="<?php echo get_permalink(get_the_ID()); ?>"><?php echo get_the_post_thumbnail( get_the_ID(), 'thumbs' ); ?></a>
</div>
<div class="video_c"><h5><a href="<?php echo get_permalink(get_the_ID()); ?>"><?php the_title(); ?></a></h5>
</div>
</div>
		
<?php endwhile; endif;   ?>

      

     

     

     </div>
 



  

     </div>

<?php /*?><?php $posts_array = get_posts( $args ); 
$i=0;
?> 
<?php foreach($posts_array as $post)
{?>
<?php
if($i < 7)
{
// vars	
$colors = get_field('premier_doctor');
// check
if( $colors ): 
$i++;?>
<div class="doc_p_one afclr">
<a href="<?php echo get_permalink($post->ID); ?>">
<div class="doc_p_img"><?php echo get_the_post_thumbnail( $post->ID, 'docimgp' ); ?></div>
<h5><?php  echo get_the_title(); ?>
<div class="specality_doc"><?php the_field("specialty"); ?></div>
<div class="address_doc"><?php the_field("doctor_address"); ?></div>
</h5>
</a>
</div>
<?php endif; ?>
<?php } } ?><?php */?>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
<?php get_footer(); ?>