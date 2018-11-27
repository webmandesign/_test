<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site"><div id="content" class="site-content">

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						<?php edit_post_link( '[ Edit ]'); ?>
					</header>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</article>

				<?php
			endwhile;
		else :
			echo 'No content here&hellip;';
		endif;
		?>
		</main>
	</div>

</div>
<?php wp_footer(); ?>
</body>
</html>
