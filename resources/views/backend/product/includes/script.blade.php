<script>
    $("#title").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#slug").val(Text);
    });
    $(document).ready(function() {
        $('#category_id').change(function() {
            var category = $(this).val();
            // alert(category);
            var path = "{{URL::route('backend.category.getSubcategory')}}";
            $.ajax({
                url:path,
                data: {'category_id':category,'_token':$('meta[name="csrf-token"]').attr('content')},
                method:'post',
                dataType : 'text',
                success:function(response) {
                    // console.log(response);
                    $('#subcategory_id').empty();
                    $('#subcategory_id').append(response);

                }
            });
        })
    });
</script>
