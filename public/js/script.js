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

// Modal Order
$(document).ready(function(){
    $('#OrderModal').on('show.bs.modal', function (event) {
        var modal = $(this)
        var button = $(event.relatedTarget)
        var uri = button.data('uri')
        var img = button.data('img')
        var brand = button.data('brand')
        var variant = button.data('variant')
        var stock = button.data('stock')
        var product = button.data('product')

        modal.find('.card-title').text(brand);
        modal.find('.card-text').text(variant);
        modal.find('.modal-photo').attr("src", img);
        modal.find('.quantity').attr("max", stock);
        modal.find('.product').attr("value", product);

        $("#OrderForm").attr("action", uri);
    })
})

// Modal Claim
$(document).ready(function(){
    $('#ClaimModal').on('show.bs.modal', function (event) {
        var modal = $(this)
        var button = $(event.relatedTarget)
        var img = button.data('img')
        var uri = button.data('uri')
        var reward = button.data('reward')
        var max = button.data('max')
        
        modal.find('.modal-photo').attr("src", img);
        modal.find('.reward').attr("value", reward);
        modal.find('.quantity').attr("max", max);

        $("#ClaimForm").attr("action", uri);
    })
})

// Modal Edit Cart
$(document).ready(function(){
    $('#EditModal').on('show.bs.modal', function (event) {
        var modal = $(this)
        var button = $(event.relatedTarget)
        var uri = button.data('uri')
        var quantity = button.data('quantity')
        var max = button.data('max')

        modal.find('.quantity').attr("value", quantity);
        modal.find('.quantity').attr("max", max);

        $("#EditForm").attr("action", uri);
    })
})

// Modal Upload Bukti
$('#UploadModal').on('show.bs.modal', function (event) {
    var modal = $(this)
    var button = $(event.relatedTarget)
    var uri = button.data('uri')
    var bank = button.data('bank')
    var name = button.data('name')
    var account = button.data('account')
    var attach = button.data('attachment')
    
    $("#UploadForm").attr("action", uri);
    modal.find('.bank').attr("value", bank); 
    modal.find('.account').attr("value", account);
    modal.find('.name').attr("value", name);
    modal.find('.attach').attr("src", attach);
    
    if(bank) {
        modal.find('.bank').prop('disabled', true);
        modal.find('.account').prop('disabled', true);
        modal.find('.name').prop('disabled', true);
        modal.find('.upload').prop('disabled', true);
        modal.find('.btn-success').prop('disabled', true);
    }
              
    
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