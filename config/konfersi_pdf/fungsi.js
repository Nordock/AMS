jQuery(document).ready(function(){
	$('.masukan').focus(function(){
			isiAsli = $(this).attr('title');
			if($(this).val()==isiAsli){
				$(this).val('').addClass('aktif');
			}
			else{
				$(this).val()=$(this).val()
				}
			});
		$('.masukan').blur(function(){
			isiAsli=$(this).attr('title');
			if($(this).val()=='')
			$(this).removeClass('aktif').val(isiAsli);
			else
			$(this).addClass('aktif');
			});
	 $('form').submit(function(e){
		 e.preventDefault();
		 periksaIsian();
		 });
});

function periksaIsian(){
	var nama = $('.nama').val();
	var uang = $('.uang').val();
	var untuk = $('.pembayaran').val();
	var petugas = $('.petugas').val();
	var peringatan = "Kotak isian belum diisi semua! \nMohon lengkapi.";
	
	if(nama==''||nama==$('.nama').attr('title')||untuk==''||untuk==$('.pembayaran').attr('title')||petugas==''||petugas==$('.petugas').attr('title')){
		alert(peringatan);
		}
	else if(isNaN(uang))
		alert("Uang harus dalam bentuk angka!");
	else{
		window.open("cetak.php?nm="+nama+"&jml="+uang+"&utk="+untuk+"&pet="+petugas);
		}
	}
