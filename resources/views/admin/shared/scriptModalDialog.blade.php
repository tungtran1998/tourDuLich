<script>
  $(document).on('click','.deletebutton',function(){
    var id=$(this).attr('data-id');
    $('#id').val(id);
  });
</script>