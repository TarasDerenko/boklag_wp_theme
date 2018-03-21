<?php
if ( function_exists( 'register_nav_menus' ) )
{
	register_nav_menus(
		array(
			'top-menu'=>__('Header menu')
		)		
	);

	register_nav_menus(
    array(
      'bottom-menu'=>__('Footer menu')
    )
  );
}


