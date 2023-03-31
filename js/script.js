var myCarousel = document.querySelector('#carouselExampleDark')
var carousel = new bootstrap.Carousel(myCarousel, {
  interval: 2000,
  wrap: false
})
const contactForm = document.querySelector("form#contactForm");

function submitCform() {
document.querySelector("form#contactForm #mybtn").disabled = "true"
document.querySelector("form#contactForm #mybtn").value = 'Please wait...'

var formdata = new FormData(contactForm);

formdata.append('action', 'submitmyform') 
AjaxCform(formdata) 
}

async function AjaxCform(formdata) {
  const url = location.protocol+ '//'+ window.location.hostname +'/wp-admin/admin-ajax.php?action=submitmyform'
  const response = await fetch(url, {
      method: 'POST',
      body: formdata,
  });
  const data = await response.json();
	
	if (data['statuse'] == 'ok'){			
			document.querySelector("form#contactForm").innerHTML = `<div id="success">
			${data['reply']}
			</div>`			
	} else if (data['statuse'] == 'er') {
			document.querySelector("form#contactForm span#status").innerHTML = `<div id="er">
			Ops, ${data['reply']}
			</div>`
			document.querySelector("form#contactForm #mybtn").disabled = false
			document.querySelector("form#contactForm #mybtn").value = 'Try again'
	}}	