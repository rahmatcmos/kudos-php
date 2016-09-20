<?php

return [

	// The default gateway to use
	'default' => 'stripe',

	// Add in each gateway here
	'gateways' => [
		'stripe' => [
			'driver'  => 'Stripe',
			'options' => [
  			'apiKey' => 'sk_test_uoJ2kbxQ0ZvVTeIA00OPGdT7'
			]
		]
	]

];