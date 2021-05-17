<script>
  function readURL(file){
    if(file.files && file.files[0]){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#preview_avatar').attr('src',e.target.result);
      }
      reader.readAsDataURL(file.files[0]);
    }
  };
  $("#image").change(function(){
    readURL(this)
  })
</script>