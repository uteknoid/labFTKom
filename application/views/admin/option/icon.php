<!DOCTYPE html>
<html>
<head>
  <title>PHP Crop Image Before Upload using Cropper JS</title>
  <meta name="_token" content="{{ csrf_token() }}">
  <script src="<?php echo base_url('assets/crop/'); ?>jquery.js"></script>
  <link rel="stylesheet" href="<?php echo base_url('assets/crop/'); ?>bootstrap.min.css"/>
  <script src="<?php echo base_url('assets/crop/'); ?>bootstrap.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url('assets/crop/'); ?>cropper.css"/>
  <script src="<?php echo base_url('assets/crop/'); ?>cropper.js"></script>
</head>
<style type="text/css">
  img {
    display: block;
    max-width: 100%;
    height: 100%;
  }
  .preview {
    overflow: hidden;
    width: 150px; 
    height: 150px;
    margin: 10px;
    border: 1px solid #ff0000;
  }
  .modal-lg{
    max-width: 1000px !important;
  }

  .seret{
    justify-content: center;
  }

  .file{
    position: relative;
    overflow: hidden;
    max-width: 800px;
    min-width: 480px;
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 2%;
    cursor: pointer;
    border: 1px dashed #000000;

  }

  .file:hover{
    filter: opacity(20%);
    background-color: grey;
    color: white;
  }
  .file input.image{
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 2rem;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
    max-width: 800px;
    min-width: 480px;
    height: 300px;
  }

</style>
<body onload="gikon()">
  <div class="modal fade" id="modalikon" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Ganti Ikon</h5>
          <button type="button" onclick="window.close()" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="img-container">
            <div class="seret row">
              <form method="post">
                <div class="file">
                  <span>Klik atau Seret dan Jatuhkan file untuk mengunggah</span>
                  <input type="file" name="image" accept="image/*" class="image">
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="window.close()" data-dismiss="modal">Keluar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Sesuaikan Ikon</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="img-container">
            <div class="row">
              <div class="col-md-8">
                <img id="image" src="<?php echo base_url('assets/img/icon.png'); ?>">
              </div>
              <div class="col-md-4">
                <div class="preview"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="crop">Crop</button>
        </div>
      </div>
    </div>
  </div>

</div>
</div>
<script>

  function gikon(){
    var $modalikon = $('#modalikon');
    $modalikon.modal('show');
  }

  var $modal = $('#modal');
  var image = document.getElementById('image');
  var cropper;
  
  $("body").on("change", ".image", function(e){
    var files = e.target.files;
    var done = function (url) {
      image.src = url;
      $modal.modal('show');
    };
    var reader;
    var file;
    var url;

    if (files && files.length > 0) {
      file = files[0];

      if (URL) {
        done(URL.createObjectURL(file));
      } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function (e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }
  });

  $modal.on('shown.bs.modal', function () {
    cropper = new Cropper(image, {
      aspectRatio: 1,
      viewMode: 1,
      preview: '.preview'
    });
  }).on('hidden.bs.modal', function () {
   cropper.destroy();
   cropper = null;
 });

  $("#crop").click(function(){
    canvas = cropper.getCroppedCanvas({
      width: 800,
      height: 800,
    });

    canvas.toBlob(function(blob) {
      url = URL.createObjectURL(blob);
      var reader = new FileReader();
      reader.readAsDataURL(blob); 
      reader.onloadend = function() {
        var base64data = reader.result;  
        
        $.ajax({
          type: "POST",
          dataType: "json",
          url: "<?php echo base_url() . 'admin/saveicon'; ?>",
          data: {image: base64data},
          success: function(data){
            console.log(data);
            $modal.modal('hide');
            alert("Icon Berhasil Diganti");

            var $modalikon = $('#modalikon');
            $modalikon.modal('hide');

            window.close();
          }
        });
      }
    });
  })

</script>
</body>
</html>