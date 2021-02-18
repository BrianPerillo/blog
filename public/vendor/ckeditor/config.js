/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {

	//config.uiColor = '#00FFFF';
	config.extraPlugins = ['embed','embedbase','youtube', 'image2'];
	//config youtube
	config.embed_provider = '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}';
	config.allowedContent = true;
	//config image2
	config.image2_alignClasses = [ 'image-left', 'image-center', 'image-right' ];
	config.image2_captionedClass = 'image-captioned';
	//remove plugins
	config.removePlugins = 'image';
};
