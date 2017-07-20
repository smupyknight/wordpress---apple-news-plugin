<?php

	function generate_apple_news_format($id, $post) {

		global $settings;

		$byline = ucfirst( get_the_author_meta( 'display_name', $post->post_author ) ) . ' | ' . date( 'M j, Y | g:i A', strtotime( $post->post_date ) );
		$article_from = '[' . $post->post_title . '](' . $post->guid . '?utm_source=apple&amp;utm_medium=cpc) is an article from: [' . stripslashes( $settings->site_title ) . '](' . get_site_url() . '?utm_source=apple&amp;utm_medium=cpc)';

		$news_format = 
			'	{																										' .
			'		"version": "1.1",																					' .
			'		"identifier": "post-' . $id . '",																	' .
			'		"language": "en",																					' .
			'		"title": ' . json_encode( $post->post_title ) . ',													' .
			'		"documentStyle": {																					' .
			'			"backgroundColor": "#fafafa"																	' .
			'		},																									' .
			'		"layout": {																							' .
			'			"columns": 7,																					' .
			'			"width": 1024,																					' .
			'			"margin": 100,																					' .
			'			"gutter": 20																					' .
			' 		},																									' .
			' 		"components": [																						' .
			'			{																								' .
			'				"role": "title",																			' .
			'				"text": ' . json_encode( $post->post_title ) . ',											' .
			'				"textStyle": "default-title",																' .
			'				"layout": "title-layout"																	' .
			'			},																								' .
			' 			{																								' .
			'				"role": "header",																			' .
			'				"layout": "headerBelowTextPhotoLayout",														' .
			'				"components": [																				' .
			'					{																						' .
			'						"role": "photo",																	' .
			'						"layout": "headerPhotoLayout",														' .
			'						"URL": "' . get_the_post_thumbnail_url($id) . '"									' .
			'					}																						' .
			'				],																							' .
			'				"behavior": {																				' .
			'					"type": "parallax",																		' .
			'					"factor": 0.8																			' .
			'				}																							' .
			'			},																								' .
			'			{																								' .
			'				"role": "container",																		' .
			'				"layout": {																					' .
			'					"columnSpan": 7,																		' .
			'					"columnStart": 0,																		' .
			'					"ignoreDocumentMargin": true 															' .
			'				},																							' .
			'				"style": {																					' .
			'					"backgroundColor": "#fafafa"															' .
			'				},																							' .
			'				"components": [																				' .
			'					{																						' .
			'						"role": "byline",																	' .
			'						"text": "by ' . $byline . '",												' .
			'						"textStyle": "default-byline",														' .
			'						"layout": "byline-layout"															' .
			'					},																						' .
			'					{																						' .
			'						"role": "body",																		' .
			'						"text": ' . json_encode( substr( $post->post_content, 0, 300) . '...' ) . ',		' .
			'						"format": "markdown",																' .
			'						"textStyle": "dropcapBodyStyle",													' .
			'						"layout": "body-layout"																' .
			'					},																						' .
			'					{																						' .
			'						"role": "body",																		' .
			'						"text": "[Click here to continue and read more...](' . $post->guid . ')",			' .
			'						"format": "markdown",																' .
			'						"textStyle": "default-body",														' .
			'						"layout": "body-layout"																' .
			'					},																						' .
			'					{																						' .
			'						"role": "body",																		' .
			'						"text": ' . json_encode( $article_from ) . ',										' .
			'						"format": "markdown",																' .
			'						"textStyle": "default-body",														' .
			'						"layout": "body-layout-last"														' .
			'					}																						' .
			'				]																							' .
			'			}																								' .
			'		],																									' .
			'		"componentTextStyles": {																			' .
			'			"dropcapBodyStyle": {																			' .
			'				"textAlignment": "left",																	' .
			'				"fontName": "AvenirNext-Regular",															' .
			'				"fontSize": 18,																				' .
			'				"tracking": 0,																				' .
			'				"lineHeight": 24,																			' .
			'				"textColor": "#000000",																		' .
			'				"linkStyle": {																				' .
			'					"textColor": "#428bca"																	' .
			'				},																							' .
			'				"paragraphSpacingBefore": 18,																' .
			'				"paragraphSpacingAfter": 18,																' .
			'				"dropCapStyle": {																			' .
			'					"numberOfLines": 4,																		' .
			'					"numberOfCharacters": 1,																' .
			'					"padding": 5,																			' .
			'					"fontName": "Georgia-Bold",																' .
			'					"textColor": "#000000",																	' .
			'					"numberOfRaisedLines": 0																' .
			'				}																							' .
			'			},																								' .
			'			"default-body": {																				' .
			'				"textAlignment": "left",																	' .
			'				"fontName": "AvenirNext-Regular",															' .
			'				"fontSize": 18,																				' .
			'				"tracking": 0,																				' .
			'				"lineHeight": 24,																			' .
			'				"textColor": "#000000",																		' .
			'				"linkStyle": {																				' .
			'					"textColor": "#428bca"																	' .
			'				},																							' .
			'				"paragraphSpacingBefore": 18,																' .
			'				"paragraphSpacingAfter": 18																	' .
			'			},																								' .
			'			"default-title": {																				' .
			'				"fontName": "AvenirNext-Bold",																' .
			'				"fontSize": 48,																				' .
			'				"lineHeight": 52,																			' .
			'				"tracking": 0,																				' .
			'				"textColor": "#000000",																		' .
			'				"textAlignment": "left"																		' .
			'			},																								' .
			'			"default-byline": {																				' .
			'				"textAlignment": "left",																	' .
			'				"fontName": "AvenirNext-Medium",															' .
			'				"fontSize": 17,																				' .
			'				"lineHeight": 24,																			' .
			'				"tracking": 0,																				' .
			'				"textColor": "#53585f"																		' .
			'			}																								' .
			'		},																									' .
			'		"componentLayouts": {																				' .
			'			"body-layout": {																				' .
      		'				"columnStart": 0,																			' .
      		'				"columnSpan": 6,																			' .
      		'				"margin": {																					' .
        	'					"top": 12,																				' .
        	'					"bottom": 12																			' .
      		'				}																							' .
    		'			},																								' .
    		'			"body-layout-last": {																			' .
      		'				"columnStart": 0,																			' .
      		'				"columnSpan": 6,																			' .
      		'				"margin": {																					' .
        	'					"top": 12,																				' .
        	'					"bottom": 30																			' .
      		'				}																							' .
    		'			},																								' .
    		'			"title-layout": {																				' .
      		'				"margin": {																					' .
        	'					"top": 30,																				' .
        	'					"bottom": 0																				' .
      		'				}																							' .
    		'			},																								' .
    		'			"headerPhotoLayout": {																			' .
      		'				"ignoreDocumentMargin": true,																' .
      		'				"columnStart": 0,																			' .
      		'				"columnSpan": 7																				' .
    		'			},																								' .
    		'			"headerBelowTextPhotoLayout": {																	' .
      		'				"ignoreDocumentMargin": true,																' .
      		'				"columnStart": 0,																			' .
      		'				"columnSpan": 7,																			' .
      		'				"margin": {																					' .
        	'					"top": 30,																				' .
        	'					"bottom": 0																				' .
      		'				}																							' .
    		'			},																								' .
    		'			"byline-layout": {																				' .
      		'				"margin": {																					' .
        	'					"top": 10,																				' .
        	'					"bottom": 10																			' .
      		'				},																							' .
      		'				"columnStart": 0,																			' .
      		'				"columnSpan": 7																				' .
    		'			}																								' .
    		'		},																									' .
    		'		"metadata": {																						' .
    		'			"excerpt": ' . json_encode( $post->post_excerpt ) . ',											' .
    		'			"thumbnailURL": "' . get_the_post_thumbnail_url($id) . '",										' .
    		'			"dateCreated": "' . date( 'c', strtotime( get_gmt_from_date( $post->post_date ) ) ) . '",		' .
    		'			"dateModified": "' . date( 'c', strtotime( get_gmt_from_date( $post->post_modified ) ) ) . '",	' .
    		'			"datePublished": "' . date( 'c', strtotime( get_gmt_from_date( $post->post_date ) ) ) . '",		' .
    		'			"canonicalURL": "' . $post->guid . '",															' .
    		'			"generatorIdentifier": "bp-apple-news",															' .
    		'			"generatorName": "Publish to Apple News",														' .
    		'			"generatorVersion": "1.2.7"																		' .
    		'		},																									' .
    		'		"advertisingSettings": {																			' .
    		'			"frequency": 1,																					' .
    		'			"layout": {																						' .
      		'				"margin": {																					' .
        	'					"top": 15,																				' .
        	'					"bottom": 15																			' .
      		'				}																							' .
    		'			}																								' .
  			'		}																									' .
			'	}																										';

		return $news_format;
	}

