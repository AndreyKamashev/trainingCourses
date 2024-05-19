var table;

$(document).ready(function() {
  ajaxcsrf();

  table = $("#students").DataTable({
    initComplete: function() {
      var api = this.api();
      $("#students_filter input")
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
        exportOptions: { columns: [1, 2, 3, 4, 5] }
      },
      {
        extend: "print",
        exportOptions: { columns: [1, 2, 3, 4, 5] }
      },
      {
        extend: "excel",
        exportOptions: { columns: [1, 2, 3, 4, 5] }
      },
      {
        extend: "pdf",
        exportOptions: { columns: [1, 2, 3, 4, 5] }
      }
    ],
    oLanguage: {
      sProcessing: "загрузка...",
	  sUrl: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: base_url + "students/data",
      type: "POST"
      //data: csrf
    },
    columns: [
      {
        data: "id_students",
        orderable: false,
        searchable: false
      },
      { data: "nim" },
      { data: "name" },
      { data: "email" },
      { data: "name_classes" },
      { data: "name_themes" }
    ],
    columnDefs: [
      {
        searchable: false,
        targets: 6,
        data: {
          id_students: "id_students",
          ada: "ada"
        },
        render: function(data, type, row, meta) {
          let btn;
          if (data.ada > 0) {
            btn = "";
          } else {
            btn = `<button data-id="${data.id_students}" type="button" class="btn btn-xs btn-primary btn-aktif">
								<i class="fa fa-user-plus"></i>
							</button>`;
          }
          return `<div class="text-center">
									<a class="btn btn-xs btn-warning" href="${base_url}students/edit/${data.id_students}">
										<i class="fa fa-pencil"></i> Ред.
									</a>
									${btn}
								</div>`;
        }
      },
      {
        targets: 7,
        data: "id_students",
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
    .appendTo("#students_wrapper .col-md-6:eq(0)");

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

  $("#students tbody").on("click", "tr .check", function() {
    var check = $("#students tbody tr .check").length;
    var checked = $("#students tbody tr .check:checked").length;
    if (check === checked) {
      $(".select_all").prop("checked", true);
    } else {
      $(".select_all").prop("checked", false);
    }
  });

  $("#bulk").on("submit", function(e) {
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
  });

  $("#students").on("click", ".btn-aktif", function() {
    let id = $(this).data("id");

    $.ajax({
      url: base_url + "students/create_user",
      data: "id=" + id,
      type: "GET",
      success: function(response) {
        if (response.msg) {
          var title = response.status ? "Успешно" : "Ошибка";
          var type = response.status ? "success" : "error";
          Swal({
            title: title,
            text: response.msg,
            type: type
          });
        }
        reload_ajax();
      }
    });
  });
});

function bulk_delete() {
  if ($("#students tbody tr .check:checked").length == 0) {
    Swal({
      title: "Ошибка",
      text: "Не выбраны данные.",
      type: "error"
    });
  } else {
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
