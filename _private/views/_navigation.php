<ul>
        <li>
            <a href="<?php echo url( 'home' ) ?>"<?php if ( current_route_is( 'home' ) ): ?> class="active"<?php endif ?>>Home</a>
            <a href="<?php echo url( 'registreren' ) ?>"<?php if ( current_route_is( 'registreren' ) ): ?> class="active"<?php endif ?>>Registreren</a>
                <?php if(isLoggedIn()):?>
                    <?php echo getLoggedInUserEmail(); ?>
                <?php endif;?>
                    <?php if(isLoggedIn()):?>
                        <a href="<?php echo url( 'logout' ) ?>">Uitloggen</a>
                    <?php else:  ?>
                        <a href="<?php echo url( 'login.form' ) ?>"<?php if ( current_route_is( 'login.form' ) ): ?> class="active"<?php endif ?>>Inloggen</a>
                <?php endif;?>
            </li>                     
</ul>

