document.getElementById('file-input').addEventListener('change', function(e) {
    var file = e.target.files[0];
    var reader = new FileReader();
  
    reader.onload = function(e) {
      document.getElementById('preview-image').src = e.target.result;
    }
  
    reader.readAsDataURL(file);
  });
  