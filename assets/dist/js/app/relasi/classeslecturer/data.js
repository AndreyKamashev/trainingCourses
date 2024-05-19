var save_label;
var table;

$(document).ready(function() {
  ajaxcsrf();

  table = $("#classeslecturer").DataTable({
    initComplete: function() {
      var api = this.api();
      $("#classeslecturer_filter input")
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
        exportOptions: { columns: [1, 2, 3] }
      },
      {
        extend: "print",
        exportOptions: { columns: [1, 2, 3] }
      },
      {
        extend: "excel",
        exportOptions: { columns: [1, 2, 3] }
      },
      {
        extend: "pdf",
        exportOptions: { columns: [1, 2, 3] }
      }
    ],
    oLanguage: {
      sProcessing: "загрузка...",
	  sUrl: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: base_url + "classeslecturer/data",
      type: "POST"
    },
    columns: [
      {
        data: "id",
        orderable: false,
        searchable: false
      },
      { data: "nip" },
      { data: "name_lecturer" }
    ],
    columnDefs: [
      {
        targets: 3,
        searchable: false,
        orderable: false,
        title: "classes",
        data: "classes",
        render: function(data, type, row, meta) {
          let classes = data.split(",");
          let badge = [];
          $.each(classes, function(i, val) {
            var newclasses = `<span class="badge bg-green">${val}</span>`;
            badge.push(newclasses);
          });
          return badge.join(" ");
        }
      },
      {
        targets: 4,
        searchable: false,
        orderable: false,
        data: "id_lecturer",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
									<a href="${base_url}classeslecturer/edit/${data}" class="btn btn-warning btn-xs">
										<i class="fa fa-pencil"></i> Ред.
									</a>
								</div>`;
        }
      },
      {
        targets: 5,
        searchable: false,
        orderable: false,
        data: "id_lecturer",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
									<input name="checked[]" class="check" value="${data}" type="checkbox">
								</div>`;
        }
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
    .appendTo("#classeslecturer_wrapper .col-md-6:eq(0)");

  $(".select_all").on("click", function() {
    if (this.checked) {
      $(".check").each(function() {
        this.checked = true;
        $(".select_all").prop("checked", true);
      });
    } else {
      $(".check").each(function() {
        this.checked = false;
        $(".select_all").prop("checked", false);
      });
    }
  });

  $("#classeslecturer tbody").on("click", "tr .check", function() {
    var check = $("#classeslecturer tbody tr .check").length;
    var checked = $("#classeslecturer tbody tr .check:checked").length;
    if (check === checked) {
      $(".select_all").prop("checked", true);
    } else {
      $(".select_all").prop("checked", false);
    }
  });

  $("#bulk").on("submit", function(e) {
    if ($(this).attr("action") == base_url + "classeslecturer/delete") {
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
              text: respon.total + " данные удалены.",
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

function bulk_delete() {
  if ($("#classeslecturer tbody tr .check:checked").length == 0) {
    Swal({
      title: "Ошибка",
      text: "Не выбраны данные.",
      type: "error"
    });
  } else {
    $("#bulk").attr("action", base_url + "classeslecturer/delete");
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