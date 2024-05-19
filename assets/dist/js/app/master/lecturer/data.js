var table;

$(document).ready(function() {
  ajaxcsrf();

  table = $("#lecturer").DataTable({
    initComplete: function() {
      var api = this.api();
      $("#lecturer_filter input")
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
        exportOptions: { columns: [1, 2, 3, 4] }
      },
      {
        extend: "print",
        exportOptions: { columns: [1, 2, 3, 4] }
      },
      {
        extend: "excel",
        exportOptions: { columns: [1, 2, 3, 4] }
      },
      {
        extend: "pdf",
        exportOptions: { columns: [1, 2, 3, 4] }
      }
    ],
    oLanguage: {
       sProcessing: "загрузка...",
	   sUrl: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: base_url + "lecturer/data",
      type: "POST"
    },
    columns: [
      {
        data: "id_lecturer",
        orderable: false,
        searchable: false
      },
      { data: "nip" },
      { data: "name_lecturer" },
      { data: "email" },
      { data: "name_courses" }
    ],
    columnDefs: [
      {
        searchable: false,
        targets: 5,
        data: {
          id_lecturer: "id_lecturer",
          ada: "ada"
        },
        render: function(data, type, row, meta) {
          let btn;
          if (data.ada > 0) {
            btn = "";
          } else {
            btn = `<button type="button" class="btn btn-aktif btn-primary btn-xs" data-id="${data.id_lecturer}">
								<i class="fa fa-user-plus"></i> Active
							</button>`;
          }
          return `<div class="text-center">
							<a href="${base_url}lecturer/edit/${data.id_lecturer}" class="btn btn-xs btn-warning">
								<i class="fa fa-pencil"></i> Ред.
							</a>
							${btn}
						</div>`;
        }
      },
      {
        targets: 6,
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
    .appendTo("#lecturer_wrapper .col-md-6:eq(0)");

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

  $("#lecturer tbody").on("click", "tr .check", function() {
    var check = $("#lecturer tbody tr .check").length;
    var checked = $("#lecturer tbody tr .check:checked").length;
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
  });

  $("#lecturer").on("click", ".btn-aktif", function() {
    let id = $(this).data("id");

    $.ajax({
      url: base_url + "lecturer/create_user",
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
  if ($("#lecturer tbody tr .check:checked").length == 0) {
    Swal({
      title: "Ошибка",
      text: "Не выбраны данные",
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