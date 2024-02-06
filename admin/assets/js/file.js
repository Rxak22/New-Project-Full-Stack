function previewBeforeUpload(id) {
    document.querySelector("#"+id).addEventListener("change", function (e) {
      if (e.target.files.length == 0) return;
      let file = e.target.files[0];
      let url = URL.createObjectURL(file);
      document.querySelector("label[for="+id+"] img").src = url;
      // Revoke the URL when it's not needed
      e.target.addEventListener("loadend", function () {
        URL.revokeObjectURL(url);
      });
    });
  }
  previewBeforeUpload("file");

  // control two in one form file ima
function previewBeforeUpload2(id) {
    document.querySelector("#"+id).addEventListener("change", function (e) {
      if (e.target.files.length == 0) return;
      let file = e.target.files[0];
      let url = URL.createObjectURL(file);
      document.querySelector("label[for="+id+"] img").src = url;
      // Revoke the URL when it's not needed
      e.target.addEventListener("loadend", function () {
        URL.revokeObjectURL(url);
      });
    });
  }
  previewBeforeUpload2("files");