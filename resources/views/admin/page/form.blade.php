<div class="box-body">
    <!-- text input -->
    <div class="form-group">
        <label>หัวข้อ</label>
        <input name="title" type="text" class="form-control" value="{{ @$rs->title }}">
    </div>

    <div class="form-group">
        <label>รายละเอียด</label>
        <textarea name="detail" class="form-control tinymce" rows="15">{{ @$rs->detail }}</textarea>
    </div>

</div>

<!-- /.box-body -->
<div class="box-footer">
    <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
    <button type="submit" class="btn btn-info pull-right">บันทึกข้อมูล</button>
</div>
<!-- /.box-footer -->

<script src = "{{ URL::to('js/tinymce_file_manager/tinymce/tinymce.min.js') }}"></script>
<script>
tinymce.init({
    selector: "textarea.tinymce",theme: "modern",
        height: 400,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons paste textcolor responsivefilemanager code" ],
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
    toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
    image_advtab: true ,
    external_filemanager_path:"/js/tinymce_file_manager/filemanager/",
    filemanager_title:"Responsive Filemanager" ,
    external_plugins: { "filemanager" : "../filemanager/plugin.min.js"}
    ,relative_urls:false,
    remove_script_host:false
});
</script>
