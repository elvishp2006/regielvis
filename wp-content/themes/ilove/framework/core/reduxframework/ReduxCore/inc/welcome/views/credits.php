<div class="wrap about-wrap">
    <h1><?php esc_html_e( 'Redux Framework - A Community Effort', 'redux-framework' ); ?></h1>

    <div
        class="about-text"><?php esc_html_e( 'We recognize we are nothing without our community. We would like to thank all of those who help Redux to be what it is. Thank you for your involvement.', 'redux-framework' ); ?></div>
    <div
        class="redux-badge"><i
            class="el el-redux"></i><span><?php printf( esc_html__( 'Version %s', 'redux-framework' ), ReduxFramework::$_version ); ?></span>
    </div>

    <?php $this->actions(); ?>
    <?php $this->tabs(); ?>

    <p class="about-description"><?php esc_html_e( 'Redux is created by a community of developers world wide. Want to have your name listed too? <a href="#" target="_blank">Contribute to Redux</a>.', 'redux-framework' ); ?></p>

    <?php echo $this->contributors(); ?>
</div>