(function ($)
{
  $(document).ready(function ()
  {
    jQuery('.tablaArticulos').sortable({
      axis: 'y',
      update: function (event, ui) {
        var data = {};
        var cat = jQuery(this).closest('.unproducto');
        var catid = cat.attr('idproducto');
        var lista = jQuery(this).sortable('serialize');
        data['catid'] = catid;
        data['lista'] = lista;
        jQuery.ajax({
          data: data,
          type: 'POST',
          url: 'index.php?option=com_autores&controller=ordenar&format=raw&tmpl=component',
          success: function (data) {
            if (data.success) {
              alert('mono loco');
            }
            //jQuery("#resultados").html(data.html);
          }
        });
      }
    });
    $('*[rel=tooltip]').tooltip()

    // Turn radios into btn-group
    $('.radio.btn-group label').addClass('btn');
    $(".btn-group label:not(.active)").click(function ()
    {
      var label = $(this);
      var input = $('#' + label.attr('for'));

      if (!input.prop('checked')) {
        label.closest('.btn-group').find("label").removeClass('active btn-success btn-danger btn-primary');
        if (input.val() == '') {
          label.addClass('active btn-primary');
        } else if (input.val() == 0) {
          label.addClass('active btn-danger');
        } else {
          label.addClass('active btn-success');
        }
        input.prop('checked', true);
      }
    });
    $(".btn-group input[checked=checked]").each(function ()
    {
      if ($(this).val() == '') {
        $("label[for=" + $(this).attr('id') + "]").addClass('active btn-primary');
      } else if ($(this).val() == 0) {
        $("label[for=" + $(this).attr('id') + "]").addClass('active btn-danger');
      } else {
        $("label[for=" + $(this).attr('id') + "]").addClass('active btn-success');
      }
    });
  })
})(jQuery);