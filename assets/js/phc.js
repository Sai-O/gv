$(document).ready(function(){

	/*
	======================================================================================
		* INTERFACE
	======================================================================================
	*/

	// nav responsive
	window.nav = function() {
	    var a = $("#top .ct");
	    $(window).scrollTop() > 240 ? a.addClass("nav") : a.removeClass("nav"), $(window).scrollTop() >= $("#top").offset().top && $("#game").offset().top - 60 > $(window).scrollTop() ? ($("a[data-go]").parent("li").removeClass("active"), $('a[data-go="#top"]').parent("li").addClass("active")) : $(window).scrollTop() >= $("#game").offset().top - 60 && $("#chance").offset().top - 60 > $(window).scrollTop() ? ($("a[data-go]").parent("li").removeClass("active"), $('a[data-go="#game"]').parent("li").addClass("active")) : $(window).scrollTop() >= $("#chance").offset().top - 60 && $("#avis").offset().top - 60 > $(window).scrollTop() ? ($("a[data-go]").parent("li").removeClass("active"), $('a[data-go="#chance"]').parent("li").addClass("active")) : $(window).scrollTop() >= $("#avis").offset().top - 60 && $("footer[role=footer]").offset().top - 60 > $(window).scrollTop() && ($("a[data-go]").parent("li").removeClass("active"), $('a[data-go="#avis"]').parent("li").addClass("active")), $(window).scrollTop() >= 0 && $(window).width() < 780 ? a.addClass("nav") : $(window).scrollTop() > 240 && $(window).width() >= 780 ? a.addClass("nav") : a.removeClass("nav")
	}, nav(), $(window).scroll(function() {
	    nav()
	}), $(window).resize(function() {
	    nav()
	});

	//data-nav
	window.navDown = function(){
		var a = $('nav');
		if($(a).css('top') != '-400px'){
			a.stop().animate({'top': '-400', 'opacity': 0,},300);
		}else{
			a.stop().animate({'top': 0, 'opacity': 1,},600);
		}
	}
	$('[data-nav]').on('click', function(){
		navDown();
		return false;
	});

	// scroll smooth
	$("[data-go]").on("click", function() {
		if($('nav').css('opacity') == 1){navDown()}
	    var a = $(this).attr("data-go"),
	        b = 750;
	    return $("html, body").stop().animate({
	        scrollTop: $(a).position().top - 60
	    }, b), !1
	});

	/*
	======================================================================================
		* SELECT
	======================================================================================
	*/

		$("select").each(function() {
		    $(this).hide();
		    var a = $(this).attr("name"),
		        b = $(this).attr("data-price");
		    $(this).before('<ul id="' + a + '" class="select" data-price="' + b + '"><li selected></li></ul>');
		    var c = $("ul[id=" + a + "]");
		    $(this).children("option").each(function() {
		        var d = $(this).text(),
		            e = $(this).attr("value"),
		            g = ($(this).attr("data-icon"), $(this).attr("selected"));
		        if (c.append("<li value=" + e + ">" + d + "</li>"), "selected" == g && ($('ul[id="' + a + '"] li[selected]').html(d).attr("value", e), "qty" == a)) {
		            var h = b * e;
		            $("[data-price-v]").html(h.toFixed(2))
		        }
		    })
		}), $("ul.select").on("click", function() {
		    var a = $(this).children("li").length,
		        b = $(this).attr("id"),
		        c = $(this).height();
		    y = $(this).children("li").height(), h = a * y, y >= c ? ($(this).stop().animate({
		        height: 220,
		    }, 400).addClass('overflow'), "qty" == b && $("table").addClass("s")) : ($(this).stop().animate({
		        height: y
		    }, 10).removeClass('overflow').scrollTop(0), "qty" == b && $("table").removeClass("s"))
		}), $("ul.select li").on("click", function() {
		    var a = $(this).text(),
		        b = $(this).attr("value"),
		        c = $(this).attr("data-icon"),
		        e = ($(this).attr("selected"), $(this).parent("ul").attr("id")),
		        f = $(this).parent("ul").attr("data-price"),
		        g = $("ul[id=" + e + "]").children("li[selected]");
		    g.attr("value", b), g.html('<i class="' + c + '"></i> ' + a), $("select[name=" + e + "] option[selected=selected]").removeAttr("selected"), $("select[name=" + e + "] option[value=" + b + "]").attr("selected", "selected"), $(this).parent("ul").stop().animate({
		        height: 30
		    }, 10), "qty" == e && (pt = f * b, $("[data-price-v]").html(pt.toFixed(2)))
		});

});

/*
======================================================================================
	* POPUP
======================================================================================
*/
/*
function popup(id) {

	if(id == 1) {
		var email = document.getElementById("email").value;
		var plateforme = document.getElementById("plateforme").value;
		var quantite = document.getElementById("quantite").value;
		var paiement = document.getElementById("paiement").value;

		if(email !== '') {
			document.getElementById("email").style.border='1px solid #e5e5e5';
			if(document.getElementById("facebook")) {
				document.getElementById("facebook").style.display='none';
			}
			//document.getElementById("action").innerHTML='<div id="popup" onclick="popup(2)"><div id="cadre"><div id="closep" onclick="popup(2)"><img src="/template/img/close.png" alt="Close" /></div><div id="frame"><iframe src="/commande?email='+email+'&plateforme='+plateforme+'&quantite='+quantite+'&paiement='+paiement+'" scrolling="yes" frameborder="0" allowfullscreen></iframe></div></div></div>';
			document.location.href='/commande?email='+email+'&plateforme='+plateforme+'&quantite='+quantite+'&paiement='+paiement+'';
		} else {
			document.getElementById("email").style.border='1px solid #ff0000';
		}

	}

	if(id == 2) {
		document.getElementById("action").innerHTML='';
		if(document.getElementById("facebook")) {
			document.getElementById("facebook").style.display='block';
		}
	}

}*/

/*
======================================================================================
	* NAV DISPLAY
======================================================================================
*/

function menuc(id) {
	var el = document.getElementById(id);

	if( el && el.style.display == 'block') {
		el.style.display = 'none';
	}
	else {
		el.style.display = 'block';
	}
}

/*
======================================================================================
	* PAYMENT AFF
======================================================================================
*/

function paiement() {
	var montant = document.getElementById("montant").value;

	if(montant < 20) {
		document.getElementById("montant").style.border='1px solid #ff0000';
		return false;
	}
	else {
		alert('Si votre solde est supérieur à 20€, veuillez nous contacter pour demander votre paiement. Ecrivez-nous l\'adresse e-mail de votre compte affilié, la méthode de paiement et le montant à : contact@playhappyclub.com');
		return false;
	}
}