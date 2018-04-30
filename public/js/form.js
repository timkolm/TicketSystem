$(document).ready(function() { 
  $("#addFile").on('click', function (e) {
    e.preventDefault();
    $('#attachemens').append(`<div class="form-group">
    <label for="file">Attach a file:</label>
    <input type="file" name="files[]">
  </div>`)
  });
});