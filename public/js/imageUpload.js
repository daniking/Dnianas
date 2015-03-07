var token = $('input[name=_token]').val();

$('#profilePicture').on('change', function(event) {
    var profilePictureEl = $('#profilePicture');
    var profilePicture = profilePictureEl.get(0).files[0];
   // Check if the browser is supporting the File API.
   if (window.File && window.FileReader && window.FileList && window.Blob) {
        var formData = new FormData();
        formData.append('profile_picture', profilePicture);
        formData.append('_token',token);
        $.ajax({
            url: '/getting_started/step_two/profile_picture',
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            data: formData
        })
        .done(function(data) {
            pictureBox = profilePictureEl.parents(2).next('#pictrigbox');
            pictureBox.empty().prepend('<img id="profilePicturePreview" src="'+ data.image_path +'" />');
        })
        
    } else {
        // If it doesn't support File API.
        alert('Your browser is outdated. Please upgrade your browser to access this functionality!');
    }
    event.preventDefault();
});

$('#coverPhoto').on('change', function(event) {
    var coverPhotoEl = $('#coverPhoto');
    var coverPhoto = coverPhotoEl.get(0).files[0];
   // Check if the browser is supporting the File API.
   if (window.File && window.FileReader && window.FileList && window.Blob) {
        var formData = new FormData();
        formData.append('cover_photo', coverPhoto);
        formData.append('_token',token);
        $.ajax({
            url: '/getting_started/step_two/cover_photo',
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            data: formData
        })
        .done(function(data) {
            if(data.success === 'false') {
                
            }
            pictureBox = coverPhotoEl.parents(2).next('#pictrigbox');
            pictureBox.empty().prepend('<img id="coverPhotoPreview" src="'+ data.image_path +'" />');
        })
        
    } else {
        // If it doesn't support File API.
        alert('Your browser is outdated. Please upgrade your browser to access this functionality!');
    }
    event.preventDefault();
});