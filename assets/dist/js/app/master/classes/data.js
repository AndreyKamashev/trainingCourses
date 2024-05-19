var save_label;
var table;

$(document).ready(function() {
  ajaxcsrf();

  table = $("#classes").DataTable({
    initComplete: function() {
      var api = this.api();
      $("#classes_filter input")
        .off(".DT")
        .on("keyup.DT", function(e) {
          api.search(this.value).draw();
        });
    },
    dom:
      "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [
      {
        extend: "copy",
        exportOptions: { columns: [1, 2] }
      },
      {
        extend: "print",
        exportOptions: { columns: [1, 2] }
      },
      {
        extend: "excel",
        exportOptions: { columns: [1, 2] }
      },
      {
        extend: "pdf",
        exportOptions: { columns: [1, 2] }
      }
    ],
    oLanguage: {
      sProcessing: "загрузка...",
	  sUrl: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: base_url + "classes/data",
      type: "POST"
      //data: csrf
    },
    columns: [
      {
        data: "id_classes",
        orderable: false,
        searchable: false
      },
      { data: "name_classes" },
      { data: "name_themes" },
      {
        data: "bulk_select",
        orderable: false,
        searchable: false
      }
    ],
    order: [[1, "asc"]],
    rowId: function(a) {
      return a;
    },
    rowCallback: function(row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
      $("td:eq(0)", row).html(index);
    }
  });

  table
    .buttons()
    .container()
    .appendTo("#classes_wrapper .col-md-6:eq(0)");

  $("#myModal").on("shown.modal.bs", function() {
    $(':input[name="banyak"]').select();
  });

  $("#select_all").on("click", function() {
    if (this.checked) {
      $(".check").each(function() {
        this.checked = true;
      });
    } else {
      $(".check").each(function() {
        this.checked = false;
      });
    }
  });

  $("#classes tbody").on("click", "tr .check", function() {
    var check = $("#classes tbody tr .check").length;
    var checked = $("#classes tbody tr .check:checked").length;
    if (check === checked) {
      $("#select_all").prop("checked", true);
    } else {
      $("#select_all").prop("checked", false);
    }
  });

  $("#bulk").on("submit", function(e) {
    if ($(this).attr("action") == base_url + "classes/delete") {
      e.preventDefault();
      e.stopImmediatePropagation();

      $.ajax({
        url: $(this).attr("action"),
        data: $(this).serialize(),
        type: "POST",
        success: function(respon) {
          if (respon.status) {
            Swal({
              title: "Успешно",
              text: respon.total + " данные успешно удалены.",
              type: "success"
            });
          } else {
            Swal({
              title: "Ошибка",
              text: "Не выбраны данные.",
              type: "error"
            });
          }
          reload_ajax();
        },
        error: function() {
          Swal({
            title: "Ошибка",
            text: "Данные используются.",
            type: "error"
          });
        }
      });
    }
  });
});

function load_themes() {
  var themes = $('select[name="name_themes"]');
  themes.children("option:not(:first)").remove();

  ajaxcsrf(); // get csrf token
  $.ajax({
    url: base_url + "themes/load_themes",
    type: "GET",
    success: function(data) {
      //console.log(data);
      if (data.length) {
        var datathemes;
        $.each(data, function(key, val) {
          datathemes = `<option value="${val.id_themes}">${val.name_themes}</option>`;
          themes.append(datathemes);
        });
      }
    }
  });
}

function bulk_delete() {
  if ($("#classes tbody tr .check:checked").length == 0) {
    Swal({
      title: "Ошибка",
      text: "Не выбраны данные.",
      type: "error"
    });
  } else {
    $("#bulk").attr("action", base_url + "classes/delete");
    Swal({
      title: "Вы уверены?",
      text: "Данные будут удалены!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Удалить"
    }).then(result => {
      if (result.value) {
        $("#bulk").submit();
      }
    });
  }
}

function bulk_edit() {
  if ($("#classes tbody tr .check:checked").length == 0) {
    Swal({
      title: "Ошибка",
      text: "Не выбраны данные.",
      type: "error"
    });
  } else {
    $("#bulk").attr("action", base_url + "classes/edit");
    $("#bulk").submit();
  }
}
