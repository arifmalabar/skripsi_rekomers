export function showMsg(title, text, status) {
    Swal.fire({
        title: title,
        text: text,
        icon: status,
    });
}
export function showDlg(title, text, btntext) {
    return Swal.fire({
        title: title,
        text: text,
        icon: "question",
        showCancelButton: true,
        confirmButtonText: btntext,
    });
}
