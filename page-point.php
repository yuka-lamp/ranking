<?php get_header('2');
/*
Template Name: 評価基準
*/
?>
<div id="content">
<div id="wrapper" class="wrap pa30">
<div id="main">
<div class="main-inner">
<section id="point">
<div class="top-ttl-wrap">
  <h3 class="top-ttl3">Eevaluation</h3>
  <p class="top-ttl3-sub">評価基準</p>
</div>
<div class="point-list">
<table>
<tbody>
<tr>
<th><?php echo get_field('evaluation_01');?></th>
<td><?php echo get_field('txt_01');?></td>
</tr>
<tr>
<th><?php echo get_field('evaluation_02');?></th>
<td><?php echo get_field('txt_02');?></td>
</tr>
<tr>
<th><?php echo get_field('evaluation_03');?></th>
<td><?php echo get_field('txt_03');?></td>
</tr>
<tr>
<th><?php echo get_field('evaluation_04');?></th>
<td><?php echo get_field('txt_04');?></td>
</tr>
<tr>
<th><?php echo get_field('evaluation_05');?></th>
<td><?php echo get_field('txt_05');?></td>
</tr>
</tbody>
</table>
</div>
</section>
</div>
</div>
<?php get_sidebar(); ?>
</div>
</div>
<?php get_footer();
