var save_label;
var table;

$(document).ready(function() {
  ajaxcsrf();

  table = $("#themescourses").DataTable({
    initComplete: function() {
      var api = this.api();
      $("#themescourses_filter input")
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
      url: base_url + "themescourses/data",
      type: "POST"
    },
    columns: [
      {
        data: "id",
        orderable: false,
        searchable: false
      },
      { data: "name_courses" }
    ],
    columnDefs: [
      {
        targets: 2,
        searchable: false,
        orderable: false,
        title: "themes",
        data: "name_themes",
        render: function(data, type, row, meta) {
          let courses = data.split(",");
          let badge = [];
          $.each(courses, function(i, val) {
            var newcourses = `<span class="badge bg-green">${val}</span>`;
            badge.push(newcourses);
          });
          return badge.join(" ");
        }
      },
      {
        targets: 3,
        searchable: false,
        orderable: false,
        data: "id_courses",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
									<a href="${base_url}themescourses/edit/${data}" class="btn btn-warning btn-xs">
										<i class="fa fa-pencil"></i> Ред.
									</a>
								</div>`;
        }
      },
      {
        targets: 4,
        data: "id_courses",
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
    .appendTo("#themescourses_wrapper .col-md-6:eq(0)");

  $("#myModal").on("shown.modal.bs", function() {
    $(':input[name="banyak"]').select();
  });

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

  $("#themescourses tbody").on("click", "tr .check", function() {
    var check = $("#themescourses tbody tr .check").length;
    var checked = $("#themescourses tbody tr .check:checked").length;
    if (check === checked) {
      $(".select_all").prop("checked", true);
    } else {
      $(".select_all").prop("checked", false);
    }
  });

  $("#bulk").on("submit", function(e) {
    if ($(this).attr("action") == base_url + "themescourses/delete") {
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
  if ($("#themescourses tbody tr .check:checked").length == 0) {
    Swal({
      title: "Ошибка",
      text: "Не выбраны данные.",
      type: "error"
    });
  } else {
    $("#bulk").attr("action", base_url + "themescourses/delete");
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
