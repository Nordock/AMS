/*
Name: 			Tables / Advanced - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.3.0

	$('#datatable-default').dataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": "modul/mod_daftarjamaah/json_jamaah.php"
		} );
*/

(function( $ ) {

	'use strict';

	var datatableInit = function() {
		
		$('#datatable-pembayaran').dataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": "modul/mod_pembayaran/json_pembayaran.php"
		} );

	};

	$(function() {
		datatableInit();
	});

}).apply( this, [ jQuery ]);