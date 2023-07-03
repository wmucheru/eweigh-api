$(document).ready(function () {
    /* Image cropper */
    var cropImg = document.getElementById('crop-img'),
        cropImgOriginal = document.getElementById('crop-img-original'),
        cropBtn = document.getElementById('crop-btn'),
        uploadModal = $('#image-upload-modal'),
        uploadBtn = document.getElementById('upload-btn'),
        cropBoxData,
        canvasData,
        cropper;

    if (uploadBtn !== null) {
        uploadBtn.addEventListener('change', function (e) {
            var files = e.target.files,
                reader, file,
                done = function (url) {
                    uploadBtn.value = '';
                    cropImg.src = url;

                    uploadModal.modal('show');

                    cropper = new Cropper(cropImg, {
                        viewMode: 3,
                        ready: function () {
                            cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                        }
                    })
                };

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                }
                else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        cropImg.addEventListener('cropend', function (e) {
            cropBoxData = cropper.getCropBoxData()
            canvasData = cropper.getCanvasData()
        })

        cropBtn.addEventListener('click', function (e) {
            var cropImgOriginalURL = cropImg.src,
                canvas = cropper.getCroppedCanvas(),
                formData = new FormData();

            cropImg.src = canvas.toDataURL();
            formData.append('image', canvas.toDataURL())

            $.ajax(siteURL + 'site/processUpload', {
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                xhr: function () {
                    var xhr = new XMLHttpRequest();

                    xhr.upload.onprogress = function (e) {
                        var percent = '0',
                            percentage = '0%';

                        if (e.lengthComputable) {
                            percent = Math.round((e.loaded / e.total) * 100);
                            percentage = percent + '%';

                            // console.log('Upload progress: ' + percentage);
                        }
                    };
                    return xhr;
                },

                success: function (data) {
                    cropImgOriginal.src = data.url;

                    // close modal
                    $('.close').click();
                },

                error: function () {
                    cropImgOriginal.src = cropImgOriginalURL;
                    // console.log('Error during upload')
                },

                complete: function () {
                    // console.log('Upload complete')
                },
            });
        })
    }
})