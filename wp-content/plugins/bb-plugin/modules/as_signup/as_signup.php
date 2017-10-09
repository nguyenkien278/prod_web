<?php

/**
 * @class FLSignupModule
 */
class FLSignupModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Sign up', 'fl-builder'),
			'description'   	=> __('Displays multiple slides with an optional heading and call to action.', 'fl-builder'),
			'category'      	=> __('Amsterdam Standard Modules', 'fl-builder'),
			'partial_refresh'	=> true
		));

		$this->add_css('jquery-bxslider');
		$this->add_js('jquery-bxslider');
	}

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('FLSignupModule', array(
	'general'       => array(
		'title'         => __('General', 'fl-builder'),
		'sections'      => array(
			'general'       => array(
				'title'         => 'Button',
				'fields'        => array(
                    'bt_text'         => array(
                        'type'          => 'text',
                        'label'         => __('Text', 'fl-builder')
                    ),
                    'bt_color'      => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'fl-builder')
                    ),
                    'bt_fcolor'      => array(
                        'type'          => 'color',
                        'label'         => __('Font color', 'fl-builder')
                    )
				)
			),
            'form'       => array(
                'title'         => 'Form',
                'fields'        => array(
                    'bg_form'         => array(
                        'type'          => 'color',
                        'label'         => __('Background', 'fl-builder')
                    ),
                    'bg_radius'      => array(
                        'type'          => 'text',
                        'default'       => '0',
                        'label'         => __('Border radius', 'fl-builder')
                    ),
                    'bg_opacity_form'      => array(
                        'type'          => 'text',
                        'default'       => '100',
                        'label'         => __('Opacity (0-100)', 'fl-builder')
                    ),
                    'font_cform'         => array(
                        'type'          => 'color',
                        'label'         => __('Font color', 'fl-builder')
                    ),
                    'include'      => array(
                        'type'          => 'select',
                        'label'         => __('Include Lightspeed & Google+', 'fl-builder'),
                        'default'       => 'no',
                        'options'       => array(
                            'no'      => __( 'No', 'fl-builder' ),
                            'yes'      => __( 'Yes', 'fl-builder' )
                        ),
                    )
                )
            )
		)
	)
));
