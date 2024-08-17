<script src="https://cdn.tiny.cloud/1/16o2l3g14itqyeqcq7yomy706m53lwbg9vu627stkyk25z36/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

{{-- <script src="https://cdn.tiny.cloud/1/rztfu7tkyrfllts5q71asfnui6eq4zu35gn6iwyquo5vyxzn/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}

<script>
  var editor_config = {
    path_absolute : "/",
    selector: 'textarea.tinymce',
    relative_urls: false,
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
  
    file_picker_callback : function(callback, value, meta) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
      if (meta.filetype == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.openUrl({
        url : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no",
        onMessage: (api, message) => {
          callback(message.content);
        }
      });
    }
  };

  tinymce.init(editor_config);
</script>