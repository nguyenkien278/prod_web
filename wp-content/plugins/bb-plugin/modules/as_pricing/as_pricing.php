<?php

/**
 * @class FLPricingModule
 */
class FLPricingModule extends FLBuilderModule {

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          	=> __('Pricing 3.0', 'fl-builder'),
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
FLBuilder::register_module('FLPricingModule', array(
	'general'       => array(
		'title'         => __('General', 'fl-builder'),
		'sections'      => array(
			'general'       => array(
				'title'         => '',
				'fields'        => array(
					'pricings'        => array(
						'type'          => 'form',
						'label'         => __('Pricing', 'fl-builder'),
						'form'          => 'content_slider_pricing', // ID from registered form below
						'preview_text'  => 'name', // Name of a field to use for the preview text
						'multiple'      => true
					)
				)
			)
		)
	)
));

/**
 * Register the slide settings form.
 */
FLBuilder::register_settings_form('content_slider_pricing', array(
	'title' => __('Pricing Settings', 'fl-builder'),
	'tabs'  => array(
		'general'        => array( // Tab
			'title'         => __('General', 'fl-builder'), // Tab title
			'sections'      => array( // Tab Sections
				'general'       => array(
					'title'     => 'Defaults',
					'fields'    => array(
						'name'         => array(
							'type'          => 'text',
							'label'         => __('Pricing Name', 'fl-builder')
						),
                        'bg_photo'      => array(
                            'type'          => 'photo',
                            'label'         => __('Pricing Icon', 'fl-builder')
                        )
					)
				)
			)
		),
		'monthly'        => array(
			'title'         => __( 'Monthly','fl-builder' ),
			'sections'      => array(
				'build'   => array(
					'title'         => 'Build APP Monthly',
					'fields'        => array(
						'monthly_price'  => array(
							'type'          => 'text',
							'label'         => 'Price'
						),
                        'monthly_heading' => array(
                            'type'          => 'text',
                            'label'         => 'Heading'
                        ),
						'monthly_subtext' => array(
							'type'          => 'text',
							'label'         => 'Description'
						),
                        'monthly_table_background'  => array(
                            'type'          => 'color',
                            'default'       => '#999999',
                            'label'         => 'Table background'
                        )
					)
				),
                'button'   => array(
                    'title'         => 'Button',
                    'fields'        => array(
                        'monthly_button_text'  => array(
                            'type'          => 'text',
                            'label'         => 'Text'
                        ),
                        'monthly_button_url'  => array(
                            'type'          => 'text',
                            'label'         => 'Url'
                        ),
                        'monthly_button_background'  => array(
                            'type'          => 'color',
                            'default'       => '#999999',
                            'label'         => 'Background'
                        )
                    )
                ),
                'features'   => array(
                    'title'         => 'Features',
                    'fields'        => array(
                        'monthly_feature0'  => array(
                            'type'          => 'text'
                        ),
                        'monthly_feature1'  => array(
                            'type'          => 'text'
                        ),
                        'monthly_feature2'  => array(
                            'type'          => 'text'
                        ),
                        'monthly_feature3'  => array(
                            'type'          => 'text'
                        ),
                        'monthly_feature4'  => array(
                            'type'          => 'text'
                        ),
                        'monthly_feature5'  => array(
                            'type'          => 'text'
                        ),
                        'monthly_feature6'  => array(
                            'type'          => 'text'
                        ),
                        'monthly_feature7'  => array(
                            'type'          => 'text'
                        ),
                        'monthly_feature8'  => array(
                            'type'          => 'text'
                        ),
                        'monthly_feature9'  => array(
                            'type'          => 'text'
                        )
                    )
                )
			)
		),
        'yearly'        => array(
            'title'         => __( 'Yearly','fl-builder' ),
            'sections'      => array(
                'build'   => array(
                    'title'         => 'Build APP Yearly',
                    'fields'        => array(
                        'yearly_price'  => array(
                            'type'          => 'text',
                            'label'         => 'Price'
                        ),
                        'yearly_heading' => array(
                            'type'          => 'text',
                            'label'         => 'Heading'
                        ),
                        'yearly_subtext' => array(
                            'type'          => 'text',
                            'label'         => 'Description'
                        ),
                        'yearly_table_background'  => array(
                            'type'          => 'color',
                            'default'       => '#999999',
                            'label'         => 'Table background'
                        )
                    )
                ),
                'button'   => array(
                    'title'         => 'Button',
                    'fields'        => array(
                        'yearly_button_text'  => array(
                            'type'          => 'text',
                            'label'         => 'Text'
                        ),
                        'yearly_button_url'  => array(
                            'type'          => 'text',
                            'label'         => 'Url'
                        ),
                        'yearly_button_background'  => array(
                            'type'          => 'color',
                            'default'       => '#999999',
                            'label'         => 'Background'
                        )
                    )
                ),
                'features'   => array(
                    'title'         => 'Features',
                    'fields'        => array(
                        'yearly_feature0'  => array(
                            'type'          => 'text'
                        ),
                        'yearly_feature1'  => array(
                            'type'          => 'text'
                        ),
                        'yearly_feature2'  => array(
                            'type'          => 'text'
                        ),
                        'yearly_feature3'  => array(
                            'type'          => 'text'
                        ),
                        'yearly_feature4'  => array(
                            'type'          => 'text'
                        ),
                        'yearly_feature5'  => array(
                            'type'          => 'text'
                        ),
                        'yearly_feature6'  => array(
                            'type'          => 'text'
                        ),
                        'yearly_feature7'  => array(
                            'type'          => 'text'
                        ),
                        'yearly_feature8'  => array(
                            'type'          => 'text'
                        ),
                        'yearly_feature9'  => array(
                            'type'          => 'text'
                        )
                    )
                )
            )
        ),
        'total'        => array(
            'title'         => __( 'Total','fl-builder' ),
            'sections'      => array(
                'build'   => array(
                    'title'         => 'Total Package',
                    'fields'        => array(
                        'total_price'  => array(
                            'type'          => 'text',
                            'label'         => 'Price'
                        ),
                        'total_heading' => array(
                            'type'          => 'text',
                            'label'         => 'Heading'
                        ),
                        'total_subtext' => array(
                            'type'          => 'text',
                            'label'         => 'Description'
                        ),
                        'total_table_background'  => array(
                            'type'          => 'color',
                            'default'       => '#999999',
                            'label'         => 'Table background'
                        )
                    )
                ),
                'button'   => array(
                    'title'         => 'Button',
                    'fields'        => array(
                        'total_button_text'  => array(
                            'type'          => 'text',
                            'label'         => 'Text'
                        ),
                        'total_button_url'  => array(
                            'type'          => 'text',
                            'label'         => 'Url'
                        ),
                        'total_button_background'  => array(
                            'type'          => 'color',
                            'default'       => '#999999',
                            'label'         => 'Background'
                        )
                    )
                ),
                'features'   => array(
                    'title'         => 'Features',
                    'fields'        => array(
                        'total_feature0'  => array(
                            'type'          => 'text'
                        ),
                        'total_feature1'  => array(
                            'type'          => 'text'
                        ),
                        'total_feature2'  => array(
                            'type'          => 'text'
                        ),
                        'total_feature3'  => array(
                            'type'          => 'text'
                        ),
                        'total_feature4'  => array(
                            'type'          => 'text'
                        ),
                        'total_feature5'  => array(
                            'type'          => 'text'
                        ),
                        'total_feature6'  => array(
                            'type'          => 'text'
                        ),
                        'total_feature7'  => array(
                            'type'          => 'text'
                        ),
                        'total_feature8'  => array(
                            'type'          => 'text'
                        ),
                        'total_feature9'  => array(
                            'type'          => 'text'
                        )
                    )
                )
            )
        ),
        'build'        => array(
            'title'         => __( 'Build','fl-builder' ),
            'sections'      => array(
                'build'   => array(
                    'title'         => 'Build Package',
                    'fields'        => array(
                        'build_price'  => array(
                            'type'          => 'text',
                            'label'         => 'Price'
                        ),
                        'build_heading' => array(
                            'type'          => 'text',
                            'label'         => 'Heading'
                        ),
                        'build_subtext' => array(
                            'type'          => 'text',
                            'label'         => 'Description'
                        ),
                        'build_table_background'  => array(
                            'type'          => 'color',
                            'default'       => '#999999',
                            'label'         => 'Table background'
                        )
                    )
                ),
                'button'   => array(
                    'title'         => 'Button',
                    'fields'        => array(
                        'build_button_text'  => array(
                            'type'          => 'text',
                            'label'         => 'Text'
                        ),
                        'build_button_url'  => array(
                            'type'          => 'text',
                            'label'         => 'Url'
                        ),
                        'build_button_background'  => array(
                            'type'          => 'color',
                            'default'       => '#999999',
                            'label'         => 'Background'
                        )
                    )
                ),
                'features'   => array(
                    'title'         => 'Features',
                    'fields'        => array(
                        'build_feature0'  => array(
                            'type'          => 'text'
                        ),
                        'build_feature1'  => array(
                            'type'          => 'text'
                        ),
                        'build_feature2'  => array(
                            'type'          => 'text'
                        ),
                        'build_feature3'  => array(
                            'type'          => 'text'
                        ),
                        'build_feature4'  => array(
                            'type'          => 'text'
                        ),
                        'build_feature5'  => array(
                            'type'          => 'text'
                        ),
                        'build_feature6'  => array(
                            'type'          => 'text'
                        ),
                        'build_feature7'  => array(
                            'type'          => 'text'
                        ),
                        'build_feature8'  => array(
                            'type'          => 'text'
                        ),
                        'build_feature9'  => array(
                            'type'          => 'text'
                        )
                    )
                )
            )
        )
	)
));