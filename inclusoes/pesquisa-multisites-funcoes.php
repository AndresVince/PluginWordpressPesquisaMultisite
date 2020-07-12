<?php
/*
 * Adiciona ao Admin Control Panel (ACP)
 */

 //  Usa o action hook 'admin_menu', roda a função 'mmp_Adiciona_Admin_Link()'
defined( 'ABSPATH' ) or die( 'Crianças, não brinquem com script!' );


function procuramultisite($pesquisa) {
	$listasites = array ( 2, 3, 4);
	$qsites = count($listasites);
    //for ( $i=1; $i<=$qsites; $i++) {
	foreach ($listasites as $i=>$valor_i) {
		switch_to_blog($valor_i);
        $blog_id = get_current_blog_id(); 
        $args = array(
            's'					=>$pesquisa,
            'orderby'			=>'date',
            'order'				=>'DESC',
			'posts_per_page'	=>-1,
            );
			$busca_blog = new WP_Query( $args );
			$procura = $busca_blog->posts;
        //if ( $busca[$e]->have_posts() ) {
        //for ($g = 0; $g<=(count($resulta));$g++) {
		//$testethumb = 'ID=' . $transeunte->post->ID;
			
		foreach ($procura as $chave=>$valor_chave) {
			//$caminhothumb = $valor_chave->ID;
			//$transeunte = $caminhothumb;
			$temthumb = has_post_thumbnail($valor_chave->ID);
			$busca[] = array ($valor_chave->post_date, $valor_chave->post_name, $blog_id, $temthumb);
			//$datadopost = $resulta[$f]->post_date;   
            //if (!empty ($datadopost)) {
           // }
		}
		wp_reset_postdata();
        restore_current_blog();
	}
	usort($busca,function($b, $a){ if ($a==$b) return 0; return ($a<$b)?-1:1;});
	/*switch ($maisnovo) {
		case 'sim':
			$numposts = 1;
			break;
		case 'nao':
			$numposts = (count($manchete));
			break;
	}*/
	
	do_action( 'wp_body_open' ); 
	codigodapagina( $busca, $pesquisa);

	//começa aqui 
	/* $pesquisa = $_POST['s']; 
	if ($pesquisa != NULL) {
	procuramultisite($pesquisa);
	$pesquisa= NULL;
	return;
	}
	else {	
		return;
	}
	//termina aqui
	//$teste = ;
	// apply_filters( 'get_search_form', 'searchform.php' );
	//var_dump(get_search_query());
	//var_dump(count($posts));
	//var_dump($posts->post->post_title);
	//var_dump($pesquisa);
	*/
	//get_search_form ();
}


function codigodapagina($busca, $pesquisa) {
//get_header(); 
//global $post;
//$numposts = count($posts->posts);
?>
<main id="main" class="site-main" role="main">

			<header class="page-header">
				<h3 class="osresul">
				<?php
				/* translators: %s: The search query. */
				$numposts = count($busca);
				print_r($numposts . ' ');
				printf( __( 'Search Results for: %s', 'twentysixteen' ), '<span class="page-title">' . $pesquisa . '</span>' );
				?>
				</h3>
			<?php the_posts_pagination(
				array(
					'prev_text'          => __( 'Previous page', 'twentysixteen' ),
					'next_text'          => __( 'Next page', 'twentysixteen' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
				)
			);
			?>
			</header><!-- .page-header -->
			<?php
			if(!empty($busca)) :
				//$testemime = get_allowed_mime_types();
				//print_r($testemime);
				//var_dump($transeunte);
				//var_dump($busca[0][3]);
				//echo '<br>';
				
				foreach ($busca as $chave) {
						$refpost = $chave[1];
						$blog = $chave[2];
						$temthumb =  $chave[3];

					switch ($temthumb) {
						case '0':
							$leiout = 'buscasemfoto';
							break;
						case '1':
							$leiout = 'buscacomfoto';
							break;
						default:
							$leiout = 'buscasemfoto';
							break;
					}
					// AQUI COMEÇA O CODE DO OUTPUT
					echo '<div style="margin: 0; float: none; padding: 0;">'. do_shortcode('[gknsp article_cols="1" article_rows="1" cache_time="0" data_source_type="wp-post" data_source="' . $refpost . '" data_source_blog = "' . $blog .'" article_format="' . $leiout . '.format" orderby="date" order="DESC" article_wrapper="default" article_block_padding = "0" offset = "0" use_css = "on" article_title_len_type="words" article_title_len="30" article_text_len_type="words" article_text_len="100" article_readmore_state="on"  article_readmore_order="6" article_info_date_format="j/F/Y" ]') . '</div>';
				}
				$busca[] = NULL;
					//print_r($busca->$query);
					//var_dump($refpost);
					//var_dump($blog);
					//print_r($temthumb);
					//echo '<br>';
					//print_r(count($busca[$i][0]->posts));
					//var_dump(count($busca[$i][0]->posts));
					//var_dump($busca[$i][0]->posts);
					//var_dump(count($busca[$i][0]->posts));
					
				// If no content, include the "No posts found" template.
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;		
				// AQUI TERMINA O CODE DO OUTPUT
				
				//while ( $posts->have_posts() ) :
				//global $post;
				//setup_postdata($post);
				//while (list($i, $post) = each($posts)) :
				//the_post();
				//get_template_part( 'template-parts/content', 'search' );
	
			// FIM do WHILE dos posts;
			//endwhile;	
			// don't forget to restore the main queried object after the loop!
			// wp_reset_postdata();
			// Previous/next page navigation.
			
			the_posts_pagination(
				array(
					'prev_text'          => __( 'Previous page', 'twentysixteen' ),
					'next_text'          => __( 'Next page', 'twentysixteen' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
				)
			);

		
		?>
</main><!-- .site-main -->
	<!-- .content-area -->
<?php
return;
}
