export function showInformation(backgroud, title, message) {
    $(".information-status").removeClass("alert-danger");
    $(".information-status").addClass(backgroud);
    $(".information-title").text(title);
    $(".information-message").text(message);
}
