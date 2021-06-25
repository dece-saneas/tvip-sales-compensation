// Back to Top
$(document).ready(function(){
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('#back-to-top').fadeIn();
		} else {
			$('#back-to-top').fadeOut();
		}
	});
	$('#back-to-top').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 200);
		return false;
	}); 
});

// File Upload Preview
$(document).ready(function(){
    var input = document.getElementById( 'upload' );
    var infoArea = document.getElementById( 'upload-label' );

    // show file name
    input.addEventListener( 'change', showFileName );
    function showFileName( event ) {
        var input = event.srcElement;
        var fileName = input.files[0].name;
        infoArea.textContent = fileName;
    }

    $(function () {
        $('#upload').on('change', function () {
            readURL(input);
        });
    });
    
    //show image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imageResult')
                    .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
});

// Select
$(document).ready(function(){
    $(".select").select2({
        placeholder: "Select"
    });
});

// Modal Confirm Delete
$('#DeleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var uri = button.data('uri')
    // var modal = $(this)
    
    // modal.find('.modal-title').text(uri)
    
    $("#DeleteForm").attr("action", uri);
})

// Daterangepicker
$(document).ready(function(){
    $('#period').daterangepicker({
        timePicker: true,
        timePicker24Hour: true,
        drops: 'auto',
        locale: {
            format: 'Y-MM-DD HH:mm:ss',
            separator: ' / ',
        }
    })
});