(function( $ ){

  $.fn.filemanager = function(type, options) {
    type = type || 'file';

    this.on('click', function(e) {
      var multiple = $(this)[0].hasAttribute("data-multiple") ? $(this).data('multiple') : true;
      var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
      var id_input = $(this).data('input');
      var target_input = $('#' + $(this).data('input'));
      var target_preview = $('#' + $(this).data('preview'));
      window.open(route_prefix + '?type=' + type + '&multiple=' + multiple, 'FileManager', 'width=900,height=600');
      window.SetUrl = function (items) {
        var file_path = items.map(function (item) {
          return item.url;
        }).join(',');

        // set the value of the desired input to image url
        target_input.val('').val(file_path).trigger('change');

        // clear previous preview
        target_preview.html('');

        // set or change the preview image src
          if (items.length > 1 && !multiple) {
              items.splice(1);
          }
        items.forEach(function (item, idx) {
          target_preview.append(
            $('<img onclick="removeImage(\''+id_input+'\','+idx+')" data-idx="'+idx+'" title="Click to Remove">').css('height', '7rem').attr('src', item.thumb_url)
          );
        });

        // trigger change event
        target_preview.trigger('change');
      };
      return false;
    });
  }
})(jQuery);
function removeImage(target_input_id,idx) {
    var target_input = $('#' + target_input_id);
    var images = target_input.val().split(",");
    images.splice(idx, 1);
    target_input.val(images.join(','));
    $('img[data-idx="'+idx+'"]').remove();
}
