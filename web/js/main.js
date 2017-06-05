$(document).ready(function () {
    
    $('.uploadButton').on('click', function() {
        $('#add-photos').click();
    });

    $('#add-photos').on('change', function() {
            if (this.files) {
                $('.img-prev').remove();
                var filesAmount = this.files.length;
                if (filesAmount > 5) {filesAmount=5;}
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).attr('class', 'img-prev').appendTo('.prev');
                    }
                    reader.readAsDataURL(this.files[i]);
                }
            }
    });
     
});