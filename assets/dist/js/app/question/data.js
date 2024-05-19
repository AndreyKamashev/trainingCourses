var table;

$(document).ready(function() {
  ajaxcsrf();

  table = $("#question").DataTable({
    initComplete: function() {
      var api = this.api();
      $("#question_filter input")
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
        exportOptions: { columns: [2, 3, 4, 5] }
      },
      {
        extend: "print",
        exportOptions: { columns: [2, 3, 4, 5] }
      },
      {
        extend: "excel",
        exportOptions: { columns: [2, 3, 4, 5] }
      },
      {
        extend: "pdf",
        exportOptions: { columns: [2, 3, 4, 5] }
      }
    ],
    oLanguage: {
      sProcessing: "загрузка...",
	  sUrl: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
    },
    processing: true,
    serverSide: true,
    ajax: {
      url: base_url + "question/data",
      type: "POST"
    },
    columns: [
      {
        data: "id_questions",
        orderable: false,
        searchable: false
      },
      { data: "name_lecturer" },
      { data: "name" },
      { data: "name_questions" },
      { data: "name_answers" },
	  { data: "score" },
	  { data: "date_questions" },
	  { data: "date_answers" }
    ],
    columnDefs: [
      {
        targets: 0,
        data: "id_questions",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
									<input name="checked[]" class="check" value="${data}" type="checkbox">
								</div>`;
        }
      },
      {
        targets: 9,
        data: "id_questions",
        render: function(data, type, row, meta) {
          return `<div class="text-center">
                                
                                <a href="${base_url}question/edit/${data}" class="btn btn-xs btn-warning">
                                    <i class="fa fa-edit"></i> Ред.
                                </a>
                            </div>`;
        }
      }
    ],
    order: [[5, "desc"]],
    rowId: function(a) {
      return a;
    },
    rowCallback: function(row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
      $("td:eq(1)", row).html(index);
    }
  });

  table
    .buttons()
    .container()
    .appendTo("#question_wrapper .col-md-6:eq(0)");

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

  $("#question tbody").on("click", "tr .check", function() {
    var check = $("#question tbody tr .check").length;
    var checked = $("#question tbody tr .check:checked").length;
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
});

function bulk_delete() {
  if ($("#question tbody tr .check:checked").length == 0) {
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