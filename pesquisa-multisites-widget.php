<?php
/*
 * Adiciona Widget
 */

 //  Usa o action hook 'admin_menu', roda a função 'mmp_Adiciona_Admin_Link()'

function pesquisamultisite_registra_widget() {
    register_widget( 'pesquisamultisite_widget' );
    }
add_action( 'widgets_init', 'pesquisamultisite_registra_widget' );

class pesquisamultisite_widget extends WP_Widget {
   
    function __construct() {
        parent::__construct(
        // widget ID
        'pesquisamultisite_widget',
        // widget name
        __('Pesquisa Multisite', 'pesquisamultisite_widget_domain'),
        // widget description
        array( 'description' => __( 'Pesquisa posts por palavra chave atráves dos subsites e retorna o(s) mais recente(s).', 'pesquisamultisite_widget_domain' ), )
        );
        }

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $minhapesquisa = apply_filters( 'widget_title', $instance['pesq'] );
        echo $args['before_widget'];
        //verifica se tem titulo
        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];
        //saida
        //add_action( 'wp_body_open', 'custom_body_open_code' );
        procuramultisite($minhapesquisa);
        //echo __( '<code>naoenadanao();</code>', 'pesquisamultisite_widget_domain' );
        echo $args['after_widget'];
        }

    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) )
        $title = $instance[ 'title' ];
        else
        $title = __( 'pesquisa Multisite', 'pesquisamultisite_widget_domain' );
        if ( isset( $instance[ 'pesq' ] ) )
        $minhapesquisa = $instance[ 'pesq' ];
        else
        $minhapesquisa = __( 'digite a pesquisa', 'pesquisamultisite_widget_domain' );
        ?>
 
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Titulo:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p><label for="<?php echo $this->get_field_id( 'pesq' ); ?>"><?php _e( 'pesq' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'categoria1' ); ?>" name="<?php echo $this->get_field_name( 'pesq' ); ?>" type="text" value="<?php echo esc_attr( $minhapesquisa ); ?>" />
        </p>
 
        <?php
        }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['pesq'] = ( ! empty( $new_instance['pesq'] ) ) ? strip_tags( $new_instance['pesq'] ) : '';
        return $instance;
        }
}
?>